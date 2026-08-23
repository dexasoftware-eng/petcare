import React, { useState } from 'react';
import StarRating from '../Common/StarRating';
import { testimonials } from '../../data/testimonials';

const Testimonials = () => {
  const [currentIndex, setCurrentIndex] = useState(0);

  const prevSlide = () => {
    setCurrentIndex(prev => (prev === 0 ? testimonials.length - 1 : prev - 1));
  };

  const nextSlide = () => {
    setCurrentIndex(prev => (prev + 1) % testimonials.length);
  };

  const current = testimonials[currentIndex];

  return (
    <section
      className="section-client gap"
      style={{ backgroundImage: 'url(/assets/img/client-b.jpg)' }}
    >
      <div className="container">
        <div className="heading two text-center mb-5">
          <h2>What Our Client’s Say</h2>
        </div>

        <div className="client-slider position-relative d-flex justify-content-center align-items-center">
          <button
            className="btn btn-link text-white fs-4 me-3"
            onClick={prevSlide}
            aria-label="Previous Testimonial"
            style={{ textDecoration: 'none' }}
          >
            <i className="fa-solid fa-chevron-left"></i>
          </button>

          <div className="client d-flex flex-column flex-md-row align-items-center gap-4 max-w-2xl" style={{ maxWidth: '750px' }}>
            <img src={current.img} alt={current.name} className="rounded-circle" />
            <div className="client-text position-relative">
              <StarRating rating={current.rating} />
              <p className="lead">{current.text}</p>
              <h4>{current.name}</h4>
              <span>{current.role}</span>
              <i className="quote position-absolute">
                <img src="/assets/img/quote.png" alt="Quote mark" />
              </i>
            </div>
          </div>

          <button
            className="btn btn-link text-white fs-4 ms-3"
            onClick={nextSlide}
            aria-label="Next Testimonial"
            style={{ textDecoration: 'none' }}
          >
            <i className="fa-solid fa-chevron-right"></i>
          </button>
        </div>

        <div className="rated text-center mt-5">
          <div className="d-flex justify-content-center">
            <StarRating rating={5} />
          </div>
          <h4>Rated 4.5 Out of 5.0</h4>
        </div>
      </div>
    </section>
  );
};

export default Testimonials;
