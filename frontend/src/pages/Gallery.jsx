import React, { useState } from 'react';
import PageBanner from '../components/Common/PageBanner';
import InstaGallery from '../components/Home/InstaGallery';

const galleryItems = [
  { id: 1, img: "/assets/img/gallery-image-1.jpg", title: "Happy Labrador in Spa", category: "Grooming" },
  { id: 2, img: "/assets/img/gallery-image-2.jpg", title: "Playful Kittens in Condo", category: "Cats" },
  { id: 3, img: "/assets/img/gallery-image-3.jpg", title: "Group Park Walking Session", category: "Dogs" },
  { id: 4, img: "/assets/img/gallery-image-4.jpg", title: "Veterinary Wellness Exam", category: "Activities" },
  { id: 5, img: "/assets/img/gallery-image-5.jpg", title: "Hydrotherapy Pool Session", category: "Activities" },
  { id: 6, img: "/assets/img/gallery-image-6.jpg", title: "Luxury Suite Boarding", category: "Dogs" },
  { id: 7, img: "/assets/img/gallery-1.jpg", title: "Puppy Daycare Play", category: "Dogs" },
  { id: 8, img: "/assets/img/gallery-2.jpg", title: "Fluffy Persian Grooming", category: "Cats" },
  { id: 9, img: "/assets/img/gallery-3.jpg", title: "Canine Agility Practice", category: "Activities" }
];

const categories = ["All", "Dogs", "Cats", "Grooming", "Activities"];

const Gallery = () => {
  const [selectedCategory, setSelectedCategory] = useState("All");
  const [activeImg, setActiveImg] = useState(null);

  const filtered = selectedCategory === "All"
    ? galleryItems
    : galleryItems.filter(item => item.category === selectedCategory);

  return (
    <div className="gallery-page">
      <PageBanner title="Photo Gallery" parentPage="Pages" />

      <section className="gap">
        <div className="container">
          {/* Category Filter Pills */}
          <div className="d-flex justify-content-center flex-wrap gap-2 mb-5">
            {categories.map((cat) => (
              <button
                key={cat}
                onClick={() => setSelectedCategory(cat)}
                className="btn btn-sm"
                style={{
                  backgroundColor: selectedCategory === cat ? '#fa441d' : '#fff8e5',
                  color: selectedCategory === cat ? '#ffffff' : '#222222',
                  borderRadius: '20px',
                  padding: '8px 24px',
                  fontWeight: '600',
                  border: '1px solid #fedc4f'
                }}
              >
                {cat}
              </button>
            ))}
          </div>

          {/* Gallery Grid */}
          <div className="row g-4">
            {filtered.map((item) => (
              <div key={item.id} className="col-lg-4 col-md-6">
                <div
                  className="gallery-card rounded overflow-hidden position-relative shadow-sm cursor-pointer"
                  onClick={() => setActiveImg(item.img)}
                  style={{ height: '260px' }}
                >
                  <img
                    src={item.img}
                    alt={item.title}
                    className="w-100 h-100"
                    style={{ objectFit: 'cover', transition: 'transform 0.4s ease' }}
                  />
                  <div
                    className="position-absolute bottom-0 start-0 w-100 p-3 text-white d-flex justify-content-between align-items-center"
                    style={{ background: 'linear-gradient(to top, rgba(0,0,0,0.8), transparent)' }}
                  >
                    <div>
                      <h6 className="mb-0 fw-bold">{item.title}</h6>
                      <small style={{ color: '#fedc4f' }}>{item.category}</small>
                    </div>
                    <i className="fa-solid fa-magnifying-glass-plus fs-5"></i>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Lightbox */}
      {activeImg && (
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
          onClick={() => setActiveImg(null)}
        >
          <div style={{ maxWidth: '850px', maxHeight: '85vh', position: 'relative' }}>
            <img src={activeImg} alt="Enlarged gallery view" style={{ maxWidth: '100%', maxHeight: '85vh', borderRadius: '12px' }} />
            <button
              onClick={() => setActiveImg(null)}
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

      <InstaGallery />
    </div>
  );
};

export default Gallery;
