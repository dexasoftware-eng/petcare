import React from 'react';
import { Link } from '../../router/Router';

export default function Footer() {
  return (
    <footer style={{ backgroundColor: '#fff8e5', backgroundImage: 'url(/assets/img/background.png)' }}>
      <div className="container">
        <div className="row">
          <div className="col-xl-4 col-lg-6">
            <div className="logo">
              <Link to="/">
                <img src="/assets/img/logo.svg" alt="Petguard" style={{ height: '48px', width: 'auto' }} />
              </Link>
              <p>FurShield is a multi-role digital platform connecting pet owners, veterinary clinics, and animal rescue shelters for smarter health management and streamlined care coordination.</p>
              <div className="phone">
                <i>
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style={{ enableBackground: 'new 0 0 512 512' }}>
                    <path d="M0,81v350h512V81H0z M456.952,111L256,286.104L55.047,111H456.952z M30,128.967l134.031,116.789L30,379.787V128.967z M51.213,401l135.489-135.489L256,325.896l69.298-60.384L460.787,401H51.213z M482,379.788L347.969,245.756L482,128.967V379.788z" />
                  </svg>
                </i>
                <a href="mailto:info@Petguard.com">info@Petguard.com</a>
              </div>
              <div className="phone d-flax align-items-center">
                <i>
                  <svg version="1.1" xmlSpace="preserve" width="682.66669" height="682.66669" viewBox="0 0 682.66669 682.66669" xmlns="http://www.w3.org/2000/svg">
                    <clipPath clipPathUnits="userSpaceOnUse"><path d="M 0,512 H 512 V 0 H 0 Z" /></clipPath>
                    <g transform="matrix(1.3333333,0,0,-1.3333333,0,682.66667)">
                      <g>
                        <g clipPath="url(#clipPath2333)">
                          <g transform="translate(256,92)">
                            <path d="m 0,0 c -126.964,143.662 -160,165.23 -160,240 0,88.366 71.634,160 160,160 88.365,0 160,-71.634 160,-160 C 160,165.854 130.212,147.337 0,0 Z" style={{ fill: 'none', stroke: '#000', strokeWidth: 40, strokeLinecap: 'square', strokeLinejoin: 'miter', strokeMiterlimit: 10, strokeDasharray: 'none', strokeOpacity: 1 }} />
                          </g>
                          <g transform="translate(316,372)">
                            <path d="m 0,0 -80,-80 -40,40" style={{ fill: 'none', stroke: '#000', strokeWidth: 40, strokeLinecap: 'square', strokeLinejoin: 'miter', strokeMiterlimit: 10, strokeDasharray: 'none', strokeOpacity: 1 }} />
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                </i>
                <p>Eighth Avenue 487, New York</p>
              </div>
            </div>
          </div>

          <div className="col-xl-4 col-lg-6">
            <div className="widget-title">
              <h3>Platform Navigation</h3>
              <div className="boder"></div>
              <ul>
                <li><i className="fa-solid fa-angle-right"></i><Link to="/services">Digital Pet Profiles</Link></li>
                <li><i className="fa-solid fa-angle-right"></i><Link to="/services">Veterinary Consultations</Link></li>
                <li><i className="fa-solid fa-angle-right"></i><Link to="/services">Vaccination Tracking</Link></li>
                <li><i className="fa-solid fa-angle-right"></i><Link to="/services">Shelter Adoption Hub</Link></li>
                <li><i className="fa-solid fa-angle-right"></i><Link to="/register/owner">Pet Owner Portal</Link></li>
                <li><i className="fa-solid fa-angle-right"></i><Link to="/register/veterinarian">Veterinarian Portal</Link></li>
              </ul>
            </div>
          </div>

          <div className="col-xl-4 col-lg-6">
            <div className="working-hours">
              <div className="widget-title">
                <h3>working hours</h3>
                <div className="boder"></div>
                <div className="working-time">
                  <h6 className="pt-0">Monday - Saturday <span>08AM - 10PM</span></h6>
                  <h6>Sunday<span>08AM - 10PM</span></h6>
                  <div className="call-us">
                    <img src="/assets/img/hadphon.png" alt="hadphon" />
                    <div>
                      <a href="tel:+923243284192">+92 324 3284 192</a>
                      <span>Got Questions? Call us 24/7</span>
                    </div>
                  </div>
                  <ul className="social-icon">
                    <li><a href="https://facebook.com" target="_blank" rel="noreferrer"><i className="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="https://twitter.com" target="_blank" rel="noreferrer"><i className="fa-brands fa-twitter"></i></a></li>
                    <li><a href="https://instagram.com" target="_blank" rel="noreferrer"><i className="fa-brands fa-instagram"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="copyright">
          <p>Petguard Pet Care - Copyright 2024. All rights reserved.</p>
          <a href="#"><img src="/assets/img/visa.jpg" alt="cad" /></a>
        </div>
      </div>

      <img src="/assets/img/hero-shaps-1.png" alt="hero-shaps" className="img-2" />
      <img src="/assets/img/dabal-foot-1.png" alt="hero-shaps" className="img-3" />
      <img src="/assets/img/hero-shaps-1.png" alt="hero-shaps" className="img-4" />
    </footer>
  );
}
