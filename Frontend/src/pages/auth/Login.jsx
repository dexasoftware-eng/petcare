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
        backgroundColor: '#faf8f5',
        backgroundImage: `
          radial-gradient(circle at 10% 20%, rgba(254, 215, 170, 0.25) 0%, transparent 40%),
          radial-gradient(circle at 90% 80%, rgba(253, 186, 116, 0.2) 0%, transparent 45%)
        `,
        minHeight: '100vh',
        position: 'relative',
        overflow: 'hidden',
        padding: '50px 0 70px 0',
        fontFamily: "'Segoe UI', Roboto, Helvetica, Arial, sans-serif",
      }}
    >
      {/* Decorative Warm Background Shapes */}
      <div
        style={{
          position: 'absolute',
          bottom: '-120px',
          left: '-120px',
          width: '450px',
          height: '450px',
          borderRadius: '50%',
          background: 'linear-gradient(135deg, rgba(255, 126, 41, 0.12) 0%, rgba(255, 237, 213, 0.05) 100%)',
          filter: 'blur(30px)',
          zIndex: 0,
          pointerEvents: 'none',
        }}
      />
      <div
        style={{
          position: 'absolute',
          top: '20px',
          right: '-100px',
          width: '400px',
          height: '400px',
          borderRadius: '50%',
          background: 'linear-gradient(135deg, rgba(255, 107, 44, 0.08) 0%, transparent 70%)',
          filter: 'blur(40px)',
          zIndex: 0,
          pointerEvents: 'none',
        }}
      />

      <div className="container" style={{ position: 'relative', zIndex: 1, maxWidth: '1240px' }}>
        <div className="row align-items-center justify-content-between g-5">
          {/* ================= LEFT COLUMN ================= */}
          <div className="col-lg-6 col-md-12">
            <div style={{ maxWidth: '540px', margin: '0 auto' }}>
              {/* Heading */}
              <h1
                style={{
                  fontSize: 'clamp(34px, 4vw, 48px)',
                  fontWeight: 800,
                  color: '#1e293b',
                  lineHeight: '1.18',
                  letterSpacing: '-0.02em',
                  marginBottom: '16px',
                }}
              >
                Your Pet&apos;s Health, <br />
                Our <span style={{ color: '#f95c19' }}>Priority</span>{' '}
                <span style={{ color: '#f95c19', fontSize: '0.9em' }}>
                  <i className="fa-regular fa-heart"></i>
                </span>
              </h1>

              {/* Subtitle */}
              <p
                style={{
                  fontSize: '16px',
                  color: '#64748b',
                  lineHeight: '1.6',
                  marginBottom: '32px',
                  maxWidth: '480px',
                }}
              >
                Manage your pet&apos;s health, appointments, and care all in one secure place.
              </p>

              {/* 3 Value Propositions */}
              <div style={{ display: 'flex', flexDirection: 'column', gap: '20px', marginBottom: '36px' }}>
                {/* Item 1 */}
                <div style={{ display: 'flex', alignItems: 'center', gap: '16px' }}>
                  <div
                    style={{
                      width: '48px',
                      height: '48px',
                      borderRadius: '14px',
                      backgroundColor: '#ffedd5',
                      color: '#f95c19',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '20px',
                      flexShrink: 0,
                    }}
                  >
                    <i className="fa-solid fa-shield-halved"></i>
                  </div>
                  <div>
                    <h4 style={{ fontSize: '16px', fontWeight: 700, color: '#1e293b', margin: '0 0 2px 0' }}>
                      Secure &amp; Private
                    </h4>
                    <p style={{ fontSize: '13.5px', color: '#64748b', margin: 0 }}>
                      Your pet&apos;s data is always protected
                    </p>
                  </div>
                </div>

                {/* Item 2 */}
                <div style={{ display: 'flex', alignItems: 'center', gap: '16px' }}>
                  <div
                    style={{
                      width: '48px',
                      height: '48px',
                      borderRadius: '14px',
                      backgroundColor: '#ffedd5',
                      color: '#f95c19',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '20px',
                      flexShrink: 0,
                    }}
                  >
                    <i className="fa-regular fa-calendar-days"></i>
                  </div>
                  <div>
                    <h4 style={{ fontSize: '16px', fontWeight: 700, color: '#1e293b', margin: '0 0 2px 0' }}>
                      Easy Appointments
                    </h4>
                    <p style={{ fontSize: '13.5px', color: '#64748b', margin: 0 }}>
                      Book vet visits with ease
                    </p>
                  </div>
                </div>

                {/* Item 3 */}
                <div style={{ display: 'flex', alignItems: 'center', gap: '16px' }}>
                  <div
                    style={{
                      width: '48px',
                      height: '48px',
                      borderRadius: '14px',
                      backgroundColor: '#ffedd5',
                      color: '#f95c19',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '20px',
                      flexShrink: 0,
                    }}
                  >
                    <i className="fa-regular fa-bell"></i>
                  </div>
                  <div>
                    <h4 style={{ fontSize: '16px', fontWeight: 700, color: '#1e293b', margin: '0 0 2px 0' }}>
                      Smart Reminders
                    </h4>
                    <p style={{ fontSize: '13.5px', color: '#64748b', margin: 0 }}>
                      Never miss important care
                    </p>
                  </div>
                </div>
              </div>

              {/* Pet Photo (Dog & Cat together) */}
              <div
                style={{
                  position: 'relative',
                  borderRadius: '24px',
                  overflow: 'hidden',
                  boxShadow: '0 20px 40px -15px rgba(0, 0, 0, 0.12)',
                  border: '4px solid #ffffff',
                  backgroundColor: '#ffffff',
                }}
              >
                <img
                  src="/assets/img/login-pets.jpg"
                  alt="Golden Retriever Dog and Cute Cat"
                  style={{
                    width: '100%',
                    height: 'auto',
                    display: 'block',
                    objectFit: 'cover',
                    maxHeight: '340px',
                    transition: 'transform 0.4s ease',
                  }}
                />
              </div>
            </div>
          </div>

          {/* ================= RIGHT COLUMN (LOGIN FORM CARD) ================= */}
          <div className="col-lg-6 col-md-12">
            <div
              style={{
                backgroundColor: '#ffffff',
                borderRadius: '28px',
                padding: 'clamp(28px, 4vw, 42px) clamp(24px, 4vw, 38px)',
                boxShadow: '0 25px 60px -15px rgba(0, 0, 0, 0.08), 0 0 1px 1px rgba(0, 0, 0, 0.04)',
                border: '1px solid #f1f5f9',
                maxWidth: '520px',
                margin: '0 auto',
              }}
            >
              {/* Top Badge Icon */}
              <div style={{ textAlign: 'center', marginBottom: '16px' }}>
                <div
                  style={{
                    width: '56px',
                    height: '56px',
                    borderRadius: '50%',
                    backgroundColor: '#fff3eb',
                    color: '#f95c19',
                    display: 'inline-flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '24px',
                    boxShadow: '0 4px 14px rgba(249, 92, 25, 0.15)',
                  }}
                >
                  <i className="fa-solid fa-paw"></i>
                </div>
              </div>

              {/* Card Title & Subtitle */}
              <div style={{ textAlign: 'center', marginBottom: '28px' }}>
                <h2
                  style={{
                    fontSize: '28px',
                    fontWeight: 800,
                    color: '#1e293b',
                    letterSpacing: '-0.02em',
                    margin: '0 0 6px 0',
                  }}
                >
                  Welcome Back!
                </h2>
                <p style={{ fontSize: '14px', color: '#64748b', margin: 0 }}>
                  Sign in to continue to your account
                </p>
              </div>

              {/* Error Message Alert */}
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

              {/* Sign In Form */}
              <form onSubmit={handleSubmit}>
                {/* Email Field */}
                <div style={{ marginBottom: '18px' }}>
                  <label
                    style={{
                      display: 'block',
                      fontSize: '13.5px',
                      fontWeight: 600,
                      color: '#334155',
                      marginBottom: '8px',
                    }}
                  >
                    Email Address
                  </label>
                  <div style={{ position: 'relative' }}>
                    <span
                      style={{
                        position: 'absolute',
                        left: '16px',
                        top: '50%',
                        transform: 'translateY(-50%)',
                        color: '#94a3b8',
                        fontSize: '16px',
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
                        padding: '13px 16px 13px 44px',
                        fontSize: '14.5px',
                        borderRadius: '12px',
                        border: '1.5px solid #e2e8f0',
                        backgroundColor: '#ffffff',
                        color: '#1e293b',
                        outline: 'none',
                        transition: 'border-color 0.2s ease, box-shadow 0.2s ease',
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

                {/* Password Field */}
                <div style={{ marginBottom: '18px' }}>
                  <div
                    style={{
                      display: 'flex',
                      justifyContent: 'space-between',
                      alignItems: 'center',
                      marginBottom: '8px',
                    }}
                  >
                    <label
                      style={{
                        fontSize: '13.5px',
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
                        fontSize: '12.5px',
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
                        left: '16px',
                        top: '50%',
                        transform: 'translateY(-50%)',
                        color: '#94a3b8',
                        fontSize: '16px',
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
                        padding: '13px 44px 13px 44px',
                        fontSize: '14.5px',
                        borderRadius: '12px',
                        border: '1.5px solid #e2e8f0',
                        backgroundColor: '#ffffff',
                        color: '#1e293b',
                        outline: 'none',
                        transition: 'border-color 0.2s ease, box-shadow 0.2s ease',
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
                        right: '14px',
                        top: '50%',
                        transform: 'translateY(-50%)',
                        background: 'none',
                        border: 'none',
                        color: '#94a3b8',
                        cursor: 'pointer',
                        padding: '4px',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                      }}
                      aria-label={showPassword ? 'Hide password' : 'Show password'}
                    >
                      <i className={`fa-regular ${showPassword ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                    </button>
                  </div>
                </div>

                {/* Remember Me Checkbox */}
                <div style={{ display: 'flex', alignItems: 'center', gap: '8px', marginBottom: '22px' }}>
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
                      fontSize: '13.5px',
                      color: '#475569',
                      cursor: 'pointer',
                      userSelect: 'none',
                      margin: 0,
                    }}
                  >
                    Remember me
                  </label>
                </div>

                {/* Sign In Primary CTA */}
                <button
                  type="submit"
                  disabled={isSubmitting}
                  style={{
                    width: '100%',
                    padding: '14px',
                    borderRadius: '12px',
                    background: 'linear-gradient(135deg, #ff6929 0%, #f54a00 100%)',
                    border: 'none',
                    color: '#ffffff',
                    fontSize: '15.5px',
                    fontWeight: 700,
                    cursor: isSubmitting ? 'not-allowed' : 'pointer',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    gap: '10px',
                    boxShadow: '0 8px 22px rgba(245, 74, 0, 0.32)',
                    transition: 'transform 0.15s ease, box-shadow 0.2s ease',
                  }}
                  onMouseEnter={(e) => {
                    if (!isSubmitting) {
                      e.currentTarget.style.transform = 'translateY(-1px)';
                      e.currentTarget.style.boxShadow = '0 10px 25px rgba(245, 74, 0, 0.4)';
                    }
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.transform = 'none';
                    e.currentTarget.style.boxShadow = '0 8px 22px rgba(245, 74, 0, 0.32)';
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

              {/* Social Login Divider */}
              <div
                style={{
                  display: 'flex',
                  alignItems: 'center',
                  margin: '24px 0 20px 0',
                  color: '#94a3b8',
                  fontSize: '13px',
                }}
              >
                <div style={{ flex: 1, height: '1px', backgroundColor: '#e2e8f0' }} />
                <span style={{ padding: '0 12px', color: '#64748b', fontWeight: 500 }}>
                  or continue with
                </span>
                <div style={{ flex: 1, height: '1px', backgroundColor: '#e2e8f0' }} />
              </div>

              {/* Social Login Buttons (Google, Facebook, Apple) */}
              <div style={{ display: 'flex', justifyContent: 'center', gap: '14px', marginBottom: '28px' }}>
                {/* Google */}
                <button
                  type="button"
                  style={{
                    flex: 1,
                    height: '44px',
                    borderRadius: '12px',
                    border: '1.5px solid #e2e8f0',
                    backgroundColor: '#ffffff',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    cursor: 'pointer',
                    transition: 'background-color 0.2s, border-color 0.2s',
                  }}
                  onMouseEnter={(e) => {
                    e.currentTarget.style.backgroundColor = '#f8fafc';
                    e.currentTarget.style.borderColor = '#cbd5e1';
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.backgroundColor = '#ffffff';
                    e.currentTarget.style.borderColor = '#e2e8f0';
                  }}
                  title="Sign in with Google"
                >
                  <svg width="20" height="20" viewBox="0 0 24 24">
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
                    height: '44px',
                    borderRadius: '12px',
                    border: '1.5px solid #e2e8f0',
                    backgroundColor: '#ffffff',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    cursor: 'pointer',
                    color: '#1877f2',
                    fontSize: '20px',
                    transition: 'background-color 0.2s, border-color 0.2s',
                  }}
                  onMouseEnter={(e) => {
                    e.currentTarget.style.backgroundColor = '#f8fafc';
                    e.currentTarget.style.borderColor = '#cbd5e1';
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.backgroundColor = '#ffffff';
                    e.currentTarget.style.borderColor = '#e2e8f0';
                  }}
                  title="Sign in with Facebook"
                >
                  <i className="fa-brands fa-facebook"></i>
                </button>

                {/* Apple */}
                <button
                  type="button"
                  style={{
                    flex: 1,
                    height: '44px',
                    borderRadius: '12px',
                    border: '1.5px solid #e2e8f0',
                    backgroundColor: '#ffffff',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    cursor: 'pointer',
                    color: '#000000',
                    fontSize: '20px',
                    transition: 'background-color 0.2s, border-color 0.2s',
                  }}
                  onMouseEnter={(e) => {
                    e.currentTarget.style.backgroundColor = '#f8fafc';
                    e.currentTarget.style.borderColor = '#cbd5e1';
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.backgroundColor = '#ffffff';
                    e.currentTarget.style.borderColor = '#e2e8f0';
                  }}
                  title="Sign in with Apple"
                >
                  <i className="fa-brands fa-apple"></i>
                </button>
              </div>

              {/* Registration Options / Choose Account Type */}
              <div
                style={{
                  borderTop: '1px solid #f1f5f9',
                  paddingTop: '22px',
                }}
              >
                <p
                  style={{
                    fontSize: '13.5px',
                    fontWeight: 700,
                    color: '#475569',
                    textAlign: 'center',
                    marginBottom: '14px',
                  }}
                >
                  New to PetGuard? Choose your account type
                </p>

                <div style={{ display: 'flex', flexDirection: 'column', gap: '10px' }}>
                  {/* Pet Owner */}
                  <Link
                    to="/register/owner"
                    style={{
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'space-between',
                      padding: '10px 14px',
                      borderRadius: '14px',
                      backgroundColor: '#f8fafc',
                      border: '1.5px solid #e2e8f0',
                      textDecoration: 'none',
                      transition: 'all 0.2s ease',
                    }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.backgroundColor = '#fff7ed';
                      e.currentTarget.style.borderColor = '#fdba74';
                      e.currentTarget.style.transform = 'translateY(-1px)';
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.backgroundColor = '#f8fafc';
                      e.currentTarget.style.borderColor = '#e2e8f0';
                      e.currentTarget.style.transform = 'none';
                    }}
                  >
                    <div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
                      <div
                        style={{
                          width: '36px',
                          height: '36px',
                          borderRadius: '10px',
                          backgroundColor: '#ffedd5',
                          color: '#f95c19',
                          display: 'flex',
                          alignItems: 'center',
                          justifyContent: 'center',
                          fontSize: '16px',
                        }}
                      >
                        <i className="fa-solid fa-paw"></i>
                      </div>
                      <div>
                        <div style={{ fontSize: '13.5px', fontWeight: 700, color: '#1e293b' }}>
                          Pet Owner
                        </div>
                        <div style={{ fontSize: '11.5px', color: '#64748b' }}>
                          For pet parents
                        </div>
                      </div>
                    </div>
                    <i className="fa-solid fa-chevron-right" style={{ fontSize: '12px', color: '#94a3b8' }}></i>
                  </Link>

                  {/* Veterinarian */}
                  <Link
                    to="/register/veterinarian"
                    style={{
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'space-between',
                      padding: '10px 14px',
                      borderRadius: '14px',
                      backgroundColor: '#f8fafc',
                      border: '1.5px solid #e2e8f0',
                      textDecoration: 'none',
                      transition: 'all 0.2s ease',
                    }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.backgroundColor = '#eff6ff';
                      e.currentTarget.style.borderColor = '#93c5fd';
                      e.currentTarget.style.transform = 'translateY(-1px)';
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.backgroundColor = '#f8fafc';
                      e.currentTarget.style.borderColor = '#e2e8f0';
                      e.currentTarget.style.transform = 'none';
                    }}
                  >
                    <div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
                      <div
                        style={{
                          width: '36px',
                          height: '36px',
                          borderRadius: '10px',
                          backgroundColor: '#dbeafe',
                          color: '#2563eb',
                          display: 'flex',
                          alignItems: 'center',
                          justifyContent: 'center',
                          fontSize: '16px',
                        }}
                      >
                        <i className="fa-solid fa-stethoscope"></i>
                      </div>
                      <div>
                        <div style={{ fontSize: '13.5px', fontWeight: 700, color: '#1e293b' }}>
                          Veterinarian
                        </div>
                        <div style={{ fontSize: '11.5px', color: '#64748b' }}>
                          For vet professionals
                        </div>
                      </div>
                    </div>
                    <i className="fa-solid fa-chevron-right" style={{ fontSize: '12px', color: '#94a3b8' }}></i>
                  </Link>

                  {/* Animal Shelter */}
                  <Link
                    to="/register/shelter"
                    style={{
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'space-between',
                      padding: '10px 14px',
                      borderRadius: '14px',
                      backgroundColor: '#f8fafc',
                      border: '1.5px solid #e2e8f0',
                      textDecoration: 'none',
                      transition: 'all 0.2s ease',
                    }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.backgroundColor = '#faf5ff';
                      e.currentTarget.style.borderColor = '#d8b4fe';
                      e.currentTarget.style.transform = 'translateY(-1px)';
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.backgroundColor = '#f8fafc';
                      e.currentTarget.style.borderColor = '#e2e8f0';
                      e.currentTarget.style.transform = 'none';
                    }}
                  >
                    <div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
                      <div
                        style={{
                          width: '36px',
                          height: '36px',
                          borderRadius: '10px',
                          backgroundColor: '#f3e8ff',
                          color: '#9333ea',
                          display: 'flex',
                          alignItems: 'center',
                          justifyContent: 'center',
                          fontSize: '16px',
                        }}
                      >
                        <i className="fa-solid fa-house-chimney-medical"></i>
                      </div>
                      <div>
                        <div style={{ fontSize: '13.5px', fontWeight: 700, color: '#1e293b' }}>
                          Animal Shelter
                        </div>
                        <div style={{ fontSize: '11.5px', color: '#64748b' }}>
                          For shelters &amp; rescues
                        </div>
                      </div>
                    </div>
                    <i className="fa-solid fa-chevron-right" style={{ fontSize: '12px', color: '#94a3b8' }}></i>
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* ================= BOTTOM FLOATING TRUST BAR ================= */}
        <div
          style={{
            marginTop: '55px',
            backgroundColor: '#ffffff',
            borderRadius: '20px',
            padding: '18px 28px',
            boxShadow: '0 10px 30px rgba(0, 0, 0, 0.04)',
            border: '1px solid #f1f5f9',
          }}
        >
          <div className="row g-4 align-items-center text-start">
            {/* Trust 1 */}
            <div className="col-lg-3 col-md-6 col-12">
              <div style={{ display: 'flex', alignItems: 'center', gap: '14px' }}>
                <div
                  style={{
                    width: '42px',
                    height: '42px',
                    borderRadius: '12px',
                    backgroundColor: '#ecfdf5',
                    color: '#10b981',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '18px',
                    flexShrink: 0,
                  }}
                >
                  <i className="fa-solid fa-star"></i>
                </div>
                <div>
                  <div style={{ fontSize: '14px', fontWeight: 700, color: '#1e293b' }}>
                    Trusted by Pet Parents
                  </div>
                  <div style={{ fontSize: '12.5px', color: '#64748b' }}>
                    10K+ happy families
                  </div>
                </div>
              </div>
            </div>

            {/* Trust 2 */}
            <div className="col-lg-3 col-md-6 col-12">
              <div style={{ display: 'flex', alignItems: 'center', gap: '14px' }}>
                <div
                  style={{
                    width: '42px',
                    height: '42px',
                    borderRadius: '12px',
                    backgroundColor: '#f0fdf4',
                    color: '#16a34a',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '18px',
                    flexShrink: 0,
                  }}
                >
                  <i className="fa-solid fa-user-doctor"></i>
                </div>
                <div>
                  <div style={{ fontSize: '14px', fontWeight: 700, color: '#1e293b' }}>
                    Expert Veterinarians
                  </div>
                  <div style={{ fontSize: '12.5px', color: '#64748b' }}>
                    Verified professionals
                  </div>
                </div>
              </div>
            </div>

            {/* Trust 3 */}
            <div className="col-lg-3 col-md-6 col-12">
              <div style={{ display: 'flex', alignItems: 'center', gap: '14px' }}>
                <div
                  style={{
                    width: '42px',
                    height: '42px',
                    borderRadius: '12px',
                    backgroundColor: '#f0fdfa',
                    color: '#0d9488',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '18px',
                    flexShrink: 0,
                  }}
                >
                  <i className="fa-regular fa-clock"></i>
                </div>
                <div>
                  <div style={{ fontSize: '14px', fontWeight: 700, color: '#1e293b' }}>
                    24/7 Support
                  </div>
                  <div style={{ fontSize: '12.5px', color: '#64748b' }}>
                    We&apos;re always here
                  </div>
                </div>
              </div>
            </div>

            {/* Trust 4 */}
            <div className="col-lg-3 col-md-6 col-12">
              <div style={{ display: 'flex', alignItems: 'center', gap: '14px' }}>
                <div
                  style={{
                    width: '42px',
                    height: '42px',
                    borderRadius: '12px',
                    backgroundColor: '#f8fafc',
                    color: '#475569',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '18px',
                    flexShrink: 0,
                  }}
                >
                  <i className="fa-solid fa-shield-check"></i>
                </div>
                <div>
                  <div style={{ fontSize: '14px', fontWeight: 700, color: '#1e293b' }}>
                    Safe &amp; Secure
                  </div>
                  <div style={{ fontSize: '12.5px', color: '#64748b' }}>
                    HIPAA compliant
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
