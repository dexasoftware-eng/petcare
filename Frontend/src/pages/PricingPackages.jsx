import React from 'react';
import { Link } from '../router/Router';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function PricingPackages({ onOpenLightbox }) {
  const packages = [
    {
      title: 'Standard Care',
      price: '$29',
      period: '/ visit',
      features: ['30 Min Dog Walking', 'Fresh Food & Water', 'Medication Administration', 'Daily Photo Updates'],
    },
    {
      title: 'Premium Grooming',
      price: '$59',
      period: '/ session',
      features: ['Full Bath & Styling', 'Nail Trimming & Filing', 'Ear Cleaning & Teeth Check', 'Coat Conditioning'],
      featured: true,
    },
    {
      title: 'All-Inclusive Stay',
      price: '$99',
      period: '/ day',
      features: ['24/7 Supervised Boarding', 'Private Luxury Suite', '3 Daily Play Sessions', 'Grooming & Treats Included'],
    },
  ];

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
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>Pricing Packages</h2>
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
            <li className="active" style={{ color: '#fa441d' }}>Pricing</li>
          </ul>
        </div>
      </section>

      <section className="gap">
        <div className="container">
          <div className="row">
            {packages.map((pkg, idx) => (
              <div key={idx} className="col-lg-4 col-md-6 mb-4">
                <div
                  className="package-card p-5 text-center"
                  style={{
                    backgroundColor: '#fff8e5',
                    borderRadius: '16px',
                    border: pkg.featured ? '2px solid #fa441d' : 'none',
                    position: 'relative',
                  }}
                >
                  {pkg.featured && (
                    <span
                      style={{
                        position: 'absolute',
                        top: '-14px',
                        left: '50%',
                        transform: 'translateX(-50%)',
                        backgroundColor: '#fa441d',
                        color: '#fff',
                        padding: '4px 14px',
                        borderRadius: '20px',
                        fontSize: '12px',
                        fontWeight: 'bold',
                      }}
                    >
                      Most Popular
                    </span>
                  )}
                  <h3 style={{ fontWeight: 'bold', marginBottom: '15px' }}>{pkg.title}</h3>
                  <div className="d-flex align-items-baseline justify-content-center mb-4">
                    <span style={{ fontSize: '42px', fontWeight: 'bold', color: '#fa441d' }}>{pkg.price}</span>
                    <span style={{ color: '#777', marginLeft: '5px' }}>{pkg.period}</span>
                  </div>
                  <ul style={{ listStyle: 'none', padding: 0, marginBottom: '30px', textAlign: 'left' }}>
                    {pkg.features.map((feat, i) => (
                      <li key={i} className="mb-2 d-flex align-items-center">
                        <i className="fa-solid fa-check me-2" style={{ color: '#fa441d' }}></i>
                        {feat}
                      </li>
                    ))}
                  </ul>
                  <Link to="/contact" className="button d-block text-center">
                    Choose Plan
                  </Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
