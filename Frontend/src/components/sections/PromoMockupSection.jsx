import React from 'react';
import { Link } from '../../router/Router';

export default function PromoMockupSection({
  title = "Create your pet's digital health profile with FurShield today",
  description = 'Join proactive pet owners, certified veterinary clinics, and rescue shelters collaborating on one connected platform.',
  buttonText = 'Create Pet Profile',
  buttonLink = '/register/owner',
  image = '/assets/img/mockup.png',
}) {
  return (
    <div className="gap">
      <div className="container">
        <div className="mockup">
          <h3>
            Create your pet's digital profile with <span>FurShield</span> today
          </h3>
          <div className="mockup-img">
            <img src={image} alt="Pet Care Promo" />
          </div>
          <div className="mockup-text">
            <p>{description}</p>
            <Link to={buttonLink} className="button">
              {buttonText}
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
}
