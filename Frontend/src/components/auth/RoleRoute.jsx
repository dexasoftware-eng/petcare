import React, { useEffect } from 'react';
import { useAuth } from '../../context/AuthContext';
import { useNavigate, Link } from '../../router/Router';

export const getRoleDashboardPath = (role) => {
  switch (role) {
    case 'admin':
      return '/admin/dashboard';
    case 'veterinarian':
      return '/veterinarian/dashboard';
    case 'shelter':
      return '/shelter/dashboard';
    case 'owner':
    default:
      return '/owner/dashboard';
  }
};

export default function RoleRoute({ allowedRoles = [], children }) {
  const { user, isAuthenticated, isLoading } = useAuth();
  const navigate = useNavigate();

  useEffect(() => {
    if (!isLoading) {
      if (!isAuthenticated) {
        navigate('/login');
      }
    }
  }, [isAuthenticated, isLoading, navigate]);

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
        <p className="mt-3 text-muted" style={{ fontWeight: 500 }}>
          Verifying security authorizations...
        </p>
      </div>
    );
  }

  if (!isAuthenticated) {
    return null;
  }

  if (allowedRoles.length > 0 && !allowedRoles.includes(user?.role)) {
    const userDashboard = getRoleDashboardPath(user?.role);
    return (
      <section className="gap" style={{ padding: '100px 0' }}>
        <div className="container text-center">
          <div
            className="p-5 mx-auto"
            style={{
              maxWidth: '600px',
              backgroundColor: '#fff8e5',
              borderRadius: '20px',
              border: '1px solid #fed8b1',
            }}
          >
            <div
              style={{
                width: '80px',
                height: '80px',
                lineHeight: '80px',
                borderRadius: '50%',
                backgroundColor: '#fa441d',
                color: '#fff',
                fontSize: '36px',
                margin: '0 auto 20px',
              }}
            >
              <i className="fa-solid fa-lock"></i>
            </div>
            <h3 style={{ fontWeight: 700, marginBottom: '12px' }}>Access Restricted</h3>
            <p className="text-muted" style={{ marginBottom: '25px' }}>
              Your account with role <strong>{user?.role}</strong> does not have permission to access
              this administrative or specialized portal.
            </p>
            <div className="d-flex justify-content-center gap-3">
              <Link to={userDashboard} className="button">
                Go to My Dashboard
              </Link>
              <Link to="/" className="button btn-outline" style={{ border: '1px solid #fa441d' }}>
                Back to Home
              </Link>
            </div>
          </div>
        </div>
      </section>
    );
  }

  return children;
}
