import React, { useState } from 'react';
import { Link, useNavigate } from '../../router/Router';
import { useAuth } from '../../context/AuthContext';
import RoleRegisterSwitcher from '../../components/auth/RoleRegisterSwitcher';

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
      navigate('/shelter/dashboard');
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
    <>
      <section
        className="banner"
        style={{
          backgroundColor: '#fff8e5',
          backgroundImage: 'url(/assets/img/background.png)',
          padding: '60px 0',
          textAlign: 'center',
        }}
      >
        <div className="container">
          <h2 style={{ fontSize: '40px', fontWeight: 800, marginBottom: '10px', color: '#222' }}>
            Create Your FurShield Account
          </h2>
          <ul
            className="breadcrumb"
            style={{
              display: 'flex',
              justifyContent: 'center',
              listStyle: 'none',
              padding: 0,
              margin: 0,
              gap: '10px',
              fontSize: '15px',
            }}
          >
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#7b1fa2', fontWeight: 600 }}>
              Animal Shelter Registration
            </li>
          </ul>
        </div>
      </section>

      <section className="gap" style={{ padding: '60px 0' }}>
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-8 col-md-10">
              {/* Responsive 3-Role Switcher */}
              <RoleRegisterSwitcher currentRole="shelter" />

              <div
                className="p-4 p-md-5"
                style={{
                  backgroundColor: '#fff8e5',
                  borderRadius: '28px',
                  boxShadow: '0 20px 45px rgba(0,0,0,0.05)',
                  border: '1px solid #fce3b8',
                }}
              >
                <div className="text-center mb-4">
                  <div
                    style={{
                      width: '56px',
                      height: '56px',
                      borderRadius: '16px',
                      backgroundColor: '#7b1fa2',
                      color: '#fff',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '24px',
                      margin: '0 auto 12px',
                      boxShadow: '0 8px 18px rgba(123, 31, 162, 0.3)',
                    }}
                  >
                    <i className="fa-solid fa-house-chimney-medical"></i>
                  </div>
                  <h3 style={{ fontWeight: 800, fontSize: '26px', color: '#1a1a1a', marginBottom: '4px' }}>
                    Shelter & Rescue Sanctuary
                  </h3>
                  <p className="text-muted" style={{ fontSize: '14px' }}>
                    List adoptable animals, organize intake rosters, and review adoption applications
                  </p>
                </div>

                {errorMsg && (
                  <div
                    className="alert alert-danger d-flex align-items-center mb-4"
                    style={{ borderRadius: '12px', fontSize: '14px', padding: '14px 18px' }}
                  >
                    <i className="fa-solid fa-circle-exclamation me-2 fs-5"></i>
                    <div>{errorMsg}</div>
                  </div>
                )}

                <form onSubmit={handleSubmit}>
                  <div className="row g-3">
                    <div className="col-md-6">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Shelter / Sanctuary Name <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type="text"
                        name="shelterName"
                        className="form-control"
                        placeholder="e.g. Hope Paws Sanctuary"
                        value={formData.shelterName}
                        onChange={handleChange}
                        required
                        style={{
                          borderRadius: '12px',
                          padding: '13px 16px',
                          border: '1.5px solid #e2d7c5',
                          backgroundColor: '#fff',
                        }}
                      />
                    </div>

                    <div className="col-md-6">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Contact Person Name <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type="text"
                        name="contactPerson"
                        className="form-control"
                        placeholder="e.g. Marcus Vance (Director)"
                        value={formData.contactPerson}
                        onChange={handleChange}
                        required
                        style={{
                          borderRadius: '12px',
                          padding: '13px 16px',
                          border: '1.5px solid #e2d7c5',
                          backgroundColor: '#fff',
                        }}
                      />
                    </div>

                    <div className="col-md-6">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Official Email <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type="email"
                        name="email"
                        className="form-control"
                        placeholder="contact@hopepaws.org"
                        value={formData.email}
                        onChange={handleChange}
                        required
                        style={{
                          borderRadius: '12px',
                          padding: '13px 16px',
                          border: '1.5px solid #e2d7c5',
                          backgroundColor: '#fff',
                        }}
                      />
                    </div>

                    <div className="col-md-6">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Phone Number <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type="tel"
                        name="phone"
                        className="form-control"
                        placeholder="+1 (555) 345-6789"
                        value={formData.phone}
                        onChange={handleChange}
                        required
                        style={{
                          borderRadius: '12px',
                          padding: '13px 16px',
                          border: '1.5px solid #e2d7c5',
                          backgroundColor: '#fff',
                        }}
                      />
                    </div>

                    <div className="col-md-12">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Shelter Facility Address <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type="text"
                        name="address"
                        className="form-control"
                        placeholder="250 Sanctuary Road, Seattle, WA"
                        value={formData.address}
                        onChange={handleChange}
                        required
                        style={{
                          borderRadius: '12px',
                          padding: '13px 16px',
                          border: '1.5px solid #e2d7c5',
                          backgroundColor: '#fff',
                        }}
                      />
                    </div>

                    <div className="col-md-6">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Password <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <div style={{ position: 'relative' }}>
                        <input
                          type={showPassword ? 'text' : 'password'}
                          name="password"
                          className="form-control"
                          placeholder="Min 8 chars, 1 uppercase, 1 number"
                          value={formData.password}
                          onChange={handleChange}
                          required
                          style={{
                            borderRadius: '12px',
                            padding: '13px 44px 13px 16px',
                            border: '1.5px solid #e2d7c5',
                            backgroundColor: '#fff',
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
                            color: '#888',
                            cursor: 'pointer',
                          }}
                        >
                          <i className={`fa-solid ${showPassword ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                        </button>
                      </div>
                    </div>

                    <div className="col-md-6">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Confirm Password <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type={showPassword ? 'text' : 'password'}
                        name="confirmPassword"
                        className="form-control"
                        placeholder="Repeat password"
                        value={formData.confirmPassword}
                        onChange={handleChange}
                        required
                        style={{
                          borderRadius: '12px',
                          padding: '13px 16px',
                          border: '1.5px solid #e2d7c5',
                          backgroundColor: '#fff',
                        }}
                      />
                    </div>
                  </div>

                  <button
                    type="submit"
                    className="button w-100 mt-4"
                    disabled={isSubmitting}
                    style={{
                      padding: '15px',
                      borderRadius: '14px',
                      fontWeight: 700,
                      fontSize: '16px',
                      backgroundColor: '#7b1fa2',
                      border: 'none',
                      color: '#fff',
                      cursor: isSubmitting ? 'not-allowed' : 'pointer',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      gap: '8px',
                      boxShadow: '0 8px 20px rgba(123, 31, 162, 0.3)',
                    }}
                  >
                    {isSubmitting ? (
                      <>
                        <span className="spinner-border spinner-border-sm" role="status"></span>
                        Registering Sanctuary...
                      </>
                    ) : (
                      <>
                        Complete Shelter Signup <i className="fa-solid fa-arrow-right"></i>
                      </>
                    )}
                  </button>
                </form>

                <div className="text-center mt-4 pt-3" style={{ borderTop: '1px dashed #ded4c0' }}>
                  <p className="text-muted mb-0" style={{ fontSize: '14px' }}>
                    Already an affiliated shelter?{' '}
                    <Link to="/login" style={{ color: '#7b1fa2', fontWeight: 700, textDecoration: 'none' }}>
                      Log In here
                    </Link>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
