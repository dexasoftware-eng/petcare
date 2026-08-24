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
      setStatusMsg(response.message || 'If an account exists, a reset link has been dispatched to your email.');
    } catch (err) {
      setErrorMsg(err.response?.data?.message || 'Failed to process request. Please try again.');
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div
      style={{
        position: 'relative',
        minHeight: '100vh',
        width: '100%',
        background: `
          linear-gradient(to right, rgba(250, 247, 242, 0.65) 0%, rgba(250, 247, 242, 0.55) 35%, rgba(250, 247, 242, 0.88) 65%, rgba(250, 247, 242, 0.98) 100%),
          url(/assets/img/login-bg-original.jpg) center center / cover no-repeat
        `,
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'space-between',
        overflowX: 'hidden',
        fontFamily: "'Plus Jakarta Sans', 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif",
      }}
    >
      {/* Decorative Wave */}
      <div
        style={{
          position: 'absolute',
          bottom: '-30px',
          left: '-40px',
          width: '360px',
          height: '300px',
          background: 'radial-gradient(circle, #ff8a34 0%, #f95c19 100%)',
          borderRadius: '40% 60% 70% 30% / 45% 50% 50% 55%',
          zIndex: 2,
          pointerEvents: 'none',
          opacity: 0.85,
          boxShadow: '0 20px 40px rgba(249, 92, 25, 0.25)',
        }}
      />
      <div
        style={{
          position: 'absolute',
          bottom: '10px',
          left: '10px',
          width: '160px',
          height: '160px',
          backgroundImage: 'radial-gradient(rgba(255, 255, 255, 0.4) 1.5px, transparent 1.5px)',
          backgroundSize: '12px 12px',
          zIndex: 3,
          pointerEvents: 'none',
        }}
      />

      {/* Top Logo */}
      <div
        style={{
          maxWidth: '1440px',
          width: '100%',
          margin: '0 auto',
          padding: '24px 40px 0 40px',
          position: 'relative',
          zIndex: 10,
        }}
      >
        <Link to="/" style={{ display: 'inline-flex', alignItems: 'center', gap: '12px', textDecoration: 'none' }}>
          <img
            src="/assets/img/logo.svg"
            alt="Petguard"
            style={{ height: '44px', width: 'auto', display: 'block' }}
          />
        </Link>
      </div>

      {/* Main Section */}
      <div
        style={{
          maxWidth: '1440px',
          width: '100%',
          margin: '0 auto',
          padding: '16px 40px 16px 40px',
          position: 'relative',
          zIndex: 10,
          flex: 1,
          display: 'flex',
          alignItems: 'center',
        }}
      >
        <div
          style={{
            display: 'grid',
            gridTemplateColumns: 'minmax(0, 1.25fr) minmax(360px, 470px)',
            alignItems: 'center',
            gap: '40px',
            width: '100%',
          }}
        >
          <div style={{ position: 'relative', zIndex: 10 }}>
            <div style={{ maxWidth: '540px' }}>
              <h1
                style={{
                  fontFamily: "'Outfit', sans-serif",
                  fontSize: 'clamp(36px, 4.2vw, 52px)',
                  fontWeight: 900,
                  color: '#18212f',
                  lineHeight: '1.12',
                  letterSpacing: '-0.03em',
                  marginBottom: '14px',
                }}
              >
                Reset &amp; Secure <br />
                <span style={{ color: '#f95c19' }}>Your Account Access</span> 🔒
              </h1>

              <p style={{ fontSize: '15.5px', color: '#475569', lineHeight: '1.55', marginBottom: '24px', maxWidth: '460px' }}>
                Enter your registered email address and we&apos;ll send you secure instructions to reset your password.
              </p>
            </div>
          </div>

          <div style={{ position: 'relative', zIndex: 10 }}>
            <div
              style={{
                backgroundColor: '#ffffff',
                borderRadius: '28px',
                padding: '34px 34px',
                boxShadow: '0 24px 60px -10px rgba(0, 0, 0, 0.1), 0 0 1px 1px rgba(0, 0, 0, 0.03)',
                border: '1px solid #f1f5f9',
                maxWidth: '460px',
                margin: '0 auto',
              }}
            >
              <div style={{ textAlign: 'center', marginBottom: '20px' }}>
                <div
                  style={{
                    width: '46px',
                    height: '46px',
                    borderRadius: '50%',
                    backgroundColor: '#fff4eb',
                    color: '#f95c19',
                    display: 'inline-flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '20px',
                    boxShadow: '0 4px 12px rgba(249, 92, 25, 0.12)',
                    marginBottom: '8px',
                  }}
                >
                  <i className="fa-solid fa-key"></i>
                </div>
                <h2 style={{ fontFamily: "'Outfit', sans-serif", fontSize: '24px', fontWeight: 800, color: '#18212f', margin: '0 0 4px 0' }}>
                  Forgot Password?
                </h2>
                <p style={{ fontSize: '13px', color: '#64748b', margin: 0 }}>
                  Enter your email to receive recovery instructions
                </p>
              </div>

              {statusMsg && (
                <div
                  style={{
                    backgroundColor: '#ecfdf5',
                    border: '1px solid #d1fae5',
                    borderRadius: '10px',
                    padding: '10px 14px',
                    color: '#065f46',
                    fontSize: '13px',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '8px',
                    marginBottom: '16px',
                  }}
                >
                  <i className="fa-solid fa-circle-check"></i>
                  <span>{statusMsg}</span>
                </div>
              )}

              {errorMsg && (
                <div
                  style={{
                    backgroundColor: '#fef2f2',
                    border: '1px solid #fee2e2',
                    borderRadius: '10px',
                    padding: '10px 14px',
                    color: '#dc2626',
                    fontSize: '13px',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '8px',
                    marginBottom: '16px',
                  }}
                >
                  <i className="fa-solid fa-circle-exclamation"></i>
                  <span>{errorMsg}</span>
                </div>
              )}

              <form onSubmit={handleSubmit}>
                <div style={{ marginBottom: '18px' }}>
                  <label style={{ display: 'block', fontSize: '12.5px', fontWeight: 600, color: '#334155', marginBottom: '6px' }}>
                    Email Address
                  </label>
                  <div style={{ position: 'relative' }}>
                    <span style={{ position: 'absolute', left: '14px', top: '50%', transform: 'translateY(-50%)', color: '#94a3b8', fontSize: '14.5px' }}>
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
                        padding: '11px 14px 11px 40px',
                        fontSize: '14px',
                        borderRadius: '11px',
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
                    padding: '12px',
                    borderRadius: '11px',
                    background: 'linear-gradient(90deg, #ff6622 0%, #ff4500 100%)',
                    border: 'none',
                    color: '#ffffff',
                    fontSize: '14.5px',
                    fontWeight: 700,
                    cursor: isSubmitting ? 'not-allowed' : 'pointer',
                    boxShadow: '0 6px 18px rgba(255, 69, 0, 0.28)',
                    marginBottom: '16px',
                  }}
                >
                  {isSubmitting ? 'Sending Link...' : 'Send Reset Link ➔'}
                </button>

                <div style={{ textAlign: 'center' }}>
                  <Link to="/login" style={{ fontSize: '13px', color: '#f95c19', fontWeight: 700, textDecoration: 'none' }}>
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
          zIndex: 10,
          padding: '14px 24px',
          margin: '12px auto 14px auto',
          maxWidth: '980px',
          width: 'calc(100% - 48px)',
          backgroundColor: '#ffffff',
          borderRadius: '24px',
          boxShadow: '0 8px 30px rgba(0, 0, 0, 0.05)',
          border: '1px solid #f1f5f9',
        }}
      >
        <div className="row g-3 text-center align-items-center">
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div style={{ width: '32px', height: '32px', borderRadius: '50%', backgroundColor: '#ecfdf5', color: '#059669', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '14px' }}>
                <i className="fa-solid fa-shield-halved"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Secure &amp; Private</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>Your data is safe</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div style={{ width: '32px', height: '32px', borderRadius: '50%', backgroundColor: '#ecfdf5', color: '#10b981', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '14px' }}>
                <i className="fa-regular fa-clock"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Instant Delivery</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>Reset in 2 minutes</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div style={{ width: '32px', height: '32px', borderRadius: '50%', backgroundColor: '#eff6ff', color: '#2563eb', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '14px' }}>
                <i className="fa-solid fa-lock"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Encrypted Links</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>SHA-256 tokens</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div style={{ width: '32px', height: '32px', borderRadius: '50%', backgroundColor: '#ecfdf5', color: '#059669', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '14px' }}>
                <i className="fa-solid fa-headset"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>24/7 Support</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>We&apos;re always here</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
