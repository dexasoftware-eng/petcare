import React, { useState } from 'react';
import { Link, useNavigate } from '../../router/Router';
import { useAuth } from '../../context/AuthContext';

export default function OwnerRegister() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    address: '',
    password: '',
    confirmPassword: '',
  });
  const [showPassword, setShowPassword] = useState(false);
  const [agreeTerms, setAgreeTerms] = useState(false);
  const [errorMsg, setErrorMsg] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  const { registerOwner } = useAuth();
  const navigate = useNavigate();

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrorMsg('');

    if (formData.password !== formData.confirmPassword) {
      setErrorMsg('Passwords do not match');
      return;
    }

    if (!agreeTerms) {
      setErrorMsg('Please accept the Terms of Service & Privacy Policy');
      return;
    }

    setIsSubmitting(true);
    try {
      await registerOwner({
        name: formData.name,
        email: formData.email,
        phone: formData.phone,
        address: formData.address,
        password: formData.password,
      });
      navigate('/dashboard/owner');
    } catch (err) {
      const msg =
        err.response?.data?.message ||
        err.message ||
        'Registration failed. Please check your details.';
      setErrorMsg(msg);
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
        backgroundImage: 'url(/assets/img/login-bg-original.jpg)',
        backgroundSize: 'cover',
        backgroundPosition: 'center center',
        backgroundRepeat: 'no-repeat',
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'space-between',
        overflowX: 'hidden',
        fontFamily: "'Plus Jakarta Sans', 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif",
      }}
    >
      {/* Soft Ambient Light Gradient Overlay */}
      <div
        style={{
          position: 'absolute',
          top: 0,
          left: 0,
          width: '100%',
          height: '100%',
          background: `linear-gradient(
            to right,
            rgba(255, 252, 247, 0.72) 0%,
            rgba(255, 252, 247, 0.45) 45%,
            rgba(255, 252, 247, 0.65) 100%
          )`,
          pointerEvents: 'none',
          zIndex: 1,
        }}
      />

      {/* Decorative Bottom-Left Fluid Orange Wave */}
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

      {/* Top Logo */}
      <div
        style={{
          maxWidth: '1440px',
          width: '100%',
          margin: '0 auto',
          padding: '22px 40px 0 40px',
          position: 'relative',
          zIndex: 10,
        }}
      >
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
            <div style={{ fontSize: '23px', fontWeight: 900, color: '#18212f', fontFamily: "'Outfit', sans-serif", lineHeight: '1.1' }}>
              PetGuard
            </div>
            <div style={{ fontSize: '11px', fontWeight: 600, color: '#8b96a5' }}>Care. Protect. Love.</div>
          </div>
        </Link>
      </div>

      {/* Main 2-Column Section */}
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
            gridTemplateColumns: 'minmax(0, 1.15fr) minmax(380px, 500px)',
            alignItems: 'center',
            gap: '40px',
            width: '100%',
          }}
        >
          {/* Left Hero */}
          <div style={{ position: 'relative', zIndex: 10 }}>
            <div style={{ maxWidth: '540px' }}>
              <h1
                style={{
                  fontFamily: "'Outfit', sans-serif",
                  fontSize: 'clamp(36px, 4vw, 50px)',
                  fontWeight: 900,
                  color: '#18212f',
                  lineHeight: '1.12',
                  letterSpacing: '-0.03em',
                  marginBottom: '14px',
                }}
              >
                Welcome to <br />
                <span style={{ color: '#f95c19' }}>PetGuard Family</span>{' '}
                <span style={{ color: '#f95c19', fontSize: '0.8em', verticalAlign: 'middle' }}>
                  <i className="fa-solid fa-paw"></i>
                </span>
              </h1>

              <p style={{ fontSize: '15px', color: '#475569', lineHeight: '1.55', marginBottom: '22px' }}>
                Join thousands of pet parents managing vaccinations, nutrition, vet visits, and health journals with ease.
              </p>

              {/* Role Switcher Pills */}
              <div style={{ display: 'flex', gap: '8px', marginBottom: '24px', flexWrap: 'wrap' }}>
                <Link
                  to="/register/owner"
                  style={{
                    padding: '8px 16px',
                    borderRadius: '20px',
                    backgroundColor: '#f95c19',
                    color: '#ffffff',
                    fontSize: '13px',
                    fontWeight: 700,
                    textDecoration: 'none',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '6px',
                    boxShadow: '0 4px 12px rgba(249, 92, 25, 0.3)',
                  }}
                >
                  <i className="fa-solid fa-paw"></i> Pet Owner
                </Link>
                <Link
                  to="/register/veterinarian"
                  style={{
                    padding: '8px 16px',
                    borderRadius: '20px',
                    backgroundColor: '#ffffff',
                    color: '#475569',
                    fontSize: '13px',
                    fontWeight: 600,
                    textDecoration: 'none',
                    border: '1.5px solid #e2e8f0',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '6px',
                  }}
                >
                  <i className="fa-solid fa-stethoscope"></i> Veterinarian
                </Link>
                <Link
                  to="/register/shelter"
                  style={{
                    padding: '8px 16px',
                    borderRadius: '20px',
                    backgroundColor: '#ffffff',
                    color: '#475569',
                    fontSize: '13px',
                    fontWeight: 600,
                    textDecoration: 'none',
                    border: '1.5px solid #e2e8f0',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '6px',
                  }}
                >
                  <i className="fa-solid fa-house-chimney-medical"></i> Shelter
                </Link>
              </div>
            </div>
          </div>

          {/* Right Form Card */}
          <div style={{ position: 'relative', zIndex: 10 }}>
            <div
              style={{
                backgroundColor: '#ffffff',
                borderRadius: '28px',
                padding: '30px 32px',
                boxShadow: '0 24px 60px -10px rgba(0, 0, 0, 0.1), 0 0 1px 1px rgba(0, 0, 0, 0.03)',
                border: '1px solid #f1f5f9',
                maxWidth: '490px',
                margin: '0 auto',
              }}
            >
              <div style={{ textAlign: 'center', marginBottom: '16px' }}>
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
                    marginBottom: '8px',
                  }}
                >
                  <i className="fa-solid fa-paw"></i>
                </div>
                <h2 style={{ fontFamily: "'Outfit', sans-serif", fontSize: '24px', fontWeight: 800, color: '#18212f', margin: '0 0 4px 0' }}>
                  Register as Pet Owner
                </h2>
                <p style={{ fontSize: '13px', color: '#64748b', margin: 0 }}>
                  Already have an account?{' '}
                  <Link to="/login" style={{ color: '#f95c19', fontWeight: 700, textDecoration: 'none' }}>
                    Sign In
                  </Link>
                </p>
              </div>

              {errorMsg && (
                <div
                  style={{
                    backgroundColor: '#fef2f2',
                    border: '1px solid #fee2e2',
                    borderRadius: '10px',
                    padding: '9px 12px',
                    color: '#dc2626',
                    fontSize: '12.5px',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '8px',
                    marginBottom: '14px',
                  }}
                >
                  <i className="fa-solid fa-circle-exclamation"></i>
                  <span>{errorMsg}</span>
                </div>
              )}

              <form onSubmit={handleSubmit}>
                <div className="row g-2 mb-2">
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Full Name *
                    </label>
                    <input
                      type="text"
                      name="name"
                      required
                      placeholder="e.g. John Doe"
                      value={formData.name}
                      onChange={handleChange}
                      style={{
                        width: '100%',
                        padding: '9px 12px',
                        fontSize: '13px',
                        borderRadius: '9px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Phone Number *
                    </label>
                    <input
                      type="tel"
                      name="phone"
                      required
                      placeholder="+1 (555) 000-0000"
                      value={formData.phone}
                      onChange={handleChange}
                      style={{
                        width: '100%',
                        padding: '9px 12px',
                        fontSize: '13px',
                        borderRadius: '9px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                </div>

                <div className="mb-2">
                  <label style={{ fontSize: '12px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                    Email Address *
                  </label>
                  <input
                    type="email"
                    name="email"
                    required
                    placeholder="john@example.com"
                    value={formData.email}
                    onChange={handleChange}
                    style={{
                      width: '100%',
                      padding: '9px 12px',
                      fontSize: '13px',
                      borderRadius: '9px',
                      border: '1.5px solid #e2e8f0',
                      outline: 'none',
                    }}
                  />
                </div>

                <div className="mb-2">
                  <label style={{ fontSize: '12px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                    Home Address *
                  </label>
                  <input
                    type="text"
                    name="address"
                    required
                    placeholder="123 Main St, New York, NY"
                    value={formData.address}
                    onChange={handleChange}
                    style={{
                      width: '100%',
                      padding: '9px 12px',
                      fontSize: '13px',
                      borderRadius: '9px',
                      border: '1.5px solid #e2e8f0',
                      outline: 'none',
                    }}
                  />
                </div>

                <div className="row g-2 mb-2">
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Password *
                    </label>
                    <div style={{ position: 'relative' }}>
                      <input
                        type={showPassword ? 'text' : 'password'}
                        name="password"
                        required
                        placeholder="••••••••"
                        value={formData.password}
                        onChange={handleChange}
                        style={{
                          width: '100%',
                          padding: '9px 34px 9px 12px',
                          fontSize: '13px',
                          borderRadius: '9px',
                          border: '1.5px solid #e2e8f0',
                          outline: 'none',
                        }}
                      />
                      <button
                        type="button"
                        onClick={() => setShowPassword(!showPassword)}
                        style={{
                          position: 'absolute',
                          right: '8px',
                          top: '50%',
                          transform: 'translateY(-50%)',
                          background: 'none',
                          border: 'none',
                          color: '#94a3b8',
                          cursor: 'pointer',
                        }}
                      >
                        <i className={`fa-regular ${showPassword ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                      </button>
                    </div>
                  </div>

                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Confirm Password *
                    </label>
                    <input
                      type={showPassword ? 'text' : 'password'}
                      name="confirmPassword"
                      required
                      placeholder="••••••••"
                      value={formData.confirmPassword}
                      onChange={handleChange}
                      style={{
                        width: '100%',
                        padding: '9px 12px',
                        fontSize: '13px',
                        borderRadius: '9px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                </div>

                <div style={{ display: 'flex', alignItems: 'center', gap: '8px', margin: '12px 0 16px 0' }}>
                  <input
                    type="checkbox"
                    id="agreeTerms"
                    checked={agreeTerms}
                    onChange={(e) => setAgreeTerms(e.target.checked)}
                    style={{ width: '15px', height: '15px', accentColor: '#f95c19', cursor: 'pointer' }}
                  />
                  <label htmlFor="agreeTerms" style={{ fontSize: '12px', color: '#475569', cursor: 'pointer', margin: 0 }}>
                    I agree to the Terms of Service &amp; Privacy Policy
                  </label>
                </div>

                <button
                  type="submit"
                  disabled={isSubmitting}
                  style={{
                    width: '100%',
                    padding: '11.5px',
                    borderRadius: '10px',
                    background: 'linear-gradient(90deg, #ff6622 0%, #ff4500 100%)',
                    border: 'none',
                    color: '#ffffff',
                    fontSize: '14.5px',
                    fontWeight: 700,
                    cursor: isSubmitting ? 'not-allowed' : 'pointer',
                    boxShadow: '0 6px 18px rgba(255, 69, 0, 0.28)',
                  }}
                >
                  {isSubmitting ? 'Creating Account...' : 'Create Pet Owner Account ➔'}
                </button>
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
                <i className="fa-solid fa-star"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Trusted by Parents</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>10K+ happy families</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div style={{ width: '32px', height: '32px', borderRadius: '50%', backgroundColor: '#eff6ff', color: '#2563eb', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '14px' }}>
                <i className="fa-solid fa-stethoscope"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Expert Vets</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>Verified professionals</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div style={{ width: '32px', height: '32px', borderRadius: '50%', backgroundColor: '#ecfdf5', color: '#10b981', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '14px' }}>
                <i className="fa-regular fa-clock"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>24/7 Support</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>We&apos;re always here</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '10px' }}>
              <div style={{ width: '32px', height: '32px', borderRadius: '50%', backgroundColor: '#ecfdf5', color: '#059669', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '14px' }}>
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
