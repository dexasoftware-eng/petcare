import React, { useState, useEffect } from 'react';

export default function ScrollToTop() {
  const [scrollProgress, setScrollProgress] = useState(0);
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      const pos = document.documentElement.scrollTop || document.body.scrollTop;
      const calcHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

      if (calcHeight > 0) {
        const scrollValue = Math.min(100, Math.max(0, Math.round((pos * 100) / calcHeight)));
        setScrollProgress(scrollValue);
      }

      if (pos > 100) {
        setIsVisible(true);
      } else {
        setIsVisible(false);
      }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const scrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    });
  };

  if (!isVisible) return null;

  return (
    <div
      id="progress"
      onClick={scrollToTop}
      style={{
        display: 'grid',
        background: `conic-gradient(#fa441d ${scrollProgress}%, #fff ${scrollProgress}%)`,
        cursor: 'pointer',
      }}
      aria-label="Scroll to top"
    >
      <span id="progress-value">
        <i className="fa-solid fa-up-long"></i>
      </span>
    </div>
  );
}
