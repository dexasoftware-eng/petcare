import React, { useEffect } from 'react';
import { useAuth } from '../../context/AuthContext';
import { useNavigate } from '../../router/Router';
import { getRoleDashboardPath } from './RoleRoute';

export default function GuestRoute({ children }) {
  const { user, isAuthenticated, isLoading } = useAuth();
  const navigate = useNavigate();

  useEffect(() => {
    if (!isLoading && isAuthenticated && user) {
      const dashboardPath = getRoleDashboardPath(user.role);
      navigate(dashboardPath);
    }
  }, [isAuthenticated, isLoading, user, navigate]);

  if (isLoading) {
    return (
      <div
        className="d-flex flex-column align-items-center justify-content-center"
        style={{ minHeight: '60vh', padding: '60px 0' }}
      >
        <div
          className="spinner-border"
          role="status"
          style={{ width: '3rem', height: '3rem', color: '#fa441d' }}
        >
          <span className="visually-hidden">Loading...</span>
        </div>
      </div>
    );
  }

  if (isAuthenticated) {
    return null;
  }

  return children;
}
