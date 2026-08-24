import React, { useState } from 'react';
import { Link } from '../router/Router';
import WeProvideSection from '../components/sections/WeProvideSection';
import TeamSection from '../components/sections/TeamSection';
import FunFactsSection from '../components/sections/FunFactsSection';
import TestimonialSection from '../components/sections/TestimonialSection';
import LightboxModal from '../components/common/LightboxModal';

export default function About() {
  const [selectedImageIndex, setSelectedImageIndex] = useState(null);
  const [isVideoOpen, setIsVideoOpen] = useState(false);

  const galleryList = [
    '/assets/img/gallery-img-1.jpg',
    '/assets/img/gallery-img-3.jpg',
    '/assets/img/gallery-img-4.jpg',
    '/assets/img/gallery-img-5.jpg',
    '/assets/img/gallery-img-6.jpg',
    '/assets/img/gallery-img-7.jpg',
    '/assets/img/gallery-img-2.jpg',
  ];

  const clientLogos = [
    { id: 1, src: '/assets/img/clients-1.png', alt: 'Client Partner 1' },
    { id: 2, src: '/assets/img/clients-2.png', alt: 'Client Partner 2' },
    { id: 3, src: '/assets/img/clients-3.png', alt: 'Client Partner 3' },
    { id: 4, src: '/assets/img/clients-4.png', alt: 'Client Partner 4' },
    { id: 5, src: '/assets/img/clients-5.png', alt: 'Client Partner 5' },
  ];

  const handleOpenLightbox = (index) => {
    setSelectedImageIndex(index);
  };

  const handleCloseLightbox = () => {
    setSelectedImageIndex(null);
  };

  const handleNextImage = () => {
    setSelectedImageIndex((prev) => (prev + 1) % galleryList.length);
  };

  const handlePrevImage = () => {
    setSelectedImageIndex((prev) => (prev === 0 ? galleryList.length - 1 : prev - 1));
  };

  return (
    <>
      {/* 1. Page Banner Section */}
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
                <h2>About Us</h2>
                <ol className="breadcrumb">
                  <li className="breadcrumb-item">
                    <Link to="/">Home</Link>
                  </li>
                  <li className="breadcrumb-item active" aria-current="page">
                    About Us
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
                  <img src="/assets/img/banner-img-1.jpg" alt="About FurShield Banner 1" />
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
                  <img src="/assets/img/banner-img-2.jpg" alt="About FurShield Banner 2" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <img src="/assets/img/hero-shaps-1.png" alt="decorative shape" className="img-2" />
        <img src="/assets/img/hero-shaps-1.png" alt="decorative shape" className="img-4" />
      </section>

      {/* 2. Welcome to The Pet Care Company / Story Section */}
      <section className="gap about">
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-6">
              <div className="heading two">
                <h2>Welcome to The Pet Care Company</h2>
              </div>
              <div className="love-your-pets">
                <p>
                  At FurShield, we are passionate about providing state-of-the-art care, health management, and sanctuary solutions for companions of all shapes and sizes. Every pet deserves a healthy, joyful, and protected life with loving caretakers.
                </p>
                <ul className="list">
                  <li>
                    <img src="/assets/img/list.png" alt="list icon" /> Graceful goldfish, to small, cute kittens
                  </li>
                  <li>
                    <img src="/assets/img/list.png" alt="list icon" /> Feeders and handlers are veterinary certified staff
                  </li>
                  <li>
                    <img src="/assets/img/list.png" alt="list icon" /> Experienced pet owners and dedicated animal lovers
                  </li>
                  <li>
                    <img src="/assets/img/list.png" alt="list icon" /> Comprehensive boarding & nutrition plans for any pet
                  </li>
                </ul>
                <div className="company-oner position-relative">
                  <img src="/assets/img/girl.jpg" alt="Jessica Catty - Founder" />
                  <svg width="116" height="116" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                    <path
                      fillRule="evenodd"
                      clipRule="evenodd"
                      d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                      fill="#000"
                    />
                  </svg>
                  <div>
                    <h3>Jessica Catty</h3>
                    <p>Owner & Founder, FurShield Pet Care</p>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-lg-6">
              <div className="dogs-img">
                <img src="/assets/img/dogs-1.png" alt="Happy Dogs" />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* 3. We Provide 3-Card Section */}
      <WeProvideSection />

      {/* 4. Pet Care Services Grid & Video Highlight */}
      <section
        style={{ backgroundImage: 'url(/assets/img/healthy-product.png)', backgroundColor: '#f5f5f5' }}
        className="gap care-services"
      >
        <div className="container">
          <div className="heading">
            <img src="/assets/img/heading-img.png" alt="heading ornament" />
            <h6>What We Provide</h6>
            <h2>Pet Care Services</h2>
          </div>
          <div className="row">
            <div className="col-lg-3 p-lg-0 col-md-6 col-sm-6">
              <div className="pet-grooming">
                <i>
                  <img src="/assets/img/welcome-to-3.png" alt="Online Order icon" />
                </i>
                <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fillRule="evenodd"
                    clipRule="evenodd"
                    d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                    fill="#940c69"
                  />
                </svg>
                <Link to="/our-products">
                  <h4>Online Order</h4>
                </Link>
                <p>Fast doorstep delivery for nutrient-dense pet formulas and healthcare supplies.</p>
              </div>
            </div>

            <div className="col-lg-3 p-lg-0 col-md-6 col-sm-6">
              <div className="pet-grooming">
                <i>
                  <img src="/assets/img/welcome-to-1.png" alt="Pet Grooming icon" />
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
                  <h4>Pet Grooming</h4>
                </Link>
                <p>Gentle therapeutic baths, coat trims, and dermatological skin care treatments.</p>
              </div>
            </div>

            <div className="col-lg-3 p-lg-0 col-md-6 col-sm-6">
              <div className="pet-grooming">
                <i>
                  <img src="/assets/img/welcome-to-4.png" alt="Pet Boarding icon" />
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
                  <h4>Pet Boarding</h4>
                </Link>
                <p>Comfortable climate-controlled suites with 24/7 attentive supervision and care.</p>
              </div>
            </div>

            <div className="col-lg-3 p-lg-0 col-md-6 col-sm-6">
              <div className="pet-grooming">
                <i>
                  <img src="/assets/img/welcome-to-2.png" alt="Dog Walking icon" />
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
                  <h4>Dog Walking</h4>
                </Link>
                <p>Scheduled daily adventures and energetic fitness runs customized for your pup.</p>
              </div>
            </div>
          </div>

          <div className="row mt-3">
            <div className="col-lg-6 col-md-6">
              <div className="video position-relative">
                <figure>
                  <img src="/assets/img/about-1.jpg" alt="Veterinary Facility" className="w-100" />
                </figure>
              </div>
            </div>
            <div className="col-lg-6 col-md-6">
              <div className="video position-relative">
                <button
                  type="button"
                  onClick={() => setIsVideoOpen(true)}
                  style={{
                    position: 'absolute',
                    top: '50%',
                    left: '50%',
                    transform: 'translate(-50%, -50%)',
                    background: '#fff',
                    border: 'none',
                    borderRadius: '50%',
                    width: '64px',
                    height: '64px',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    cursor: 'pointer',
                    boxShadow: '0 10px 25px rgba(0,0,0,0.25)',
                    zIndex: 2,
                  }}
                  aria-label="Play Video"
                >
                  <i style={{ color: '#fa441d', fontSize: '20px', marginLeft: '3px' }} className="fa-solid fa-play"></i>
                </button>
                <figure>
                  <img src="/assets/img/about-2.jpg" alt="Pet Play Area" className="w-100" />
                </figure>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* 5. Meet Our Experts / Best Working Team */}
      <section className="gap no-bottom">
        <TeamSection />
      </section>

      {/* 6. Fun Facts Counter Section */}
      <FunFactsSection />

      {/* 7. Client Testimonials Slider */}
      <TestimonialSection />

      {/* 8. Pet Care Memories Photo Gallery */}
      <div className="gap">
        <div className="container">
          <div className="heading">
            <img src="/assets/img/heading-img.png" alt="heading ornament" />
            <h6>Gallery Photos</h6>
            <h2>Pet Care Memories</h2>
          </div>
          <div className="row">
            <div className="col-lg-4 col-md-6">
              <div className="about-gallery-img">
                <a
                  href="javascript:void(0)"
                  onClick={(e) => {
                    e.preventDefault();
                    handleOpenLightbox(0);
                  }}
                >
                  <i className="fa-solid fa-plus"></i>
                </a>
                <figure>
                  <img alt="Pet gallery 1" src="/assets/img/gallery-img-1.jpg" />
                </figure>
              </div>
              <div className="about-gallery-img mb-lg-0">
                <a
                  href="javascript:void(0)"
                  onClick={(e) => {
                    e.preventDefault();
                    handleOpenLightbox(1);
                  }}
                >
                  <i className="fa-solid fa-plus"></i>
                </a>
                <figure>
                  <img alt="Pet gallery 3" src="/assets/img/gallery-img-3.jpg" />
                </figure>
              </div>
            </div>
            <div className="col-lg-4 col-md-6">
              <div className="about-gallery-img">
                <a
                  href="javascript:void(0)"
                  onClick={(e) => {
                    e.preventDefault();
                    handleOpenLightbox(2);
                  }}
                >
                  <i className="fa-solid fa-plus"></i>
                </a>
                <figure>
                  <img alt="Pet gallery 4" src="/assets/img/gallery-img-4.jpg" />
                </figure>
              </div>
              <div className="about-gallery-img">
                <a
                  href="javascript:void(0)"
                  onClick={(e) => {
                    e.preventDefault();
                    handleOpenLightbox(3);
                  }}
                >
                  <i className="fa-solid fa-plus"></i>
                </a>
                <figure>
                  <img alt="Pet gallery 5" src="/assets/img/gallery-img-5.jpg" />
                </figure>
              </div>
              <div className="about-gallery-img mb-lg-0">
                <a
                  href="javascript:void(0)"
                  onClick={(e) => {
                    e.preventDefault();
                    handleOpenLightbox(4);
                  }}
                >
                  <i className="fa-solid fa-plus"></i>
                </a>
                <figure>
                  <img alt="Pet gallery 6" src="/assets/img/gallery-img-6.jpg" />
                </figure>
              </div>
            </div>
            <div className="col-lg-4 col-md-6">
              <div className="about-gallery-img">
                <a
                  href="javascript:void(0)"
                  onClick={(e) => {
                    e.preventDefault();
                    handleOpenLightbox(5);
                  }}
                >
                  <i className="fa-solid fa-plus"></i>
                </a>
                <figure>
                  <img alt="Pet gallery 7" src="/assets/img/gallery-img-7.jpg" />
                </figure>
              </div>
              <div className="about-gallery-img mb-lg-0">
                <a
                  href="javascript:void(0)"
                  onClick={(e) => {
                    e.preventDefault();
                    handleOpenLightbox(6);
                  }}
                >
                  <i className="fa-solid fa-plus"></i>
                </a>
                <figure>
                  <img alt="Pet gallery 2" src="/assets/img/gallery-img-2.jpg" />
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* 9. Brand Partners Logo Section */}
      <div className="clients-logo">
        <div className="container">
          <div className="logodata d-flex align-items-center justify-content-between flex-wrap gap-4 py-4">
            {clientLogos.map((client) => (
              <div key={client.id} className="partner item">
                <img
                  alt={client.alt}
                  src={client.src}
                  style={{ opacity: 0.85, transition: 'opacity 0.3s ease' }}
                  onMouseEnter={(e) => (e.currentTarget.style.opacity = '1')}
                  onMouseLeave={(e) => (e.currentTarget.style.opacity = '0.85')}
                />
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* 10. Discount / CTA Registration Banner */}
      <div className="gap">
        <div className="container">
          <div className="mockup">
            <h3>
              Register your pet with us and <span>Get 5% off</span> their next order
            </h3>
            <div className="mockup-img">
              <img src="/assets/img/mockup.png" alt="Pet care mockup discount" />
            </div>
            <div className="mockup-text">
              <p>Join the FurShield family today for health tracking, certified clinics, and shelter adoptions.</p>
              <Link to="/register/owner" className="button">
                Register Now
              </Link>
            </div>
          </div>
        </div>
      </div>

      {/* Lightbox Modal for Gallery Images */}
      <LightboxModal
        isOpen={selectedImageIndex !== null}
        imageSrc={selectedImageIndex !== null ? galleryList[selectedImageIndex] : ''}
        onClose={handleCloseLightbox}
        onNext={handleNextImage}
        onPrev={handlePrevImage}
      />

      {/* Video Popup Modal */}
      {isVideoOpen && (
        <div
          style={{
            position: 'fixed',
            inset: 0,
            backgroundColor: 'rgba(0, 0, 0, 0.88)',
            zIndex: 999999,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            padding: '20px',
          }}
          onClick={() => setIsVideoOpen(false)}
        >
          <div
            style={{
              position: 'relative',
              width: '100%',
              maxWidth: '850px',
              aspectRatio: '16/9',
              borderRadius: '16px',
              overflow: 'hidden',
              boxShadow: '0 25px 60px rgba(0,0,0,0.5)',
            }}
            onClick={(e) => e.stopPropagation()}
          >
            <button
              type="button"
              onClick={() => setIsVideoOpen(false)}
              style={{
                position: 'absolute',
                top: '12px',
                right: '12px',
                background: 'rgba(0,0,0,0.7)',
                color: '#fff',
                border: 'none',
                width: '36px',
                height: '36px',
                borderRadius: '50%',
                cursor: 'pointer',
                zIndex: 10,
              }}
            >
              <i className="fa-solid fa-xmark"></i>
            </button>
            <iframe
              width="100%"
              height="100%"
              src="https://www.youtube-nocookie.com/embed/xKxrkht7CpY?autoplay=1"
              title="FurShield Pet Care Video"
              frameBorder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowFullScreen
            ></iframe>
          </div>
        </div>
      )}
    </>
  );
}
