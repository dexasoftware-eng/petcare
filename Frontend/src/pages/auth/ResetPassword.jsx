import React, { useState, useEffect } from 'react';
import { Link, useNavigate } from '../../router/Router';
import { authService } from '../../services/auth.service';

export default function ResetPassword() {
  const [token, setToken] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [statusMsg, setStatusMsg] = useState('');
  const [errorMsg, setErrorMsg] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  const navigate = useNavigate();

  useEffect(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const tokenParam = urlParams.get('token');
    if (tokenParam) {
      setToken(tokenParam);
    }
  }, []);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setStatusMsg('');
    setErrorMsg('');

    if (password !== confirmPassword) {
      setErrorMsg('Passwords do not match');
      return;
    }

    setIsSubmitting(true);
    try {
      const response = await authService.resetPassword({ token, password });
      setStatusMsg(response.message || 'Password reset successfully! Redirecting to login...');
      setTimeout(() => {
        navigate('/login');
      }, 2000);
    } catch (err) {
      setErrorMsg(
        err.response?.data?.message || 'Invalid or expired reset token. Please request a new one.'
      );
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <>
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
            Set New Password
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
            <li>
              <Link to="/login">Login</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d', fontWeight: 600 }}>
              Reset Password
            </li>
          </ul>
        </div>
      </section>

      <section className="gap" style={{ padding: '80px 0' }}>
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-5 col-md-8">
              <div
                className="p-4 p-md-5"
                style={{
                  backgroundColor: '#fff8e5',
                  borderRadius: '24px',
                  boxShadow: '0 20px 40px rgba(0,0,0,0.04)',
                  border: '1px solid #fce3b8',
                }}
              >
                <div className="text-center mb-4">
                  <div
                    style={{
                      width: '60px',
                      height: '60px',
                      borderRadius: '50%',
                      backgroundColor: '#fa441d',
                      color: '#fff',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '24px',
                      margin: '0 auto 12px',
                    }}
                  >
                    <i className="fa-solid fa-shield-halved"></i>
                  </div>
                  <h3 style={{ fontWeight: 800, fontSize: '22px', color: '#1a1a1a' }}>
                    Reset Account Password
                  </h3>
                  <p className="text-muted" style={{ fontSize: '14px' }}>
                    Enter your new secure password below to regain access
                  </p>
                </div>

                {statusMsg && (
                  <div
                    className="alert alert-success d-flex align-items-center mb-4"
                    style={{ borderRadius: '12px', fontSize: '14px' }}
                  >
                    <i className="fa-solid fa-circle-check me-2 fs-5"></i>
                    <div>{statusMsg}</div>
                  </div>
                )}

                {errorMsg && (
                  <div
                    className="alert alert-danger d-flex align-items-center mb-4"
                    style={{ borderRadius: '12px', fontSize: '14px' }}
                  >
                    <i className="fa-solid fa-circle-exclamation me-2 fs-5"></i>
                    <div>{errorMsg}</div>
                  </div>
                )}

                <form onSubmit={handleSubmit}>
                  {!token && (
                    <div className="mb-3">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Security Token <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type="text"
                        className="form-control"
                        placeholder="Paste security reset token"
                        value={token}
                        onChange={(e) => setToken(e.target.value)}
                        required
                        style={{
                          borderRadius: '10px',
                          padding: '12px 16px',
                          border: '1px solid #e0d5c1',
                          backgroundColor: '#fff',
                        }}
                      />
                    </div>
                  )}

                  <div className="mb-3">
                    <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                      New Password <span style={{ color: '#fa441d' }}>*</span>
                    </label>
                    <div style={{ position: 'relative' }}>
                      <input
                        type={showPassword ? 'text' : 'password'}
                        className="form-control"
                        placeholder="Min 8 chars, 1 uppercase, 1 number"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                        style={{
                          borderRadius: '10px',
                          padding: '12px 40px 12px 16px',
                          border: '1px solid #e0d5c1',
                          backgroundColor: '#fff',
                        }}
                      />
                      <button
                        type="button"
                        onClick={() => setShowPassword(!showPassword)}
                        style={{
                          position: 'absolute',
                          right: '12px',
                          top: '50%',
                          transform: 'translateY(-50%)',
                          background: 'none',
                          border: 'none',
                          color: '#888',
                          cursor: 'pointer',
                        }}
                      >
                        <i className={`fa-solid ${showPassword ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                      </button>
                    </div>
                  </div>

                  <div className="mb-4">
                    <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                      Confirm New Password <span style={{ color: '#fa441d' }}>*</span>
                    </label>
                    <input
                      type={showPassword ? 'text' : 'password'}
                      className="form-control"
                      placeholder="Repeat new password"
                      value={confirmPassword}
                      onChange={(e) => setConfirmPassword(e.target.value)}
                      required
                      style={{
                        borderRadius: '10px',
                        padding: '12px 16px',
                        border: '1px solid #e0d5c1',
                        backgroundColor: '#fff',
                      }}
                    />
                  </div>

                  <button
                    type="submit"
                    className="button w-100"
                    disabled={isSubmitting}
                    style={{
                      padding: '14px',
                      borderRadius: '12px',
                      fontWeight: 700,
                      fontSize: '16px',
                      backgroundColor: '#fa441d',
                      border: 'none',
                      color: '#fff',
                      cursor: isSubmitting ? 'not-allowed' : 'pointer',
                    }}
                  >
                    {isSubmitting ? 'Updating Password...' : 'Save New Password'}
                  </button>
                </form>

                <div className="text-center mt-4 pt-3" style={{ borderTop: '1px dashed #ded4c0' }}>
                  <Link
                    to="/login"
                    style={{ color: '#fa441d', fontWeight: 600, fontSize: '14px', textDecoration: 'none' }}
                  >
                    <i className="fa-solid fa-arrow-left me-1"></i> Back to Login
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
