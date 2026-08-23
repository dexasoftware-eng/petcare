import React from 'react';
import PageBanner from '../components/Common/PageBanner';
import SectionHeading from '../components/Common/SectionHeading';
import InstaGallery from '../components/Home/InstaGallery';

const milestones = [
  {
    year: "2018",
    title: "The Inception",
    desc: "Founded in New York with a passion for providing compassionate, cage-free canine walking and home sitting services."
  },
  {
    year: "2020",
    title: "First Clinical Facility",
    desc: "Opened our premier certified veterinary clinic and hygienic grooming salon equipped with modern medical tools."
  },
  {
    year: "2022",
    title: "Luxury Boarding Suites",
    desc: "Expanded to offer spacious, climate-controlled boarding suites with 24/7 webcams and personalized enrichment."
  },
  {
    year: "2024",
    title: "Statewide Recognition",
    desc: "Honored with the National Pet Care Excellence award, serving over 10,000 satisfied pet parents and animal companions."
  }
];

const History = () => {
  return (
    <div className="history-page">
      <PageBanner title="Our History" parentPage="Pages" />

      <section className="gap">
        <div className="container">
          <SectionHeading
            subTitle="Our Story & Milestones"
            title="A Journey of Unconditional Love"
          />

          <div className="timeline mt-5 position-relative" style={{ maxWidth: '800px', margin: '0 auto' }}>
            <div className="row g-4">
              {milestones.map((m, idx) => (
                <div key={idx} className="col-md-6">
                  <div
                    className="p-4 rounded border h-100"
                    style={{ backgroundColor: idx % 2 === 0 ? '#fff8e5' : '#ffffff', borderColor: '#fedc4f' }}
                  >
                    <span className="fs-2 fw-bold d-block mb-2" style={{ color: '#fa441d' }}>
                      {m.year}
                    </span>
                    <h3 className="fs-4 mb-2">{m.title}</h3>
                    <p className="text-secondary leading-relaxed mb-0">{m.desc}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>

          {/* Awards Row */}
          <div className="awards-section text-center mt-5 pt-5 border-top">
            <h4 className="mb-4">Recognitions & Certified Badges</h4>
            <div className="d-flex flex-wrap justify-content-center gap-5 align-items-center">
              <img src="/assets/img/awards-1.png" alt="Award 1" style={{ height: '70px', objectFit: 'contain' }} />
              <img src="/assets/img/awards-2.png" alt="Award 2" style={{ height: '70px', objectFit: 'contain' }} />
              <img src="/assets/img/awards-3.png" alt="Award 3" style={{ height: '70px', objectFit: 'contain' }} />
              <img src="/assets/img/awards-4.png" alt="Award 4" style={{ height: '70px', objectFit: 'contain' }} />
            </div>
          </div>
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default History;
