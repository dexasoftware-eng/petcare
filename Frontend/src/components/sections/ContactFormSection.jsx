import React, { useState } from 'react';

export default function ContactFormSection() {
  const [petType, setPetType] = useState('dog');
  const [branchSearch, setBranchSearch] = useState('');

  const handleBranchSubmit = (e) => {
    e.preventDefault();
  };

  const handleFormSubmit = (e) => {
    e.preventDefault();
    alert('Thank you! Your message has been submitted.');
  };

  return (
    <section>
      <div className="container">
        <div className="row">
          <div className="col-lg-6">
            <div className="find-a-dog contact">
              <h2>Find a dog walker or pet care</h2>
              <p>Place your trust in PetGuard, an award-winning dog walking and pet care</p>
              <form onSubmit={handleBranchSubmit}>
                <input
                  type="text"
                  name="Enter"
                  placeholder="Enter address or postcode..."
                  value={branchSearch}
                  onChange={(e) => setBranchSearch(e.target.value)}
                />
                <button type="submit" className="button">
                  Find Branch
                </button>
              </form>
              <div className="head-office">
                <div className="d-flex align-items-center">
                  <i className="fa-solid fa-location-dot"></i>
                  <h6>Head Office United State:</h6>
                </div>
                <p>#201 1218 9th Avenue SE, Calgary, AB T2G 0T1</p>
              </div>
              <div className="head-office mb-lg-0">
                <div className="d-flex align-items-center">
                  <i className="fa-solid fa-location-dot"></i>
                  <h6>Head Office United State:</h6>
                </div>
                <p>#201 1218 9th Avenue SE, Calgary, AB T2G 0T1</p>
              </div>
            </div>
          </div>

          <div className="col-lg-6">
            <div className="looking position-relative contact">
              <form className="looking-form" onSubmit={handleFormSubmit}>
                <h3>Book Your Place or Find out More</h3>
                <ul>
                  <li>
                    <input
                      type="radio"
                      id="f-option"
                      name="selector"
                      checked={petType === 'dog'}
                      onChange={() => setPetType('dog')}
                    />
                    <label htmlFor="f-option">dog</label>
                    <div className="check"></div>
                  </li>
                  <li>
                    <input
                      type="radio"
                      id="s-option"
                      name="selector"
                      checked={petType === 'cat'}
                      onChange={() => setPetType('cat')}
                    />
                    <label htmlFor="s-option">cat</label>
                    <div className="check">
                      <div className="inside"></div>
                    </div>
                  </li>
                </ul>

                <div className="row">
                  <div className="col-lg-6">
                    <input type="text" name="Complete Name" placeholder="Complete Name" required />
                  </div>
                  <div className="col-lg-6">
                    <input type="email" name="Email Address" placeholder="Email Address" required />
                  </div>
                  <div className="col-lg-6">
                    <input type="text" name="Phone Number" placeholder="Phone Number" />
                  </div>
                  <div className="col-lg-6">
                    <input type="text" name="Postal Code" placeholder="Postal Code" />
                  </div>
                  <div className="col-lg-12">
                    <select
                      className="nice-select Advice w-100"
                      style={{
                        display: 'block',
                        height: '60px',
                        border: '3px solid #feda46',
                        borderRadius: '46px',
                        padding: '0 20px',
                        backgroundColor: '#ffffff',
                        fontWeight: '600',
                        color: '#222',
                        marginBottom: '15px',
                      }}
                      defaultValue="Select Service"
                    >
                      <option value="Select Service">Select Service</option>
                      <option value="Services 1">Pet Sitting &amp; Dog Walking</option>
                      <option value="Services 2">Veterinary Health Consultation</option>
                      <option value="Services 3">Vaccination &amp; Immunization</option>
                      <option value="Services 4">Shelter Rescue &amp; Adoption</option>
                    </select>
                  </div>
                  <div className="col-lg-6">
                    <input type="text" name="Pet Breed" placeholder="Pet Breed &amp; Name" />
                  </div>
                  <div className="col-lg-6">
                    <input type="text" name="Pet Age" placeholder="Pet Age / Weight" />
                  </div>
                  <div className="col-lg-12">
                    <textarea placeholder="Please let us know which day package you're interested"></textarea>
                  </div>
                </div>
                <button type="submit" className="button">
                  Submit Now
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
