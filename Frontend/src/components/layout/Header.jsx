import React from 'react';
import { Link } from '../../router/Router';
import { useAuth } from '../../context/AuthContext';

export default function Header({ onOpenCart, onOpenSearch, onOpenMobileNav }) {
  const { user, role, isAuthenticated, logout } = useAuth();

  const getDashboardLink = () => {
    switch (role) {
      case 'owner':
        return '/owner/dashboard';
      case 'veterinarian':
        return '/veterinarian/dashboard';
      case 'shelter':
        return '/shelter/dashboard';
      case 'admin':
        return '/admin/dashboard';
      default:
        return '/login';
    }
  };

  return (
    <header>
      <div className="top-bar">
        <div className="container">
          <div className="top-bar-slid">
            <div>
              <div className="phone-data">
                <div className="phone">
                  <i>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style={{ enableBackground: 'new 0 0 512 512' }}>
                      <path d="M0,81v350h512V81H0z M456.952,111L256,286.104L55.047,111H456.952z M30,128.967l134.031,116.789L30,379.787V128.967z M51.213,401l135.489-135.489L256,325.896l69.298-60.384L460.787,401H51.213z M482,379.788L347.969,245.756L482,128.967V379.788z" />
                    </svg>
                  </i>
                  <a href="mailto:support@furshield.com">support@furshield.com</a>
                </div>
                <div className="phone d-flax align-items-center">
                  <i>
                    <svg height="112" viewBox="0 0 24 24" width="112" xmlns="http://www.w3.org/2000/svg">
                      <g clipRule="evenodd" fill="#fe5716" fillRule="evenodd">
                        <path d="m7 2.75c-.41421 0-.75.33579-.75.75v17c0 .4142.33579.75.75.75h10c.4142 0 .75-.3358.75-.75v-17c0-.41421-.3358-.75-.75-.75zm-2.25.75c0-1.24264 1.00736-2.25 2.25-2.25h10c1.2426 0 2.25 1.00736 2.25 2.25v17c0 1.2426-1.0074 2.25-2.25 2.25h-10c-1.24264 0-2.25-1.0074-2.25-2.25z" />
                        <path d="m10.25 5c0-.41421.3358-.75.75-.75h2c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-2c-.4142 0-.75-.33579-.75-.75z" />
                        <path d="m9.25 19c0-.4142.33579-.75.75-.75h4c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-4c-.41421 0-.75-.3358-.75-.75z" />
                      </g>
                    </svg>
                  </i>
                  <a className="me-3" href="tel:+18005550199">+1 (800) 555-0199</a>
                </div>
              </div>
            </div>
            <div>
              <div className="time">
                <div className="ordering">
                  <Link to="/services">Services</Link>
                  <div className="line"></div>
                  <Link to="/our-products">Pet Shop</Link>
                  <div className="line"></div>
                  <Link to="/contact">Emergency</Link>
                </div>
                <div className="login">
                  {isAuthenticated ? (
                    <div style={{ display: 'flex', alignItems: 'center', gap: '10px' }}>
                      <i className="fa-solid fa-user-circle" style={{ color: '#fe5716' }}></i>
                      <Link to={getDashboardLink()} style={{ fontWeight: 700 }}>
                        {user?.name} ({role})
                      </Link>
                      <button
                        onClick={logout}
                        style={{
                          background: 'none',
                          border: 'none',
                          color: '#888',
                          fontSize: '13px',
                          cursor: 'pointer',
                          paddingLeft: '6px',
                        }}
                        title="Log Out"
                      >
                        <i className="fa-solid fa-right-from-bracket"></i>
                      </button>
                    </div>
                  ) : (
                    <div style={{ display: 'flex', alignItems: 'center' }}>
                      <i className="fa-solid fa-user"></i>
                      <Link to="/login">Login / Register</Link>
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div className="container">
        <div className="bottom-bar">
          <Link to="/">
            <img src="/assets/img/logo.svg" alt="Petguard" style={{ height: '48px', width: 'auto' }} />
          </Link>
          <nav className="navbar">
            <ul className="navbar-links">
              <li>
                <Link to="/">Home</Link>
              </li>
              <li>
                <Link to="/about">About</Link>
              </li>
              <li>
                <Link to="/services">Services</Link>
              </li>
              <li>
                <Link to="/our-products">Shop</Link>
              </li>
              <li>
                <Link to="/our-blog">News</Link>
              </li>
              <li>
                <Link to="/contact">Contact</Link>
              </li>
              {isAuthenticated && (
                <li>
                  <Link to={getDashboardLink()} style={{ color: '#fe5716', fontWeight: 'bold' }}>
                    Dashboard
                  </Link>
                </li>
              )}
            </ul>
          </nav>

          <div className="menu-end">
            <div className="bar-menu" onClick={onOpenMobileNav} style={{ cursor: 'pointer' }}>
              <i className="fa-solid fa-bars"></i>
            </div>
            <div className="header-search-button search-box-outer" onClick={onOpenSearch}>
              <a href="javascript:void(0)" className="search-btn">
                <svg height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg">
                  <g id="_12" data-name="12">
                    <path d="M21.71 20.29l-2.83-2.82A9.52 9.52 0 1 0 17.47 18.88l2.82 2.83a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM4 11.5a7.5 7.5 0 1 1 7.5 7.5A7.5 7.5 0 0 1 4 11.5z" />
                  </g>
                </svg>
              </a>
            </div>
            <div className="line"></div>
            <Link to="/our-products">
              <i className="fa-regular fa-heart"></i>
            </Link>
            <div className="hamburger-icon">
              <div className="donation">
                <a
                  href="javascript:void(0)"
                  className="mx-0"
                  id="show"
                  onClick={onOpenCart}
                  aria-label="Shopping Cart"
                >
                  <svg enableBackground="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <path d="m452 120h-60.946c-7.945-67.478-65.477-120-135.054-120s-127.109 52.522-135.054 120h-60.946c-11.046 0-20 8.954-20 20v352c0 11.046 8.954 20 20 20h392c11.046 0 20-8.954 20-20v-352c0-11.046-8.954-20-20-20zm-196-80c47.484 0 87.019 34.655 94.659 80h-189.318c7.64-45.345 47.175-80 94.659-80zm176 432h-352v-312h40v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h192v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h40z" />
                    </g>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
  );
}
