import React, { useState } from 'react';
import { Link } from '../../router/Router';
import { categoriesData } from '../../data/templateData';

export default function CategorySlider() {
  const [startIndex, setStartIndex] = useState(0);
  const itemsVisible = 4;

  const prevSlide = () => {
    setStartIndex((prev) => (prev === 0 ? categoriesData.length - 1 : prev - 1));
  };

  const nextSlide = () => {
    setStartIndex((prev) => (prev + 1) % categoriesData.length);
  };

  const getVisibleItems = () => {
    const items = [];
    for (let i = 0; i < itemsVisible; i++) {
      items.push(categoriesData[(startIndex + i) % categoriesData.length]);
    }
    return items;
  };

  return (
    <section className="gap">
      <div className="container">
        <div className="heading">
          <img src="/assets/img/heading-img.png" alt="heading-img" />
          <h6>Find Healthy Product By Category</h6>
          <h2>Browse By Categories</h2>
        </div>

        <div className="row slider-categorie owl-carousel owl-theme owl-loaded owl-drag" style={{ display: 'block', position: 'relative' }}>
          <div className="owl-stage-outer">
            <div className="owl-stage row" style={{ margin: '0 -15px', display: 'flex', flexWrap: 'wrap' }}>
              {getVisibleItems().map((cat, idx) => (
                <div key={`${cat.id}-${idx}`} className="col-lg-3 col-md-6 col-sm-6 item" style={{ transition: 'all 0.4s ease' }}>
                  <div className="food-categorie">
                    <img src={cat.image} alt={cat.title} />
                    <Link to={cat.link}>{cat.title}</Link>
                  </div>
                </div>
              ))}
            </div>
          </div>

          <div className="owl-nav">
            <button type="button" role="presentation" className="owl-prev" onClick={prevSlide} aria-label="Previous category">
              <i className="fa-solid fa-arrow-left"></i>
            </button>
            <button type="button" role="presentation" className="owl-next" onClick={nextSlide} aria-label="Next category">
              <i className="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>
      </div>
    </section>
  );
}
