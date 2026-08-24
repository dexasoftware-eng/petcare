import React from 'react';
import { Link } from '../router/Router';
import WeProvideSection from '../components/sections/WeProvideSection';
import WelcomeSection from '../components/sections/WelcomeSection';
import TeamSection from '../components/sections/TeamSection';
import FunFactsSection from '../components/sections/FunFactsSection';
import TestimonialSection from '../components/sections/TestimonialSection';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function About({ onOpenLightbox }) {
  return (
    <>
      <section
        className="banner"
        style={{
          backgroundColor: '#fff8e5',
          backgroundImage: 'url(/assets/img/background.png)',
          padding: '80px 0',
          textAlign: 'center',
          position: 'relative',
        }}
      >
        <div className="container">
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>About Us</h2>
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
            <li className="active" style={{ color: '#fa441d' }}>About Us</li>
          </ul>
        </div>
      </section>

      <WelcomeSection />
      <WeProvideSection />
      <FunFactsSection />
      <TeamSection />
      <TestimonialSection />
      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
