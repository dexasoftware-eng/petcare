const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:5000/api/v1';

let accessTokenMemory = null;

export const setAccessToken = (token) => {
  accessTokenMemory = token;
};

export const getAccessToken = () => accessTokenMemory;

let isRefreshing = false;
let failedQueue = [];

const processQueue = (error, token = null) => {
  failedQueue.forEach((prom) => {
    if (error) {
      prom.reject(error);
    } else {
      prom.resolve(token);
    }
  });
  failedQueue = [];
};

async function customFetch(endpoint, options = {}) {
  const url = endpoint.startsWith('http') ? endpoint : `${API_BASE_URL}${endpoint}`;
  const headers = {
    'Content-Type': 'application/json',
    ...(options.headers || {}),
  };

  if (accessTokenMemory && !headers.Authorization) {
    headers.Authorization = `Bearer ${accessTokenMemory}`;
  }

  const fetchOptions = {
    ...options,
    headers,
    credentials: 'include', // Always send and receive cookies across origins
  };

  let response;
  try {
    response = await fetch(url, fetchOptions);
  } catch (netErr) {
    const error = new Error(netErr.message || 'Network error');
    error.isNetworkError = true;
    throw error;
  }

  let responseData = null;
  const contentType = response.headers.get('content-type');
  if (contentType && contentType.includes('application/json')) {
    responseData = await response.json();
  } else {
    responseData = await response.text();
  }

  if (response.ok) {
    return {
      status: response.status,
      data: responseData,
      headers: response.headers,
    };
  }

  // Handle 401 Unauthorized for token refresh retry
  if (
    response.status === 401 &&
    !options._retry &&
    !endpoint.includes('/auth/login') &&
    !endpoint.includes('/auth/refresh')
  ) {
    if (isRefreshing) {
      return new Promise((resolve, reject) => {
        failedQueue.push({ resolve, reject });
      }).then((token) => {
        const retryHeaders = {
          ...options.headers,
          Authorization: `Bearer ${token}`,
        };
        return customFetch(endpoint, { ...options, headers: retryHeaders, _retry: true });
      });
    }

    isRefreshing = true;

    try {
      const refreshResponse = await fetch(`${API_BASE_URL}/auth/refresh`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
      });

      if (!refreshResponse.ok) {
        throw new Error('Session expired');
      }

      const refreshData = await refreshResponse.json();
      const newAccessToken = refreshData.data?.accessToken;
      setAccessToken(newAccessToken);
      processQueue(null, newAccessToken);

      const retryHeaders = {
        ...options.headers,
        Authorization: `Bearer ${newAccessToken}`,
      };
      return customFetch(endpoint, { ...options, headers: retryHeaders, _retry: true });
    } catch (refreshErr) {
      processQueue(refreshErr, null);
      setAccessToken(null);
      window.dispatchEvent(new CustomEvent('petguard:auth-expired'));
      const error = new Error('Session expired');
      error.response = { status: 401, data: responseData };
      throw error;
    } finally {
      isRefreshing = false;
    }
  }

  const err = new Error(responseData?.message || `Request failed with status ${response.status}`);
  err.response = {
    status: response.status,
    data: responseData,
  };
  throw err;
}

export const api = {
  get: (url, config = {}) => {
    let finalUrl = url;
    if (config.params) {
      const queryParams = new URLSearchParams();
      Object.entries(config.params).forEach(([key, val]) => {
        if (val !== undefined && val !== null && val !== '') {
          queryParams.append(key, val);
        }
      });
      const qs = queryParams.toString();
      if (qs) {
        finalUrl += (url.includes('?') ? '&' : '?') + qs;
      }
    }
    return customFetch(finalUrl, { method: 'GET', ...config });
  },

  post: (url, data, config = {}) => {
    return customFetch(url, {
      method: 'POST',
      body: data ? JSON.stringify(data) : undefined,
      ...config,
    });
  },

  put: (url, data, config = {}) => {
    return customFetch(url, {
      method: 'PUT',
      body: data ? JSON.stringify(data) : undefined,
      ...config,
    });
  },

  patch: (url, data, config = {}) => {
    return customFetch(url, {
      method: 'PATCH',
      body: data ? JSON.stringify(data) : undefined,
      ...config,
    });
  },

  delete: (url, config = {}) => {
    return customFetch(url, { method: 'DELETE', ...config });
  },
};
