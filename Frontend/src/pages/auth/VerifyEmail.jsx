import React, { useState, useEffect } from 'react';
import { Link } from '../../router/Router';
import { authService } from '../../services/auth.service';

export default function VerifyEmail() {
  const [status, setStatus] = useState('verifying'); // 'verifying', 'success', 'error'
  const [message, setMessage] = useState('');

  useEffect(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get('token');

    if (!token) {
      setStatus('error');
      setMessage('Missing email verification token in link.');
      return;
    }

    const performVerification = async () => {
      try {
        const response = await authService.verifyEmail(token);
        setStatus('success');
        setMessage(response.message || 'Email verified successfully! You are all set.');
      } catch (err) {
        setStatus('error');
        setMessage(err.response?.data?.message || 'Verification link is invalid or has expired.');
      }
    };

    performVerification();
  }, []);

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
                Instant Email <br />
                <span style={{ color: '#f95c19' }}>Account Verification</span> ✉️
              </h1>

              <p style={{ fontSize: '15.5px', color: '#475569', lineHeight: '1.55', marginBottom: '24px', maxWidth: '460px' }}>
                Verifying your email ensures that your pet&apos;s medical records, appointments, and notifications are securely synchronized.
              </p>
            </div>
          </div>

          <div style={{ position: 'relative', zIndex: 10 }}>
            <div
              style={{
                backgroundColor: '#ffffff',
                borderRadius: '28px',
                padding: '38px 34px',
                boxShadow: '0 24px 60px -10px rgba(0, 0, 0, 0.1), 0 0 1px 1px rgba(0, 0, 0, 0.03)',
                border: '1px solid #f1f5f9',
                maxWidth: '460px',
                margin: '0 auto',
                textAlign: 'center',
              }}
            >
              {status === 'verifying' && (
                <div>
                  <div className="spinner-border text-warning mb-3" style={{ width: '46px', height: '46px' }} role="status"></div>
                  <h3 style={{ fontFamily: "'Outfit', sans-serif", fontSize: '22px', fontWeight: 800, color: '#18212f', marginBottom: '6px' }}>
                    Verifying Email Token...
                  </h3>
                  <p style={{ fontSize: '13.5px', color: '#64748b' }}>
                    Please wait while we confirm your account credentials.
                  </p>
                </div>
              )}

              {status === 'success' && (
                <div>
                  <div
                    style={{
                      width: '60px',
                      height: '60px',
                      borderRadius: '50%',
                      backgroundColor: '#ecfdf5',
                      color: '#10b981',
                      display: 'inline-flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '26px',
                      marginBottom: '14px',
                    }}
                  >
                    <i className="fa-solid fa-check"></i>
                  </div>
                  <h3 style={{ fontFamily: "'Outfit', sans-serif", fontSize: '24px', fontWeight: 800, color: '#18212f', marginBottom: '6px' }}>
                    Verified Successfully!
                  </h3>
                  <p style={{ fontSize: '13.5px', color: '#64748b', marginBottom: '22px' }}>
                    {message}
                  </p>
                  <Link
                    to="/login"
                    style={{
                      display: 'inline-block',
                      width: '100%',
                      padding: '12px',
                      borderRadius: '11px',
                      background: 'linear-gradient(90deg, #ff6622 0%, #ff4500 100%)',
                      color: '#ffffff',
                      fontSize: '14.5px',
                      fontWeight: 700,
                      textDecoration: 'none',
                      boxShadow: '0 6px 18px rgba(255, 69, 0, 0.28)',
                    }}
                  >
                    Continue to Sign In ➔
                  </Link>
                </div>
              )}

              {status === 'error' && (
                <div>
                  <div
                    style={{
                      width: '60px',
                      height: '60px',
                      borderRadius: '50%',
                      backgroundColor: '#fef2f2',
                      color: '#ef4444',
                      display: 'inline-flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '26px',
                      marginBottom: '14px',
                    }}
                  >
                    <i className="fa-solid fa-xmark"></i>
                  </div>
                  <h3 style={{ fontFamily: "'Outfit', sans-serif", fontSize: '24px', fontWeight: 800, color: '#18212f', marginBottom: '6px' }}>
                    Verification Failed
                  </h3>
                  <p style={{ fontSize: '13.5px', color: '#64748b', marginBottom: '22px' }}>
                    {message}
                  </p>
                  <Link
                    to="/login"
                    style={{
                      display: 'inline-block',
                      width: '100%',
                      padding: '12px',
                      borderRadius: '11px',
                      background: '#18212f',
                      color: '#ffffff',
                      fontSize: '14.5px',
                      fontWeight: 700,
                      textDecoration: 'none',
                    }}
                  >
                    Back to Sign In ➔
                  </Link>
                </div>
              )}
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
                <i className="fa-regular fa-envelope"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Verified Email</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>Official accounts</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div style={{ width: '32px', height: '32px', borderRadius: '50%', backgroundColor: '#eff6ff', color: '#2563eb', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '14px' }}>
                <i className="fa-solid fa-user-shield"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Zero Spam</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>Strict privacy</div>
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
