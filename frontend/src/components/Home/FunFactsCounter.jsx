import React from 'react';

const stats = [
  {
    id: 1,
    img: "/assets/img/fun-facts-1.png",
    count: "100",
    symbol: "+",
    label: "Client Served"
  },
  {
    id: 2,
    img: "/assets/img/fun-facts-2.png",
    count: "99",
    symbol: "%",
    label: "Client Served"
  },
  {
    id: 3,
    img: "/assets/img/fun-facts-3.png",
    count: "2",
    symbol: "k",
    label: "Client Served"
  },
  {
    id: 4,
    img: "/assets/img/fun-facts-4.png",
    count: "400",
    symbol: "+",
    label: "Client Served"
  }
];

const FunFactsCounter = () => {
  return (
    <section className="gap">
      <div className="container">
        <div className="row">
          {stats.map((stat, idx) => (
            <div
              key={stat.id}
              className={`col-lg-3 col-md-4 col-sm-6 ${idx === stats.length - 1 ? 'mb-0' : ''}`}
            >
              <div className="count-text text-center">
                <img alt="Milestone Icon" src={stat.img} className="mb-3" />
                <div>
                  <div className="d-flex justify-content-center align-items-center">
                    <h2 className="count mb-0">{stat.count}</h2>
                    <span style={{ color: '#fa441d', fontSize: '28px', fontWeight: 'bold' }}>
                      {stat.symbol}
                    </span>
                  </div>
                  <h3 className="text mt-1">{stat.label}</h3>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default FunFactsCounter;
