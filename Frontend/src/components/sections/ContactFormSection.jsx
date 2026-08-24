import React, { useState } from 'react';

export default function ContactFormSection() {
  const [branchSearch, setBranchSearch] = useState('');
  const [petType, setPetType] = useState('dog');
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    postalCode: '',
    service: 'Pet Grooming',
    petBreed: '',
    notes: '',
  });
  const [submitted, setSubmitted] = useState(false);

  const handleBranchSearch = (e) => {
    e.preventDefault();
    if (branchSearch.trim()) {
      alert(`Searching for available PetGuard branches near: ${branchSearch}`);
    }
  };

  const handleBookingSubmit = (e) => {
    e.preventDefault();
    setSubmitted(true);
  };

  return (
    <section className="gap">
      <div className="container">
        <div className="row g-4">
          {/* Left Column: Branch Finder & Head Offices */}
          <div className="col-lg-6">
            <div className="find-a-dog contact">
              <h2>Find a Clinic or Support Center</h2>
              <p>Locate partner veterinary clinics, care specialists, and rescue shelter centers in your network.</p>
              <form onSubmit={handleBranchSearch}>
                <input
                  type="text"
                  name="branchSearch"
                  placeholder="Enter city, state, or postcode..."
                  value={branchSearch}
                  onChange={(e) => setBranchSearch(e.target.value)}
                  required
                />
                <button type="submit" className="button">
                  Find Center
                </button>
              </form>

              {/* Head Office 1 */}
              <div className="head-office mt-4">
                <div className="d-flex align-items-center">
                  <i className="fa-solid fa-location-dot"></i>
                  <h6>Global Operations Office:</h6>
                </div>
                <p>#201 1218 9th Avenue SE, Calgary, AB T2G 0T1</p>
              </div>

              {/* Head Office 2 */}
              <div className="head-office mb-lg-0">
                <div className="d-flex align-items-center">
                  <i className="fa-solid fa-location-dot"></i>
                  <h6>Customer Support &amp; Regional Hub:</h6>
                </div>
                <p>Eighth Avenue 487, Manhattan, New York, NY 10018</p>
              </div>
            </div>
          </div>

          {/* Right Column: Book Your Place or Find Out More */}
          <div className="col-lg-6">
            <div className="looking position-relative contact">
              <form className="looking-form" onSubmit={handleBookingSubmit}>
                <h3>Schedule Care or Contact PetGuard</h3>

                {/* Pet Selector Radio Pills */}
                <ul style={{ display: 'flex', gap: '20px', listStyle: 'none', padding: 0, margin: '20px 0' }}>
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

                {submitted ? (
                  <div
                    style={{
                      backgroundColor: '#fff',
                      padding: '30px',
                      borderRadius: '12px',
                      textAlign: 'center',
                      boxShadow: '0 8px 25px rgba(0,0,0,0.06)',
                    }}
                  >
                    <i className="fa-solid fa-circle-check" style={{ fontSize: '46px', color: '#fa441d' }}></i>
                    <h4 style={{ fontWeight: 'bold', marginTop: '16px', color: '#222' }}>Inquiry Received!</h4>
                    <p style={{ color: '#666', fontSize: '15px' }}>
                      Thank you, <strong>{formData.name || 'Pet Owner'}</strong>. Our {petType} care specialist will contact you shortly at <strong>{formData.email}</strong>.
                    </p>
                    <button
                      type="button"
                      className="button mt-2"
                      onClick={() => {
                        setSubmitted(false);
                        setFormData({
                          name: '',
                          email: '',
                          phone: '',
                          postalCode: '',
                          service: 'Digital Pet Profiles',
                          petBreed: '',
                          notes: '',
                        });
                      }}
                    >
                      Submit Another Request
                    </button>
                  </div>
                ) : (
                  <div className="row g-3">
                    <div className="col-lg-6">
                      <input
                        type="text"
                        name="name"
                        placeholder="Complete Name"
                        required
                        value={formData.name}
                        onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                      />
                    </div>
                    <div className="col-lg-6">
                      <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        required
                        value={formData.email}
                        onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                      />
                    </div>
                    <div className="col-lg-6">
                      <input
                        type="tel"
                        name="phone"
                        placeholder="Phone Number"
                        required
                        value={formData.phone}
                        onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                      />
                    </div>
                    <div className="col-lg-6">
                      <input
                        type="text"
                        name="postalCode"
                        placeholder="Postal Code / Area"
                        value={formData.postalCode}
                        onChange={(e) => setFormData({ ...formData, postalCode: e.target.value })}
                      />
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
                        value={formData.service}
                        onChange={(e) => setFormData({ ...formData, service: e.target.value })}
                      >
                        <option value="Digital Pet Profiles">Digital Pet Profiles & Health Records</option>
                        <option value="Veterinary Consultation">Veterinary Consultation & Checkup</option>
                        <option value="Vaccination Tracking">Vaccination & Immunization Updates</option>
                        <option value="Shelter Adoption">Shelter Adoption & Foster Inquiry</option>
                        <option value="Preventive Care">Preventive Diagnostics & Nutrition</option>
                        <option value="General Support">General Platform Support</option>
                      </select>
                    </div>
                    <div className="col-lg-12">
                      <input
                        type="text"
                        name="petBreed"
                        placeholder="Pet Breed & Age (Optional)"
                        value={formData.petBreed}
                        onChange={(e) => setFormData({ ...formData, petBreed: e.target.value })}
                      />
                    </div>
                    <div className="col-lg-12">
                      <textarea
                        placeholder="Please let us know your inquiry details or preferred appointment time..."
                        value={formData.notes}
                        onChange={(e) => setFormData({ ...formData, notes: e.target.value })}
                      ></textarea>
                    </div>
                    <div className="col-lg-12">
                      <button type="submit" className="button">
                        Submit Now
                      </button>
                    </div>
                  </div>
                )}
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
