import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

const DogWalkerCTA = () => {
  const [address, setAddress] = useState('');
  const navigate = useNavigate();

  const handleSearch = (e) => {
    e.preventDefault();
    if (address.trim()) {
      navigate(`/contact?location=${encodeURIComponent(address.trim())}`);
    }
  };

  return (
    <section className="gap">
      <div className="container">
        <div className="dog-walker position-relative">
          <img src="/assets/img/dog-walker.png" alt="Dog Walker Companion" />
          <img src="/assets/img/line.png" className="line position-absolute" alt="Decorative Curve" />
          <img src="/assets/img/dabal-foot.png" className="dabal-foot position-absolute" alt="Paw Prints" />

          <div className="dog-walker-text">
            <h2>Find a dog walker or pet care</h2>
            <p>Place your trust in We Love Pets, an award-winning dog walking and pet care</p>
            <form onSubmit={handleSearch} className="d-flex flex-column flex-sm-row gap-2">
              <input
                placeholder="Enter address or postcode..."
                name="address"
                type="text"
                value={address}
                onChange={(e) => setAddress(e.target.value)}
                required
              />
              <button type="submit" className="button border-0">
                Find Branch
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  );
};

export default DogWalkerCTA;
