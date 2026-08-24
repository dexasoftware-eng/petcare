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
      setStatusMsg(response.message || 'If an account exists, a password reset link has been dispatched to your email.');
    } catch (err) {
      setErrorMsg(err.response?.data?.message || 'Failed to process request. Please try again.');
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div
      style={{
        backgroundColor: '#fbf8f3',
        minHeight: '100vh',
        position: 'relative',
        overflow: 'hidden',
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'space-between',
        fontFamily: "'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif",
      }}
    >
      {/* Decorative Background */}
      <div
        style={{
          position: 'absolute',
          bottom: '-70px',
          left: '-70px',
          width: '520px',
          height: '420px',
          background: 'linear-gradient(135deg, #ff8a34 0%, #f95c19 100%)',
          borderRadius: '45% 55% 65% 35% / 40% 45% 55% 60%',
          zIndex: 1,
          pointerEvents: 'none',
          boxShadow: '0 20px 45px rgba(249, 92, 25, 0.22)',
        }}
      />

      {/* Main Container */}
      <div
        className="container-fluid"
        style={{
          maxWidth: '1440px',
          padding: '24px 36px 0 36px',
          position: 'relative',
          zIndex: 2,
          flex: 1,
        }}
      >
        {/* Top-Left Logo */}
        <div style={{ marginBottom: '20px' }}>
          <Link to="/" style={{ display: 'inline-flex', alignItems: 'center', gap: '12px', textDecoration: 'none' }}>
            <div
              style={{
                width: '42px',
                height: '42px',
                borderRadius: '12px',
                background: 'linear-gradient(135deg, #ff7a29 0%, #f24e07 100%)',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                color: '#ffffff',
                fontSize: '20px',
                boxShadow: '0 6px 16px rgba(242, 78, 7, 0.28)',
              }}
            >
              <i className="fa-solid fa-shield-cat"></i>
            </div>
            <div>
              <div style={{ fontSize: '22px', fontWeight: 900, color: '#18212f', lineHeight: '1.1', letterSpacing: '-0.02em' }}>
                PetGuard
              </div>
              <div style={{ fontSize: '10.5px', fontWeight: 600, color: '#8b96a5', letterSpacing: '0.04em' }}>
                Care. Protect. Love.
              </div>
            </div>
          </Link>
        </div>

        {/* Content Row */}
        <div className="row align-items-center justify-content-between g-4">
          <div className="col-xl-6 col-lg-6 col-md-12">
            <div style={{ maxWidth: '580px', position: 'relative' }}>
              <h1
                style={{
                  fontSize: 'clamp(36px, 4.2vw, 50px)',
                  fontWeight: 900,
                  color: '#18212f',
                  lineHeight: '1.15',
                  letterSpacing: '-0.03em',
                  marginBottom: '16px',
                }}
              >
                Reset &amp; Secure <br />
                <span style={{ color: '#f95c19' }}>Your Account Access</span> <br />
                In Seconds 🔒
              </h1>

              <p style={{ fontSize: '15.5px', color: '#556579', lineHeight: '1.6', marginBottom: '24px', maxWidth: '460px' }}>
                Enter your registered email address and we&apos;ll send you secure instructions to reset your password.
              </p>

              <div style={{ position: 'relative', marginTop: '10px' }}>
                <img
                  src="/assets/img/pets-cutout.png"
                  alt="Pets"
                  style={{
                    width: '100%',
                    maxWidth: '520px',
                    height: 'auto',
                    display: 'block',
                    position: 'relative',
                    zIndex: 3,
                    filter: 'drop-shadow(0 15px 30px rgba(0, 0, 0, 0.08))',
                  }}
                />
              </div>
            </div>
          </div>

          <div className="col-xl-6 col-lg-6 col-md-12">
            <div
              style={{
                backgroundColor: '#ffffff',
                borderRadius: '32px',
                padding: 'clamp(28px, 3.5vw, 40px) clamp(24px, 3.5vw, 38px)',
                boxShadow: '0 25px 60px -10px rgba(0, 0, 0, 0.06), 0 0 1px 1px rgba(0, 0, 0, 0.02)',
                border: '1px solid #f1f5f9',
                maxWidth: '480px',
                margin: '0 auto',
                position: 'relative',
                zIndex: 3,
              }}
            >
              <div style={{ textAlign: 'center', marginBottom: '24px' }}>
                <div
                  style={{
                    width: '52px',
                    height: '52px',
                    borderRadius: '50%',
                    backgroundColor: '#fff4eb',
                    color: '#f95c19',
                    display: 'inline-flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '22px',
                    boxShadow: '0 4px 12px rgba(249, 92, 25, 0.12)',
                    marginBottom: '10px',
                  }}
                >
                  <i className="fa-solid fa-key"></i>
                </div>
                <h2 style={{ fontSize: '26px', fontWeight: 800, color: '#18212f', margin: '0 0 4px 0' }}>
                  Forgot Password?
                </h2>
                <p style={{ fontSize: '13.5px', color: '#64748b', margin: 0 }}>
                  Enter your email to receive recovery instructions
                </p>
              </div>

              {statusMsg && (
                <div
                  style={{
                    backgroundColor: '#ecfdf5',
                    border: '1px solid #d1fae5',
                    borderRadius: '12px',
                    padding: '12px 16px',
                    color: '#065f46',
                    fontSize: '13.5px',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '10px',
                    marginBottom: '20px',
                  }}
                >
                  <i className="fa-solid fa-circle-check" style={{ fontSize: '16px' }}></i>
                  <span>{statusMsg}</span>
                </div>
              )}

              {errorMsg && (
                <div
                  style={{
                    backgroundColor: '#fef2f2',
                    border: '1px solid #fee2e2',
                    borderRadius: '12px',
                    padding: '12px 16px',
                    color: '#dc2626',
                    fontSize: '13.5px',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '10px',
                    marginBottom: '20px',
                  }}
                >
                  <i className="fa-solid fa-circle-exclamation" style={{ fontSize: '16px' }}></i>
                  <span>{errorMsg}</span>
                </div>
              )}

              <form onSubmit={handleSubmit}>
                <div style={{ marginBottom: '20px' }}>
                  <label style={{ display: 'block', fontSize: '13.5px', fontWeight: 600, color: '#334155', marginBottom: '8px' }}>
                    Email Address
                  </label>
                  <div style={{ position: 'relative' }}>
                    <span style={{ position: 'absolute', left: '16px', top: '50%', transform: 'translateY(-50%)', color: '#94a3b8', fontSize: '16px' }}>
                      <i className="fa-regular fa-envelope"></i>
                    </span>
                    <input
                      type="email"
                      required
                      placeholder="Enter your registered email"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      style={{
                        width: '100%',
                        padding: '13px 16px 13px 44px',
                        fontSize: '14.5px',
                        borderRadius: '12px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                </div>

                <button
                  type="submit"
                  disabled={isSubmitting}
                  style={{
                    width: '100%',
                    padding: '13px',
                    borderRadius: '12px',
                    background: 'linear-gradient(90deg, #ff6622 0%, #ff4500 100%)',
                    border: 'none',
                    color: '#ffffff',
                    fontSize: '15px',
                    fontWeight: 700,
                    cursor: isSubmitting ? 'not-allowed' : 'pointer',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    gap: '8px',
                    boxShadow: '0 8px 20px rgba(255, 69, 0, 0.3)',
                    marginBottom: '16px',
                  }}
                >
                  {isSubmitting ? 'Sending Link...' : 'Send Password Reset Link ➔'}
                </button>

                <div style={{ textAlign: 'center' }}>
                  <Link to="/login" style={{ fontSize: '13.5px', color: '#f95c19', fontWeight: 700, textDecoration: 'none' }}>
                    <i className="fa-solid fa-arrow-left me-1"></i> Back to Sign In
                  </Link>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      {/* Bottom Trust Dock */}
      <div
        style={{
          position: 'relative',
          zIndex: 3,
          padding: '14px 24px',
          margin: '18px auto 14px auto',
          maxWidth: '920px',
          width: 'calc(100% - 48px)',
          backgroundColor: '#ffffff',
          borderRadius: '20px',
          boxShadow: '0 8px 28px rgba(0, 0, 0, 0.04)',
          border: '1px solid #f1f5f9',
        }}
      >
        <div className="row g-3 text-center align-items-center">
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}>
              <i className="fa-solid fa-shield-halved" style={{ color: '#64748b', fontSize: '15px' }}></i>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12.5px', fontWeight: 700, color: '#1e293b' }}>Secure &amp; Private</div>
                <div style={{ fontSize: '11px', color: '#8b96a5' }}>Your data is safe</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}>
              <i className="fa-regular fa-clock" style={{ color: '#64748b', fontSize: '15px' }}></i>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12.5px', fontWeight: 700, color: '#1e293b' }}>Instant Delivery</div>
                <div style={{ fontSize: '11px', color: '#8b96a5' }}>Reset in 2 minutes</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}>
              <i className="fa-solid fa-lock" style={{ color: '#64748b', fontSize: '15px' }}></i>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12.5px', fontWeight: 700, color: '#1e293b' }}>Encrypted Links</div>
                <div style={{ fontSize: '11px', color: '#8b96a5' }}>SHA-256 tokens</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}>
              <i className="fa-solid fa-headset" style={{ color: '#64748b', fontSize: '15px' }}></i>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12.5px', fontWeight: 700, color: '#1e293b' }}>24/7 Support</div>
                <div style={{ fontSize: '11px', color: '#8b96a5' }}>We&apos;re always here</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
