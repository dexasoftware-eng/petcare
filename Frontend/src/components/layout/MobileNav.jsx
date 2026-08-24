import React, { useState } from 'react';
import { Link } from '../../router/Router';

export default function MobileNav({ isOpen, onClose }) {
  const [openSubMenus, setOpenSubMenus] = useState({});

  const toggleSubMenu = (menuName) => {
    setOpenSubMenus((prev) => ({
      ...prev,
      [menuName]: !prev[menuName],
    }));
  };

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
            <img src="/assets/img/logo-w.png" alt="Responsive Logo" />
          </Link>
        </div>
        <ul>
          <li className={`menu-item-has-children ${openSubMenus['home'] ? 'active' : ''}`}>
            <a
              href="javascript:void(0)"
              onClick={(e) => {
                e.preventDefault();
                toggleSubMenu('home');
              }}
            >
              Home
            </a>
            <ul className="sub-menu" style={{ display: openSubMenus['home'] ? 'block' : 'none' }}>
              <li><Link to="/" onClick={handleLinkClick}>home 1</Link></li>
              <li><Link to="/" onClick={handleLinkClick}>home 2</Link></li>
              <li><Link to="/" onClick={handleLinkClick}>home 3</Link></li>
            </ul>
          </li>

          <li>
            <Link to="/about" onClick={handleLinkClick}>about</Link>
          </li>

          <li className={`menu-item-has-children ${openSubMenus['services'] ? 'active' : ''}`}>
            <a
              href="javascript:void(0)"
              onClick={(e) => {
                e.preventDefault();
                toggleSubMenu('services');
              }}
            >
              Services
            </a>
            <ul className="sub-menu" style={{ display: openSubMenus['services'] ? 'block' : 'none' }}>
              <li><Link to="/services" onClick={handleLinkClick}>services</Link></li>
              <li><Link to="/service-details" onClick={handleLinkClick}>service details</Link></li>
            </ul>
          </li>

          <li className={`menu-item-has-children ${openSubMenus['pages'] ? 'active' : ''}`}>
            <a
              href="javascript:void(0)"
              onClick={(e) => {
                e.preventDefault();
                toggleSubMenu('pages');
              }}
            >
              pages
            </a>
            <ul className="sub-menu" style={{ display: openSubMenus['pages'] ? 'block' : 'none' }}>
              <li><Link to="/team-details" onClick={handleLinkClick}>team details</Link></li>
              <li><Link to="/how-we-works" onClick={handleLinkClick}>how we works</Link></li>
              <li><Link to="/history" onClick={handleLinkClick}>history</Link></li>
              <li><Link to="/pricing-packages" onClick={handleLinkClick}>pricing packages</Link></li>
              <li><Link to="/photo-gallery" onClick={handleLinkClick}>photo gallery</Link></li>
              <li><Link to="/login" onClick={handleLinkClick}>login</Link></li>
            </ul>
          </li>

          <li className={`menu-item-has-children ${openSubMenus['shop'] ? 'active' : ''}`}>
            <a
              href="javascript:void(0)"
              onClick={(e) => {
                e.preventDefault();
                toggleSubMenu('shop');
              }}
            >
              shop
            </a>
            <ul className="sub-menu" style={{ display: openSubMenus['shop'] ? 'block' : 'none' }}>
              <li><Link to="/our-products" onClick={handleLinkClick}>our products</Link></li>
              <li><Link to="/product-details" onClick={handleLinkClick}>product details</Link></li>
              <li><Link to="/shop-cart" onClick={handleLinkClick}>shop cart</Link></li>
              <li><Link to="/cart-checkout" onClick={handleLinkClick}>cart checkout</Link></li>
            </ul>
          </li>

          <li className={`menu-item-has-children ${openSubMenus['news'] ? 'active' : ''}`}>
            <a
              href="javascript:void(0)"
              onClick={(e) => {
                e.preventDefault();
                toggleSubMenu('news');
              }}
            >
              News
            </a>
            <ul className="sub-menu" style={{ display: openSubMenus['news'] ? 'block' : 'none' }}>
              <li><Link to="/our-blog" onClick={handleLinkClick}>our blog</Link></li>
              <li><Link to="/blog-details" onClick={handleLinkClick}>blog details</Link></li>
            </ul>
          </li>

          <li>
            <Link to="/contact" onClick={handleLinkClick}>contacts</Link>
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
