import React, { useState } from 'react';
import { Link } from '../router/Router';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function Contact({ onOpenLightbox }) {
  const [formData, setFormData] = useState({ name: '', email: '', phone: '', message: '' });
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    setSubmitted(true);
  };

  return (
    <>
      <section
        className="banner"
        style={{
          backgroundColor: '#fff8e5',
          backgroundImage: 'url(/assets/img/background.png)',
          padding: '80px 0',
          textAlign: 'center',
        }}
      >
        <div className="container">
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>Contact Us</h2>
          <ul
            className="breadcrumb"
            style={{
              display: 'flex',
              justifyContent: 'center',
              listStyle: 'none',
              padding: 0,
              margin: 0,
              gap: '10px',
              fontSize: '16px',
            }}
          >
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d' }}>Contact</li>
          </ul>
        </div>
      </section>

      <section className="gap">
        <div className="container">
          <div className="row">
            <div className="col-lg-5">
              <div className="contact-info p-4" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                <h3 style={{ fontWeight: 'bold', marginBottom: '20px' }}>Get In Touch</h3>
                <p style={{ lineHeight: '1.8', marginBottom: '30px' }}>
                  Have questions about our pet boarding, grooming, or veterinary services? We'd love to hear from you.
                </p>

                <div className="d-flex align-items-start mb-4">
                  <div
                    style={{
                      width: '45px',
                      height: '45px',
                      borderRadius: '50%',
                      backgroundColor: '#fa441d',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      color: '#fff',
                      flexShrink: 0,
                      marginRight: '15px',
                    }}
                  >
                    <i className="fa-solid fa-location-dot"></i>
                  </div>
                  <div>
                    <h5 style={{ fontWeight: 'bold', margin: '0 0 5px 0' }}>Location</h5>
                    <p style={{ margin: 0 }}>Eighth Avenue 487, New York, NY</p>
                  </div>
                </div>

                <div className="d-flex align-items-start mb-4">
                  <div
                    style={{
                      width: '45px',
                      height: '45px',
                      borderRadius: '50%',
                      backgroundColor: '#fa441d',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      color: '#fff',
                      flexShrink: 0,
                      marginRight: '15px',
                    }}
                  >
                    <i className="fa-solid fa-phone"></i>
                  </div>
                  <div>
                    <h5 style={{ fontWeight: 'bold', margin: '0 0 5px 0' }}>Phone Number</h5>
                    <p style={{ margin: 0 }}><a href="tel:+02101283492">+021 01283492</a></p>
                  </div>
                </div>

                <div className="d-flex align-items-start">
                  <div
                    style={{
                      width: '45px',
                      height: '45px',
                      borderRadius: '50%',
                      backgroundColor: '#fa441d',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      color: '#fff',
                      flexShrink: 0,
                      marginRight: '15px',
                    }}
                  >
                    <i className="fa-solid fa-envelope"></i>
                  </div>
                  <div>
                    <h5 style={{ fontWeight: 'bold', margin: '0 0 5px 0' }}>Email Address</h5>
                    <p style={{ margin: 0 }}><a href="mailto:username@domain.com">username@domain.com</a></p>
                  </div>
                </div>
              </div>
            </div>

            <div className="col-lg-7 mt-4 mt-lg-0">
              <div className="contact-form p-4" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                <h3 style={{ fontWeight: 'bold', marginBottom: '20px' }}>Send Us a Message</h3>
                {submitted ? (
                  <div className="p-4 text-center">
                    <i className="fa-solid fa-circle-check" style={{ fontSize: '48px', color: '#fa441d' }}></i>
                    <h4 className="mt-3">Message Sent Successfully!</h4>
                    <p>Thank you for reaching out. We will get back to you shortly.</p>
                  </div>
                ) : (
                  <form onSubmit={handleSubmit}>
                    <div className="row">
                      <div className="col-md-6 mb-3">
                        <label className="form-label font-semi-bold">Your Name *</label>
                        <input
                          type="text"
                          className="form-control"
                          required
                          placeholder="Your Name"
                          value={formData.name}
                          onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                        />
                      </div>
                      <div className="col-md-6 mb-3">
                        <label className="form-label font-semi-bold">Your Email *</label>
                        <input
                          type="email"
                          className="form-control"
                          required
                          placeholder="username@domain.com"
                          value={formData.email}
                          onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                        />
                      </div>
                      <div className="col-12 mb-3">
                        <label className="form-label font-semi-bold">Phone Number</label>
                        <input
                          type="tel"
                          className="form-control"
                          placeholder="+021 01283492"
                          value={formData.phone}
                          onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                        />
                      </div>
                      <div className="col-12 mb-4">
                        <label className="form-label font-semi-bold">Your Message *</label>
                        <textarea
                          className="form-control"
                          rows="4"
                          required
                          placeholder="How can we assist your pet?"
                          value={formData.message}
                          onChange={(e) => setFormData({ ...formData, message: e.target.value })}
                        ></textarea>
                      </div>
                      <div className="col-12">
                        <button type="submit" className="button">
                          Send Message
                        </button>
                      </div>
                    </div>
                  </form>
                )}
              </div>
            </div>
          </div>
        </div>
      </section>

      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
