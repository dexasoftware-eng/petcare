import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { useCart } from '../../context/CartContext';

const MobileNav = () => {
  const { isMobileNavOpen, setIsMobileNavOpen } = useCart();
  const [activeSubMenu, setActiveSubMenu] = useState(null);

  const toggleSubMenu = (menuKey) => {
    setActiveSubMenu(prev => (prev === menuKey ? null : menuKey));
  };

  const handleLinkClick = () => {
    setIsMobileNavOpen(false);
    setActiveSubMenu(null);
  };

  return (
    <div
      className={`mobile-nav hmburger-menu ${isMobileNavOpen ? 'open' : ''}`}
      id="mobile-nav"
      style={{
        display: isMobileNavOpen ? 'block' : 'none',
        position: 'fixed',
        top: 0,
        right: isMobileNavOpen ? 0 : '-100%',
        width: '320px',
        maxWidth: '85vw',
        height: '100vh',
        zIndex: 99999,
        background: '#222222',
        overflowY: 'auto',
        transition: 'all 0.4s ease-in-out',
        padding: '35px 25px'
      }}
    >
      <div className="res-log mb-4">
        <Link to="/" onClick={handleLinkClick}>
          <img src="/assets/img/logo-w.png" alt="Responsive Logo" />
        </Link>
      </div>

      <ul className="list-unstyled">
        <li className={`menu-item-has-children ${activeSubMenu === 'home' ? 'active' : ''}`}>
          <a
            href="#home"
            onClick={(e) => {
              e.preventDefault();
              toggleSubMenu('home');
            }}
            className="d-flex justify-content-between align-items-center"
          >
            <span>Home</span>
            <i className={`fa-solid ${activeSubMenu === 'home' ? 'fa-minus' : 'fa-plus'}`}></i>
          </a>
          {activeSubMenu === 'home' && (
            <ul className="sub-menu list-unstyled ps-3">
              <li><Link to="/" onClick={handleLinkClick}>home 1</Link></li>
              <li><Link to="/" onClick={handleLinkClick}>home 2</Link></li>
              <li><Link to="/" onClick={handleLinkClick}>home 3</Link></li>
            </ul>
          )}
        </li>

        <li>
          <Link to="/about" onClick={handleLinkClick}>about</Link>
        </li>

        <li className={`menu-item-has-children ${activeSubMenu === 'services' ? 'active' : ''}`}>
          <a
            href="#services"
            onClick={(e) => {
              e.preventDefault();
              toggleSubMenu('services');
            }}
            className="d-flex justify-content-between align-items-center"
          >
            <span>Services</span>
            <i className={`fa-solid ${activeSubMenu === 'services' ? 'fa-minus' : 'fa-plus'}`}></i>
          </a>
          {activeSubMenu === 'services' && (
            <ul className="sub-menu list-unstyled ps-3">
              <li><Link to="/services" onClick={handleLinkClick}>services</Link></li>
              <li><Link to="/service-details" onClick={handleLinkClick}>service details</Link></li>
            </ul>
          )}
        </li>

        <li className={`menu-item-has-children ${activeSubMenu === 'pages' ? 'active' : ''}`}>
          <a
            href="#pages"
            onClick={(e) => {
              e.preventDefault();
              toggleSubMenu('pages');
            }}
            className="d-flex justify-content-between align-items-center"
          >
            <span>pages</span>
            <i className={`fa-solid ${activeSubMenu === 'pages' ? 'fa-minus' : 'fa-plus'}`}></i>
          </a>
          {activeSubMenu === 'pages' && (
            <ul className="sub-menu list-unstyled ps-3">
              <li><Link to="/team-details" onClick={handleLinkClick}>team details</Link></li>
              <li><Link to="/how-we-work" onClick={handleLinkClick}>how we works</Link></li>
              <li><Link to="/history" onClick={handleLinkClick}>history</Link></li>
              <li><Link to="/pricing" onClick={handleLinkClick}>pricing packages</Link></li>
              <li><Link to="/gallery" onClick={handleLinkClick}>photo gallery</Link></li>
              <li><Link to="/login" onClick={handleLinkClick}>login</Link></li>
            </ul>
          )}
        </li>

        <li className={`menu-item-has-children ${activeSubMenu === 'shop' ? 'active' : ''}`}>
          <a
            href="#shop"
            onClick={(e) => {
              e.preventDefault();
              toggleSubMenu('shop');
            }}
            className="d-flex justify-content-between align-items-center"
          >
            <span>shop</span>
            <i className={`fa-solid ${activeSubMenu === 'shop' ? 'fa-minus' : 'fa-plus'}`}></i>
          </a>
          {activeSubMenu === 'shop' && (
            <ul className="sub-menu list-unstyled ps-3">
              <li><Link to="/shop" onClick={handleLinkClick}>our products</Link></li>
              <li><Link to="/product-details" onClick={handleLinkClick}>product details</Link></li>
              <li><Link to="/cart" onClick={handleLinkClick}>shop cart</Link></li>
              <li><Link to="/checkout" onClick={handleLinkClick}>cart checkout</Link></li>
            </ul>
          )}
        </li>

        <li className={`menu-item-has-children ${activeSubMenu === 'news' ? 'active' : ''}`}>
          <a
            href="#news"
            onClick={(e) => {
              e.preventDefault();
              toggleSubMenu('news');
            }}
            className="d-flex justify-content-between align-items-center"
          >
            <span>News</span>
            <i className={`fa-solid ${activeSubMenu === 'news' ? 'fa-minus' : 'fa-plus'}`}></i>
          </a>
          {activeSubMenu === 'news' && (
            <ul className="sub-menu list-unstyled ps-3">
              <li><Link to="/blog" onClick={handleLinkClick}>our blog</Link></li>
              <li><Link to="/blog-details" onClick={handleLinkClick}>blog details</Link></li>
            </ul>
          )}
        </li>

        <li>
          <Link to="/contact" onClick={handleLinkClick}>contacts</Link>
        </li>
      </ul>

      <ul className="social-icon list-unstyled d-flex gap-3 mt-4">
        <li><a href="https://facebook.com" target="_blank" rel="noreferrer"><i className="fa-brands fa-facebook-f"></i></a></li>
        <li><a href="https://twitter.com" target="_blank" rel="noreferrer"><i className="fa-brands fa-twitter"></i></a></li>
        <li><a href="https://instagram.com" target="_blank" rel="noreferrer"><i className="fa-brands fa-instagram"></i></a></li>
      </ul>

      <a
        href="#close"
        id="res-cross"
        onClick={(e) => {
          e.preventDefault();
          setIsMobileNavOpen(false);
        }}
        style={{
          position: 'absolute',
          top: '20px',
          right: '20px',
          color: '#fff',
          fontSize: '20px',
          cursor: 'pointer'
        }}
      >
        <i className="fa-solid fa-xmark"></i>
      </a>
    </div>
  );
};

export default MobileNav;
