import React from 'react';

export default function ClientLogosSection() {
  const clientLogos = [
    { id: 1, src: '/assets/img/clients-1.png', alt: 'Client Partner 1' },
    { id: 2, src: '/assets/img/clients-2.png', alt: 'Client Partner 2' },
    { id: 3, src: '/assets/img/clients-3.png', alt: 'Client Partner 3' },
    { id: 4, src: '/assets/img/clients-4.png', alt: 'Client Partner 4' },
    { id: 5, src: '/assets/img/clients-5.png', alt: 'Client Partner 5' },
  ];

  return (
    <div className="clients-logo">
      <div className="container">
        <div className="logodata d-flex align-items-center justify-content-between flex-wrap gap-4 py-4">
          {clientLogos.map((client) => (
            <div key={client.id} className="partner item">
              <img
                alt={client.alt}
                src={client.src}
                style={{ opacity: 0.85, transition: 'opacity 0.3s ease' }}
                onMouseEnter={(e) => (e.currentTarget.style.opacity = '1')}
                onMouseLeave={(e) => (e.currentTarget.style.opacity = '0.85')}
              />
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
