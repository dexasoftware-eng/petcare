import React, { useState, useEffect, useRef } from 'react';
import { funFactsData } from '../../data/templateData';

export default function FunFactsSection() {
  const [counters, setCounters] = useState(funFactsData.map(() => 0));
  const [hasAnimated, setHasAnimated] = useState(false);
  const sectionRef = useRef(null);

  useEffect(() => {
    const handleScroll = () => {
      if (hasAnimated || !sectionRef.current) return;
      const rect = sectionRef.current.getBoundingClientRect();
      if (rect.top <= window.innerHeight && rect.bottom >= 0) {
        setHasAnimated(true);

        funFactsData.forEach((fact, idx) => {
          const duration = 2000;
          const steps = 60;
          const increment = fact.count / steps;
          let current = 0;
          const timer = setInterval(() => {
            current += increment;
            if (current >= fact.count) {
              current = fact.count;
              clearInterval(timer);
            }
            setCounters((prev) => {
              const updated = [...prev];
              updated[idx] = Math.floor(current);
              return updated;
            });
          }, duration / steps);
        });
      }
    };

    window.addEventListener('scroll', handleScroll);
    handleScroll();
    return () => window.removeEventListener('scroll', handleScroll);
  }, [hasAnimated]);

  return (
    <section className="gap" ref={sectionRef}>
      <div className="container">
        <div className="row">
          {funFactsData.map((fact, idx) => (
            <div key={fact.id} className="col-lg-3 col-md-4 col-sm-6">
              <div className={`count-text ${idx === 2 ? 'mb-sm-0' : idx === 3 ? 'mb-0' : ''}`}>
                <img alt="img" src={fact.image} />
                <div>
                  <div className="d-flex justify-content-center">
                    <h2 className="count">{counters[idx]}</h2>
                    <span>{fact.suffix}</span>
                  </div>
                  <h3 className="text">{fact.label}</h3>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
