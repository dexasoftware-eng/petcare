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
    <>
      <section
        className="banner"
        style={{
          backgroundColor: '#fff8e5',
          backgroundImage: 'url(/assets/img/background.png)',
          padding: '70px 0',
          textAlign: 'center',
        }}
      >
        <div className="container">
          <h2 style={{ fontSize: '40px', fontWeight: 800, marginBottom: '10px', color: '#222' }}>
            Email Verification
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
            <li className="active" style={{ color: '#fa441d', fontWeight: 600 }}>
              Verify Email
            </li>
          </ul>
        </div>
      </section>

      <section className="gap" style={{ padding: '80px 0' }}>
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-5 col-md-8 text-center">
              <div
                className="p-4 p-md-5"
                style={{
                  backgroundColor: '#fff8e5',
                  borderRadius: '24px',
                  boxShadow: '0 20px 40px rgba(0,0,0,0.04)',
                  border: '1px solid #fce3b8',
                }}
              >
                {status === 'verifying' && (
                  <div className="py-4">
                    <div
                      className="spinner-border"
                      role="status"
                      style={{ width: '3.5rem', height: '3.5rem', color: '#fa441d' }}
                    >
                      <span className="visually-hidden">Loading...</span>
                    </div>
                    <h4 className="mt-4" style={{ fontWeight: 700 }}>
                      Verifying your email...
                    </h4>
                    <p className="text-muted">Connecting with FurShield security service</p>
                  </div>
                )}

                {status === 'success' && (
                  <div className="py-2">
                    <div
                      style={{
                        width: '70px',
                        height: '70px',
                        borderRadius: '50%',
                        backgroundColor: '#198754',
                        color: '#fff',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        fontSize: '32px',
                        margin: '0 auto 16px',
                      }}
                    >
                      <i className="fa-solid fa-check"></i>
                    </div>
                    <h3 style={{ fontWeight: 800, color: '#198754', marginBottom: '10px' }}>
                      Verified!
                    </h3>
                    <p className="text-muted mb-4">{message}</p>
                    <Link to="/login" className="button w-100">
                      Proceed to Sign In <i className="fa-solid fa-arrow-right ms-1"></i>
                    </Link>
                  </div>
                )}

                {status === 'error' && (
                  <div className="py-2">
                    <div
                      style={{
                        width: '70px',
                        height: '70px',
                        borderRadius: '50%',
                        backgroundColor: '#dc3545',
                        color: '#fff',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        fontSize: '32px',
                        margin: '0 auto 16px',
                      }}
                    >
                      <i className="fa-solid fa-xmark"></i>
                    </div>
                    <h3 style={{ fontWeight: 800, color: '#dc3545', marginBottom: '10px' }}>
                      Verification Failed
                    </h3>
                    <p className="text-muted mb-4">{message}</p>
                    <div className="d-flex flex-column gap-2">
                      <Link to="/login" className="button w-100">
                        Go to Sign In
                      </Link>
                      <Link to="/" className="button btn-outline" style={{ border: '1px solid #fa441d' }}>
                        Back to Home
                      </Link>
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
