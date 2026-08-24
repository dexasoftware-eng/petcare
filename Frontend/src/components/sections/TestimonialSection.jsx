import React, { useState } from 'react';
import { clientReviews } from '../../data/templateData';

export default function TestimonialSection() {
  const [currentIndex, setCurrentIndex] = useState(0);

  const prevReview = () => {
    setCurrentIndex((prev) => (prev === 0 ? clientReviews.length - 1 : prev - 1));
  };

  const nextReview = () => {
    setCurrentIndex((prev) => (prev + 1) % clientReviews.length);
  };

  const getVisibleReviews = () => {
    const first = clientReviews[currentIndex];
    const second = clientReviews[(currentIndex + 1) % clientReviews.length];
    return [first, second];
  };

  return (
    <section className="section-client gap" style={{ backgroundImage: 'url(/assets/img/client-b.jpg)' }}>
      <div className="container">
        <div className="heading two">
          <h2>Ecosystem Feedback & Community Impact</h2>
        </div>

        <div className="client-slider owl-carousel owl-theme owl-loaded owl-drag" style={{ display: 'block', position: 'relative' }}>
          <div className="owl-stage-outer">
            <div className="owl-stage row" style={{ margin: '0 -15px', display: 'flex', flexWrap: 'wrap' }}>
              {getVisibleReviews().map((review, idx) => (
                <div key={`${review.id}-${idx}`} className="col-lg-6 col-md-12 item mb-4">
                  <div className="client">
                    <img src={review.avatar} alt="client" />
                    <div className="client-text">
                      <ul className="star">
                        {Array.from({ length: review.rating }).map((_, i) => (
                          <li key={i}>
                            <i className="fa-solid fa-star"></i>
                          </li>
                        ))}
                      </ul>
                      <p>{review.text}</p>
                      <h4>{review.name}</h4>
                      <span>{review.role}</span>
                      <i className="quote">
                        <img src="/assets/img/quote.png" alt="quote" />
                      </i>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>

          <div className="owl-nav">
            <button type="button" role="presentation" className="owl-prev" onClick={prevReview} aria-label="Previous review">
              <i className="fa-solid fa-arrow-left"></i>
            </button>
            <button type="button" role="presentation" className="owl-next" onClick={nextReview} aria-label="Next review">
              <i className="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>

        <div className="rated">
          <ul className="star">
            <li><i className="fa-solid fa-star"></i></li>
            <li><i className="fa-solid fa-star"></i></li>
            <li><i className="fa-solid fa-star"></i></li>
            <li><i className="fa-solid fa-star"></i></li>
            <li><i className="fa-solid fa-star"></i></li>
          </ul>
          <h4>Unified Experience for Owners, Clinics & Rescues</h4>
        </div>
      </div>
    </section>
  );
}
