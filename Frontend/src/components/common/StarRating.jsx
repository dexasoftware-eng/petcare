import React from 'react';

const StarRating = ({ rating = 5 }) => {
  return (
    <ul className="star list-unstyled d-flex gap-1 mb-2">
      {[...Array(5)].map((_, i) => (
        <li key={i}>
          <i
            className={`fa-solid fa-star ${i < rating ? 'text-warning' : 'text-muted'}`}
            style={{ color: i < rating ? '#ffc107' : '#e0e0e0', fontSize: '13px' }}
          ></i>
        </li>
      ))}
    </ul>
  );
};

export default StarRating;
