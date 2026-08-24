import React, { useState, useEffect } from 'react';

const ScrollToTop = () => {
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      if (window.scrollY > 300) {
        setIsVisible(true);
      } else {
        setIsVisible(false);
      }
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const scrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  };

  if (!isVisible) return null;

  return (
    <div
      id="progress"
      className="active"
      onClick={scrollToTop}
      style={{
        position: 'fixed',
        bottom: '30px',
        right: '30px',
        height: '50px',
        width: '50px',
        display: 'grid',
        placeItems: 'center',
        borderRadius: '50%',
        boxShadow: '0 0 10px rgba(0, 0, 0, 0.2)',
        cursor: 'pointer',
        zIndex: 99999,
        background: '#fa441d',
        color: '#ffffff'
      }}
    >
      <span id="progress-value" style={{ display: 'block', color: '#fff', fontSize: '18px' }}>
        <i className="fa-solid fa-arrow-up"></i>
      </span>
    </div>
  );
};

export default ScrollToTop;
