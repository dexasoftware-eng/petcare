import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import Testimonials from '../components/Home/Testimonials';
import InstaGallery from '../components/Home/InstaGallery';
import { services } from '../data/services';

const faqs = [
  {
    id: 1,
    title: "Stand out from your competitors",
    content: "Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei amet,consectetur adipiscing elibore et Lorem ipsum dolor sit amet,consectetur."
  },
  {
    id: 2,
    title: "Save costs with partner discounts",
    content: "Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei amet,consectetur adipiscing elibore et Lorem ipsum dolor sit amet,consectetur."
  },
  {
    id: 3,
    title: "Automate appointment reminders",
    content: "Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei amet,consectetur adipiscing elibore et Lorem ipsum dolor sit amet,consectetur."
  },
  {
    id: 4,
    title: "24/7 Veterinary emergency hotline",
    content: "Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei amet,consectetur adipiscing elibore et Lorem ipsum dolor sit amet,consectetur."
  }
];

const Services = () => {
  const [activeFaq, setActiveFaq] = useState(2);
  const [isVideoOpen, setIsVideoOpen] = useState(false);

  return (
    <div className="services-page">
      <PageBanner title="Services" />

      {/* Services Grid Section */}
      <section className="gap services">
        <div className="container">
          <div className="row g-4">
            {services.slice(0, 3).map((service) => (
              <div key={service.id} className="col-lg-4 col-md-6">
                <div className="pet-grooming text-center">
                  <i><img src={service.icon} alt={service.title} /></i>
                  <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                    <path fillRule="evenodd" clipRule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000" />
                  </svg>
                  <Link to="/service-details"><h4>{service.title}</h4></Link>
                  <p>{service.shortDesc}</p>
                </div>
              </div>
            ))}

            {/* Video Banner */}
            <div className="col-lg-12">
              <div className="video position-relative rounded overflow-hidden">
                <a
                  href="#play-video"
                  onClick={(e) => {
                    e.preventDefault();
                    setIsVideoOpen(true);
                  }}
                  className="position-absolute top-50 start-50 translate-middle"
                  style={{
                    width: '70px',
                    height: '70px',
                    backgroundColor: '#ffffff',
                    borderRadius: '50%',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    boxShadow: '0 5px 20px rgba(0,0,0,0.3)',
                    zIndex: 2
                  }}
                >
                  <i className="fa-solid fa-play text-dark ps-1 fs-5"></i>
                </a>
                <figure className="mb-0">
                  <img src="/assets/img/services-video.jpg" alt="Service Presentation" className="w-100" />
                </figure>
              </div>
            </div>

            {services.slice(3, 6).map((service) => (
              <div key={service.id} className="col-lg-4 col-md-6">
                <div className="pet-grooming text-center mt-0">
                  <i><img src={service.icon} alt={service.title} /></i>
                  <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                    <path fillRule="evenodd" clipRule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000" />
                  </svg>
                  <Link to="/service-details"><h4>{service.title}</h4></Link>
                  <p>{service.shortDesc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Accordion FAQ Section */}
      <section
        className="gap position-relative"
        style={{ backgroundImage: 'url(/assets/img/client-b.jpg)' }}
      >
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-6">
              <div className="heading two w-100 mb-4">
                <h6>laundry faq's</h6>
                <h2>Pet Benefits of Membership</h2>
              </div>
              <div className="accordion">
                {faqs.map((faq) => {
                  const isActive = activeFaq === faq.id;
                  return (
                    <div
                      key={faq.id}
                      className={`accordion-item mb-3 ${isActive ? 'active' : ''}`}
                      style={{
                        background: '#ffffff',
                        borderRadius: '10px',
                        overflow: 'hidden',
                        border: '1px solid #ebebeb'
                      }}
                    >
                      <a
                        href="#toggle"
                        onClick={(e) => {
                          e.preventDefault();
                          setActiveFaq(isActive ? null : faq.id);
                        }}
                        className="heading d-flex align-items-center justify-content-between p-3"
                        style={{ textDecoration: 'none', color: '#222' }}
                      >
                        <div className="title fw-bold">{faq.title}</div>
                        <div
                          className="icon"
                          style={{
                            width: '24px',
                            height: '24px',
                            borderRadius: '50%',
                            backgroundColor: isActive ? '#fa441d' : '#f0f0f0',
                            color: isActive ? '#fff' : '#222',
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'center',
                            fontSize: '12px'
                          }}
                        >
                          <i className={`fa-solid ${isActive ? 'fa-minus' : 'fa-plus'}`}></i>
                        </div>
                      </a>
                      {isActive && (
                        <div className="content px-3 pb-3">
                          <p className="mb-0 text-muted">{faq.content}</p>
                        </div>
                      )}
                    </div>
                  );
                })}
              </div>
            </div>
            <div className="col-lg-6 text-center">
              <img src="/assets/img/faq-1.jpg" alt="FAQ Mascot" className="img-fluid rounded-circle shadow" style={{ maxWidth: '400px' }} />
            </div>
          </div>
        </div>
      </section>

      {/* Video Lightbox Modal */}
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

      {/* Testimonials */}
      <Testimonials />

      {/* Insta Gallery */}
      <InstaGallery />
    </div>
  );
};

export default Services;
