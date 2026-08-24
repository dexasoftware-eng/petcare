import React, { createContext, useContext, useState, useEffect, useCallback } from 'react';
import { authService } from '../services/auth.service';
import { setAccessToken } from '../services/api';

const AuthContext = createContext(null);

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);
  const [isLoading, setIsLoading] = useState(true);
  const [authError, setAuthError] = useState(null);

  const checkAuth = useCallback(async () => {
    setIsLoading(true);
    setAuthError(null);
    try {
      // First attempt to refresh token via HttpOnly cookie
      const refreshRes = await authService.refresh();
      if (refreshRes.success && refreshRes.data?.user) {
        setUser(refreshRes.data.user);
        return refreshRes.data.user;
      }
    } catch {
      // If refresh fails or user has no session, clear user state
      setUser(null);
      setAccessToken(null);
    } finally {
      setIsLoading(false);
    }
    return null;
  }, []);

  useEffect(() => {
    checkAuth();

    const handleAuthExpired = () => {
      setUser(null);
      setAccessToken(null);
    };

    window.addEventListener('furshield:auth-expired', handleAuthExpired);
    return () => window.removeEventListener('furshield:auth-expired', handleAuthExpired);
  }, [checkAuth]);

  const login = async (email, password) => {
    setIsLoading(true);
    setAuthError(null);
    try {
      const response = await authService.login({ email, password });
      if (response.success && response.data?.user) {
        setUser(response.data.user);
        return response.data.user;
      }
      throw new Error(response.message || 'Login failed');
    } catch (err) {
      const message = err.response?.data?.message || err.message || 'Login failed';
      setAuthError(message);
      throw err;
    } finally {
      setIsLoading(false);
    }
  };

  const registerOwner = async (data) => {
    setIsLoading(true);
    setAuthError(null);
    try {
      const response = await authService.registerOwner(data);
      if (response.success && response.data?.user) {
        setUser(response.data.user);
        return response.data.user;
      }
      throw new Error(response.message || 'Registration failed');
    } catch (err) {
      const message = err.response?.data?.message || err.message || 'Registration failed';
      setAuthError(message);
      throw err;
    } finally {
      setIsLoading(false);
    }
  };

  const registerVet = async (data) => {
    setIsLoading(true);
    setAuthError(null);
    try {
      const response = await authService.registerVeterinarian(data);
      if (response.success && response.data?.user) {
        setUser(response.data.user);
        return response.data.user;
      }
      throw new Error(response.message || 'Registration failed');
    } catch (err) {
      const message = err.response?.data?.message || err.message || 'Registration failed';
      setAuthError(message);
      throw err;
    } finally {
      setIsLoading(false);
    }
  };

  const registerShelter = async (data) => {
    setIsLoading(true);
    setAuthError(null);
    try {
      const response = await authService.registerShelter(data);
      if (response.success && response.data?.user) {
        setUser(response.data.user);
        return response.data.user;
      }
      throw new Error(response.message || 'Registration failed');
    } catch (err) {
      const message = err.response?.data?.message || err.message || 'Registration failed';
      setAuthError(message);
      throw err;
    } finally {
      setIsLoading(false);
    }
  };

  const logout = async () => {
    try {
      await authService.logout();
    } finally {
      setUser(null);
    }
  };

  const logoutAll = async () => {
    try {
      await authService.logoutAll();
    } finally {
      setUser(null);
    }
  };

  const updateUser = (updater) => {
    setUser((prev) => (typeof updater === 'function' ? updater(prev) : { ...prev, ...updater }));
  };

  const value = {
    user,
    role: user?.role || null,
    isAuthenticated: Boolean(user),
    isLoading,
    authError,
    setAuthError,
    login,
    registerOwner,
    registerVet,
    registerShelter,
    logout,
    logoutAll,
    checkAuth,
    updateUser,
  };

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
};

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};
