import React, { useState } from 'react';

const faqs = [
  {
    id: 1,
    title: '1. What is PetGuard and who is it designed for?',
    content:
      'PetGuard is a digital ecosystem built for Pet Owners, licensed Veterinarians, and registered Animal Shelters to manage pet health profiles, clinical care, and adoption workflows in one place.',
  },
  {
    id: 2,
    title: '2. How do digital pet health profiles work?',
    content:
      'Pet owners can securely store medical history, vaccinations, dietary notes, and microchip numbers. When visiting a vet or shelter, this history is readily accessible to ensure continuous care.',
  },
  {
    id: 3,
    title: '3. How do veterinarians and animal shelters register?',
    content:
      'Veterinarians and animal rescue shelters can register their specialized profiles through our dedicated role-specific portals to coordinate clinical appointments or list adoptable rescue animals.',
  },
  {
    id: 4,
    title: "4. How is my pet's data and health information protected?",
    content:
      'PetGuard implements secure role-based access control and protected authentication so that only authorized pet owners and linked veterinary clinics can access pet health records.',
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
              <h6>Frequently Asked Questions</h6>
              <h2>How PetGuard Works For You</h2>
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
