import React from 'react';
import { Link } from '../../router/Router';

export default function PromoMockupSection({
  title = 'Register your pet with us and Get 5% off their next order',
  description = 'Join the FurShield family today for health tracking, certified clinics, and shelter adoptions.',
  buttonText = 'Register Now',
  buttonLink = '/register/owner',
  image = '/assets/img/mockup.png',
}) {
  return (
    <div className="gap">
      <div className="container">
        <div className="mockup">
          <h3>
            Register your pet with us and <span>Get 5% off</span> their next order
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
