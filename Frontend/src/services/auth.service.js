import { api, setAccessToken } from './api';

export const authService = {
  async registerOwner(userData) {
    const response = await api.post('/auth/register/owner', userData);
    if (response.data?.data?.accessToken) {
      setAccessToken(response.data.data.accessToken);
    }
    return response.data;
  },

  async registerVeterinarian(userData) {
    const response = await api.post('/auth/register/veterinarian', userData);
    if (response.data?.data?.accessToken) {
      setAccessToken(response.data.data.accessToken);
    }
    return response.data;
  },

  async registerShelter(userData) {
    const response = await api.post('/auth/register/shelter', userData);
    if (response.data?.data?.accessToken) {
      setAccessToken(response.data.data.accessToken);
    }
    return response.data;
  },

  async login(credentials) {
    const response = await api.post('/auth/login', credentials);
    if (response.data?.data?.accessToken) {
      setAccessToken(response.data.data.accessToken);
    }
    return response.data;
  },

  async refresh() {
    const response = await api.post('/auth/refresh');
    if (response.data?.data?.accessToken) {
      setAccessToken(response.data.data.accessToken);
    }
    return response.data;
  },

  async getMe() {
    const response = await api.get('/auth/me');
    return response.data;
  },

  async logout() {
    try {
      await api.post('/auth/logout');
    } finally {
      setAccessToken(null);
    }
  },

  async logoutAll() {
    try {
      await api.post('/auth/logout-all');
    } finally {
      setAccessToken(null);
    }
  },

  async forgotPassword(data) {
    const response = await api.post('/auth/forgot-password', data);
    return response.data;
  },

  async resetPassword(data) {
    const response = await api.post('/auth/reset-password', data);
    return response.data;
  },

  async verifyEmail(token) {
    const response = await api.get('/auth/verify-email', { params: { token } });
    return response.data;
  },

  // Admin APIs
  async getAdminUsers(params) {
    const response = await api.get('/admin/users', { params });
    return response.data;
  },

  async updateAdminUserStatus(userId, status) {
    const response = await api.patch(`/admin/users/${userId}/status`, { status });
    return response.data;
  },

  async getAdminAuditLogs(params) {
    const response = await api.get('/admin/audit-logs', { params });
    return response.data;
  },

  async getAdminStats() {
    const response = await api.get('/admin/stats');
    return response.data;
  },
};
