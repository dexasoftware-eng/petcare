import React, { useState } from 'react';
import { Link, useNavigate } from '../../router/Router';
import { useAuth } from '../../context/AuthContext';
import { getRoleDashboardPath } from '../../components/auth/RoleRoute';

export default function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [rememberMe, setRememberMe] = useState(false);
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
    <div
      style={{
        backgroundColor: '#faf7f2',
        minHeight: '100vh',
        position: 'relative',
        overflowX: 'hidden',
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'space-between',
        fontFamily: "'Plus Jakarta Sans', 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif",
      }}
    >
      {/* ================= BACKGROUND ROOM & FLUID ACCENTS ================= */}
      {/* Cozy Living Room Background for Left Side with Smooth Edge Fading */}
      <div
        style={{
          position: 'absolute',
          top: 0,
          left: 0,
          width: '65%',
          height: '100%',
          backgroundImage: `
            linear-gradient(to right, rgba(250, 247, 242, 0.4) 0%, rgba(250, 247, 242, 0.75) 60%, rgba(250, 247, 242, 1) 100%),
            linear-gradient(to bottom, rgba(250, 247, 242, 0.85) 0%, rgba(250, 247, 242, 0.2) 40%, rgba(250, 247, 242, 0.9) 100%),
            url(/assets/img/login-pets-home.jpg)
          `,
          backgroundSize: 'cover',
          backgroundPosition: 'left bottom',
          backgroundRepeat: 'no-repeat',
          zIndex: 0,
          pointerEvents: 'none',
          opacity: 0.95,
        }}
      />

      {/* Decorative Subtle Background Waves (Right Side) */}
      <svg
        style={{
          position: 'absolute',
          top: '10%',
          right: '-5%',
          width: '500px',
          height: '600px',
          pointerEvents: 'none',
          zIndex: 0,
          opacity: 0.45,
        }}
        viewBox="0 0 500 600"
        fill="none"
      >
        <path
          d="M 100 0 C 350 150, 450 400, 200 600"
          stroke="rgba(249, 115, 22, 0.15)"
          strokeWidth="35"
          fill="none"
        />
        <path
          d="M 220 0 C 450 180, 520 420, 300 600"
          stroke="rgba(249, 115, 22, 0.08)"
          strokeWidth="20"
          fill="none"
        />
      </svg>

      {/* Subtle Dotted Matrix & Orange Wave at Bottom Left */}
      <div
        style={{
          position: 'absolute',
          bottom: '-30px',
          left: '-40px',
          width: '380px',
          height: '320px',
          background: 'radial-gradient(circle, #ff8a34 0%, #f95c19 100%)',
          borderRadius: '40% 60% 70% 30% / 45% 50% 50% 55%',
          zIndex: 1,
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
          width: '180px',
          height: '180px',
          backgroundImage: 'radial-gradient(rgba(255, 255, 255, 0.4) 1.5px, transparent 1.5px)',
          backgroundSize: '12px 12px',
          zIndex: 2,
          pointerEvents: 'none',
        }}
      />

      {/* ================= TOP NAVIGATION / LOGO ================= */}
      <div
        style={{
          maxWidth: '1400px',
          width: '100%',
          margin: '0 auto',
          padding: '20px 36px 0 36px',
          position: 'relative',
          zIndex: 10,
        }}
      >
        <Link
          to="/"
          style={{
            display: 'inline-flex',
            alignItems: 'center',
            gap: '12px',
            textDecoration: 'none',
          }}
        >
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
            <div
              style={{
                fontSize: '23px',
                fontWeight: 900,
                color: '#18212f',
                fontFamily: "'Outfit', sans-serif",
                lineHeight: '1.1',
                letterSpacing: '-0.02em',
              }}
            >
              PetGuard
            </div>
            <div
              style={{
                fontSize: '11px',
                fontWeight: 600,
                color: '#8b96a5',
                letterSpacing: '0.04em',
              }}
            >
              Care. Protect. Love.
            </div>
          </div>
        </Link>
      </div>

      {/* ================= MAIN 2-COLUMN SECTION ================= */}
      <div
        style={{
          maxWidth: '1400px',
          width: '100%',
          margin: '0 auto',
          padding: '10px 36px 10px 36px',
          position: 'relative',
          zIndex: 5,
          flex: 1,
          display: 'flex',
          alignItems: 'center',
        }}
      >
        <div
          style={{
            display: 'grid',
            gridTemplateColumns: 'minmax(0, 1.25fr) minmax(360px, 490px)',
            alignItems: 'center',
            gap: '40px',
            width: '100%',
          }}
        >
          {/* ================= LEFT COLUMN: HERO HEADINGS & FEATURE LIST ================= */}
          <div style={{ position: 'relative', zIndex: 5 }}>
            <div style={{ maxWidth: '560px' }}>
              {/* Main Headline */}
              <h1
                style={{
                  fontFamily: "'Outfit', sans-serif",
                  fontSize: 'clamp(38px, 4.4vw, 54px)',
                  fontWeight: 900,
                  color: '#18212f',
                  lineHeight: '1.12',
                  letterSpacing: '-0.03em',
                  marginBottom: '14px',
                }}
              >
                Your Pet&apos;s Health, <br />
                Our <span style={{ color: '#f95c19' }}>Priority</span>{' '}
                <span
                  style={{
                    color: '#f95c19',
                    fontSize: '0.78em',
                    verticalAlign: 'middle',
                    display: 'inline-block',
                    marginLeft: '2px',
                  }}
                >
                  <i className="fa-regular fa-heart"></i>
                </span>
              </h1>

              {/* Subtitle */}
              <p
                style={{
                  fontSize: '15.5px',
                  color: '#475569',
                  lineHeight: '1.55',
                  marginBottom: '26px',
                  maxWidth: '460px',
                  fontWeight: 500,
                }}
              >
                Manage your pet&apos;s health, appointments, and care all in one secure place.
              </p>

              {/* 3 Feature Bullets */}
              <div style={{ display: 'flex', flexDirection: 'column', gap: '18px', marginBottom: '32px' }}>
                {/* Bullet 1: Secure & Private */}
                <div style={{ display: 'flex', alignItems: 'center', gap: '14px' }}>
                  <div
                    style={{
                      width: '40px',
                      height: '40px',
                      borderRadius: '50%',
                      backgroundColor: '#ffedd5',
                      color: '#ea580c',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '17px',
                      flexShrink: 0,
                      boxShadow: '0 4px 10px rgba(234, 88, 12, 0.15)',
                    }}
                  >
                    <i className="fa-solid fa-shield-halved"></i>
                  </div>
                  <div>
                    <div style={{ fontSize: '15px', fontWeight: 800, color: '#1e293b', lineHeight: '1.2' }}>
                      Secure &amp; Private
                    </div>
                    <div style={{ fontSize: '13px', color: '#64748b', fontWeight: 500 }}>
                      Your pet&apos;s data is always protected
                    </div>
                  </div>
                </div>

                {/* Bullet 2: Easy Appointments */}
                <div style={{ display: 'flex', alignItems: 'center', gap: '14px' }}>
                  <div
                    style={{
                      width: '40px',
                      height: '40px',
                      borderRadius: '50%',
                      backgroundColor: '#ffedd5',
                      color: '#ea580c',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '17px',
                      flexShrink: 0,
                      boxShadow: '0 4px 10px rgba(234, 88, 12, 0.15)',
                    }}
                  >
                    <i className="fa-regular fa-calendar-check"></i>
                  </div>
                  <div>
                    <div style={{ fontSize: '15px', fontWeight: 800, color: '#1e293b', lineHeight: '1.2' }}>
                      Easy Appointments
                    </div>
                    <div style={{ fontSize: '13px', color: '#64748b', fontWeight: 500 }}>
                      Book vet visits with ease
                    </div>
                  </div>
                </div>

                {/* Bullet 3: Smart Reminders */}
                <div style={{ display: 'flex', alignItems: 'center', gap: '14px' }}>
                  <div
                    style={{
                      width: '40px',
                      height: '40px',
                      borderRadius: '50%',
                      backgroundColor: '#ffedd5',
                      color: '#ea580c',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '17px',
                      flexShrink: 0,
                      boxShadow: '0 4px 10px rgba(234, 88, 12, 0.15)',
                    }}
                  >
                    <i className="fa-regular fa-bell"></i>
                  </div>
                  <div>
                    <div style={{ fontSize: '15px', fontWeight: 800, color: '#1e293b', lineHeight: '1.2' }}>
                      Smart Reminders
                    </div>
                    <div style={{ fontSize: '13px', color: '#64748b', fontWeight: 500 }}>
                      Never miss important care
                    </div>
                  </div>
                </div>
              </div>

              {/* High-Resolution Foreground Pet Cutout */}
              <div
                style={{
                  position: 'relative',
                  marginTop: '10px',
                  maxWidth: '520px',
                }}
              >
                <img
                  src="/assets/img/pets-cutout.png"
                  alt="Golden Retriever dog and British Shorthair cat"
                  style={{
                    width: '100%',
                    height: 'auto',
                    display: 'block',
                    filter: 'drop-shadow(0 18px 30px rgba(0, 0, 0, 0.12))',
                  }}
                />
              </div>
            </div>
          </div>

          {/* ================= RIGHT COLUMN: FLOATING WHITE LOGIN CARD ================= */}
          <div style={{ position: 'relative', zIndex: 10 }}>
            <div
              style={{
                backgroundColor: '#ffffff',
                borderRadius: '28px',
                padding: '32px 34px',
                boxShadow: '0 24px 60px -12px rgba(0, 0, 0, 0.08), 0 0 1px 1px rgba(0, 0, 0, 0.02)',
                border: '1px solid #f1f5f9',
                maxWidth: '480px',
                margin: '0 auto',
              }}
            >
              {/* Paw Icon Badge */}
              <div style={{ textAlign: 'center', marginBottom: '10px' }}>
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
                    fontSize: '19px',
                    boxShadow: '0 4px 12px rgba(249, 92, 25, 0.12)',
                  }}
                >
                  <i className="fa-solid fa-paw"></i>
                </div>
              </div>

              {/* Title & Subtitle */}
              <div style={{ textAlign: 'center', marginBottom: '22px' }}>
                <h2
                  style={{
                    fontFamily: "'Outfit', sans-serif",
                    fontSize: '26px',
                    fontWeight: 800,
                    color: '#18212f',
                    letterSpacing: '-0.02em',
                    margin: '0 0 4px 0',
                  }}
                >
                  Welcome Back!
                </h2>
                <p style={{ fontSize: '13.5px', color: '#64748b', margin: 0, fontWeight: 500 }}>
                  Sign in to continue to your account
                </p>
              </div>

              {/* Error Message */}
              {errorMsg && (
                <div
                  style={{
                    backgroundColor: '#fef2f2',
                    border: '1px solid #fee2e2',
                    borderRadius: '11px',
                    padding: '10px 14px',
                    color: '#dc2626',
                    fontSize: '13px',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '8px',
                    marginBottom: '16px',
                  }}
                >
                  <i className="fa-solid fa-circle-exclamation" style={{ fontSize: '14px' }}></i>
                  <span>{errorMsg}</span>
                </div>
              )}

              {/* Form */}
              <form onSubmit={handleSubmit}>
                {/* Email Address */}
                <div style={{ marginBottom: '15px' }}>
                  <label
                    style={{
                      display: 'block',
                      fontSize: '12.5px',
                      fontWeight: 600,
                      color: '#334155',
                      marginBottom: '6px',
                    }}
                  >
                    Email Address
                  </label>
                  <div style={{ position: 'relative' }}>
                    <span
                      style={{
                        position: 'absolute',
                        left: '14px',
                        top: '50%',
                        transform: 'translateY(-50%)',
                        color: '#94a3b8',
                        fontSize: '14.5px',
                        pointerEvents: 'none',
                      }}
                    >
                      <i className="fa-regular fa-envelope"></i>
                    </span>
                    <input
                      type="email"
                      required
                      placeholder="Enter your email address"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      style={{
                        width: '100%',
                        padding: '11px 14px 11px 40px',
                        fontSize: '14px',
                        borderRadius: '11px',
                        border: '1.5px solid #e2e8f0',
                        backgroundColor: '#ffffff',
                        color: '#1e293b',
                        outline: 'none',
                        transition: 'border-color 0.2s, box-shadow 0.2s',
                      }}
                      onFocus={(e) => {
                        e.target.style.borderColor = '#f95c19';
                        e.target.style.boxShadow = '0 0 0 3px rgba(249, 92, 25, 0.12)';
                      }}
                      onBlur={(e) => {
                        e.target.style.borderColor = '#e2e8f0';
                        e.target.style.boxShadow = 'none';
                      }}
                    />
                  </div>
                </div>

                {/* Password */}
                <div style={{ marginBottom: '15px' }}>
                  <div
                    style={{
                      display: 'flex',
                      justifyContent: 'space-between',
                      alignItems: 'center',
                      marginBottom: '6px',
                    }}
                  >
                    <label
                      style={{
                        fontSize: '12.5px',
                        fontWeight: 600,
                        color: '#334155',
                        margin: 0,
                      }}
                    >
                      Password
                    </label>
                    <Link
                      to="/forgot-password"
                      style={{
                        fontSize: '12px',
                        fontWeight: 600,
                        color: '#f95c19',
                        textDecoration: 'none',
                      }}
                    >
                      Forgot Password?
                    </Link>
                  </div>

                  <div style={{ position: 'relative' }}>
                    <span
                      style={{
                        position: 'absolute',
                        left: '14px',
                        top: '50%',
                        transform: 'translateY(-50%)',
                        color: '#94a3b8',
                        fontSize: '14.5px',
                        pointerEvents: 'none',
                      }}
                    >
                      <i className="fa-solid fa-lock"></i>
                    </span>
                    <input
                      type={showPassword ? 'text' : 'password'}
                      required
                      placeholder="Enter your password"
                      value={password}
                      onChange={(e) => setPassword(e.target.value)}
                      style={{
                        width: '100%',
                        padding: '11px 40px 11px 40px',
                        fontSize: '14px',
                        borderRadius: '11px',
                        border: '1.5px solid #e2e8f0',
                        backgroundColor: '#ffffff',
                        color: '#1e293b',
                        outline: 'none',
                        transition: 'border-color 0.2s, box-shadow 0.2s',
                      }}
                      onFocus={(e) => {
                        e.target.style.borderColor = '#f95c19';
                        e.target.style.boxShadow = '0 0 0 3px rgba(249, 92, 25, 0.12)';
                      }}
                      onBlur={(e) => {
                        e.target.style.borderColor = '#e2e8f0';
                        e.target.style.boxShadow = 'none';
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
                        color: '#94a3b8',
                        cursor: 'pointer',
                        padding: '4px',
                        display: 'flex',
                        alignItems: 'center',
                      }}
                      aria-label={showPassword ? 'Hide password' : 'Show password'}
                    >
                      <i className={`fa-regular ${showPassword ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                    </button>
                  </div>
                </div>

                {/* Remember Me */}
                <div style={{ display: 'flex', alignItems: 'center', gap: '8px', marginBottom: '18px' }}>
                  <input
                    type="checkbox"
                    id="rememberMe"
                    checked={rememberMe}
                    onChange={(e) => setRememberMe(e.target.checked)}
                    style={{
                      width: '16px',
                      height: '16px',
                      accentColor: '#f95c19',
                      cursor: 'pointer',
                      borderRadius: '4px',
                    }}
                  />
                  <label
                    htmlFor="rememberMe"
                    style={{
                      fontSize: '13px',
                      color: '#475569',
                      cursor: 'pointer',
                      userSelect: 'none',
                      margin: 0,
                      fontWeight: 500,
                    }}
                  >
                    Remember me
                  </label>
                </div>

                {/* Sign In CTA Button */}
                <button
                  type="submit"
                  disabled={isSubmitting}
                  style={{
                    width: '100%',
                    padding: '12.5px',
                    borderRadius: '11px',
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
                    boxShadow: '0 6px 20px rgba(255, 69, 0, 0.3)',
                    transition: 'transform 0.15s, box-shadow 0.2s',
                  }}
                  onMouseEnter={(e) => {
                    if (!isSubmitting) {
                      e.currentTarget.style.transform = 'translateY(-1px)';
                      e.currentTarget.style.boxShadow = '0 8px 24px rgba(255, 69, 0, 0.36)';
                    }
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.transform = 'none';
                    e.currentTarget.style.boxShadow = '0 6px 20px rgba(255, 69, 0, 0.3)';
                  }}
                >
                  {isSubmitting ? (
                    <>
                      <span className="spinner-border spinner-border-sm" role="status"></span>
                      Signing In...
                    </>
                  ) : (
                    <>
                      Sign In <i className="fa-solid fa-arrow-right"></i>
                    </>
                  )}
                </button>
              </form>

              {/* Divider */}
              <div
                style={{
                  display: 'flex',
                  alignItems: 'center',
                  margin: '20px 0 14px 0',
                  color: '#94a3b8',
                  fontSize: '12px',
                }}
              >
                <div style={{ flex: 1, height: '1px', backgroundColor: '#e2e8f0' }} />
                <span style={{ padding: '0 10px', color: '#64748b', fontWeight: 500 }}>
                  or continue with
                </span>
                <div style={{ flex: 1, height: '1px', backgroundColor: '#e2e8f0' }} />
              </div>

              {/* Social Login Buttons */}
              <div style={{ display: 'flex', justifyContent: 'center', gap: '10px', marginBottom: '20px' }}>
                {/* Google */}
                <button
                  type="button"
                  style={{
                    flex: 1,
                    height: '40px',
                    borderRadius: '10px',
                    border: '1.5px solid #e2e8f0',
                    backgroundColor: '#ffffff',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    cursor: 'pointer',
                    transition: 'background-color 0.2s',
                  }}
                  onMouseEnter={(e) => (e.currentTarget.style.backgroundColor = '#f8fafc')}
                  onMouseLeave={(e) => (e.currentTarget.style.backgroundColor = '#ffffff')}
                >
                  <svg width="18" height="18" viewBox="0 0 24 24">
                    <path
                      fill="#4285F4"
                      d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                    />
                    <path
                      fill="#34A853"
                      d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                    />
                    <path
                      fill="#FBBC05"
                      d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"
                    />
                    <path
                      fill="#EA4335"
                      d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"
                    />
                  </svg>
                </button>

                {/* Facebook */}
                <button
                  type="button"
                  style={{
                    flex: 1,
                    height: '40px',
                    borderRadius: '10px',
                    border: '1.5px solid #e2e8f0',
                    backgroundColor: '#ffffff',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    cursor: 'pointer',
                    transition: 'background-color 0.2s',
                  }}
                  onMouseEnter={(e) => (e.currentTarget.style.backgroundColor = '#f8fafc')}
                  onMouseLeave={(e) => (e.currentTarget.style.backgroundColor = '#ffffff')}
                >
                  <i className="fa-brands fa-facebook" style={{ color: '#1877f2', fontSize: '18px' }}></i>
                </button>

                {/* Apple */}
                <button
                  type="button"
                  style={{
                    flex: 1,
                    height: '40px',
                    borderRadius: '10px',
                    border: '1.5px solid #e2e8f0',
                    backgroundColor: '#ffffff',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    cursor: 'pointer',
                    transition: 'background-color 0.2s',
                  }}
                  onMouseEnter={(e) => (e.currentTarget.style.backgroundColor = '#f8fafc')}
                  onMouseLeave={(e) => (e.currentTarget.style.backgroundColor = '#ffffff')}
                >
                  <i className="fa-brands fa-apple" style={{ color: '#000000', fontSize: '19px' }}></i>
                </button>
              </div>

              {/* Account Type Selector ("New to PetGuard? Choose your account type") */}
              <div style={{ borderTop: '1px solid #f1f5f9', paddingTop: '16px' }}>
                <p
                  style={{
                    fontSize: '12px',
                    fontWeight: 700,
                    color: '#475569',
                    textAlign: 'center',
                    marginBottom: '10px',
                  }}
                >
                  New to PetGuard? Choose your account type
                </p>

                <div
                  style={{
                    display: 'grid',
                    gridTemplateColumns: 'repeat(3, 1fr)',
                    gap: '6px',
                  }}
                >
                  {/* Pet Owner */}
                  <Link
                    to="/register/owner"
                    style={{
                      display: 'flex',
                      alignItems: 'center',
                      gap: '5px',
                      padding: '8px 6px',
                      borderRadius: '10px',
                      backgroundColor: '#ffffff',
                      border: '1.5px solid #e2e8f0',
                      textDecoration: 'none',
                      transition: 'all 0.2s',
                    }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.borderColor = '#f95c19';
                      e.currentTarget.style.backgroundColor = '#fff7ed';
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.borderColor = '#e2e8f0';
                      e.currentTarget.style.backgroundColor = '#ffffff';
                    }}
                  >
                    <div
                      style={{
                        width: '24px',
                        height: '24px',
                        borderRadius: '6px',
                        backgroundColor: '#ffedd5',
                        color: '#f95c19',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        fontSize: '11px',
                        flexShrink: 0,
                      }}
                    >
                      <i className="fa-solid fa-paw"></i>
                    </div>
                    <div style={{ minWidth: 0, flex: 1 }}>
                      <div style={{ fontSize: '10.5px', fontWeight: 700, color: '#1e293b', lineHeight: '1.1' }}>
                        Pet Owner
                      </div>
                      <div style={{ fontSize: '8.5px', color: '#64748b', whiteSpace: 'nowrap' }}>
                        For parents
                      </div>
                    </div>
                    <i className="fa-solid fa-chevron-right" style={{ fontSize: '8px', color: '#94a3b8' }}></i>
                  </Link>

                  {/* Veterinarian */}
                  <Link
                    to="/register/veterinarian"
                    style={{
                      display: 'flex',
                      alignItems: 'center',
                      gap: '5px',
                      padding: '8px 6px',
                      borderRadius: '10px',
                      backgroundColor: '#ffffff',
                      border: '1.5px solid #e2e8f0',
                      textDecoration: 'none',
                      transition: 'all 0.2s',
                    }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.borderColor = '#2563eb';
                      e.currentTarget.style.backgroundColor = '#eff6ff';
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.borderColor = '#e2e8f0';
                      e.currentTarget.style.backgroundColor = '#ffffff';
                    }}
                  >
                    <div
                      style={{
                        width: '24px',
                        height: '24px',
                        borderRadius: '6px',
                        backgroundColor: '#dbeafe',
                        color: '#2563eb',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        fontSize: '11px',
                        flexShrink: 0,
                      }}
                    >
                      <i className="fa-solid fa-stethoscope"></i>
                    </div>
                    <div style={{ minWidth: 0, flex: 1 }}>
                      <div style={{ fontSize: '10.5px', fontWeight: 700, color: '#1e293b', lineHeight: '1.1' }}>
                        Vet
                      </div>
                      <div style={{ fontSize: '8.5px', color: '#64748b', whiteSpace: 'nowrap' }}>
                        Doctors
                      </div>
                    </div>
                    <i className="fa-solid fa-chevron-right" style={{ fontSize: '8px', color: '#94a3b8' }}></i>
                  </Link>

                  {/* Animal Shelter */}
                  <Link
                    to="/register/shelter"
                    style={{
                      display: 'flex',
                      alignItems: 'center',
                      gap: '5px',
                      padding: '8px 6px',
                      borderRadius: '10px',
                      backgroundColor: '#ffffff',
                      border: '1.5px solid #e2e8f0',
                      textDecoration: 'none',
                      transition: 'all 0.2s',
                    }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.borderColor = '#9333ea';
                      e.currentTarget.style.backgroundColor = '#faf5ff';
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.borderColor = '#e2e8f0';
                      e.currentTarget.style.backgroundColor = '#ffffff';
                    }}
                  >
                    <div
                      style={{
                        width: '24px',
                        height: '24px',
                        borderRadius: '6px',
                        backgroundColor: '#f3e8ff',
                        color: '#9333ea',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        fontSize: '11px',
                        flexShrink: 0,
                      }}
                    >
                      <i className="fa-solid fa-house-chimney-medical"></i>
                    </div>
                    <div style={{ minWidth: 0, flex: 1 }}>
                      <div style={{ fontSize: '10.5px', fontWeight: 700, color: '#1e293b', lineHeight: '1.1' }}>
                        Shelter
                      </div>
                      <div style={{ fontSize: '8.5px', color: '#64748b', whiteSpace: 'nowrap' }}>
                        Rescues
                      </div>
                    </div>
                    <i className="fa-solid fa-chevron-right" style={{ fontSize: '8px', color: '#94a3b8' }}></i>
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* ================= BOTTOM FLOATING TRUST BADGES DOCK ================= */}
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
          {/* Badge 1: Trusted by Pet Parents */}
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div
                style={{
                  width: '32px',
                  height: '32px',
                  borderRadius: '50%',
                  backgroundColor: '#ecfdf5',
                  color: '#059669',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  fontSize: '14px',
                }}
              >
                <i className="fa-solid fa-star"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Trusted by Parents</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>10K+ happy families</div>
              </div>
            </div>
          </div>

          {/* Badge 2: Expert Veterinarians */}
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div
                style={{
                  width: '32px',
                  height: '32px',
                  borderRadius: '50%',
                  backgroundColor: '#eff6ff',
                  color: '#2563eb',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  fontSize: '14px',
                }}
              >
                <i className="fa-solid fa-stethoscope"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Expert Vets</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>Verified professionals</div>
              </div>
            </div>
          </div>

          {/* Badge 3: 24/7 Support */}
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div
                style={{
                  width: '32px',
                  height: '32px',
                  borderRadius: '50%',
                  backgroundColor: '#ecfdf5',
                  color: '#10b981',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  fontSize: '14px',
                }}
              >
                <i className="fa-regular fa-clock"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>24/7 Support</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>We&apos;re always here</div>
              </div>
            </div>
          </div>

          {/* Badge 4: Safe & Secure */}
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div
                style={{
                  width: '32px',
                  height: '32px',
                  borderRadius: '50%',
                  backgroundColor: '#ecfdf5',
                  color: '#059669',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  fontSize: '14px',
                }}
              >
                <i className="fa-solid fa-shield-halved"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Safe &amp; Secure</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>HIPAA compliant</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
