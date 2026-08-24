import React from 'react';

export default function AboutGallerySection({ onOpenLightbox }) {
  const images = [
    { id: 1, src: '/assets/img/gallery-img-1.jpg', alt: 'Pet Gallery 1', col: 1 },
    { id: 2, src: '/assets/img/gallery-img-3.jpg', alt: 'Pet Gallery 2', col: 1 },
    { id: 3, src: '/assets/img/gallery-img-4.jpg', alt: 'Pet Gallery 3', col: 2 },
    { id: 4, src: '/assets/img/gallery-img-5.jpg', alt: 'Pet Gallery 4', col: 2 },
    { id: 5, src: '/assets/img/gallery-img-6.jpg', alt: 'Pet Gallery 5', col: 2 },
    { id: 6, src: '/assets/img/gallery-img-7.jpg', alt: 'Pet Gallery 6', col: 3 },
    { id: 7, src: '/assets/img/gallery-img-2.jpg', alt: 'Pet Gallery 7', col: 3 },
  ];

  return (
    <div className="gap">
      <div className="container">
        <div className="heading">
          <img src="/assets/img/heading-img.png" alt="heading ornament" />
          <h6>Gallery Photos</h6>
          <h2>Pet Care Memories</h2>
        </div>
        <div className="row">
          {/* Column 1 */}
          <div className="col-lg-4 col-md-6">
            <div className="about-gallery-img">
              <a
                href="javascript:void(0)"
                onClick={(e) => {
                  e.preventDefault();
                  onOpenLightbox(0);
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
                  onOpenLightbox(1);
                }}
              >
                <i className="fa-solid fa-plus"></i>
              </a>
              <figure>
                <img alt="Pet gallery 3" src="/assets/img/gallery-img-3.jpg" />
              </figure>
            </div>
          </div>

          {/* Column 2 */}
          <div className="col-lg-4 col-md-6">
            <div className="about-gallery-img">
              <a
                href="javascript:void(0)"
                onClick={(e) => {
                  e.preventDefault();
                  onOpenLightbox(2);
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
                  onOpenLightbox(3);
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
                  onOpenLightbox(4);
                }}
              >
                <i className="fa-solid fa-plus"></i>
              </a>
              <figure>
                <img alt="Pet gallery 6" src="/assets/img/gallery-img-6.jpg" />
              </figure>
            </div>
          </div>

          {/* Column 3 */}
          <div className="col-lg-4 col-md-6">
            <div className="about-gallery-img">
              <a
                href="javascript:void(0)"
                onClick={(e) => {
                  e.preventDefault();
                  onOpenLightbox(5);
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
                  onOpenLightbox(6);
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
  );
}
