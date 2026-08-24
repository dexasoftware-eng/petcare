import React from 'react';
import { Link } from '../../router/Router';
import { weProvideItems } from '../../data/templateData';

export default function WeProvideSection({ className = 'gap no-bottom', style = {} }) {
  return (
    <section className={className} style={style}>
      <div className="container">
        <div className="row">
          {weProvideItems.map((item, index) => (
            <div key={item.id} className="col-lg-4 col-md-6">
              <div className={`we-provide ${index === weProvideItems.length - 1 ? 'mb-0' : ''}`}>
                <div className="we-provide-img">
                  <img src={item.image} alt={item.title} />
                  <svg width="326" height="326" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                    <path
                      fillRule="evenodd"
                      clipRule="evenodd"
                      d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                      fill={item.color}
                    />
                  </svg>
                </div>
                <Link to={item.link}>
                  <h5>{item.title}</h5>
                </Link>
                <p>{item.desc}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
