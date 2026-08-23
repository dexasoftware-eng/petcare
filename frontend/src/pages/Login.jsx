import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import InstaGallery from '../components/Home/InstaGallery';

const Login = () => {
  const [isRegister, setIsRegister] = useState(false);

  return (
    <div className="login-page">
      <PageBanner title={isRegister ? "Register" : "Login"} parentPage="Account" />

      <section className="gap">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-6 col-md-8">
              <div className="p-5 rounded border shadow-sm" style={{ backgroundColor: '#fff8e5', borderColor: '#fedc4f' }}>
                <div className="d-flex justify-content-center gap-3 mb-4 border-bottom pb-3">
                  <button
                    className={`btn fw-bold ${!isRegister ? 'btn-danger' : 'btn-light'}`}
                    style={{ backgroundColor: !isRegister ? '#fa441d' : 'transparent', color: !isRegister ? '#fff' : '#222' }}
                    onClick={() => setIsRegister(false)}
                  >
                    Sign In
                  </button>
                  <button
                    className={`btn fw-bold ${isRegister ? 'btn-danger' : 'btn-light'}`}
                    style={{ backgroundColor: isRegister ? '#fa441d' : 'transparent', color: isRegister ? '#fff' : '#222' }}
                    onClick={() => setIsRegister(true)}
                  >
                    Register
                  </button>
                </div>

                {!isRegister ? (
                  <form onSubmit={(e) => { e.preventDefault(); alert('Login successful!'); }}>
                    <div className="mb-3">
                      <label className="form-label fw-semibold">Username or Email *</label>
                      <input type="text" required className="form-control p-3" placeholder="username@domain.com" />
                    </div>
                    <div className="mb-3">
                      <label className="form-label fw-semibold">Password *</label>
                      <input type="password" required className="form-control p-3" placeholder="••••••••" />
                    </div>
                    <div className="d-flex justify-content-between align-items-center mb-4">
                      <div className="form-check">
                        <input className="form-check-input" type="checkbox" id="rememberMe" />
                        <label className="form-check-label small" htmlFor="rememberMe">Remember me</label>
                      </div>
                      <a href="#forgot" className="small text-danger">Lost your password?</a>
                    </div>
                    <button type="submit" className="button w-100 py-3 border-0">
                      Log In
                    </button>
                  </form>
                ) : (
                  <form onSubmit={(e) => { e.preventDefault(); alert('Account registered successfully!'); }}>
                    <div className="mb-3">
                      <label className="form-label fw-semibold">Full Name *</label>
                      <input type="text" required className="form-control p-3" placeholder="Alex Morgan" />
                    </div>
                    <div className="mb-3">
                      <label className="form-label fw-semibold">Email Address *</label>
                      <input type="email" required className="form-control p-3" placeholder="alex@domain.com" />
                    </div>
                    <div className="mb-3">
                      <label className="form-label fw-semibold">Create Password *</label>
                      <input type="password" required className="form-control p-3" placeholder="Minimum 8 characters" />
                    </div>
                    <div className="form-check mb-4">
                      <input className="form-check-input" type="checkbox" id="agreeTerms" required />
                      <label className="form-check-label small" htmlFor="agreeTerms">I agree to the privacy policy and terms.</label>
                    </div>
                    <button type="submit" className="button w-100 py-3 border-0">
                      Create Account
                    </button>
                  </form>
                )}
              </div>
            </div>
          </div>
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default Login;
