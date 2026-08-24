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
            <li className="active" style={{ color: '#fa441d' }}>Pet Grooming</li>
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
                  alt="Pet Grooming"
                  style={{ width: '100%', borderRadius: '16px', marginBottom: '30px' }}
                />
                <h3 style={{ fontSize: '28px', fontWeight: 'bold', marginBottom: '15px' }}>
                  Professional Pet Grooming & Spa Services
                </h3>
                <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                  Our professional pet grooming service ensures your beloved pets stay clean, healthy, and happy. We use organic, hypoallergenic products and modern grooming techniques tailored to your pet's breed and unique coat requirements.
                </p>
                <div className="row my-4">
                  <div className="col-md-6">
                    <div className="d-flex align-items-center mb-3">
                      <i className="fa-solid fa-circle-check me-3" style={{ color: '#fa441d', fontSize: '20px' }}></i>
                      <span>Full Bath & Blow Dry</span>
                    </div>
                    <div className="d-flex align-items-center mb-3">
                      <i className="fa-solid fa-circle-check me-3" style={{ color: '#fa441d', fontSize: '20px' }}></i>
                      <span>Hair Trimming & Styling</span>
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div className="d-flex align-items-center mb-3">
                      <i className="fa-solid fa-circle-check me-3" style={{ color: '#fa441d', fontSize: '20px' }}></i>
                      <span>Nail Clipping & Ear Cleaning</span>
                    </div>
                    <div className="d-flex align-items-center mb-3">
                      <i className="fa-solid fa-circle-check me-3" style={{ color: '#fa441d', fontSize: '20px' }}></i>
                      <span>Teeth Brushing & Breath Freshening</span>
                    </div>
                  </div>
                </div>
                <Link to="/contact" className="button mt-3">
                  Book Grooming Appointment
                </Link>
              </div>
            </div>

            <div className="col-lg-4">
              <div className="widget-title p-4" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                <h3 style={{ fontSize: '22px', fontWeight: 'bold', marginBottom: '15px' }}>All Services</h3>
                <div className="boder mb-3"></div>
                <ul style={{ listStyle: 'none', padding: 0 }}>
                  <li className="mb-2"><i className="fa-solid fa-angle-right me-2"></i><Link to="/service-details">Dog Boarding Services</Link></li>
                  <li className="mb-2"><i className="fa-solid fa-angle-right me-2"></i><Link to="/service-details">Cat Boarding Services</Link></li>
                  <li className="mb-2"><i className="fa-solid fa-angle-right me-2"></i><Link to="/service-details">Spa and Grooming</Link></li>
                  <li className="mb-2"><i className="fa-solid fa-angle-right me-2"></i><Link to="/service-details">Puppy Care</Link></li>
                  <li className="mb-2"><i className="fa-solid fa-angle-right me-2"></i><Link to="/service-details">Veterinary Services</Link></li>
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
