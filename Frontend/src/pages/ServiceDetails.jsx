import React from 'react';
import { Link } from '../router/Router';
import FindDogWalkerSection from '../components/sections/FindDogWalkerSection';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function ServiceDetails({ onOpenLightbox }) {
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
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>Service Details</h2>
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
              <Link to="/services">Services</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d' }}>Digital Pet Profiles</li>
          </ul>
        </div>
      </section>

      <section className="gap">
        <div className="container">
          <div className="row">
            <div className="col-lg-8">
              <div className="service-details-content">
                <img
                  src="/assets/img/we-provide-1.jpg"
                  alt="Digital Pet Profiles"
                  style={{ width: '100%', borderRadius: '16px', marginBottom: '30px' }}
                />
                <h3 style={{ fontSize: '28px', fontWeight: 'bold', marginBottom: '15px' }}>
                  Centralized Digital Pet Profiles &amp; Health Tracking
                </h3>
                <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                  FurShield empowers pet owners and veterinary professionals with structured, accessible health profiles. Keep comprehensive track of vaccinations, medical diagnoses, allergies, dietary schedules, and emergency contacts in one secure, accessible cloud environment.
                </p>
                <div className="row my-4">
                  <div className="col-md-6">
                    <div className="d-flex align-items-center mb-3">
                      <i className="fa-solid fa-circle-check me-3" style={{ color: '#fa441d', fontSize: '20px' }}></i>
                      <span>Digital Vaccination Logs</span>
                    </div>
                    <div className="d-flex align-items-center mb-3">
                      <i className="fa-solid fa-circle-check me-3" style={{ color: '#fa441d', fontSize: '20px' }}></i>
                      <span>Allergy &amp; Medical Alerts</span>
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div className="d-flex align-items-center mb-3">
                      <i className="fa-solid fa-circle-check me-3" style={{ color: '#fa441d', fontSize: '20px' }}></i>
                      <span>Direct Veterinary Record Access</span>
                    </div>
                    <div className="d-flex align-items-center mb-3">
                      <i className="fa-solid fa-circle-check me-3" style={{ color: '#fa441d', fontSize: '20px' }}></i>
                      <span>Medication &amp; Dietary Reminders</span>
                    </div>
                  </div>
                </div>
                <Link to="/register/owner" className="button mt-3">
                  Create Pet Profile
                </Link>
              </div>
            </div>

            <div className="col-lg-4">
              <div className="widget-title p-4" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                <h3 style={{ fontSize: '22px', fontWeight: 'bold', marginBottom: '15px' }}>Platform Services</h3>
                <div className="boder mb-3"></div>
                <ul style={{ listStyle: 'none', padding: 0 }}>
                  <li className="mb-2"><i className="fa-solid fa-angle-right me-2"></i><Link to="/services">Digital Pet Profiles</Link></li>
                  <li className="mb-2"><i className="fa-solid fa-angle-right me-2"></i><Link to="/services">Veterinary Consultations</Link></li>
                  <li className="mb-2"><i className="fa-solid fa-angle-right me-2"></i><Link to="/services">Vaccination Tracking</Link></li>
                  <li className="mb-2"><i className="fa-solid fa-angle-right me-2"></i><Link to="/services">Shelter Adoption Hub</Link></li>
                  <li className="mb-2"><i className="fa-solid fa-angle-right me-2"></i><Link to="/services">Preventive Diagnostics</Link></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <FindDogWalkerSection />
      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
