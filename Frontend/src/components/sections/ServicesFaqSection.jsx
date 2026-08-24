import React, { useState } from 'react';

const faqs = [
  {
    id: 1,
    title: '1. What is the FurShield Pet Membership program?',
    content:
      'Our membership offers priority scheduling, discounted grooming packages, complimentary annual checkups, and 24/7 tele-vet assistance.',
  },
  {
    id: 2,
    title: '2. How do I book a dog walking or boarding session?',
    content:
      'You can book directly through your owner dashboard or contact our customer support. Select your preferred date, time slot, and walker preferences.',
  },
  {
    id: 3,
    title: '3. What qualifications do your veterinarians and sitters hold?',
    content:
      'All our veterinarians are certified professionals and our pet sitters undergo comprehensive background verification and pet first-aid certifications.',
  },
  {
    id: 4,
    title: '4. Can I reschedule or cancel a booked service?',
    content:
      'Yes, bookings can be modified or cancelled free of charge up to 12 hours before the scheduled appointment via your owner portal.',
  },
];

export default function ServicesFaqSection() {
  const [activeFaq, setActiveFaq] = useState(2);

  const toggleFaq = (id) => {
    setActiveFaq((prev) => (prev === id ? null : id));
  };

  return (
    <section className="gap position-relative" style={{ backgroundImage: 'url(/assets/img/client-b.jpg)' }}>
      <div className="container">
        <div className="row align-items-center">
          <div className="col-lg-6">
            <div className="heading two w-100 mb-4">
              <h6>laundry faq's</h6>
              <h2>Pet Benefits of Membership</h2>
            </div>
            <div className="accordion">
              {faqs.map((faq) => {
                const isActive = activeFaq === faq.id;
                return (
                  <div
                    key={faq.id}
                    className={`accordion-item mb-3 ${isActive ? 'active' : ''}`}
                    style={{
                      background: '#ffffff',
                      borderRadius: '10px',
                      overflow: 'hidden',
                      border: '1px solid #ebebeb',
                      boxShadow: isActive ? '0 5px 20px rgba(0,0,0,0.06)' : 'none',
                      transition: 'box-shadow 0.3s ease',
                    }}
                  >
                    <a
                      href={`#faq-${faq.id}`}
                      onClick={(e) => {
                        e.preventDefault();
                        toggleFaq(faq.id);
                      }}
                      className="heading d-flex align-items-center justify-content-between p-3"
                      style={{ textDecoration: 'none', color: '#222', cursor: 'pointer' }}
                    >
                      <div className="title fw-bold" style={{ padding: '0', background: 'transparent' }}>
                        {faq.title}
                      </div>
                      <div
                        className="icon-indicator"
                        style={{
                          width: '28px',
                          height: '28px',
                          borderRadius: '50%',
                          backgroundColor: isActive ? '#fa441d' : '#f0f0f0',
                          color: isActive ? '#fff' : '#222',
                          display: 'flex',
                          alignItems: 'center',
                          justifyContent: 'center',
                          fontSize: '12px',
                          flexShrink: 0,
                          marginLeft: '12px',
                          transition: 'background-color 0.2s ease, color 0.2s ease',
                        }}
                      >
                        <i className={`fa-solid ${isActive ? 'fa-minus' : 'fa-plus'}`}></i>
                      </div>
                    </a>
                    {isActive && (
                      <div className="content px-3 pb-3" style={{ display: 'block', marginTop: 0 }}>
                        <p className="mb-0 text-muted" style={{ fontSize: '15px', lineHeight: 1.6 }}>
                          {faq.content}
                        </p>
                      </div>
                    )}
                  </div>
                );
              })}
            </div>
          </div>
          <div className="col-lg-6 text-center">
            <div className="faq-img" style={{ display: 'inline-block' }}>
              <img
                src="/assets/img/faq-1.jpg"
                alt="FAQ Mascot"
                className="img-fluid rounded-circle shadow"
                style={{
                  maxWidth: '380px',
                  width: '100%',
                  height: 'auto',
                  border: '10px solid #ffffff',
                  boxShadow: '0 15px 40px rgba(0,0,0,0.12)',
                }}
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
