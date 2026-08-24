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
        fontFamily: "'Plus Jakarta Sans', 'Outfit', system-ui, -apple-system, sans-serif",
      }}
    >
      {/* Decorative Scattered Watermark Paw Prints */}
      <div
        style={{
          position: 'absolute',
          top: '30px',
          left: '310px',
          color: 'rgba(235, 195, 155, 0.35)',
          fontSize: '44px',
          transform: 'rotate(-15deg)',
          pointerEvents: 'none',
          zIndex: 0,
        }}
      >
        <i className="fa-solid fa-paw"></i>
      </div>
      <div
        style={{
          position: 'absolute',
          top: '150px',
          left: '410px',
          color: 'rgba(235, 195, 155, 0.28)',
          fontSize: '36px',
          transform: 'rotate(25deg)',
          pointerEvents: 'none',
          zIndex: 0,
        }}
      >
        <i className="fa-solid fa-paw"></i>
      </div>
      <div
        style={{
          position: 'absolute',
          top: '480px',
          left: '110px',
          color: 'rgba(235, 195, 155, 0.32)',
          fontSize: '40px',
          transform: 'rotate(10deg)',
          pointerEvents: 'none',
          zIndex: 0,
        }}
      >
        <i className="fa-solid fa-paw"></i>
      </div>
      <div
        style={{
          position: 'absolute',
          top: '100px',
          right: '50px',
          color: 'rgba(235, 195, 155, 0.22)',
          fontSize: '42px',
          transform: 'rotate(-20deg)',
          pointerEvents: 'none',
          zIndex: 0,
        }}
      >
        <i className="fa-solid fa-paw"></i>
      </div>

      {/* Decorative Curved Dotted SVG Line & Heart in Left Canvas */}
      <svg
        style={{
          position: 'absolute',
          top: '160px',
          left: '260px',
          width: '240px',
          height: '180px',
          pointerEvents: 'none',
          zIndex: 0,
        }}
        viewBox="0 0 240 180"
        fill="none"
      >
        <path
          d="M 10 160 C 80 40, 160 30, 220 10"
          stroke="rgba(249, 115, 22, 0.2)"
          strokeWidth="1.5"
          strokeDasharray="4 4"
        />
        <path
          d="M 195 25 C 190 20, 185 24, 185 28 C 185 36, 195 44, 195 44 C 195 44, 205 36, 205 28 C 205 24, 200 20, 195 25 Z"
          stroke="#f97316"
          strokeWidth="1.2"
          fill="none"
        />
      </svg>

      {/* Bottom Left Vibrant Orange Fluid Wave */}
      <div
        style={{
          position: 'absolute',
          bottom: '-60px',
          left: '-60px',
          width: '480px',
          height: '380px',
          background: 'linear-gradient(135deg, #ff8a34 0%, #f95c19 100%)',
          borderRadius: '45% 55% 65% 35% / 40% 45% 55% 60%',
          zIndex: 1,
          pointerEvents: 'none',
          boxShadow: '0 20px 45px rgba(249, 92, 25, 0.22)',
        }}
      />

      {/* Small Paw Badge on Left Curve */}
      <div
        style={{
          position: 'absolute',
          bottom: '240px',
          left: '42px',
          width: '36px',
          height: '36px',
          borderRadius: '50%',
          backgroundColor: 'rgba(255, 255, 255, 0.28)',
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
          color: '#ffffff',
          fontSize: '16px',
          zIndex: 2,
        }}
      >
        <i className="fa-solid fa-paw"></i>
      </div>

      {/* ================= MAIN CONTAINER ================= */}
      <div
        style={{
          maxWidth: '1360px',
          margin: '0 auto',
          width: '100%',
          padding: '24px 32px 0 32px',
          position: 'relative',
          zIndex: 2,
          flex: 1,
        }}
      >
        {/* Top-Left PetGuard Logo */}
        <div style={{ marginBottom: '18px' }}>
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
                width: '40px',
                height: '40px',
                borderRadius: '12px',
                background: 'linear-gradient(135deg, #ff7a29 0%, #f24e07 100%)',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                color: '#ffffff',
                fontSize: '19px',
                boxShadow: '0 6px 16px rgba(242, 78, 7, 0.28)',
              }}
            >
              <i className="fa-solid fa-shield-cat"></i>
            </div>
            <div>
              <div
                style={{
                  fontSize: '22px',
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
                  fontSize: '10.5px',
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

        {/* 2-Column Grid */}
        <div
          style={{
            display: 'grid',
            gridTemplateColumns: 'minmax(0, 1.2fr) minmax(360px, 480px)',
            alignItems: 'center',
            gap: '36px',
          }}
          className="auth-grid-responsive"
        >
          {/* ================= LEFT COLUMN ================= */}
          <div style={{ position: 'relative' }}>
            <div style={{ maxWidth: '560px' }}>
              {/* Heading */}
              <h1
                style={{
                  fontFamily: "'Outfit', sans-serif",
                  fontSize: 'clamp(34px, 3.8vw, 48px)',
                  fontWeight: 900,
                  color: '#18212f',
                  lineHeight: '1.14',
                  letterSpacing: '-0.03em',
                  marginBottom: '14px',
                }}
              >
                Because Their <br />
                Health Means <br />
                <span style={{ color: '#f95c19' }}>Everything</span>{' '}
                <span style={{ color: '#f95c19', fontSize: '0.82em', verticalAlign: 'middle' }}>
                  <i className="fa-regular fa-heart"></i>
                </span>
              </h1>

              {/* Subtitle */}
              <p
                style={{
                  fontSize: '15px',
                  color: '#556579',
                  lineHeight: '1.55',
                  marginBottom: '18px',
                  maxWidth: '460px',
                }}
              >
                PetGuard helps you manage your pet&apos;s health, appointments, and daily care —all in one secure place.
              </p>

              {/* Cozy Home Pets Photo & Floating Trusted Card */}
              <div
                style={{
                  position: 'relative',
                  marginTop: '12px',
                }}
              >
                {/* Floating "Trusted by 10K+ Pet Parents" Card */}
                <div
                  style={{
                    position: 'absolute',
                    top: '28px',
                    left: '-10px',
                    backgroundColor: '#ffffff',
                    borderRadius: '16px',
                    padding: '12px 18px',
                    boxShadow: '0 12px 30px rgba(0, 0, 0, 0.09)',
                    zIndex: 4,
                    border: '1px solid rgba(241, 245, 249, 0.95)',
                  }}
                >
                  <div style={{ fontSize: '11px', color: '#64748b', fontWeight: 600, marginBottom: '2px' }}>
                    Trusted by
                  </div>
                  <div style={{ fontSize: '13.5px', fontWeight: 800, color: '#18212f', marginBottom: '8px' }}>
                    10K+ Pet Parents
                  </div>
                  {/* Avatar Stack */}
                  <div style={{ display: 'flex', alignItems: 'center' }}>
                    <img
                      src="/assets/img/team-1.jpg"
                      alt="Parent 1"
                      style={{
                        width: '26px',
                        height: '26px',
                        borderRadius: '50%',
                        border: '2px solid #ffffff',
                        objectFit: 'cover',
                      }}
                    />
                    <img
                      src="/assets/img/team-2.jpg"
                      alt="Parent 2"
                      style={{
                        width: '26px',
                        height: '26px',
                        borderRadius: '50%',
                        border: '2px solid #ffffff',
                        marginLeft: '-7px',
                        objectFit: 'cover',
                      }}
                    />
                    <img
                      src="/assets/img/team-3.jpg"
                      alt="Parent 3"
                      style={{
                        width: '26px',
                        height: '26px',
                        borderRadius: '50%',
                        border: '2px solid #ffffff',
                        marginLeft: '-7px',
                        objectFit: 'cover',
                      }}
                    />
                    <div
                      style={{
                        width: '26px',
                        height: '26px',
                        borderRadius: '50%',
                        backgroundColor: '#ffedd5',
                        color: '#f95c19',
                        fontSize: '9px',
                        fontWeight: 800,
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        border: '2px solid #ffffff',
                        marginLeft: '-7px',
                      }}
                    >
                      10K+
                    </div>
                  </div>
                </div>

                {/* Cozy Home Dog and Cat Image */}
                <div
                  style={{
                    position: 'relative',
                    borderRadius: '24px',
                    overflow: 'hidden',
                    boxShadow: '0 16px 36px -10px rgba(0, 0, 0, 0.1)',
                    backgroundColor: '#ffffff',
                    border: '3px solid #ffffff',
                  }}
                >
                  <img
                    src="/assets/img/login-pets-home.jpg"
                    alt="Golden Retriever Dog and Cat in cozy living room"
                    style={{
                      width: '100%',
                      height: 'auto',
                      maxHeight: '340px',
                      objectFit: 'cover',
                      display: 'block',
                    }}
                  />
                </div>
              </div>
            </div>
          </div>

          {/* ================= RIGHT COLUMN (LOGIN FORM CARD) ================= */}
          <div>
            <div
              style={{
                backgroundColor: '#ffffff',
                borderRadius: '28px',
                padding: '30px 32px',
                boxShadow: '0 20px 50px -10px rgba(0, 0, 0, 0.05), 0 0 1px 1px rgba(0, 0, 0, 0.02)',
                border: '1px solid #f1f5f9',
                maxWidth: '460px',
                margin: '0 auto',
                position: 'relative',
                zIndex: 3,
              }}
            >
              {/* Top Badge Icon */}
              <div style={{ textAlign: 'center', marginBottom: '12px' }}>
                <div
                  style={{
                    width: '48px',
                    height: '48px',
                    borderRadius: '50%',
                    backgroundColor: '#fff4eb',
                    color: '#f95c19',
                    display: 'inline-flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '20px',
                    boxShadow: '0 4px 12px rgba(249, 92, 25, 0.12)',
                  }}
                >
                  <i className="fa-solid fa-paw"></i>
                </div>
              </div>

              {/* Title & Subtitle */}
              <div style={{ textAlign: 'center', marginBottom: '20px' }}>
                <h2
                  style={{
                    fontFamily: "'Outfit', sans-serif",
                    fontSize: '25px',
                    fontWeight: 800,
                    color: '#18212f',
                    letterSpacing: '-0.02em',
                    margin: '0 0 4px 0',
                  }}
                >
                  Welcome Back!
                </h2>
                <p style={{ fontSize: '13px', color: '#64748b', margin: 0 }}>
                  Sign in to continue to your account
                </p>
              </div>

              {/* Error Message Alert */}
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
                <div style={{ marginBottom: '14px' }}>
                  <label
                    style={{
                      display: 'block',
                      fontSize: '12.5px',
                      fontWeight: 600,
                      color: '#334155',
                      marginBottom: '5px',
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
                        fontSize: '14px',
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
                        padding: '10.5px 14px 10.5px 38px',
                        fontSize: '13.5px',
                        borderRadius: '10px',
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
                <div style={{ marginBottom: '14px' }}>
                  <div
                    style={{
                      display: 'flex',
                      justifyContent: 'space-between',
                      alignItems: 'center',
                      marginBottom: '5px',
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
                        fontSize: '11.5px',
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
                        fontSize: '14px',
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
                        padding: '10.5px 38px 10.5px 38px',
                        fontSize: '13.5px',
                        borderRadius: '10px',
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
                <div style={{ display: 'flex', alignItems: 'center', gap: '8px', marginBottom: '16px' }}>
                  <input
                    type="checkbox"
                    id="rememberMe"
                    checked={rememberMe}
                    onChange={(e) => setRememberMe(e.target.checked)}
                    style={{
                      width: '15px',
                      height: '15px',
                      accentColor: '#f95c19',
                      cursor: 'pointer',
                      borderRadius: '3px',
                    }}
                  />
                  <label
                    htmlFor="rememberMe"
                    style={{
                      fontSize: '12.5px',
                      color: '#475569',
                      cursor: 'pointer',
                      userSelect: 'none',
                      margin: 0,
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
                    padding: '12px',
                    borderRadius: '10px',
                    background: 'linear-gradient(90deg, #ff6622 0%, #ff4500 100%)',
                    border: 'none',
                    color: '#ffffff',
                    fontSize: '14.5px',
                    fontWeight: 700,
                    cursor: isSubmitting ? 'not-allowed' : 'pointer',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    gap: '8px',
                    boxShadow: '0 6px 18px rgba(255, 69, 0, 0.28)',
                    transition: 'transform 0.15s, box-shadow 0.2s',
                  }}
                  onMouseEnter={(e) => {
                    if (!isSubmitting) {
                      e.currentTarget.style.transform = 'translateY(-1px)';
                      e.currentTarget.style.boxShadow = '0 8px 22px rgba(255, 69, 0, 0.35)';
                    }
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.transform = 'none';
                    e.currentTarget.style.boxShadow = '0 6px 18px rgba(255, 69, 0, 0.28)';
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
                  margin: '18px 0 14px 0',
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

              {/* Social Buttons */}
              <div style={{ display: 'flex', justifyContent: 'center', gap: '10px', marginBottom: '18px' }}>
                {/* Google */}
                <button
                  type="button"
                  style={{
                    flex: 1,
                    height: '38px',
                    borderRadius: '10px',
                    border: '1.5px solid #e2e8f0',
                    backgroundColor: '#ffffff',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    gap: '6px',
                    fontSize: '12.5px',
                    fontWeight: 600,
                    color: '#334155',
                    cursor: 'pointer',
                    transition: 'background-color 0.2s',
                  }}
                  onMouseEnter={(e) => (e.currentTarget.style.backgroundColor = '#f8fafc')}
                  onMouseLeave={(e) => (e.currentTarget.style.backgroundColor = '#ffffff')}
                >
                  <svg width="16" height="16" viewBox="0 0 24 24">
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
                  Google
                </button>

                {/* Facebook */}
                <button
                  type="button"
                  style={{
                    flex: 1,
                    height: '38px',
                    borderRadius: '10px',
                    border: '1.5px solid #e2e8f0',
                    backgroundColor: '#ffffff',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    gap: '6px',
                    fontSize: '12.5px',
                    fontWeight: 600,
                    color: '#334155',
                    cursor: 'pointer',
                    transition: 'background-color 0.2s',
                  }}
                  onMouseEnter={(e) => (e.currentTarget.style.backgroundColor = '#f8fafc')}
                  onMouseLeave={(e) => (e.currentTarget.style.backgroundColor = '#ffffff')}
                >
                  <i className="fa-brands fa-facebook" style={{ color: '#1877f2', fontSize: '16px' }}></i>
                  Facebook
                </button>

                {/* Apple */}
                <button
                  type="button"
                  style={{
                    flex: 1,
                    height: '38px',
                    borderRadius: '10px',
                    border: '1.5px solid #e2e8f0',
                    backgroundColor: '#ffffff',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    gap: '6px',
                    fontSize: '12.5px',
                    fontWeight: 600,
                    color: '#334155',
                    cursor: 'pointer',
                    transition: 'background-color 0.2s',
                  }}
                  onMouseEnter={(e) => (e.currentTarget.style.backgroundColor = '#f8fafc')}
                  onMouseLeave={(e) => (e.currentTarget.style.backgroundColor = '#ffffff')}
                >
                  <i className="fa-brands fa-apple" style={{ color: '#000000', fontSize: '17px' }}></i>
                  Apple
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
                      gap: '6px',
                      padding: '8px 8px',
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
                        width: '26px',
                        height: '26px',
                        borderRadius: '7px',
                        backgroundColor: '#ffedd5',
                        color: '#f95c19',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        fontSize: '12px',
                        flexShrink: 0,
                      }}
                    >
                      <i className="fa-solid fa-paw"></i>
                    </div>
                    <div style={{ minWidth: 0, flex: 1 }}>
                      <div style={{ fontSize: '11px', fontWeight: 700, color: '#1e293b', lineHeight: '1.2' }}>
                        Pet Owner
                      </div>
                      <div style={{ fontSize: '9px', color: '#64748b', whiteSpace: 'nowrap' }}>
                        For parents
                      </div>
                    </div>
                    <i className="fa-solid fa-chevron-right" style={{ fontSize: '9px', color: '#94a3b8' }}></i>
                  </Link>

                  {/* Veterinarian */}
                  <Link
                    to="/register/veterinarian"
                    style={{
                      display: 'flex',
                      alignItems: 'center',
                      gap: '6px',
                      padding: '8px 8px',
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
                        width: '26px',
                        height: '26px',
                        borderRadius: '7px',
                        backgroundColor: '#dbeafe',
                        color: '#2563eb',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        fontSize: '12px',
                        flexShrink: 0,
                      }}
                    >
                      <i className="fa-solid fa-stethoscope"></i>
                    </div>
                    <div style={{ minWidth: 0, flex: 1 }}>
                      <div style={{ fontSize: '11px', fontWeight: 700, color: '#1e293b', lineHeight: '1.2' }}>
                        Vet
                      </div>
                      <div style={{ fontSize: '9px', color: '#64748b', whiteSpace: 'nowrap' }}>
                        For doctors
                      </div>
                    </div>
                    <i className="fa-solid fa-chevron-right" style={{ fontSize: '9px', color: '#94a3b8' }}></i>
                  </Link>

                  {/* Animal Shelter */}
                  <Link
                    to="/register/shelter"
                    style={{
                      display: 'flex',
                      alignItems: 'center',
                      gap: '6px',
                      padding: '8px 8px',
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
                        width: '26px',
                        height: '26px',
                        borderRadius: '7px',
                        backgroundColor: '#f3e8ff',
                        color: '#9333ea',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        fontSize: '12px',
                        flexShrink: 0,
                      }}
                    >
                      <i className="fa-solid fa-house-chimney-medical"></i>
                    </div>
                    <div style={{ minWidth: 0, flex: 1 }}>
                      <div style={{ fontSize: '11px', fontWeight: 700, color: '#1e293b', lineHeight: '1.2' }}>
                        Shelter
                      </div>
                      <div style={{ fontSize: '9px', color: '#64748b', whiteSpace: 'nowrap' }}>
                        Rescues
                      </div>
                    </div>
                    <i className="fa-solid fa-chevron-right" style={{ fontSize: '9px', color: '#94a3b8' }}></i>
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* ================= BOTTOM TRUST BADGES DOCK ================= */}
      <div
        style={{
          position: 'relative',
          zIndex: 3,
          padding: '14px 20px',
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
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Secure &amp; Private</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>Your pet&apos;s data is safe</div>
              </div>
            </div>
          </div>

          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}>
              <i className="fa-regular fa-calendar-check" style={{ color: '#64748b', fontSize: '15px' }}></i>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Easy Appointments</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>Book vet visits in seconds</div>
              </div>
            </div>
          </div>

          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}>
              <i className="fa-regular fa-bell" style={{ color: '#64748b', fontSize: '15px' }}></i>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Smart Reminders</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>Never miss important care</div>
              </div>
            </div>
          </div>

          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}>
              <i className="fa-solid fa-headset" style={{ color: '#64748b', fontSize: '15px' }}></i>
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
