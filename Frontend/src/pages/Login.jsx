import React, { useState } from 'react';
import { Link, useNavigate } from '../router/Router';

export default function Login() {
  const [isLogin, setIsLogin] = useState(true);
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [submitted, setSubmitted] = useState(false);
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();
    setSubmitted(true);
    setTimeout(() => {
      navigate('/');
    }, 1200);
  };

  return (
    <>
      <section
        className="banner"
        style={{
          backgroundColor: '#fff8e5',
          backgroundImage: 'url(/assets/img/background.png)',
          padding: '80px 0',
          textAlign: 'center',
        }}
      >
        <div className="container">
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>
            {isLogin ? 'Login' : 'Register'}
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
              fontSize: '16px',
            }}
          >
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d' }}>
              {isLogin ? 'Login' : 'Register'}
            </li>
          </ul>
        </div>
      </section>

      <section className="gap">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-6 col-md-8">
              <div
                className="login-box p-5"
                style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}
              >
                <div className="d-flex justify-content-center gap-3 mb-4">
                  <button
                    type="button"
                    className={`button ${isLogin ? '' : 'btn-outline'}`}
                    style={{
                      backgroundColor: isLogin ? '#fa441d' : 'transparent',
                      color: isLogin ? '#fff' : '#222',
                      border: '1px solid #fa441d',
                    }}
                    onClick={() => setIsLogin(true)}
                  >
                    Login
                  </button>
                  <button
                    type="button"
                    className={`button ${!isLogin ? '' : 'btn-outline'}`}
                    style={{
                      backgroundColor: !isLogin ? '#fa441d' : 'transparent',
                      color: !isLogin ? '#fff' : '#222',
                      border: '1px solid #fa441d',
                    }}
                    onClick={() => setIsLogin(false)}
                  >
                    Register
                  </button>
                </div>

                {submitted ? (
                  <div className="text-center py-4">
                    <i className="fa-solid fa-circle-check" style={{ fontSize: '48px', color: '#fa441d' }}></i>
                    <h4 className="mt-3">Welcome! Redirecting...</h4>
                  </div>
                ) : (
                  <form onSubmit={handleSubmit}>
                    {!isLogin && (
                      <div className="mb-3">
                        <label className="form-label font-semi-bold">Full Name</label>
                        <input type="text" className="form-control" placeholder="John Doe" required />
                      </div>
                    )}
                    <div className="mb-3">
                      <label className="form-label font-semi-bold">Email Address</label>
                      <input
                        type="email"
                        className="form-control"
                        placeholder="username@domain.com"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                      />
                    </div>
                    <div className="mb-4">
                      <label className="form-label font-semi-bold">Password</label>
                      <input
                        type="password"
                        className="form-control"
                        placeholder="••••••••"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                      />
                    </div>
                    <button type="submit" className="button w-100 text-center">
                      {isLogin ? 'Log In' : 'Create Account'}
                    </button>
                  </form>
                )}
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
