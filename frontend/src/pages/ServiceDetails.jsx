import React, { useState } from 'react';
import PageBanner from '../components/Common/PageBanner';
import WorkingTeam from '../components/Home/WorkingTeam';
import Testimonials from '../components/Home/Testimonials';
import InstaGallery from '../components/Home/InstaGallery';

const checkItems = [
  "Teeth Brushing",
  "Paw Pad Moisturizing",
  "Nail Buffing",
  "Pet Nail Color",
  "Blueberry Facial",
  "Oatmeal Bath",
  "Pet Hair Cut",
  "Pet Hair Color"
];

const ServiceDetails = () => {
  const [isVideoOpen, setIsVideoOpen] = useState(false);

  return (
    <div className="service-details-page">
      <PageBanner title="Service Details" parentPage="Services" parentLink="/services" />

      {/* Main Service Details Intro */}
      <section className="gap no-bottom service-details">
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-6">
              <div className="pet-grooming">
                <i><img src="/assets/img/welcome-to-1.png" alt="Grooming Icon" /></i>
                <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                  <path fillRule="evenodd" clipRule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000" />
                </svg>
                <a href="#title"><h3>Pet Grooming</h3></a>
                <p>
                  Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei usmod tempor incididunt ut labore et.Lorem ipsum sit amet, consectetur adipiscing elit, sed do eiusmod te incididunt ut la amet,consectetur. Lorem ipsum dolor sit sit amet, consectetur adipiscing elit, sed do eiusmod te incididunt ut la amet,consectetur.
                </p>
                <ul className="list list-unstyled ps-0 my-3">
                  <li className="d-flex align-items-center mb-2">
                    <img src="/assets/img/list.png" alt="list" className="me-2" />
                    <span>Graceful goldfish, to small, cute kittens</span>
                  </li>
                  <li className="d-flex align-items-center mb-2">
                    <img src="/assets/img/list.png" alt="list" className="me-2" />
                    <span>Feeders are either veterinary qualified staff</span>
                  </li>
                  <li className="d-flex align-items-center mb-2">
                    <img src="/assets/img/list.png" alt="list" className="me-2" />
                    <span>Experienced pet owners and animal lovers</span>
                  </li>
                  <li className="d-flex align-items-center mb-2">
                    <img src="/assets/img/list.png" alt="list" className="me-2" />
                    <span>Hungry horses: whatever the size of your pet</span>
                  </li>
                </ul>
              </div>
            </div>
            <div className="col-lg-6">
              <div className="dog-walker two d-block position-relative text-center">
                <img src="/assets/img/dog-walker-2.png" alt="Dog Walker Mascot" className="img-fluid" />
                <img src="/assets/img/dabal-foot.png" className="dabal-foot position-absolute" alt="Paw Prints" />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* More Information Section with Video */}
      <section className="gap no-bottom">
        <div className="container">
          <div className="information">
            <h3>More Information</h3>
            <div className="boder-bar mb-3" style={{ height: '3px', width: '50px', backgroundColor: '#fa441d' }}></div>
            <p>
              Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei usmod tempor incididunt ut labore et.Lorem ipsusit amet, consectetur adliem ipiscing elit, sed do eiusmod teincididunt ut la amet,consectetur. Lorem ipsum dolor sit sit amet, consectetur adipiscing elit, sed do eius lie mod teincididunt ut la amet,consectetur. Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei usmod tempor incididunt ut labore ui et.
            </p>
            <div className="row align-items-center my-4">
              <div className="col-lg-5">
                <p>
                  Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei usmod tempor incididunt ut labore et.Lorem ipsus it amet, consectetur adipiscing elit, sed do eiusmod te incididunt ut la amet,consectetur. Lorem ipsum dolor si t sit amet, consectetur adipiscing elit, sed do eiusmod teincididunt ut la amet,consectetur.
                </p>
              </div>
              <div className="col-lg-7">
                <div className="video position-relative rounded overflow-hidden">
                  <a
                    href="#play"
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
                      boxShadow: '0 5px 20px rgba(0,0,0,0.3)',
                      zIndex: 2
                    }}
                  >
                    <i className="fa-solid fa-play text-dark ps-1"></i>
                  </a>
                  <img src="/assets/img/service-video.jpg" alt="Service Deep Dive" className="w-100" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Feature Ticks Checklist */}
      <div className="container mt-5">
        <div className="information">
          <h3>Included Treatments</h3>
          <div className="boder-bar mb-4" style={{ height: '3px', width: '50px', backgroundColor: '#fa441d' }}></div>
          <div className="row g-3">
            {checkItems.map((item, idx) => (
              <div key={idx} className="col-lg-3 col-md-4 col-sm-6">
                <div
                  className="tick d-flex align-items-center p-3 rounded"
                  style={{ background: '#fff8e5', border: '1px solid #fedc4f' }}
                >
                  <img src="/assets/img/tick.png" alt="tick" className="me-2" />
                  <a href="#feature" className="fw-semibold text-dark">{item}</a>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>

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

      {/* Team */}
      <WorkingTeam />

      {/* Testimonials */}
      <Testimonials />

      {/* Insta Gallery */}
      <InstaGallery />
    </div>
  );
};

export default ServiceDetails;
