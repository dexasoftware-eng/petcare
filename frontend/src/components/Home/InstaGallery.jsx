import React, { useState } from 'react';

const galleryImages = [
  "/assets/img/gallery-1.jpg",
  "/assets/img/gallery-2.jpg",
  "/assets/img/gallery-3.jpg",
  "/assets/img/gallery-4.jpg",
  "/assets/img/gallery-5.jpg",
  "/assets/img/gallery-6.jpg",
  "/assets/img/gallery-7.jpg"
];

const InstaGallery = () => {
  const [selectedImg, setSelectedImg] = useState(null);

  return (
    <div className="gap">
      <div className="container">
        <div className="insta-img d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4">
          <h3 className="mb-3 mb-sm-0">
            <i className="fa-brands fa-instagram me-2 text-danger"></i>
            Follow @domain.com
          </h3>
          <a
            href="https://instagram.com"
            target="_blank"
            rel="noreferrer"
            className="button"
          >
            Follow Us
          </a>
        </div>

        <ul className="image-gallery list-unstyled d-flex flex-wrap gap-2 justify-content-between p-0 mb-0">
          {galleryImages.map((src, index) => (
            <li key={index} style={{ flex: '1 1 calc(14% - 10px)', minWidth: '130px' }}>
              <a
                href={src}
                onClick={(e) => {
                  e.preventDefault();
                  setSelectedImg(src);
                }}
                className="d-block overflow-hidden rounded position-relative"
              >
                <figure className="mb-0">
                  <img
                    alt={`Pet Gallery ${index + 1}`}
                    src={src}
                    className="w-100"
                    style={{ height: '140px', objectFit: 'cover', transition: 'transform 0.4s ease' }}
                  />
                </figure>
              </a>
            </li>
          ))}
        </ul>

        {/* Lightbox popup */}
        {selectedImg && (
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
              justifyContent: 'center',
              padding: '20px'
            }}
            onClick={() => setSelectedImg(null)}
          >
            <div style={{ maxWidth: '800px', maxHeight: '80vh', position: 'relative' }}>
              <img
                src={selectedImg}
                alt="Enlarged gallery view"
                style={{ maxWidth: '100%', maxHeight: '80vh', borderRadius: '10px' }}
              />
              <button
                onClick={() => setSelectedImg(null)}
                style={{
                  position: 'absolute',
                  top: '-40px',
                  right: '0',
                  background: 'none',
                  border: 'none',
                  color: '#fff',
                  fontSize: '28px',
                  cursor: 'pointer'
                }}
              >
                <i className="fa-solid fa-xmark"></i>
              </button>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default InstaGallery;
