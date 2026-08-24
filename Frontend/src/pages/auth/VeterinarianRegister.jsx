import React, { useState } from 'react';
import { Link, useNavigate } from '../../router/Router';
import { useAuth } from '../../context/AuthContext';

export default function VeterinarianRegister() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    address: '',
    specialization: '',
    experience: '',
    password: '',
    confirmPassword: '',
  });
  const [showPassword, setShowPassword] = useState(false);
  const [agreeTerms, setAgreeTerms] = useState(false);
  const [errorMsg, setErrorMsg] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  const { registerVet } = useAuth();
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
      setErrorMsg('Please agree to the Terms of Service & Privacy Policy');
      return;
    }

    setIsSubmitting(true);
    try {
      await registerVet({
        name: formData.name,
        email: formData.email,
        phone: formData.phone,
        address: formData.address,
        specialization: formData.specialization,
        experience: Number(formData.experience) || 1,
        password: formData.password,
      });
      navigate('/dashboard/vet');
    } catch (err) {
      const msg =
        err.response?.data?.message ||
        err.message ||
        'Registration failed. Please check your credentials.';
      setErrorMsg(msg);
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
      {/* Decorative Wave & Background */}
      <div
        style={{
          position: 'absolute',
          bottom: '-70px',
          left: '-70px',
          width: '520px',
          height: '420px',
          background: 'linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%)',
          borderRadius: '45% 55% 65% 35% / 40% 45% 55% 60%',
          zIndex: 1,
          pointerEvents: 'none',
          boxShadow: '0 20px 45px rgba(29, 78, 216, 0.22)',
        }}
      />

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
          {/* Left Column */}
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
                Join the Network of <br />
                <span style={{ color: '#2563eb' }}>Top Veterinarians</span> <br />
                &amp; Specialists 🩺
              </h1>

              <p style={{ fontSize: '15.5px', color: '#556579', lineHeight: '1.6', marginBottom: '16px', maxWidth: '460px' }}>
                Empower your clinical practice, manage appointments digitally, and access complete longitudinal medical histories.
              </p>

              {/* Role Switcher Pills */}
              <div style={{ display: 'flex', gap: '10px', marginBottom: '20px', flexWrap: 'wrap' }}>
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
                    backgroundColor: '#2563eb',
                    color: '#ffffff',
                    fontSize: '13px',
                    fontWeight: 700,
                    textDecoration: 'none',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '6px',
                    boxShadow: '0 4px 12px rgba(37, 99, 235, 0.3)',
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

              {/* Cozy Home Pets Photo */}
              <div
                style={{
                  position: 'relative',
                  marginTop: '12px',
                }}
              >
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
                    alt="Pets in cozy living room"
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

          {/* Right Column (Vet Registration Card) */}
          <div className="col-xl-6 col-lg-6 col-md-12">
            <div
              style={{
                backgroundColor: '#ffffff',
                borderRadius: '32px',
                padding: 'clamp(28px, 3.5vw, 36px) clamp(24px, 3.5vw, 36px)',
                boxShadow: '0 25px 60px -10px rgba(0, 0, 0, 0.06), 0 0 1px 1px rgba(0, 0, 0, 0.02)',
                border: '1px solid #f1f5f9',
                maxWidth: '520px',
                margin: '0 auto',
                position: 'relative',
                zIndex: 3,
              }}
            >
              <div style={{ textAlign: 'center', marginBottom: '20px' }}>
                <div
                  style={{
                    width: '48px',
                    height: '48px',
                    borderRadius: '50%',
                    backgroundColor: '#eff6ff',
                    color: '#2563eb',
                    display: 'inline-flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '20px',
                    boxShadow: '0 4px 12px rgba(37, 99, 235, 0.12)',
                    marginBottom: '10px',
                  }}
                >
                  <i className="fa-solid fa-user-doctor"></i>
                </div>
                <h2 style={{ fontSize: '24px', fontWeight: 800, color: '#18212f', margin: '0 0 4px 0' }}>
                  Register as Veterinarian
                </h2>
                <p style={{ fontSize: '13px', color: '#64748b', margin: 0 }}>
                  Already registered?{' '}
                  <Link to="/login" style={{ color: '#2563eb', fontWeight: 700, textDecoration: 'none' }}>
                    Sign In
                  </Link>
                </p>
              </div>

              {errorMsg && (
                <div
                  style={{
                    backgroundColor: '#fef2f2',
                    border: '1px solid #fee2e2',
                    borderRadius: '12px',
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
                <div className="row g-2 mb-2">
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12.5px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Dr. Full Name *
                    </label>
                    <input
                      type="text"
                      name="name"
                      required
                      placeholder="e.g. Dr. Sarah Jenkins"
                      value={formData.name}
                      onChange={handleChange}
                      style={{
                        width: '100%',
                        padding: '10px 12px',
                        fontSize: '13.5px',
                        borderRadius: '10px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12.5px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Phone / Clinic Contact *
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
                        padding: '10px 12px',
                        fontSize: '13.5px',
                        borderRadius: '10px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                </div>

                <div className="row g-2 mb-2">
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12.5px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Professional Email *
                    </label>
                    <input
                      type="email"
                      name="email"
                      required
                      placeholder="dr.sarah@clinic.com"
                      value={formData.email}
                      onChange={handleChange}
                      style={{
                        width: '100%',
                        padding: '10px 12px',
                        fontSize: '13.5px',
                        borderRadius: '10px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12.5px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Specialization *
                    </label>
                    <input
                      type="text"
                      name="specialization"
                      required
                      placeholder="e.g. Small Animals, Surgery"
                      value={formData.specialization}
                      onChange={handleChange}
                      style={{
                        width: '100%',
                        padding: '10px 12px',
                        fontSize: '13.5px',
                        borderRadius: '10px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                </div>

                <div className="row g-2 mb-2">
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12.5px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Clinic Address *
                    </label>
                    <input
                      type="text"
                      name="address"
                      required
                      placeholder="456 Health Ave, New York"
                      value={formData.address}
                      onChange={handleChange}
                      style={{
                        width: '100%',
                        padding: '10px 12px',
                        fontSize: '13.5px',
                        borderRadius: '10px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12.5px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
                      Years of Experience *
                    </label>
                    <input
                      type="number"
                      name="experience"
                      required
                      min="1"
                      placeholder="e.g. 5"
                      value={formData.experience}
                      onChange={handleChange}
                      style={{
                        width: '100%',
                        padding: '10px 12px',
                        fontSize: '13.5px',
                        borderRadius: '10px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                </div>

                <div className="row g-2 mb-2">
                  <div className="col-12 col-md-6">
                    <label style={{ fontSize: '12.5px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
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
                          padding: '10px 36px 10px 12px',
                          fontSize: '13.5px',
                          borderRadius: '10px',
                          border: '1.5px solid #e2e8f0',
                          outline: 'none',
                        }}
                      />
                      <button
                        type="button"
                        onClick={() => setShowPassword(!showPassword)}
                        style={{
                          position: 'absolute',
                          right: '10px',
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
                    <label style={{ fontSize: '12.5px', fontWeight: 600, color: '#334155', marginBottom: '4px', display: 'block' }}>
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
                        padding: '10px 12px',
                        fontSize: '13.5px',
                        borderRadius: '10px',
                        border: '1.5px solid #e2e8f0',
                        outline: 'none',
                      }}
                    />
                  </div>
                </div>

                <div style={{ display: 'flex', alignItems: 'center', gap: '8px', margin: '14px 0 18px 0' }}>
                  <input
                    type="checkbox"
                    id="agreeTerms"
                    checked={agreeTerms}
                    onChange={(e) => setAgreeTerms(e.target.checked)}
                    style={{ width: '15px', height: '15px', accentColor: '#2563eb', cursor: 'pointer' }}
                  />
                  <label htmlFor="agreeTerms" style={{ fontSize: '12px', color: '#475569', cursor: 'pointer', margin: 0 }}>
                    I agree to the Veterinary Practice Terms &amp; Conditions
                  </label>
                </div>

                <button
                  type="submit"
                  disabled={isSubmitting}
                  style={{
                    width: '100%',
                    padding: '12px',
                    borderRadius: '11px',
                    background: 'linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%)',
                    border: 'none',
                    color: '#ffffff',
                    fontSize: '15px',
                    fontWeight: 700,
                    cursor: isSubmitting ? 'not-allowed' : 'pointer',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    gap: '8px',
                    boxShadow: '0 8px 20px rgba(37, 99, 235, 0.3)',
                  }}
                >
                  {isSubmitting ? 'Registering...' : 'Register as Veterinarian ➔'}
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
              <i className="fa-regular fa-calendar-check" style={{ color: '#64748b', fontSize: '15px' }}></i>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12.5px', fontWeight: 700, color: '#1e293b' }}>Online Booking</div>
                <div style={{ fontSize: '11px', color: '#8b96a5' }}>Automated slots</div>
              </div>
            </div>
          </div>
          <div className="col-lg-3 col-6">
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}>
              <i className="fa-solid fa-file-medical" style={{ color: '#64748b', fontSize: '15px' }}></i>
              <div style={{ textAlign: 'left' }}>
                <div style={{ fontSize: '12.5px', fontWeight: 700, color: '#1e293b' }}>Digital Rx</div>
                <div style={{ fontSize: '11px', color: '#8b96a5' }}>Fast prescriptions</div>
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
