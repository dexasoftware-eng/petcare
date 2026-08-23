const API_BASE_URL = 'http://localhost:5000/api';

/**
 * Universal Fetch Helper with error handling and fallback cache
 */
async function fetchAPI(endpoint, options = {}) {
  try {
    const response = await fetch(`${API_BASE_URL}${endpoint}`, {
      headers: {
        'Content-Type': 'application/json',
        ...options.headers
      },
      ...options
    });
    
    if (!response.ok) {
      throw new Error(`API error: ${response.status} ${response.statusText}`);
    }
    
    const result = await response.json();
    return result.data !== undefined ? result.data : result;
  } catch (error) {
    console.warn(`Fetch error for ${endpoint}, falling back to local dataset:`, error.message);
    throw error;
  }
}

// Products API
export const getProductsAPI = async (params = {}) => {
  const query = new URLSearchParams(params).toString();
  return fetchAPI(`/products${query ? `?${query}` : ''}`);
};

export const getProductByIdAPI = async (id) => {
  return fetchAPI(`/products/${id}`);
};

// Services API
export const getServicesAPI = async (highlight = false) => {
  return fetchAPI(`/services${highlight ? '?highlight=true' : ''}`);
};

export const getServiceByIdAPI = async (id) => {
  return fetchAPI(`/services/${id}`);
};

// Categories API
export const getCategoriesAPI = async () => {
  return fetchAPI('/categories');
};

// Team API
export const getTeamAPI = async () => {
  return fetchAPI('/team');
};

// Blog API
export const getBlogPostsAPI = async (params = {}) => {
  const query = new URLSearchParams(params).toString();
  return fetchAPI(`/blog${query ? `?${query}` : ''}`);
};

export const getBlogPostByIdAPI = async (id) => {
  return fetchAPI(`/blog/${id}`);
};

export const addCommentAPI = async (postId, commentData) => {
  return fetchAPI(`/blog/${postId}/comments`, {
    method: 'POST',
    body: JSON.stringify(commentData)
  });
};

// Orders API
export const createOrderAPI = async (orderData) => {
  return fetchAPI('/orders', {
    method: 'POST',
    body: JSON.stringify(orderData)
  });
};

// Inquiries / Contact API
export const createInquiryAPI = async (inquiryData) => {
  return fetchAPI('/inquiries', {
    method: 'POST',
    body: JSON.stringify(inquiryData)
  });
};
