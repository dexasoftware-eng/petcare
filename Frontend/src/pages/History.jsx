import React from 'react';
import { Link } from '../router/Router';
import FunFactsSection from '../components/sections/FunFactsSection';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function History({ onOpenLightbox }) {
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
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>Our History</h2>
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
            <li className="active" style={{ color: '#fa441d' }}>History</li>
          </ul>
        </div>
      </section>

      <section className="gap">
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-6">
              <img
                src="/assets/img/we-provide-1.jpg"
                alt="history"
                style={{ width: '100%', borderRadius: '16px' }}
              />
            </div>
            <div className="col-lg-6 ps-lg-5 mt-4 mt-lg-0">
              <h2 style={{ fontSize: '36px', fontWeight: 'bold', marginBottom: '20px' }}>
                Over a Decade of Loving Pet Care
              </h2>
              <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                Founded in 2012, Patte Pet Care began with a simple mission: to provide pet owners with the highest quality, most trustworthy pet sitting, grooming, and boarding services available.
              </p>
              <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                Today, our nationwide network of certified veterinary assistants and passionate caregivers serves thousands of happy pets and their families every day.
              </p>
            </div>
          </div>
        </div>
      </section>

      <FunFactsSection />
      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
