import axios from 'axios';

const API_BASE_URL = 'http://localhost:5000/api';

// Create Axios Client
const apiClient = axios.create({
  baseURL: API_BASE_URL,
  timeout: 8000,
  headers: {
    'Content-Type': 'application/json'
  }
});

// Helper for requests with error interception
async function request(endpoint, options = {}) {
  try {
    const response = await apiClient(endpoint, options);
    return response.data?.data !== undefined ? response.data.data : response.data;
  } catch (error) {
    console.warn(`Axios request to ${endpoint} failed, continuing with fallback:`, error.message);
    throw error;
  }
}

// Products API
export const getProductsAPI = async (params = {}) => {
  return request('/products', { params });
};

export const getProductByIdAPI = async (id) => {
  return request(`/products/${id}`);
};

// Services API
export const getServicesAPI = async (highlight = false) => {
  return request('/services', { params: highlight ? { highlight: 'true' } : {} });
};

export const getServiceByIdAPI = async (id) => {
  return request(`/services/${id}`);
};

// Categories API
export const getCategoriesAPI = async () => {
  return request('/categories');
};

// Team API
export const getTeamAPI = async () => {
  return request('/team');
};

// Blog API
export const getBlogPostsAPI = async (params = {}) => {
  return request('/blog', { params });
};

export const getBlogPostByIdAPI = async (id) => {
  return request(`/blog/${id}`);
};

export const addCommentAPI = async (postId, commentData) => {
  return request(`/blog/${postId}/comments`, {
    method: 'POST',
    data: commentData
  });
};

// Orders API
export const createOrderAPI = async (orderData) => {
  return request('/orders', {
    method: 'POST',
    data: orderData
  });
};

// Inquiries / Contact API
export const createInquiryAPI = async (inquiryData) => {
  return request('/inquiries', {
    method: 'POST',
    data: inquiryData
  });
};

export default apiClient;
