import React, { useState } from 'react';
import PageBanner from '../components/Common/PageBanner';
import SectionHeading from '../components/Common/SectionHeading';
import ServiceHighlights from '../components/Home/ServiceHighlights';
import WorkingTeam from '../components/Home/WorkingTeam';
import Testimonials from '../components/Home/Testimonials';
import InstaGallery from '../components/Home/InstaGallery';
import { services } from '../data/services';

const About = () => {
  const [isVideoOpen, setIsVideoOpen] = useState(false);

  return (
    <div className="about-page">
      <PageBanner title="About" />

      {/* About Company Story Section */}
      <section className="gap about">
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-6">
              <div className="heading two">
                <h2>Welcome to The Pet Care Company</h2>
              </div>
              <div className="love-your-pets">
                <p>
                  Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei usmod tempor incididunt ut labore et.Lorem ipsumsit amet, consectetur adipiscing elit, sed do eiusmod teincididunt ut la amet,consectetur.
                </p>
                <ul className="list list-unstyled ps-0 my-4">
                  <li className="d-flex align-items-center mb-2">
                    <img src="/assets/img/list.png" alt="bullet" className="me-2" />
                    <span>Graceful goldfish, to small, cute kittens</span>
                  </li>
                  <li className="d-flex align-items-center mb-2">
                    <img src="/assets/img/list.png" alt="bullet" className="me-2" />
                    <span>Feeders are either veterinary qualified staff</span>
                  </li>
                  <li className="d-flex align-items-center mb-2">
                    <img src="/assets/img/list.png" alt="bullet" className="me-2" />
                    <span>Experienced pet owners and animal lovers</span>
                  </li>
                  <li className="d-flex align-items-center mb-2">
                    <img src="/assets/img/list.png" alt="bullet" className="me-2" />
                    <span>Hungry horses: whatever the size of your pet</span>
                  </li>
                </ul>
                <div className="company-oner position-relative d-flex align-items-center gap-3">
                  <div className="position-relative">
                    <img src="/assets/img/girl.jpg" alt="Jessica Catty" className="rounded-circle" style={{ width: '80px', height: '80px', objectFit: 'cover' }} />
                    <svg width="100" height="100" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg" style={{ position: 'absolute', top: '-10px', left: '-10px', zIndex: -1 }}>
                      <path fillRule="evenodd" clipRule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000" />
                    </svg>
                  </div>
                  <div>
                    <h3 className="mb-0 fs-5">Jessica Catty</h3>
                    <p className="mb-0 text-muted">Owner Pet Care Company</p>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-lg-6 text-center">
              <div className="dogs-img">
                <img src="/assets/img/dogs-1.png" alt="dogs group" className="img-fluid" />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* 3 Circular Feature Blocks */}
      <ServiceHighlights />

      {/* What We Provide Services & Videos */}
      <section
        style={{ backgroundImage: 'url(/assets/img/healthy-product.png)', backgroundColor: '#f5f5f5' }}
        className="gap care-services"
      >
        <div className="container">
          <SectionHeading
            subTitle="What We Provide"
            title="Pet Care Services"
          />
          <div className="row g-3">
            {services.slice(0, 4).map((service) => (
              <div key={service.id} className="col-lg-3 col-md-6 col-sm-6">
                <div className="pet-grooming text-center">
                  <i><img src={service.icon} alt={service.title} /></i>
                  <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                    <path fillRule="evenodd" clipRule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69" />
                  </svg>
                  <a href="#service"><h4>{service.title}</h4></a>
                  <p>{service.shortDesc}</p>
                </div>
              </div>
            ))}
          </div>

          <div className="row mt-4 g-4">
            <div className="col-lg-6 col-md-6">
              <div className="video position-relative rounded overflow-hidden">
                <figure className="mb-0">
                  <img src="/assets/img/about-1.jpg" alt="About Showcase 1" className="w-100" />
                </figure>
              </div>
            </div>
            <div className="col-lg-6 col-md-6">
              <div className="video position-relative rounded overflow-hidden">
                <a
                  href="#play-video"
                  onClick={(e) => {
                    e.preventDefault();
                    setIsVideoOpen(true);
                  }}
                  className="position-absolute top-50 start-50 translate-middle"
                  style={{
                    width: '60px',
                    height: '60px',
                    backgroundColor: '#ffffff',
                    borderRadius: '50%',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    boxShadow: '0 5px 15px rgba(0,0,0,0.3)',
                    zIndex: 2
                  }}
                >
                  <i className="fa-solid fa-play text-dark ps-1"></i>
                </a>
                <figure className="mb-0">
                  <img src="/assets/img/about-2.jpg" alt="About Showcase 2" className="w-100" />
                </figure>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Video Modal */}
      {isVideoOpen && (
        <div
          style={{
            position: 'fixed',
            top: 0,
            left: 0,
            width: '100vw',
            height: '100vh',
            backgroundColor: 'rgba(0,0,0,0.85)',
            zIndex: 9999999,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center'
          }}
          onClick={() => setIsVideoOpen(false)}
        >
          <div style={{ width: '80%', maxWidth: '800px', aspectRatio: '16/9' }} onClick={(e) => e.stopPropagation()}>
            <iframe
              width="100%"
              height="100%"
              src="https://www.youtube.com/embed/xKxrkht7CpY?autoplay=1"
              title="YouTube video player"
              frameBorder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowFullScreen
            ></iframe>
          </div>
        </div>
      )}

      {/* Experts Team */}
      <WorkingTeam />

      {/* Testimonials */}
      <Testimonials />

      {/* Instagram photo stream */}
      <InstaGallery />
    </div>
  );
};

export default About;
