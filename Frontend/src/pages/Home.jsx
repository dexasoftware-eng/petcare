import React from 'react';
import HeroSlider from '../components/sections/HeroSlider';
import WeProvideSection from '../components/sections/WeProvideSection';
import WelcomeSection from '../components/sections/WelcomeSection';
import CategorySlider from '../components/sections/CategorySlider';
import HealthyProductsSection from '../components/sections/HealthyProductsSection';
import FunFactsSection from '../components/sections/FunFactsSection';
import TeamSection from '../components/sections/TeamSection';
import FindDogWalkerSection from '../components/sections/FindDogWalkerSection';
import TestimonialSection from '../components/sections/TestimonialSection';
import BlogSection from '../components/sections/BlogSection';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function Home({ onAddToCart, onOpenLightbox }) {
  return (
    <>
      <HeroSlider />
      <WeProvideSection />
      <WelcomeSection />
      <CategorySlider />
      <HealthyProductsSection onAddToCart={onAddToCart} />
      <FunFactsSection />
      <TeamSection />
      <FindDogWalkerSection />
      <TestimonialSection />
      <BlogSection />
      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
