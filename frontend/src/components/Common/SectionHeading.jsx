import React from 'react';

const SectionHeading = ({ subTitle, title, align = 'center', className = '' }) => {
  return (
    <div className={`heading ${className}`} style={{ textAlign: align }}>
      <img src="/assets/img/heading-img.png" alt="heading decoration" />
      {subTitle && <h6>{subTitle}</h6>}
      {title && <h2>{title}</h2>}
    </div>
  );
};

export default SectionHeading;
