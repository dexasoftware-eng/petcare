import React from 'react';
import { Link } from '../router/Router';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function BlogDetails({ onOpenLightbox }) {
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
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>Blog Details</h2>
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
              <Link to="/our-blog">Blog</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d' }}>Article</li>
          </ul>
        </div>
      </section>

      <section className="gap">
        <div className="container">
          <div className="row">
            <div className="col-lg-8">
              <div className="blog-details-content">
                <img
                  src="/assets/img/blog-1.jpg"
                  alt="Blog cover"
                  style={{ width: '100%', borderRadius: '16px', marginBottom: '25px' }}
                />
                <div className="d-flex align-items-center gap-4 mb-3">
                  <span style={{ color: '#fa441d', fontWeight: 'bold' }}>Animal Care</span>
                  <span><i className="fa-regular fa-calendar me-2"></i>23 May, 2023</span>
                  <span><i className="fa-regular fa-user me-2"></i>Willimes Domson</span>
                </div>
                <h2 style={{ fontSize: '32px', fontWeight: 'bold', marginBottom: '20px' }}>
                  The Best High Fiber Dog Food for Optimum Canine Health
                </h2>
                <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                  Dietary fiber plays an indispensable role in maintaining your canine companion's digestive equilibrium and overall vitality. Adequate fiber supports gut microbiome health, normal stool consistency, weight management, and steady blood glucose levels.
                </p>
                <blockquote
                  style={{
                    backgroundColor: '#fff8e5',
                    padding: '25px',
                    borderRadius: '12px',
                    borderLeft: '4px solid #fa441d',
                    fontStyle: 'italic',
                    margin: '30px 0',
                  }}
                >
                  "A balanced diet enriched with natural dietary fibers and vital nutrients is the cornerstone of proactive pet healthcare."
                </blockquote>
                <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                  When selecting high-fiber nutrition for your dog, look for whole food ingredients like pumpkin, beet pulp, brown rice, sweet potatoes, and carrots. Always consult with your veterinarian before introducing significant dietary transitions.
                </p>
              </div>
            </div>

            <div className="col-lg-4">
              <div className="widget-title p-4" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                <h3 style={{ fontSize: '22px', fontWeight: 'bold', marginBottom: '15px' }}>Recent Posts</h3>
                <div className="boder mb-3"></div>
                <ul style={{ listStyle: 'none', padding: 0 }}>
                  <li className="mb-3">
                    <Link to="/blog-details" style={{ fontWeight: '600' }}>The Best High Fiber Dog Food</Link>
                    <p style={{ fontSize: '13px', color: '#777', margin: 0 }}>May 23, 2023</p>
                  </li>
                  <li className="mb-3">
                    <Link to="/blog-details" style={{ fontWeight: '600' }}>The Basic Necessities of Proper Pet Care</Link>
                    <p style={{ fontSize: '13px', color: '#777', margin: 0 }}>May 23, 2023</p>
                  </li>
                  <li className="mb-3">
                    <Link to="/blog-details" style={{ fontWeight: '600' }}>Pets need care and attention</Link>
                    <p style={{ fontSize: '13px', color: '#777', margin: 0 }}>May 23, 2023</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
