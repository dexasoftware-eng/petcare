import React from 'react';

export default function AwardsSection() {
  const awards = [
    { id: 1, img: '/assets/img/awards-1.png', alt: 'Award 1' },
    { id: 2, img: '/assets/img/awards-2.png', alt: 'Award 2' },
    { id: 3, img: '/assets/img/awards-3.png', alt: 'Award 3' },
    { id: 4, img: '/assets/img/awards-4.png', alt: 'Award 4' },
  ];

  return (
    <div className="gap">
      <div className="container">
        <h3 className="awards">Awards Winning Company</h3>
        <div className="awards">
          {awards.map((award) => (
            <img key={award.id} src={award.img} alt={award.alt} />
          ))}
        </div>
      </div>
    </div>
  );
}
