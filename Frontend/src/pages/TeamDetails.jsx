import React from 'react';
import { Link } from '../router/Router';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function TeamDetails({ onOpenLightbox }) {
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
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>Team Details</h2>
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
            <li>
              <Link to="/about">Team</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d' }}>Gorjona Hiller</li>
          </ul>
        </div>
      </section>

      <section className="gap">
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-5">
              <div className="team-details-img p-3" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                <img src="/assets/img/team-1.jpg" alt="Gorjona Hiller" style={{ width: '100%', borderRadius: '12px' }} />
              </div>
            </div>
            <div className="col-lg-7 ps-lg-5 mt-4 mt-lg-0">
              <span style={{ color: '#fa441d', fontWeight: 'bold' }}>Veterinary Assistant</span>
              <h2 style={{ fontSize: '36px', fontWeight: 'bold', margin: '10px 0 20px 0' }}>Gorjona Hiller</h2>
              <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                With over 8 years of dedicated experience in veterinary nursing and pet wellness, Gorjona leads our animal care and grooming protocols with boundless compassion and expertise.
              </p>
              <div className="d-flex gap-3 mb-4">
                <a href="https://facebook.com" target="_blank" rel="noreferrer" className="button" style={{ padding: '8px 16px' }}>
                  <i className="fa-brands fa-facebook-f me-2"></i>Facebook
                </a>
                <a href="https://twitter.com" target="_blank" rel="noreferrer" className="button" style={{ padding: '8px 16px' }}>
                  <i className="fa-brands fa-twitter me-2"></i>Twitter
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
