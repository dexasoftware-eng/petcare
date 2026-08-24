import React, { useState } from 'react';
import AboutBanner from '../components/sections/AboutBanner';
import ContactInfoCardsSection from '../components/sections/ContactInfoCardsSection';
import ContactFormSection from '../components/sections/ContactFormSection';
import AwardsSection from '../components/sections/AwardsSection';
import InstagramGallery from '../components/sections/InstagramGallery';
import LightboxModal from '../components/common/LightboxModal';
import { galleryImages } from '../data/templateData';

export default function Contact() {
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
      <AboutBanner title="Contact Us" parent="Home" parentLink="/" />

      {/* 2. Contact Info 3-Card Grid (Email, Phone Support, Working Hours) */}
      <ContactInfoCardsSection />

      {/* 3. Office Locations & Interactive Pet Booking Form */}
      <ContactFormSection />

      {/* 4. Awards Winning Company Logo Row */}
      <AwardsSection />

      {/* 5. Instagram Photo Gallery (Pre-built Reusable Component) */}
      <InstagramGallery onOpenLightbox={handleOpenLightbox} />

      {/* Reusable Lightbox Modal for Gallery Images (Pre-built Reusable Component) */}
      <LightboxModal
        isOpen={selectedImageIndex !== null}
        imageSrc={selectedImageIndex !== null ? galleryList[selectedImageIndex] : ''}
        onClose={handleCloseLightbox}
        onNext={handleNextImage}
        onPrev={handlePrevImage}
      />
    </>
  );
}
