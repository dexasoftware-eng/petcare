import React, { useState } from 'react';
import { useNavigate } from '../../router/Router';

export default function FindDogWalkerSection() {
  const [address, setAddress] = useState('');
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();
    if (address.trim()) {
      navigate('/contact');
    }
  };

  return (
    <section className="gap">
      <div className="container">
        <div className="dog-walker">
          <img src="/assets/img/dog-walker.png" alt="dog walker" />
          <img src="/assets/img/line.png" className="line" alt="line" />
          <img src="/assets/img/dabal-foot.png" className="dabal-foot" alt="dabal-foot" />
          <div className="dog-walker-text">
            <h2>Find Trusted Veterinary & Pet Care</h2>
            <p>Connect with licensed veterinarians, certified clinics, and shelter adoption centers in your area.</p>
            <form onSubmit={handleSubmit}>
              <input
                placeholder="Enter city, address, or postal code..."
                name="Enter address"
                type="text"
                value={address}
                onChange={(e) => setAddress(e.target.value)}
                required
              />
              <button type="submit" className="button">
                Find Care
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  );
}
