import React from 'react';
import { Link } from 'react-router-dom';

const WelcomeSection = () => {
  return (
    <section className="gap no-bottom">
      <div className="container">
        <div className="row align-items-center">
          <div className="col-lg-6">
            <div className="welcome-to">
              <h2>Welcome to FurShield Connected Pet Care</h2>
              <p>
                FurShield is a modern, unified platform designed to bridge the gap between pet owners, veterinary professionals, and animal rescue shelters. From digital health records and vaccination tracking to clinical consultations and adoption workflows, we bring every facet of pet wellbeing into one secure, accessible ecosystem.
              </p>
              <div className="row mt-lg-5">
                <div className="col-md-6">
                  <div className="pet-grooming">
                    <i>
                      <img src="/assets/img/welcome-to-1.png" alt="Digital Pet Profile Icon" />
                    </i>
                    <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                      <path
                        fillRule="evenodd"
                        clipRule="evenodd"
                        d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                        fill="#940c69"
                      />
                    </svg>
                    <Link to="/services">
                      <h4>Digital Health Hub</h4>
                    </Link>
                    <p>Store medical history, vaccinations, dietary needs, and microchip IDs in one central profile.</p>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="pet-grooming mb-0">
                    <i>
                      <img src="/assets/img/welcome-to-2.png" alt="Veterinary Care Icon" />
                    </i>
                    <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                      <path
                        fillRule="evenodd"
                        clipRule="evenodd"
                        d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                        fill="#940c69"
                      />
                    </svg>
                    <Link to="/services">
                      <h4>Veterinary Care</h4>
                    </Link>
                    <p>Coordinate appointments, review clinical summaries, and collaborate with certified vets.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="col-lg-6">
            <div className="dog-walker two d-block position-relative">
              <img src="/assets/img/puppies.png" className="puppies position-absolute" alt="puppies" />
              <img src="/assets/img/dog-walker-1.png" className="w-100" alt="dog walker mascot" />
              <img src="/assets/img/line.png" className="line position-absolute" alt="curved line" />
              <img src="/assets/img/dabal-foot.png" className="dabal-foot position-absolute" alt="paws" />
              <img src="/assets/img/haddi.png" className="haddi position-absolute" alt="bone" />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default WelcomeSection;
