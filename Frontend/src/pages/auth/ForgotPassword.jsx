import React, { useState } from 'react';
import { Link } from '../../router/Router';
import { authService } from '../../services/auth.service';

export default function ForgotPassword() {
  const [email, setEmail] = useState('');
  const [statusMsg, setStatusMsg] = useState('');
  const [errorMsg, setErrorMsg] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setStatusMsg('');
    setErrorMsg('');
    setIsSubmitting(true);

    try {
      const response = await authService.forgotPassword({ email });
      setStatusMsg(response.message || 'If an account exists, a reset link has been dispatched.');
    } catch (err) {
      setErrorMsg(err.response?.data?.message || 'Failed to process request. Please try again.');
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
            Recover Your Password
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
              Forgot Password
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
                    <i className="fa-solid fa-key"></i>
                  </div>
                  <h3 style={{ fontWeight: 800, fontSize: '22px', color: '#1a1a1a' }}>
                    Password Recovery
                  </h3>
                  <p className="text-muted" style={{ fontSize: '14px' }}>
                    Enter your registered email and we'll send a secure password reset link
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
                  <div className="mb-4">
                    <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                      Account Email Address <span style={{ color: '#fa441d' }}>*</span>
                    </label>
                    <input
                      type="email"
                      className="form-control"
                      placeholder="user@example.com"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
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
                    {isSubmitting ? 'Sending Link...' : 'Send Recovery Link'}
                  </button>
                </form>

                <div className="text-center mt-4 pt-3" style={{ borderTop: '1px dashed #ded4c0' }}>
                  <Link
                    to="/login"
                    style={{ color: '#fa441d', fontWeight: 600, fontSize: '14px', textDecoration: 'none' }}
                  >
                    <i className="fa-solid fa-arrow-left me-1"></i> Return to Sign In
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
