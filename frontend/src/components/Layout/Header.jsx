import React from 'react';
import { Link, useLocation } from 'react-router-dom';
import { useCart } from '../../context/CartContext';
import TopBar from './TopBar';

const Header = () => {
  const location = useLocation();
  const { setIsCartOpen, setIsSearchOpen, setIsMobileNavOpen, cartCount } = useCart();

  return (
    <header>
      <TopBar />
      <div className="container">
        <div className="bottom-bar">
          <Link to="/" className="d-inline-block">
            <img src="/assets/img/logo.png" alt="Patte Logo" />
          </Link>
          
          <nav className="navbar">
            <ul className="navbar-links">
              <li className="navbar-dropdown menu-item-children">
                <Link to="/">
                  <i>
                    <img alt="home" src="/assets/img/home.png" />
                  </i>
                  home
                </Link>
                <div className="dropdown">
                  <Link to="/">home 1</Link>
                  <Link to="/">home 2</Link>
                  <Link to="/">home 3</Link>
                </div>
              </li>

              <li className="navbar-dropdown">
                <Link to="/about">About</Link>
              </li>

              <li className="navbar-dropdown menu-item-children">
                <Link to="/services">services</Link>
                <div className="dropdown">
                  <Link to="/services">services</Link>
                  <Link to="/service-details">service details</Link>
                </div>
              </li>

              <li className="navbar-dropdown menu-item-children">
                <a href="#pages" onClick={(e) => e.preventDefault()}>pages</a>
                <div className="dropdown">
                  <Link to="/team-details">team details</Link>
                  <Link to="/how-we-work">how we works</Link>
                  <Link to="/history">history</Link>
                  <Link to="/pricing">pricing packages</Link>
                  <Link to="/gallery">photo gallery</Link>
                  <Link to="/login">login</Link>
                </div>
              </li>

              <li className="navbar-dropdown menu-item-children">
                <Link to="/shop">Shop</Link>
                <div className="dropdown">
                  <Link to="/shop">our products</Link>
                  <Link to="/product-details">product details</Link>
                  <Link to="/cart">shop cart</Link>
                  <Link to="/checkout">cart checkout</Link>
                </div>
              </li>

              <li className="navbar-dropdown menu-item-children">
                <Link to="/blog">News</Link>
                <div className="dropdown">
                  <Link to="/blog">our blog</Link>
                  <Link to="/blog-details">blog details</Link>
                </div>
              </li>

              <li className="navbar-dropdown">
                <Link to="/contact">Contact</Link>
              </li>
            </ul>
          </nav>

          <div className="menu-end">
            <div className="bar-menu" onClick={() => setIsMobileNavOpen(true)}>
              <i className="fa-solid fa-bars"></i>
            </div>
            
            <div className="header-search-button search-box-outer">
              <a
                href="#search"
                className="search-btn"
                onClick={(e) => {
                  e.preventDefault();
                  setIsSearchOpen(true);
                }}
              >
                <svg height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg">
                  <g id="_12" data-name="12">
                    <path d="m21.71 20.29-2.83-2.82a9.52 9.52 0 1 0 -1.41 1.41l2.82 2.83a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zm-17.71-8.79a7.5 7.5 0 1 1 7.5 7.5 7.5 7.5 0 0 1 -7.5-7.5z" />
                  </g>
                </svg>
              </a>
            </div>

            <div className="line"></div>

            <Link to="/shop">
              <i className="fa-regular fa-heart"></i>
            </Link>

            <div className="hamburger-icon">
              <div className="donation position-relative">
                <a
                  href="#cart"
                  className="mx-0"
                  id="show"
                  onClick={(e) => {
                    e.preventDefault();
                    setIsCartOpen(true);
                  }}
                >
                  <svg enableBackground="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <path d="m452 120h-60.946c-7.945-67.478-65.477-120-135.054-120s-127.109 52.522-135.054 120h-60.946c-11.046 0-20 8.954-20 20v352c0 11.046 8.954 20 20 20h392c11.046 0 20-8.954 20-20v-352c0-11.046-8.954-20-20-20zm-196-80c47.484 0 87.019 34.655 94.659 80h-189.318c7.64-45.345 47.175-80 94.659-80zm176 432h-352v-312h40v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h192v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h40z" />
                    </g>
                  </svg>
                  {cartCount > 0 && (
                    <span
                      style={{
                        position: 'absolute',
                        top: '-6px',
                        right: '-8px',
                        background: '#fa441d',
                        color: '#fff',
                        borderRadius: '50%',
                        fontSize: '10px',
                        fontWeight: 'bold',
                        width: '18px',
                        height: '18px',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center'
                      }}
                    >
                      {cartCount}
                    </span>
                  )}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
  );
};

export default Header;
