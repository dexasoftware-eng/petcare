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
                The Vision Behind PetGuard
              </h2>
              <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                PetGuard was created to solve one of modern pet ownership's biggest pain points: fragmented pet records and uncoordinated care. Between changing vet clinics, tracking immunization boosters, managing medications, and navigating rescue adoptions, pet information is too often lost in scattered paperwork.
              </p>
              <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                Our platform unites Pet Owners, licensed Veterinarians, and Animal Rescue Shelters into one secure, connected ecosystem. Today, PetGuard provides a unified digital space where pet wellness, clinical consultations, and responsible adoptions thrive together.
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
