import React from 'react';
import { Link } from '../../router/Router';
import { services } from '../../data/services';

export default function ServicesGridSection({ onPlayVideo }) {
  const topServices = services.slice(0, 3);
  const bottomServices = services.slice(3, 6);

  return (
    <section className="gap services">
      <div className="container">
        <div className="row g-4">
          {/* Top 3 Service Cards */}
          {topServices.map((service) => (
            <div key={service.id} className="col-lg-4 col-md-6">
              <div className="pet-grooming text-center">
                <i>
                  <img src={service.icon} alt={service.title} />
                </i>
                <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fillRule="evenodd"
                    clipRule="evenodd"
                    d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                    fill={service.accentColor || '#940c69'}
                  />
                </svg>
                <Link to="/service-details">
                  <h4>{service.title}</h4>
                </Link>
                <p>{service.shortDesc}</p>
              </div>
            </div>
          ))}

          {/* Middle Full-Width Video Presentation Banner */}
          <div className="col-lg-12">
            <div className="video position-relative rounded overflow-hidden" style={{ borderRadius: '16px' }}>
              <button
                type="button"
                onClick={onPlayVideo}
                className="position-absolute top-50 start-50 translate-middle"
                style={{
                  width: '74px',
                  height: '74px',
                  backgroundColor: '#ffffff',
                  borderRadius: '50%',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  boxShadow: '0 8px 30px rgba(0,0,0,0.3)',
                  zIndex: 3,
                  border: 'none',
                  cursor: 'pointer',
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
                aria-label="Play Service Presentation Video"
              >
                <i
                  className="fa-solid fa-play"
                  style={{
                    color: '#fa441d',
                    fontSize: '22px',
                    marginLeft: '4px',
                    transition: 'color 0.2s ease',
                  }}
                ></i>
              </button>
              <figure className="mb-0" style={{ margin: 0 }}>
                <img
                  src="/assets/img/services-video.jpg"
                  alt="Service Presentation"
                  className="w-100"
                  style={{ display: 'block', maxHeight: '420px', objectFit: 'cover' }}
                />
              </figure>
            </div>
          </div>

          {/* Bottom 3 Service Cards */}
          {bottomServices.map((service) => (
            <div key={service.id} className="col-lg-4 col-md-6">
              <div className="pet-grooming text-center mt-0">
                <i>
                  <img src={service.icon} alt={service.title} />
                </i>
                <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fillRule="evenodd"
                    clipRule="evenodd"
                    d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                    fill={service.accentColor || '#fa441d'}
                  />
                </svg>
                <Link to="/service-details">
                  <h4>{service.title}</h4>
                </Link>
                <p>{service.shortDesc}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
