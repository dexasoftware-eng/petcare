import React, { useState } from 'react';

const faqs = [
  {
    id: 1,
    title: 'Stand Out From Your competitors',
    content:
      'Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei amet,consectetur adipiscing elibore et Lorem ipsum dolor sit amet,consectetur.',
  },
  {
    id: 2,
    title: 'Save Costs With Partner Discounts',
    content:
      'Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei amet,consectetur adipiscing elibore et Lorem ipsum dolor sit amet,consectetur.',
  },
  {
    id: 3,
    title: 'Monthly Flea And Worming Treatments',
    content:
      'Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei amet,consectetur adipiscing elibore et Lorem ipsum dolor sit amet,consectetur.',
  },
  {
    id: 4,
    title: 'Discounts On Pet Food And Medication',
    content:
      'Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei amet,consectetur adipiscing elibore et Lorem ipsum dolor sit amet,consectetur.',
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
              <h6>LAUNDRY FAQ'S</h6>
              <h2>Pet Benefits of<br />Membership</h2>
            </div>
            <div className="accordion">
              {faqs.map((faq) => {
                const isActive = activeFaq === faq.id;
                return (
                  <div
                    key={faq.id}
                    className={`accordion-item ${isActive ? 'active' : ''}`}
                    style={{ marginBottom: '14px', position: 'relative' }}
                  >
                    <a
                      href={`#faq-${faq.id}`}
                      onClick={(e) => {
                        e.preventDefault();
                        toggleFaq(faq.id);
                      }}
                      className="heading position-relative d-block text-decoration-none"
                      style={{ cursor: 'pointer' }}
                    >
                      <div
                        className="title"
                        style={{
                          backgroundColor: isActive ? '#feda46' : '#ffffff',
                          color: '#000000',
                          fontWeight: '700',
                          fontSize: '18px',
                          borderRadius: '50px',
                          padding: '16px 24px 16px 64px',
                          boxShadow: isActive ? '0 6px 20px rgba(254, 218, 70, 0.3)' : '0 4px 15px rgba(0,0,0,0.04)',
                          transition: 'all 0.3s ease',
                          display: 'flex',
                          alignItems: 'center',
                        }}
                      >
                        {faq.title}
                      </div>
                      <div
                        className="icon"
                        style={{
                          position: 'absolute',
                          left: '12px',
                          top: '50%',
                          transform: 'translateY(-50%)',
                          width: '38px',
                          height: '38px',
                          borderRadius: '50%',
                          backgroundColor: isActive ? '#fa441d' : '#feda46',
                          display: 'flex',
                          alignItems: 'center',
                          justifyContent: 'center',
                          color: isActive ? '#ffffff' : '#000000',
                          fontSize: '14px',
                          transition: 'all 0.3s ease',
                          zIndex: 2,
                        }}
                      >
                        <i className={`fa-solid ${isActive ? 'fa-minus' : 'fa-plus'}`}></i>
                      </div>
                    </a>
                    {isActive && (
                      <div
                        className="content"
                        style={{
                          display: 'block',
                          padding: '14px 20px 10px 24px',
                          marginTop: '6px',
                        }}
                      >
                        <p style={{ color: '#666', fontSize: '15px', lineHeight: '1.7', margin: 0 }}>
                          {faq.content}
                        </p>
                      </div>
                    )}
                  </div>
                );
              })}
            </div>
          </div>

          <div className="col-lg-6">
            <div className="row g-3">
              <div className="col-6">
                <div className="faq-img">
                  <img src="/assets/img/faq-1.jpg" alt="Pet Eating Treat" className="img-fluid" />
                  <img src="/assets/img/faq-2.jpg" alt="Girl High-Fiving Dog" className="img-fluid" />
                  <img src="/assets/img/faq-3.jpg" alt="Cat Grooming" className="img-fluid" />
                </div>
              </div>
              <div className="col-6">
                <div className="faq-img two">
                  <img src="/assets/img/faq-4.jpg" alt="Man Hugging Golden Retriever" className="img-fluid" />
                  <img src="/assets/img/faq-5.jpg" alt="Girl Petting Horse" className="img-fluid" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <img src="/assets/img/faq-shaps.png" alt="faq-shaps" className="faq-shaps" />
    </section>
  );
}
