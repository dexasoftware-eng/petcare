import React from 'react';
import HeroSlider from '../components/Home/HeroSlider';
import ServiceHighlights from '../components/Home/ServiceHighlights';
import WelcomeSection from '../components/Home/WelcomeSection';
import CategorySlider from '../components/Home/CategorySlider';
import HealthyProducts from '../components/Home/HealthyProducts';
import FunFactsCounter from '../components/Home/FunFactsCounter';
import WorkingTeam from '../components/Home/WorkingTeam';
import DogWalkerCTA from '../components/Home/DogWalkerCTA';
import Testimonials from '../components/Home/Testimonials';
import RecentArticles from '../components/Home/RecentArticles';
import InstaGallery from '../components/Home/InstaGallery';

const Home = () => {
  return (
    <div className="home-page">
      <HeroSlider />
      <ServiceHighlights />
      <WelcomeSection />
      <CategorySlider />
      <HealthyProducts />
      <FunFactsCounter />
      <WorkingTeam />
      <DogWalkerCTA />
      <Testimonials />
      <RecentArticles />
      <InstaGallery />
    </div>
  );
};

export default Home;
