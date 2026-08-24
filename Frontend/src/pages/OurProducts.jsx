import React from 'react';
import { Link } from '../router/Router';
import HealthyProductsSection from '../components/sections/HealthyProductsSection';
import CategorySlider from '../components/sections/CategorySlider';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function OurProducts({ onAddToCart, onOpenLightbox }) {
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
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>Our Pet Products</h2>
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
            <li className="active" style={{ color: '#fa441d' }}>Products</li>
          </ul>
        </div>
      </section>

      <CategorySlider />
      <HealthyProductsSection onAddToCart={onAddToCart} />
      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
