import React from 'react';
import { galleryImages } from '../../data/templateData';

export default function InstagramGallery({ onOpenLightbox }) {
  return (
    <div className="gap">
      <div className="container">
        <div className="insta-img">
          <h3>
            <i className="fa-brands fa-instagram"></i>
            Follow @domain.com
          </h3>
          <a href="https://instagram.com" target="_blank" rel="noreferrer" className="button">
            Follow Us
          </a>
        </div>
        <ul className="image-gallery">
          {galleryImages.map((img) => (
            <li key={img.id}>
              <a
                href={img.src}
                onClick={(e) => {
                  e.preventDefault();
                  if (onOpenLightbox) {
                    onOpenLightbox(img.src);
                  }
                }}
                data-fancybox="gallery"
                style={{ cursor: 'pointer' }}
              >
                <figure>
                  <img alt={img.alt} src={img.src} />
                </figure>
              </a>
            </li>
          ))}
        </ul>
      </div>
    </div>
  );
}
