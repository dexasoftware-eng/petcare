import React, { useState } from 'react';
import AboutBanner from '../components/sections/AboutBanner';
import CompanyStorySection from '../components/sections/CompanyStorySection';
import WeProvideSection from '../components/sections/WeProvideSection';
import CareServicesVideoSection from '../components/sections/CareServicesVideoSection';
import TeamSection from '../components/sections/TeamSection';
import FunFactsSection from '../components/sections/FunFactsSection';
import TestimonialSection from '../components/sections/TestimonialSection';
import AboutGallerySection from '../components/sections/AboutGallerySection';
import ClientLogosSection from '../components/sections/ClientLogosSection';
import PromoMockupSection from '../components/sections/PromoMockupSection';
import LightboxModal from '../components/common/LightboxModal';

export default function About() {
  const [selectedImageIndex, setSelectedImageIndex] = useState(null);
  const [isVideoOpen, setIsVideoOpen] = useState(false);

  const galleryList = [
    '/assets/img/gallery-img-1.jpg',
    '/assets/img/gallery-img-3.jpg',
    '/assets/img/gallery-img-4.jpg',
    '/assets/img/gallery-img-5.jpg',
    '/assets/img/gallery-img-6.jpg',
    '/assets/img/gallery-img-7.jpg',
    '/assets/img/gallery-img-2.jpg',
  ];

  const handleOpenLightbox = (index) => {
    setSelectedImageIndex(index);
  };

  const handleCloseLightbox = () => {
    setSelectedImageIndex(null);
  };

  const handleNextImage = () => {
    setSelectedImageIndex((prev) => (prev + 1) % galleryList.length);
  };

  const handlePrevImage = () => {
    setSelectedImageIndex((prev) => (prev === 0 ? galleryList.length - 1 : prev - 1));
  };

  return (
    <>
      {/* 1. Banner Section */}
      <AboutBanner title="About Us" parent="Home" parentLink="/" />

      {/* 2. Company Story & Welcome Section */}
      <CompanyStorySection />

      {/* 3. What We Provide 3-Card Grid (Built-in Reusable Component) */}
      <WeProvideSection />

      {/* 4. Care Services Grid & Video Highlight */}
      <CareServicesVideoSection onPlayVideo={() => setIsVideoOpen(true)} />

      {/* 5. Meet Our Experts / Best Working Team (Built-in Reusable Component) */}
      <section className="gap no-bottom">
        <TeamSection />
      </section>

      {/* 6. Animated Fun Facts Counter (Built-in Reusable Component) */}
      <FunFactsSection />

      {/* 7. Client Testimonials Slider (Built-in Reusable Component) */}
      <TestimonialSection />

      {/* 8. Pet Care Memories Photo Gallery */}
      <AboutGallerySection onOpenLightbox={handleOpenLightbox} />

      {/* 9. Brand Partners Logo Row */}
      <ClientLogosSection />

      {/* 10. Discount / CTA Promo Banner */}
      <PromoMockupSection
        title="Create your pet's digital health profile with PetGuard today"
        description="Join proactive pet owners, certified veterinary clinics, and rescue shelters collaborating on one connected platform."
        buttonText="Create Pet Profile"
        buttonLink="/register/owner"
      />

      {/* Reusable Lightbox Modal for Gallery Images */}
      <LightboxModal
        isOpen={selectedImageIndex !== null}
        imageSrc={selectedImageIndex !== null ? galleryList[selectedImageIndex] : ''}
        onClose={handleCloseLightbox}
        onNext={handleNextImage}
        onPrev={handlePrevImage}
      />

      {/* Video Popup Modal */}
      {isVideoOpen && (
        <div
          style={{
            position: 'fixed',
            inset: 0,
            backgroundColor: 'rgba(0, 0, 0, 0.88)',
            zIndex: 999999,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            padding: '20px',
          }}
          onClick={() => setIsVideoOpen(false)}
        >
          <div
            style={{
              position: 'relative',
              width: '100%',
              maxWidth: '850px',
              aspectRatio: '16/9',
              borderRadius: '16px',
              overflow: 'hidden',
              boxShadow: '0 25px 60px rgba(0,0,0,0.5)',
            }}
            onClick={(e) => e.stopPropagation()}
          >
            <button
              type="button"
              onClick={() => setIsVideoOpen(false)}
              style={{
                position: 'absolute',
                top: '12px',
                right: '12px',
                background: 'rgba(0,0,0,0.7)',
                color: '#fff',
                border: 'none',
                width: '36px',
                height: '36px',
                borderRadius: '50%',
                cursor: 'pointer',
                zIndex: 10,
              }}
              aria-label="Close Video"
            >
              <i className="fa-solid fa-xmark"></i>
            </button>
            <iframe
              width="100%"
              height="100%"
              src="https://www.youtube-nocookie.com/embed/xKxrkht7CpY?autoplay=1"
              title="PetGuard Pet Care Video"
              frameBorder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowFullScreen
            ></iframe>
          </div>
        </div>
      )}
    </>
  );
}
