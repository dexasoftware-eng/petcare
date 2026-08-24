import React from 'react';
import { Link } from '../../router/Router';

export default function CareServicesVideoSection({ onPlayVideo }) {
  const services = [
    {
      id: 1,
      title: 'Online Order',
      desc: 'Fast doorstep delivery for nutrient-dense pet formulas and healthcare supplies.',
      icon: '/assets/img/welcome-to-3.png',
      link: '/our-products',
    },
    {
      id: 2,
      title: 'Pet Grooming',
      desc: 'Gentle therapeutic baths, coat trims, and dermatological skin care treatments.',
      icon: '/assets/img/welcome-to-1.png',
      link: '/services',
    },
    {
      id: 3,
      title: 'Pet Boarding',
      desc: 'Comfortable climate-controlled suites with 24/7 attentive supervision and care.',
      icon: '/assets/img/welcome-to-4.png',
      link: '/services',
    },
    {
      id: 4,
      title: 'Dog Walking',
      desc: 'Scheduled daily adventures and energetic fitness runs customized for your pup.',
      icon: '/assets/img/welcome-to-2.png',
      link: '/services',
    },
  ];

  return (
    <section
      style={{ backgroundImage: 'url(/assets/img/healthy-product.png)', backgroundColor: '#f5f5f5' }}
      className="gap care-services"
    >
      <div className="container">
        <div className="heading text-center mb-5">
          <img src="/assets/img/heading-img.png" alt="heading ornament" />
          <h6>What We Provide</h6>
          <h2>Pet Care Services</h2>
        </div>

        {/* 4 Equal Sized Service Cards */}
        <div className="row g-4 justify-content-center align-items-stretch">
          {services.map((service) => (
            <div key={service.id} className="col-lg-3 col-md-6 d-flex">
              <div
                className="pet-grooming w-100"
                style={{
                  display: 'flex',
                  flexDirection: 'column',
                  alignItems: 'center',
                  justifyContent: 'flex-start',
                  height: '100%',
                  minHeight: '290px',
                  padding: '36px 24px',
                  backgroundColor: '#ffffff',
                  borderRadius: '20px',
                  boxShadow: '0 8px 25px rgba(0,0,0,0.04)',
                  transition: 'transform 0.3s ease, box-shadow 0.3s ease',
                  border: '1px solid #ede7db',
                }}
              >
                <div style={{ position: 'relative', width: '138px', height: '138px', marginBottom: '16px', display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                  <svg
                    width="138"
                    height="138"
                    viewBox="0 0 673 673"
                    xmlns="http://www.w3.org/2000/svg"
                    style={{ position: 'absolute', top: 0, left: 0 }}
                  >
                    <path
                      fillRule="evenodd"
                      clipRule="evenodd"
                      d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                      fill="#940c69"
                    />
                  </svg>
                  <i style={{ position: 'relative', zIndex: 2 }}>
                    <img src={service.icon} alt={service.title} style={{ maxWidth: '60px', maxHeight: '60px', objectFit: 'contain' }} />
                  </i>
                </div>
                <Link to={service.link} style={{ textDecoration: 'none' }}>
                  <h4 style={{ fontSize: '20px', fontWeight: 700, color: '#222', marginBottom: '10px' }}>
                    {service.title}
                  </h4>
                </Link>
                <p style={{ fontSize: '14px', color: '#666', lineHeight: 1.6, margin: 0, textAlign: 'center', flexGrow: 1 }}>
                  {service.desc}
                </p>
              </div>
            </div>
          ))}
        </div>

        {/* 2 Equal Sized Bottom Highlights (Facility Image & Interactive Video) */}
        <div className="row g-4 mt-4 align-items-stretch">
          <div className="col-lg-6 col-md-6 d-flex">
            <div
              className="video position-relative w-100"
              style={{
                borderRadius: '24px',
                overflow: 'hidden',
                boxShadow: '0 12px 35px rgba(0,0,0,0.08)',
                height: '330px',
                backgroundColor: '#e6ded3',
              }}
            >
              <figure style={{ width: '100%', height: '100%', margin: 0 }}>
                <img
                  src="/assets/img/about-1.jpg"
                  alt="Veterinary Facility"
                  style={{
                    width: '100%',
                    height: '100%',
                    objectFit: 'cover',
                    display: 'block',
                    transition: 'transform 0.4s ease',
                  }}
                />
              </figure>
            </div>
          </div>

          <div className="col-lg-6 col-md-6 d-flex">
            <div
              className="video position-relative w-100"
              style={{
                borderRadius: '24px',
                overflow: 'hidden',
                boxShadow: '0 12px 35px rgba(0,0,0,0.08)',
                height: '330px',
                backgroundColor: '#e6ded3',
              }}
            >
              <button
                type="button"
                onClick={onPlayVideo}
                style={{
                  position: 'absolute',
                  top: '50%',
                  left: '50%',
                  transform: 'translate(-50%, -50%)',
                  backgroundColor: '#ffffff',
                  border: 'none',
                  borderRadius: '50%',
                  width: '68px',
                  height: '68px',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  cursor: 'pointer',
                  boxShadow: '0 12px 30px rgba(0,0,0,0.3)',
                  zIndex: 3,
                  transition: 'transform 0.2s ease, background-color 0.2s ease',
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.transform = 'translate(-50%, -50%) scale(1.1)';
                  e.currentTarget.style.backgroundColor = '#fa441d';
                  const icon = e.currentTarget.querySelector('i');
                  if (icon) icon.style.color = '#ffffff';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.transform = 'translate(-50%, -50%) scale(1)';
                  e.currentTarget.style.backgroundColor = '#ffffff';
                  const icon = e.currentTarget.querySelector('i');
                  if (icon) icon.style.color = '#fa441d';
                }}
                aria-label="Play Pet Care Video"
              >
                <i
                  style={{
                    color: '#fa441d',
                    fontSize: '22px',
                    marginLeft: '4px',
                    transition: 'color 0.2s ease',
                  }}
                  className="fa-solid fa-play"
                ></i>
              </button>
              <figure style={{ width: '100%', height: '100%', margin: 0 }}>
                <img
                  src="/assets/img/about-2.jpg"
                  alt="Pet Play Area"
                  style={{
                    width: '100%',
                    height: '100%',
                    objectFit: 'cover',
                    display: 'block',
                    transition: 'transform 0.4s ease',
                  }}
                />
              </figure>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
