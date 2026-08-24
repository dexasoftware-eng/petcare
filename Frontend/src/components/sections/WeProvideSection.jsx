import React from 'react';
import { Link } from '../../router/Router';
import { weProvideItems } from '../../data/templateData';

export default function WeProvideSection() {
  return (
    <section className="gap no-bottom">
      <div className="container">
        <div className="row g-4 align-items-stretch">
          {weProvideItems.map((item) => (
            <div key={item.id} className="col-lg-4 col-md-6 d-flex">
              <div
                className="we-provide w-100"
                style={{
                  display: 'flex',
                  flexDirection: 'column',
                  alignItems: 'center',
                  justifyContent: 'flex-start',
                  height: '100%',
                  padding: '30px 24px',
                  backgroundColor: '#ffffff',
                  borderRadius: '24px',
                  boxShadow: '0 8px 30px rgba(0,0,0,0.04)',
                  transition: 'transform 0.3s ease, box-shadow 0.3s ease',
                  border: '1px solid #f2ecdf',
                }}
              >
                <div
                  className="we-provide-img"
                  style={{
                    position: 'relative',
                    width: '100%',
                    height: '240px',
                    borderRadius: '18px',
                    overflow: 'hidden',
                    marginBottom: '20px',
                  }}
                >
                  <img
                    src={item.image}
                    alt={item.title}
                    style={{
                      width: '100%',
                      height: '100%',
                      objectFit: 'cover',
                      display: 'block',
                    }}
                  />
                  <svg
                    width="326"
                    height="326"
                    viewBox="0 0 673 673"
                    xmlns="http://www.w3.org/2000/svg"
                    style={{
                      position: 'absolute',
                      top: '-15%',
                      right: '-15%',
                      opacity: 0.15,
                      pointerEvents: 'none',
                    }}
                  >
                    <path
                      fillRule="evenodd"
                      clipRule="evenodd"
                      d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                      fill={item.color}
                    />
                  </svg>
                </div>
                <Link to={item.link} style={{ textDecoration: 'none' }}>
                  <h5 style={{ fontSize: '22px', fontWeight: 700, color: '#222', marginBottom: '12px', textAlign: 'center' }}>
                    {item.title}
                  </h5>
                </Link>
                <p style={{ fontSize: '15px', color: '#666', lineHeight: 1.6, textAlign: 'center', margin: 0, flexGrow: 1 }}>
                  {item.desc}
                </p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
