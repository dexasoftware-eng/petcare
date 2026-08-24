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
                Instant Email <br />
                <span style={{ color: '#f95c19' }}>Account Verification</span> <br />
                &amp; Activation ✉️
              </h1>

              <p style={{ fontSize: '15.5px', color: '#556579', lineHeight: '1.6', marginBottom: '24px', maxWidth: '460px' }}>
                Verifying your email ensures that your pet&apos;s medical records, appointments, and notifications are securely synchronized.
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
                padding: '40px 36px',
                boxShadow: '0 25px 60px -10px rgba(0, 0, 0, 0.06), 0 0 1px 1px rgba(0, 0, 0, 0.02)',
                border: '1px solid #f1f5f9',
                maxWidth: '480px',
                margin: '0 auto',
                position: 'relative',
                zIndex: 3,
                textAlign: 'center',
              }}
            >
              {status === 'verifying' && (
                <div>
                  <div className="spinner-border text-warning mb-3" style={{ width: '48px', height: '48px' }} role="status"></div>
                  <h3 style={{ fontSize: '22px', fontWeight: 800, color: '#18212f', marginBottom: '8px' }}>
                    Verifying Email Token...
                  </h3>
                  <p style={{ fontSize: '14px', color: '#64748b' }}>
                    Please wait while we confirm your account credentials.
                  </p>
                </div>
              )}

              {status === 'success' && (
                <div>
                  <div
                    style={{
                      width: '64px',
                      height: '64px',
                      borderRadius: '50%',
                      backgroundColor: '#ecfdf5',
                      color: '#10b981',
                      display: 'inline-flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '28px',
                      marginBottom: '16px',
                    }}
                  >
                    <i className="fa-solid fa-check"></i>
                  </div>
                  <h3 style={{ fontSize: '24px', fontWeight: 800, color: '#18212f', marginBottom: '8px' }}>
                    Verified Successfully!
                  </h3>
                  <p style={{ fontSize: '14px', color: '#64748b', marginBottom: '24px' }}>
                    {message}
                  </p>
                  <Link
                    to="/login"
                    style={{
                      display: 'inline-block',
                      width: '100%',
                      padding: '13px',
                      borderRadius: '12px',
                      background: 'linear-gradient(90deg, #ff6622 0%, #ff4500 100%)',
                      color: '#ffffff',
                      fontSize: '15px',
                      fontWeight: 700,
                      textDecoration: 'none',
                      boxShadow: '0 8px 20px rgba(255, 69, 0, 0.3)',
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
                      width: '64px',
                      height: '64px',
                      borderRadius: '50%',
                      backgroundColor: '#fef2f2',
                      color: '#ef4444',
                      display: 'inline-flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '28px',
                      marginBottom: '16px',
                    }}
                  >
                    <i className="fa-solid fa-xmark"></i>
                  </div>
                  <h3 style={{ fontSize: '24px', fontWeight: 800, color: '#18212f', marginBottom: '8px' }}>
                    Verification Failed
                  </h3>
                  <p style={{ fontSize: '14px', color: '#64748b', marginBottom: '24px' }}>
                    {message}
                  </p>
                  <Link
                    to="/login"
                    style={{
                      display: 'inline-block',
                      width: '100%',
                      padding: '13px',
                      borderRadius: '12px',
                      background: '#18212f',
                      color: '#ffffff',
                      fontSize: '15px',
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
              <i className="fa-regular fa-envelope" style={{ color: '#64748b', fontSize: '15px' }}></i>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12.5px', fontWeight: 700, color: '#1e293b' }}>Verified Email</div>
                <div style={{ fontSize: '11px', color: '#8b96a5' }}>Official accounts</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}>
              <i className="fa-solid fa-user-shield" style={{ color: '#64748b', fontSize: '15px' }}></i>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12.5px', fontWeight: 700, color: '#1e293b' }}>Zero Spam</div>
                <div style={{ fontSize: '11px', color: '#8b96a5' }}>Strict privacy</div>
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
