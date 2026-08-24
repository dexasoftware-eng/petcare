import React from 'react';

export default function CompanyStorySection() {
  return (
    <section className="gap about">
      <div className="container">
        <div className="row align-items-center">
          <div className="col-lg-6">
            <div className="heading two">
              <h2>Welcome to The Pet Care Company</h2>
            </div>
            <div className="love-your-pets">
              <p>
                Lorem ipsum dolor sit amet,consectetur adipiscing elit do ei usmod tempor incididunt ut labore et.Lorem ipsumsit amet, consectetur adipiscing elit, sed do eiusmod teincididunt ut la amet,consectetur.
              </p>
              <ul className="list">
                <li>
                  <img src="/assets/img/list.png" alt="list icon" /> Graceful goldfish, to small, cute kittens
                </li>
                <li>
                  <img src="/assets/img/list.png" alt="list icon" /> Feeders are either veterinary qualified staf
                </li>
                <li>
                  <img src="/assets/img/list.png" alt="list icon" /> Experienced pet owners and animal lovers
                </li>
                <li>
                  <img src="/assets/img/list.png" alt="list icon" /> Hungry horses: whatever the size of your pe
                </li>
              </ul>
              <div className="company-oner position-relative">
                <img src="/assets/img/girl.jpg" alt="Jessica Catty" />
                <svg width="116" height="116" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fillRule="evenodd"
                    clipRule="evenodd"
                    d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z"
                    fill="#000"
                  />
                </svg>
                <div>
                  <h3>Jessica Catty</h3>
                  <p>Owner Pet Care Company</p>
                </div>
              </div>
            </div>
          </div>
          <div className="col-lg-6">
            <div className="dogs-img">
              <img src="/assets/img/dogs-1.png" alt="Happy Dogs" className="w-100" />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
