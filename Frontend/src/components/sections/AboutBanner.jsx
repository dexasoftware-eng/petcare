import React from 'react';
import { Link } from '../../router/Router';

export default function AboutBanner({ title = 'About Us', parent = 'Home', parentLink = '/' }) {
  return (
    <section
      className="banner"
      style={{
        backgroundColor: '#fff8e5',
        backgroundImage: 'url(/assets/img/banner.png)',
      }}
    >
      <div className="container">
        <div className="row align-items-center">
          <div className="col-lg-6">
            <div className="banner-text">
              <h2>{title}</h2>
              <ol className="breadcrumb">
                <li className="breadcrumb-item">
                  <Link to={parentLink}>{parent}</Link>
                </li>
                <li className="breadcrumb-item active" aria-current="page">
                  {title}
                </li>
              </ol>
            </div>
          </div>
          <div className="col-lg-6">
            <div className="banner-img">
              <div className="banner-img-1">
                <svg width="260" height="260" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fillRule="evenodd"
                    clipRule="evenodd"
                    d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                    fill="#fa441d"
                  />
                </svg>
                <img src="/assets/img/banner-img-1.jpg" alt="About Banner 1" />
              </div>
              <div className="banner-img-2">
                <svg width="320" height="320" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fillRule="evenodd"
                    clipRule="evenodd"
                    d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                    fill="#fa441d"
                  />
                </svg>
                <img src="/assets/img/banner-img-2.jpg" alt="About Banner 2" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <img src="/assets/img/hero-shaps-1.png" alt="decorative shape" className="img-2" />
      <img src="/assets/img/hero-shaps-1.png" alt="decorative shape" className="img-4" />
    </section>
  );
}
