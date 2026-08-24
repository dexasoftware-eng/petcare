import React, { useState } from 'react';
import { Link, useNavigate } from '../../router/Router';
import { useAuth } from '../../context/AuthContext';
import { getRoleDashboardPath } from '../../components/auth/RoleRoute';
import RoleRegisterSwitcher from '../../components/auth/RoleRegisterSwitcher';

export default function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [errorMsg, setErrorMsg] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  const { login } = useAuth();
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrorMsg('');
    setIsSubmitting(true);

    try {
      const user = await login(email, password);
      const targetPath = getRoleDashboardPath(user?.role);
      navigate(targetPath);
    } catch (err) {
      const msg =
        err.response?.data?.message ||
        err.message ||
        'Unable to log in. Please verify your credentials.';
      setErrorMsg(msg);
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <>
      {/* Banner */}
      <section
        className="banner"
        style={{
          backgroundColor: '#fff8e5',
          backgroundImage: 'url(/assets/img/background.png)',
          padding: '70px 0',
          textAlign: 'center',
        }}
      >
        <div className="container">
          <h2 style={{ fontSize: '40px', fontWeight: 800, marginBottom: '10px', color: '#222' }}>
            Welcome Back to FurShield
          </h2>
          <ul
            className="breadcrumb"
            style={{
              display: 'flex',
              justifyContent: 'center',
              listStyle: 'none',
              padding: 0,
              margin: 0,
              gap: '10px',
              fontSize: '15px',
            }}
          >
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d', fontWeight: 600 }}>
              Account Login
            </li>
          </ul>
        </div>
      </section>

      {/* Main Login Form */}
      <section className="gap" style={{ padding: '70px 0' }}>
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-7 col-md-9">
              <div
                className="p-4 p-md-5"
                style={{
                  backgroundColor: '#fff8e5',
                  borderRadius: '28px',
                  boxShadow: '0 20px 45px rgba(0,0,0,0.05)',
                  border: '1px solid #fce3b8',
                }}
              >
                {/* Header title */}
                <div className="text-center mb-4">
                  <span
                    style={{
                      display: 'inline-block',
                      padding: '5px 16px',
                      backgroundColor: '#fa441d',
                      color: '#fff',
                      borderRadius: '20px',
                      fontSize: '12px',
                      fontWeight: 700,
                      textTransform: 'uppercase',
                      letterSpacing: '1px',
                      marginBottom: '10px',
                    }}
                  >
                    <i className="fa-solid fa-lock me-1"></i> FurShield Single Sign-On
                  </span>
                  <h3 style={{ fontWeight: 800, fontSize: '28px', color: '#1a1a1a', marginBottom: '6px' }}>
                    Sign in to your account
                  </h3>
                  <p className="text-muted" style={{ fontSize: '14px', maxWidth: '420px', margin: '0 auto' }}>
                    Access your pet health profiles, vet appointments, or shelter rosters
                  </p>
                </div>

                {errorMsg && (
                  <div
                    className="alert alert-danger d-flex align-items-center mb-4"
                    style={{
                      borderRadius: '14px',
                      fontSize: '14px',
                      border: '1px solid #f5c2c7',
                      padding: '14px 18px',
                    }}
                  >
                    <i className="fa-solid fa-circle-exclamation me-2 fs-5 text-danger"></i>
                    <div>{errorMsg}</div>
                  </div>
                )}

                <form onSubmit={handleSubmit}>
                  <div className="mb-3">
                    <label className="form-label" style={{ fontWeight: 600, fontSize: '14px', color: '#333' }}>
                      Email Address <span style={{ color: '#fa441d' }}>*</span>
                    </label>
                    <input
                      type="email"
                      className="form-control"
                      placeholder="e.g. yourname@domain.com"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      required
                      style={{
                        borderRadius: '12px',
                        padding: '13px 18px',
                        border: '1.5px solid #e2d7c5',
                        backgroundColor: '#ffffff',
                        fontSize: '15px',
                      }}
                    />
                  </div>

                  <div className="mb-4">
                    <div className="d-flex justify-content-between align-items-center mb-1">
                      <label className="form-label mb-0" style={{ fontWeight: 600, fontSize: '14px', color: '#333' }}>
                        Password <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <Link
                        to="/forgot-password"
                        style={{
                          fontSize: '13px',
                          color: '#fa441d',
                          fontWeight: 600,
                          textDecoration: 'none',
                        }}
                      >
                        Forgot password?
                      </Link>
                    </div>
                    <div style={{ position: 'relative' }}>
                      <input
                        type={showPassword ? 'text' : 'password'}
                        className="form-control"
                        placeholder="••••••••"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                        style={{
                          borderRadius: '12px',
                          padding: '13px 44px 13px 18px',
                          border: '1.5px solid #e2d7c5',
                          backgroundColor: '#ffffff',
                          fontSize: '15px',
                        }}
                      />
                      <button
                        type="button"
                        onClick={() => setShowPassword(!showPassword)}
                        style={{
                          position: 'absolute',
                          right: '14px',
                          top: '50%',
                          transform: 'translateY(-50%)',
                          background: 'none',
                          border: 'none',
                          color: '#888',
                          cursor: 'pointer',
                          fontSize: '16px',
                        }}
                        aria-label={showPassword ? 'Hide password' : 'Show password'}
                      >
                        <i className={`fa-solid ${showPassword ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                      </button>
                    </div>
                  </div>

                  <button
                    type="submit"
                    className="button w-100"
                    disabled={isSubmitting}
                    style={{
                      padding: '15px',
                      borderRadius: '14px',
                      fontWeight: 700,
                      fontSize: '16px',
                      backgroundColor: '#fa441d',
                      border: 'none',
                      color: '#fff',
                      cursor: isSubmitting ? 'not-allowed' : 'pointer',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      gap: '10px',
                      boxShadow: '0 8px 20px rgba(250, 68, 29, 0.3)',
                    }}
                  >
                    {isSubmitting ? (
                      <>
                        <span className="spinner-border spinner-border-sm" role="status"></span>
                        Authenticating...
                      </>
                    ) : (
                      <>
                        Sign In to Account <i className="fa-solid fa-arrow-right"></i>
                      </>
                    )}
                  </button>
                </form>

                {/* Perfect Role Selection Bottom Layout */}
                <div
                  className="mt-5 pt-4"
                  style={{ borderTop: '1.5px dashed #ded4c0' }}
                >
                  <div className="text-center mb-3">
                    <p
                      style={{
                        fontSize: '14px',
                        fontWeight: 700,
                        color: '#222',
                        textTransform: 'uppercase',
                        letterSpacing: '0.8px',
                        margin: 0,
                      }}
                    >
                      New to FurShield? Choose Your Account Type:
                    </p>
                  </div>

                  <RoleRegisterSwitcher />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
