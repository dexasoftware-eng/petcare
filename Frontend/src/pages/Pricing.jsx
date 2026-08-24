import React from 'react';
import { Link } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import SectionHeading from '../components/Common/SectionHeading';
import Testimonials from '../components/Home/Testimonials';
import InstaGallery from '../components/Home/InstaGallery';

const plans = [
  {
    id: 1,
    name: "Day Care Standard",
    price: 29.00,
    period: "Per Day",
    img: "/assets/img/package-1.png",
    popular: false,
    features: [
      "Full Day Supervised Group Play",
      "Organic Meals & Snack Dispensers",
      "Daily Health & Vitality Check",
      "Evening Brush & Nap Time",
      "SMS Photo Updates for Parents"
    ]
  },
  {
    id: 2,
    name: "Health & Grooming Spa",
    price: 59.00,
    period: "Per Visit",
    img: "/assets/img/package-2.png",
    popular: true,
    features: [
      "Aromatherapy Hydrobath & Blow Dry",
      "Sanitary & Coat Styling Cut",
      "Ear Cleaning & Teeth Brushing",
      "Blueberry Facial Scrub & Paw Balm",
      "Complete Parasite Inspection",
      "Free 30-min Fitness Play Session"
    ]
  },
  {
    id: 3,
    name: "Luxury Resort Boarding",
    price: 99.00,
    period: "Per Night",
    img: "/assets/img/package-3.png",
    popular: false,
    features: [
      "Private Climate Controlled Luxury Suite",
      "24/7 Live Webcam Streaming Access",
      "Individualized Gourmet Meal Prep",
      "3 Private Outdoor Exercise Sessions",
      "Bedtime Story & Tuck-In Treats",
      "Veterinary Nurse on Duty 24/7"
    ]
  }
];

const Pricing = () => {
  return (
    <div className="pricing-page">
      <PageBanner title="Pricing Packages" />

      <section className="gap">
        <div className="container">
          <SectionHeading
            subTitle="Affordable Pet Care"
            title="Care & Boarding Packages"
          />

          <div className="row g-4 mt-2">
            {plans.map((plan) => (
              <div key={plan.id} className="col-lg-4 col-md-6">
                <div
                  className="package-card p-4 rounded text-center position-relative h-100 d-flex flex-column justify-content-between"
                  style={{
                    backgroundColor: plan.popular ? '#fff8e5' : '#ffffff',
                    border: plan.popular ? '2px solid #fa441d' : '1px solid #ebebeb',
                    boxShadow: plan.popular ? '0 10px 30px rgba(250,68,29,0.15)' : 'none'
                  }}
                >
                  {plan.popular && (
                    <span
                      className="position-absolute top-0 start-50 translate-middle px-3 py-1 text-white fw-bold rounded-pill"
                      style={{ backgroundColor: '#fa441d', fontSize: '13px' }}
                    >
                      Most Popular
                    </span>
                  )}

                  <div>
                    <img src={plan.img} alt={plan.name} className="mb-3" style={{ height: '70px', objectFit: 'contain' }} />
                    <h3 className="fs-4">{plan.name}</h3>

                    <div className="my-3">
                      <span className="fs-1 fw-bold" style={{ color: '#fa441d' }}>${plan.price.toFixed(2)}</span>
                      <span className="text-muted small"> / {plan.period}</span>
                    </div>

                    <ul className="list-unstyled text-start my-4 ps-2">
                      {plan.features.map((feat, i) => (
                        <li key={i} className="mb-2 d-flex align-items-center">
                          <i className="fa-solid fa-check text-success me-2"></i>
                          <span>{feat}</span>
                        </li>
                      ))}
                    </ul>
                  </div>

                  <Link to="/contact" className={`button w-100 ${!plan.popular ? 'bg-dark text-white' : ''}`}>
                    Book This Package
                  </Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <Testimonials />
      <InstaGallery />
    </div>
  );
};

export default Pricing;
