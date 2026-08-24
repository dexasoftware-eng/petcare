import React, { useState } from 'react';
import { Link } from '../../router/Router';

export default function MobileNav({ isOpen, onClose }) {
  const handleLinkClick = () => {
    onClose();
  };

  return (
    <>
      <div
        className={`mobile-nav hmburger-menu ${isOpen ? 'open' : ''}`}
        id="mobile-nav"
        style={{ display: 'block' }}
      >
        <div className="res-log">
          <Link to="/" onClick={handleLinkClick}>
            <img src="/assets/img/logo-w.svg" alt="Petguard" style={{ height: '44px', width: 'auto' }} />
          </Link>
        </div>
        <ul>
          <li>
            <Link to="/" onClick={handleLinkClick}>Home</Link>
          </li>
          <li>
            <Link to="/about" onClick={handleLinkClick}>About</Link>
          </li>
          <li>
            <Link to="/services" onClick={handleLinkClick}>Services</Link>
          </li>
          <li>
            <Link to="/our-products" onClick={handleLinkClick}>Shop</Link>
          </li>
          <li>
            <Link to="/our-blog" onClick={handleLinkClick}>News</Link>
          </li>
          <li>
            <Link to="/contact" onClick={handleLinkClick}>Contact</Link>
          </li>
        </ul>

        <ul className="social-icon">
          <li><a href="https://facebook.com" target="_blank" rel="noreferrer"><i className="fa-brands fa-facebook-f"></i></a></li>
          <li><a href="https://twitter.com" target="_blank" rel="noreferrer"><i className="fa-brands fa-twitter"></i></a></li>
          <li><a href="https://instagram.com" target="_blank" rel="noreferrer"><i className="fa-brands fa-instagram"></i></a></li>
        </ul>

        <button
          type="button"
          id="res-cross"
          onClick={onClose}
          style={{ background: 'none', border: 'none', cursor: 'pointer' }}
          aria-label="Close navigation"
        />
      </div>

      {isOpen && (
        <div
          onClick={onClose}
          style={{
            position: 'fixed',
            inset: 0,
            backgroundColor: 'rgba(0,0,0,0.5)',
            zIndex: 998,
          }}
        />
      )}
    </>
  );
}
