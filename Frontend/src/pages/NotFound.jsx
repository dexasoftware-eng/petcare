import React from 'react';
import { Link } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import InstaGallery from '../components/Home/InstaGallery';

const NotFound = () => {
  return (
    <div className="not-found-page">
      <PageBanner title="404 - Page Not Found" />

      <section className="gap text-center">
        <div className="container py-5">
          <div className="d-inline-block p-5 rounded border" style={{ backgroundColor: '#fff8e5', maxWidth: '600px' }}>
            <h1 className="display-1 fw-bold" style={{ color: '#fa441d' }}>404</h1>
            <h2 className="mb-3">Oops! Lost in the Dog Park?</h2>
            <p className="text-secondary leading-relaxed mb-4">
              The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
            </p>
            <Link to="/" className="button">
              Return Home
            </Link>
          </div>
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default NotFound;
