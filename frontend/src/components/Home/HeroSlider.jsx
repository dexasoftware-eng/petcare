import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';

const slides = [
  {
    id: 1,
    title: "Take a Good Care of Pets",
    subtitle: "We are your local dog home boarding service giving you complete",
    img: "/assets/img/hero-img-1.png",
    btnText: "Get Appointment",
    btnLink: "/contact"
  },
  {
    id: 2,
    title: "Healthy Pets, Happy People",
    subtitle: "We are your local dog home boarding service giving you complete",
    img: "/assets/img/slide-3.png",
    btnText: "Get Appointment",
    btnLink: "/contact"
  },
  {
    id: 3,
    title: "Take a Good Care of Pets",
    subtitle: "We are your local dog home boarding service giving you complete",
    img: "/assets/img/slide-2.png",
    btnText: "Get Appointment",
    btnLink: "/contact"
  }
];

const HeroSlider = () => {
  const [currentSlide, setCurrentSlide] = useState(0);

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrentSlide(prev => (prev + 1) % slides.length);
    }, 6000);
    return () => clearInterval(timer);
  }, []);

  const slide = slides[currentSlide];

  return (
    <section
      className="hero-section position-relative"
      style={{
        backgroundColor: '#fff8e5',
        backgroundImage: 'url(/assets/img/background.png)',
        overflow: 'hidden'
      }}
    >
      <div className="container">
        <div className="row hero-one-slider">
          <div className="col-lg-12">
            <div className="row align-items-center">
              <div className="col-lg-5">
                <div className="hero-text" style={{ transition: 'all 0.5s ease-in-out' }}>
                  <h1>{slide.title}</h1>
                  <h3>{slide.subtitle}</h3>
                  <Link to={slide.btnLink} className="button">
                    {slide.btnText}
                  </Link>
                </div>
              </div>
              <div className="col-lg-7">
                <div className="hero-img position-relative text-center">
                  <img
                    src={slide.img}
                    alt="Hero Mascot"
                    key={slide.id}
                    className="img-fluid hero-main-img"
                    style={{ transition: 'opacity 0.6s ease-in-out' }}
                  />
                  <img
                    src="/assets/img/hero-shaps.png"
                    alt="Hero Shape"
                    className="img-1 position-absolute"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Carousel Indicators / Dots */}
        <div className="d-flex justify-content-center gap-2 mt-4 pb-3">
          {slides.map((_, idx) => (
            <button
              key={idx}
              type="button"
              onClick={() => setCurrentSlide(idx)}
              aria-label={`Slide ${idx + 1}`}
              style={{
                width: currentSlide === idx ? '28px' : '10px',
                height: '10px',
                borderRadius: '5px',
                backgroundColor: currentSlide === idx ? '#fa441d' : '#dddddd',
                border: 'none',
                transition: 'all 0.3s ease',
                cursor: 'pointer'
              }}
            />
          ))}
        </div>
      </div>

      <img src="/assets/img/hero-shaps-1.png" alt="Decorative Shape" className="img-2" />
      <img src="/assets/img/dabal-foot-1.png" alt="Paw Prints" className="img-3" />
      <img src="/assets/img/hero-shaps-1.png" alt="Decorative Shape" className="img-4" />
    </section>
  );
};

export default HeroSlider;
