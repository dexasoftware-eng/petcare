import React, { useState } from 'react';
import PageBanner from '../components/Common/PageBanner';
import SectionHeading from '../components/Common/SectionHeading';
import InstaGallery from '../components/Home/InstaGallery';

const Contact = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    service: 'Grooming',
    message: ''
  });

  const [isSent, setIsSent] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    setIsSent(true);
  };

  return (
    <div className="contact-page">
      <PageBanner title="Contact" />

      <section className="gap">
        <div className="container">
          <div className="row g-4 mb-5">
            {/* Info Card 1 */}
            <div className="col-lg-4 col-md-6">
              <div className="contact-info-card p-4 rounded text-center border h-100" style={{ backgroundColor: '#fff8e5' }}>
                <div className="p-3 d-inline-block rounded-circle mb-3" style={{ backgroundColor: '#fedc4f' }}>
                  <i className="fa-solid fa-location-dot fa-2x text-dark"></i>
                </div>
                <h4>Our Location</h4>
                <p className="text-secondary mb-0">Eighth Avenue 487, New York, NY 10018</p>
              </div>
            </div>

            {/* Info Card 2 */}
            <div className="col-lg-4 col-md-6">
              <div className="contact-info-card p-4 rounded text-center border h-100" style={{ backgroundColor: '#fff8e5' }}>
                <div className="p-3 d-inline-block rounded-circle mb-3" style={{ backgroundColor: '#fb5e3c' }}>
                  <i className="fa-solid fa-phone fa-2x text-white"></i>
                </div>
                <h4>Call Anytime</h4>
                <p className="text-secondary mb-0">+021 01283492 / +021 01283493</p>
              </div>
            </div>

            {/* Info Card 3 */}
            <div className="col-lg-4 col-md-6">
              <div className="contact-info-card p-4 rounded text-center border h-100" style={{ backgroundColor: '#fff8e5' }}>
                <div className="p-3 d-inline-block rounded-circle mb-3" style={{ backgroundColor: '#940c69' }}>
                  <i className="fa-solid fa-envelope fa-2x text-white"></i>
                </div>
                <h4>Email Inquiries</h4>
                <p className="text-secondary mb-0">username@domain.com / support@patte.com</p>
              </div>
            </div>
          </div>

          <div className="row g-5 align-items-center">
            {/* Contact Form */}
            <div className="col-lg-7">
              <SectionHeading
                subTitle="Get in Touch"
                title="Send Us a Message"
                align="left"
              />

              {isSent ? (
                <div className="p-4 rounded border text-success my-4" style={{ backgroundColor: '#eafaf1', borderColor: '#2ecc71' }}>
                  <i className="fa-solid fa-circle-check me-2"></i>
                  <strong>Thank you!</strong> Your message has been sent successfully. A pet care coordinator will contact you within 2 hours.
                </div>
              ) : (
                <form onSubmit={handleSubmit} className="row g-3 mt-2">
                  <div className="col-md-6">
                    <label className="form-label fw-semibold">Your Name *</label>
                    <input
                      type="text"
                      required
                      value={formData.name}
                      onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                      className="form-control p-3"
                      placeholder="John Doe"
                    />
                  </div>
                  <div className="col-md-6">
                    <label className="form-label fw-semibold">Your Email *</label>
                    <input
                      type="email"
                      required
                      value={formData.email}
                      onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                      className="form-control p-3"
                      placeholder="john@domain.com"
                    />
                  </div>
                  <div className="col-md-6">
                    <label className="form-label fw-semibold">Phone Number</label>
                    <input
                      type="tel"
                      value={formData.phone}
                      onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                      className="form-control p-3"
                      placeholder="+021..."
                    />
                  </div>
                  <div className="col-md-6">
                    <label className="form-label fw-semibold">Requested Service</label>
                    <select
                      value={formData.service}
                      onChange={(e) => setFormData({ ...formData, service: e.target.value })}
                      className="form-select p-3"
                    >
                      <option value="Grooming">Pet Grooming</option>
                      <option value="Walking">Dog Walking</option>
                      <option value="Boarding">Dog & Cat Boarding</option>
                      <option value="Veterinary">Veterinary Consultation</option>
                      <option value="Training">Behavioral Training</option>
                    </select>
                  </div>
                  <div className="col-12">
                    <label className="form-label fw-semibold">Your Message *</label>
                    <textarea
                      rows="4"
                      required
                      value={formData.message}
                      onChange={(e) => setFormData({ ...formData, message: e.target.value })}
                      className="form-control p-3"
                      placeholder="Tell us about your pet, breed, age, and preferred appointment time..."
                    ></textarea>
                  </div>
                  <div className="col-12">
                    <button type="submit" className="button border-0 py-3 px-5">
                      Submit Appointment
                    </button>
                  </div>
                </form>
              )}
            </div>

            {/* Interactive Location Map Box */}
            <div className="col-lg-5">
              <div className="rounded overflow-hidden shadow-sm border" style={{ height: '420px', position: 'relative' }}>
                <iframe
                  title="Patte Headquarters Map"
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY!5e0!3m2!1sen!2sus!4v1689234857218!5m2!1sen!2sus"
                  width="100%"
                  height="100%"
                  style={{ border: 0 }}
                  allowFullScreen=""
                  loading="lazy"
                  referrerPolicy="no-referrer-when-downgrade"
                ></iframe>
              </div>
            </div>
          </div>
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default Contact;
