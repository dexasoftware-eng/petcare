import React, { useState } from 'react';
import AboutBanner from '../components/sections/AboutBanner';
import ServicesGridSection from '../components/sections/ServicesGridSection';
import ServicesFaqSection from '../components/sections/ServicesFaqSection';
import FindDogWalkerSection from '../components/sections/FindDogWalkerSection';
import TestimonialSection from '../components/sections/TestimonialSection';
import InstagramGallery from '../components/sections/InstagramGallery';
import LightboxModal from '../components/common/LightboxModal';
import { galleryImages } from '../data/templateData';

export default function Services() {
  const [isVideoOpen, setIsVideoOpen] = useState(false);
  const [selectedImageIndex, setSelectedImageIndex] = useState(null);

  const galleryList = galleryImages.map((img) => img.src);

  const handleOpenLightbox = (srcOrIndex) => {
    if (typeof srcOrIndex === 'number') {
      setSelectedImageIndex(srcOrIndex);
    } else if (typeof srcOrIndex === 'string') {
      const idx = galleryList.indexOf(srcOrIndex);
      setSelectedImageIndex(idx !== -1 ? idx : 0);
    }
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
      {/* 1. Breadcrumb Banner (Pre-built Reusable Component) */}
      <AboutBanner title="Services" parent="Home" parentLink="/" />

      {/* 2. Services 6-Card Grid with Center Interactive Video Banner */}
      <ServicesGridSection onPlayVideo={() => setIsVideoOpen(true)} />

      {/* 3. Pet Benefits & Membership FAQs Accordion */}
      <ServicesFaqSection />

      {/* 4. Find a Dog Walker Search CTA (Pre-built Reusable Component) */}
      <FindDogWalkerSection />

      {/* 5. Client Testimonials Slider (Pre-built Reusable Component) */}
      <TestimonialSection />

      {/* 6. Instagram Photo Gallery (Pre-built Reusable Component) */}
      <InstagramGallery onOpenLightbox={handleOpenLightbox} />

      {/* Reusable Lightbox Modal for Gallery Images (Pre-built Reusable Component) */}
      <LightboxModal
        isOpen={selectedImageIndex !== null}
        imageSrc={selectedImageIndex !== null ? galleryList[selectedImageIndex] : ''}
        onClose={handleCloseLightbox}
        onNext={handleNextImage}
        onPrev={handlePrevImage}
      />

      {/* Interactive Video Popup Modal */}
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
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
              }}
              aria-label="Close Video"
            >
              <i className="fa-solid fa-xmark"></i>
            </button>
            <iframe
              width="100%"
              height="100%"
              src="https://www.youtube-nocookie.com/embed/xKxrkht7CpY?autoplay=1"
              title="FurShield Pet Care Presentation"
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
