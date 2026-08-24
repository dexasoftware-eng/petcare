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
                  <span style={{ color: '#fa441d', fontWeight: 'bold' }}>Pet Health</span>
                  <span><i className="fa-regular fa-calendar me-2"></i>14 Aug, 2024</span>
                  <span><i className="fa-regular fa-user me-2"></i>Dr. Marcus Vance</span>
                </div>
                <h2 style={{ fontSize: '32px', fontWeight: 'bold', marginBottom: '20px' }}>
                  Essential Guide to Pet Vaccination Schedules &amp; Digital Records
                </h2>
                <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                  Immunization is one of the most critical components of preventive pet care. Core vaccines protect canine and feline companions against severe, life-threatening viral infections like rabies, distemper, parvovirus, and panleukopenia. Maintaining an organized, digital vaccination timeline ensures your pet never misses a crucial booster window.
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
                  "Timely vaccination and accessible medical history are the most effective preventive steps against preventable companion animal diseases."
                </blockquote>
                <p style={{ lineHeight: '1.8', marginBottom: '20px' }}>
                  With FurShield digital health records, pet parents can log vaccine dates, upload clinic certificates, and receive automated notifications before boosters are due. When visiting a new veterinarian or animal shelter, all immunization documentation is instantly accessible.
                </p>
                <p style={{ lineHeight: '1.8', marginBottom: '20px', fontSize: '14px', color: '#777', fontStyle: 'italic' }}>
                  *Disclaimer: Always consult your licensed veterinarian for immunization protocols and healthcare advice tailored specifically to your pet's age, medical history, and lifestyle.
                </p>
              </div>
            </div>

            <div className="col-lg-4">
              <div className="widget-title p-4" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                <h3 style={{ fontSize: '22px', fontWeight: 'bold', marginBottom: '15px' }}>Educational Articles</h3>
                <div className="boder mb-3"></div>
                <ul style={{ listStyle: 'none', padding: 0 }}>
                  <li className="mb-3">
                    <Link to="/blog-details" style={{ fontWeight: '600' }}>Pet Vaccination Schedules &amp; Records</Link>
                    <p style={{ fontSize: '13px', color: '#777', margin: 0 }}>Aug 14, 2024</p>
                  </li>
                  <li className="mb-3">
                    <Link to="/blog-details" style={{ fontWeight: '600' }}>Preparing for Stress-Free Vet Checkups</Link>
                    <p style={{ fontSize: '13px', color: '#777', margin: 0 }}>Aug 10, 2024</p>
                  </li>
                  <li className="mb-3">
                    <Link to="/blog-details" style={{ fontWeight: '600' }}>The 3-3-3 Rescue Pet Adjustment Rule</Link>
                    <p style={{ fontSize: '13px', color: '#777', margin: 0 }}>Aug 02, 2024</p>
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
