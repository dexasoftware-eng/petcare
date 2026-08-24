import React, { useState } from 'react';
import { Link, useNavigate } from '../../router/Router';
import { useAuth } from '../../context/AuthContext';
import RoleRegisterSwitcher from '../../components/auth/RoleRegisterSwitcher';

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

    setIsSubmitting(true);
    try {
      await registerVet({
        name: formData.name,
        email: formData.email,
        phone: formData.phone,
        address: formData.address,
        specialization: formData.specialization,
        experience: Number(formData.experience),
        password: formData.password,
      });
      navigate('/veterinarian/dashboard');
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
            <li className="active" style={{ color: '#198754', fontWeight: 600 }}>
              Veterinarian Registration
            </li>
          </ul>
        </div>
      </section>

      <section className="gap" style={{ padding: '60px 0' }}>
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-8 col-md-10">
              {/* Responsive 3-Role Switcher */}
              <RoleRegisterSwitcher currentRole="veterinarian" />

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
                      backgroundColor: '#198754',
                      color: '#fff',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '24px',
                      margin: '0 auto 12px',
                      boxShadow: '0 8px 18px rgba(25, 135, 84, 0.3)',
                    }}
                  >
                    <i className="fa-solid fa-user-doctor"></i>
                  </div>
                  <h3 style={{ fontWeight: 800, fontSize: '26px', color: '#1a1a1a', marginBottom: '4px' }}>
                    Veterinary Practitioner Portal
                  </h3>
                  <p className="text-muted" style={{ fontSize: '14px' }}>
                    Connect with pet owners, manage clinical diagnoses, and manage daily consultations
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
                        Doctor / Clinic Name <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type="text"
                        name="name"
                        className="form-control"
                        placeholder="Dr. Emily Watson"
                        value={formData.name}
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
                        Professional Email <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type="email"
                        name="email"
                        className="form-control"
                        placeholder="dr.watson@vetcare.com"
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
                        placeholder="+1 (555) 789-0123"
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

                    <div className="col-md-6">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Primary Specialization <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <select
                        name="specialization"
                        className="form-select"
                        value={formData.specialization}
                        onChange={handleChange}
                        required
                        style={{
                          borderRadius: '12px',
                          padding: '13px 16px',
                          border: '1.5px solid #e2d7c5',
                          backgroundColor: '#fff',
                        }}
                      >
                        <option value="">Select Specialization</option>
                        <option value="General Veterinary Practice">General Veterinary Practice</option>
                        <option value="Small Animal Surgery">Small Animal Surgery</option>
                        <option value="Veterinary Dermatology">Veterinary Dermatology</option>
                        <option value="Veterinary Cardiology">Veterinary Cardiology</option>
                        <option value="Veterinary Oncology">Veterinary Oncology</option>
                        <option value="Feline & Canine Medicine">Feline & Canine Medicine</option>
                        <option value="Avian & Exotic Animals">Avian & Exotic Animals</option>
                      </select>
                    </div>

                    <div className="col-md-4">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Experience (Years) <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type="number"
                        name="experience"
                        className="form-control"
                        placeholder="e.g. 7"
                        min="0"
                        max="60"
                        value={formData.experience}
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

                    <div className="col-md-8">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '14px' }}>
                        Clinic / Hospital Address <span style={{ color: '#fa441d' }}>*</span>
                      </label>
                      <input
                        type="text"
                        name="address"
                        className="form-control"
                        placeholder="100 Veterinary Plaza, Suite 4, Austin, TX"
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
                      backgroundColor: '#198754',
                      border: 'none',
                      color: '#fff',
                      cursor: isSubmitting ? 'not-allowed' : 'pointer',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      gap: '8px',
                      boxShadow: '0 8px 20px rgba(25, 135, 84, 0.3)',
                    }}
                  >
                    {isSubmitting ? (
                      <>
                        <span className="spinner-border spinner-border-sm" role="status"></span>
                        Registering Clinic...
                      </>
                    ) : (
                      <>
                        Complete Veterinarian Signup <i className="fa-solid fa-arrow-right"></i>
                      </>
                    )}
                  </button>
                </form>

                <div className="text-center mt-4 pt-3" style={{ borderTop: '1px dashed #ded4c0' }}>
                  <p className="text-muted mb-0" style={{ fontSize: '14px' }}>
                    Already have a clinic account?{' '}
                    <Link to="/login" style={{ color: '#198754', fontWeight: 700, textDecoration: 'none' }}>
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
