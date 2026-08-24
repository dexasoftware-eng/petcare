import React, { useState } from 'react';
import { Link, useNavigate } from '../../router/Router';
import { useAuth } from '../../context/AuthContext';

export default function ShelterRegister() {
  const [formData, setFormData] = useState({
    shelterName: '',
    contactPerson: '',
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

  const { registerShelter } = useAuth();
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
      setErrorMsg('Please agree to the Shelter & Rescue Organization Guidelines');
      return;
    }

    setIsSubmitting(true);
    try {
      await registerShelter({
        shelterName: formData.shelterName,
        contactPerson: formData.contactPerson,
        email: formData.email,
        phone: formData.phone,
        address: formData.address,
        password: formData.password,
      });
      navigate('/dashboard/shelter');
    } catch (err) {
      const msg =
        err.response?.data?.message ||
        err.message ||
        'Registration failed. Please check your information.';
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
          background: 'radial-gradient(circle, #a855f7 0%, #7e22ce 100%)',
          borderRadius: '40% 60% 70% 30% / 45% 50% 50% 55%',
          zIndex: 2,
          pointerEvents: 'none',
          opacity: 0.8,
          boxShadow: '0 20px 40px rgba(126, 34, 206, 0.25)',
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
                Connect Your Shelter <br />
                <span style={{ color: '#9333ea' }}>With Caring Families</span> 🏠
              </h1>

              <p style={{ fontSize: '15px', color: '#475569', lineHeight: '1.55', marginBottom: '22px' }}>
                Streamline pet intake, manage adoption listings, and evaluate applicant applications with an end-to-end digital rescue portal.
              </p>

              {/* Role Switcher Pills */}
              <div style={{ display: 'flex', gap: '8px', marginBottom: '24px', flexWrap: 'wrap' }}>
                <Link
                  to="/register/owner"
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
                    backgroundColor: '#9333ea',
                    color: '#ffffff',
                    fontSize: '13px',
                    fontWeight: 700,
                    textDecoration: 'none',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '6px',
                    boxShadow: '0 4px 12px rgba(147, 51, 234, 0.3)',
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
                    backgroundColor: '#faf5ff',
                    color: '#9333ea',
                    display: 'inline-flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '19px',
                    boxShadow: '0 4px 12px rgba(147, 51, 234, 0.12)',
                    marginBottom: '8px',
                  }}
                >
                  <i className="fa-solid fa-house-chimney-medical"></i>
                </div>
                <h2 style={{ fontFamily: "'Outfit', sans-serif", fontSize: '24px', fontWeight: 800, color: '#18212f', margin: '0 0 4px 0' }}>
                  Register Animal Shelter
                </h2>
                <p style={{ fontSize: '13px', color: '#64748b', margin: 0 }}>
                  Already registered?{' '}
                  <Link to="/login" style={{ color: '#9333ea', fontWeight: 700, textDecoration: 'none' }}>
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
                      Shelter / Org Name *
                    </label>
                    <input
                      type="text"
                      name="shelterName"
                      required
                      placeholder="Hope Animal Sanctuary"
                      value={formData.shelterName}
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
                      Contact Person *
                    </label>
                    <input
                      type="text"
                      name="contactPerson"
                      required
                      placeholder="Alex Morgan"
                      value={formData.contactPerson}
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

                <div className="row g-2 mb-2">
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Official Email *
                    </label>
                    <input
                      type="email"
                      name="email"
                      required
                      placeholder="info@hopepaws.org"
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
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Helpline Phone *
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
                    Facility Physical Address *
                  </label>
                  <input
                    type="text"
                    name="address"
                    required
                    placeholder="789 Rescue Blvd, Austin, TX"
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
                    style={{ width: '15px', height: '15px', accentColor: '#9333ea', cursor: 'pointer' }}
                  />
                  <label htmlFor="agreeTerms" style={{ fontSize: '12px', color: '#475569', cursor: 'pointer', margin: 0 }}>
                    I agree to the Shelter &amp; Rescue Organization Guidelines
                  </label>
                </div>

                <button
                  type="submit"
                  disabled={isSubmitting}
                  style={{
                    width: '100%',
                    padding: '11.5px',
                    borderRadius: '10px',
                    background: 'linear-gradient(90deg, #a855f7 0%, #7e22ce 100%)',
                    border: 'none',
                    color: '#ffffff',
                    fontSize: '14.5px',
                    fontWeight: 700,
                    cursor: isSubmitting ? 'not-allowed' : 'pointer',
                    boxShadow: '0 6px 18px rgba(147, 51, 234, 0.28)',
                  }}
                >
                  {isSubmitting ? 'Registering...' : 'Register Shelter Organization ➔'}
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
                <i className="fa-solid fa-heart"></i>
              </div>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12px', fontWeight: 700, color: '#1e293b' }}>Adoption Engine</div>
                <div style={{ fontSize: '10.5px', color: '#8b96a5' }}>Verified adopters</div>
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
