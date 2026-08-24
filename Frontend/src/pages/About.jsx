import React from 'react';
import { Link } from '../router/Router';
import WeProvideSection from '../components/sections/WeProvideSection';
import WelcomeSection from '../components/sections/WelcomeSection';
import CategorySlider from '../components/sections/CategorySlider';
import HealthyProductsSection from '../components/sections/HealthyProductsSection';
import FunFactsSection from '../components/sections/FunFactsSection';
import TeamSection from '../components/sections/TeamSection';
import FindDogWalkerSection from '../components/sections/FindDogWalkerSection';
import TestimonialSection from '../components/sections/TestimonialSection';
import BlogSection from '../components/sections/BlogSection';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function About({ onAddToCart, onOpenLightbox }) {
  return (
    <>
      {/* About Page Hero Banner */}
      <section
        className="banner"
        style={{
          backgroundColor: '#fff8e5',
          backgroundImage: 'url(/assets/img/background.png)',
          padding: '70px 0',
          textAlign: 'center',
          position: 'relative',
        }}
      >
        <div className="container">
          <h2 style={{ fontSize: '42px', fontWeight: 800, marginBottom: '10px', color: '#1a1a1a' }}>
            About Us
          </h2>
          <ul
            className="breadcrumb"
            style={{
              display: 'flex',
              justifyContent: 'center',
              listStyle: 'none',
              padding: 0,
              margin: 0,
              gap: '10px',
              fontSize: '15px',
            }}
          >
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d', fontWeight: 600 }}>
              About Us
            </li>
          </ul>
        </div>
      </section>

      {/* About Content & Features from about.html */}
      <WelcomeSection />
      <WeProvideSection />
      <CategorySlider />
      <HealthyProductsSection onAddToCart={onAddToCart} />
      <FunFactsSection />
      <TeamSection />
      <FindDogWalkerSection />
      <TestimonialSection />
      <BlogSection />
      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
