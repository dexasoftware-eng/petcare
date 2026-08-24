import React from 'react';
import { Link } from 'react-router-dom';

const TopBar = () => {
  return (
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
                <a href="mailto:info@Petguard.com">info@Petguard.com</a>
              </div>
              <div className="phone d-flex align-items-center">
                <i>
                  <svg height="112" viewBox="0 0 24 24" width="112" xmlns="http://www.w3.org/2000/svg">
                    <g clipRule="evenodd" fill="rgb(255,255,255)" fillRule="evenodd">
                      <path d="m7 2.75c-.41421 0-.75.33579-.75.75v17c0 .4142.33579.75.75.75h10c.4142 0 .75-.3358.75-.75v-17c0-.41421-.3358-.75-.75-.75zm-2.25.75c0-1.24264 1.00736-2.25 2.25-2.25h10c1.2426 0 2.25 1.00736 2.25 2.25v17c0 1.2426-1.0074 2.25-2.25 2.25h-10c-1.24264 0-2.25-1.0074-2.25-2.25z" />
                      <path d="m10.25 5c0-.41421.3358-.75.75-.75h2c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-2c-.4142 0-.75-.33579-.75-.75z" />
                      <path d="m9.25 19c0-.4142.33579-.75.75-.75h4c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-4c-.41421 0-.75-.3358-.75-.75z" />
                    </g>
                  </svg>
                </i>
                <a className="me-3" href="tel:+923243284192">+92 324 3284 192</a>
              </div>
            </div>
          </div>
          <div>
            <div className="time">
              <div className="ordering">
                <Link to="/shop">Ordering</Link>
                <div className="line"></div>
                <Link to="/about">Shipping</Link>
                <div className="line"></div>
                <Link to="/contact">Returns</Link>
              </div>
              <div className="login">
                <i className="fa-solid fa-user me-1"></i>
                <Link to="/login">Login / Register</Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default TopBar;
