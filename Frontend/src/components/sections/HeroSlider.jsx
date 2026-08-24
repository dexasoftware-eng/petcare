import React, { useState, useEffect } from 'react';
import { Link } from '../../router/Router';
import { heroSlides } from '../../data/templateData';

export default function HeroSlider() {
  const [currentSlide, setCurrentSlide] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % heroSlides.length);
    }, 5000);
    return () => clearInterval(interval);
  }, []);

  const slide = heroSlides[currentSlide];

  return (
    <section className="hero-section" style={{ backgroundColor: '#fff8e5', backgroundImage: 'url(/assets/img/background.png)' }}>
      <div className="container">
        <div className="row hero-one-slider owl-carousel owl-theme owl-loaded owl-drag" style={{ display: 'block' }}>
          <div className="owl-stage-outer">
            <div className="owl-stage" style={{ width: '100%' }}>
              <div className="owl-item active" style={{ width: '100%' }}>
                <div className="col-lg-12">
                  <div className="row">
                    <div className="col-lg-5">
                      <div className="hero-text">
                        <h1>{slide.title}</h1>
                        <h3>{slide.subtitle}</h3>
                        <Link to={slide.buttonLink} className="button">
                          {slide.buttonText}
                        </Link>
                      </div>
                    </div>
                    <div className="col-lg-7">
                      <div className="hero-img">
                        <img key={slide.id} src={slide.image} alt="img" />
                        <img src={slide.shape} alt="hero-shaps" className="img-1" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div className="owl-dots">
            {heroSlides.map((_, index) => (
              <button
                key={index}
                role="button"
                className={`owl-dot ${index === currentSlide ? 'active' : ''}`}
                onClick={() => setCurrentSlide(index)}
                aria-label={`Slide ${index + 1}`}
              >
                <span></span>
              </button>
            ))}
          </div>
        </div>
      </div>

      <img src="/assets/img/hero-shaps-1.png" alt="hero-shaps" className="img-2" />
      <img src="/assets/img/dabal-foot-1.png" alt="hero-shaps" className="img-3" />
      <img src="/assets/img/hero-shaps-1.png" alt="hero-shaps" className="img-4" />
    </section>
  );
}
