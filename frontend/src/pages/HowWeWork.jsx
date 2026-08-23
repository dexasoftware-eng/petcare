import React from 'react';
import PageBanner from '../components/Common/PageBanner';
import SectionHeading from '../components/Common/SectionHeading';
import WorkingTeam from '../components/Home/WorkingTeam';
import InstaGallery from '../components/Home/InstaGallery';

const steps = [
  {
    step: "01",
    title: "Consultation & Meet-Up",
    img: "/assets/img/works-1.png",
    photo: "/assets/img/how-img-1.jpg",
    desc: "We begin with a gentle initial introduction to meet your furry family member, understand specific routines, dietary needs, and medical history."
  },
  {
    step: "02",
    title: "Customized Care Schedule",
    img: "/assets/img/works-2.png",
    photo: "/assets/img/how-img-2.jpg",
    desc: "We draft an individualized schedule tailored specifically to your companion's energy levels, walking preferences, and dietary sensitivities."
  },
  {
    step: "03",
    title: "Real-Time Updates & Love",
    img: "/assets/img/works-3.png",
    photo: "/assets/img/how-img-3.jpg",
    desc: "Receive daily GPS walking maps, live photo snapshots, meal logs, and total peace of mind while your pet enjoys affectionate, attentive care."
  }
];

const HowWeWork = () => {
  return (
    <div className="how-we-work-page">
      <PageBanner title="How We Works" parentPage="Pages" />

      <section className="gap">
        <div className="container">
          <SectionHeading
            subTitle="Our Workflow"
            title="Simple 3-Step Process"
          />

          <div className="row g-4 mt-3">
            {steps.map((s, idx) => (
              <div key={idx} className="col-lg-4 col-md-6">
                <div className="how-work-card p-4 rounded text-center border h-100" style={{ backgroundColor: '#fff8e5' }}>
                  <div className="position-relative mb-4 d-inline-block">
                    <img src={s.photo} alt={s.title} className="rounded-circle shadow" style={{ width: '180px', height: '180px', objectFit: 'cover' }} />
                    <span
                      className="position-absolute bottom-0 end-0 px-3 py-1 rounded-circle text-white fw-bold"
                      style={{ backgroundColor: '#fa441d' }}
                    >
                      {s.step}
                    </span>
                  </div>
                  <h3 className="fs-4 mb-3">{s.title}</h3>
                  <p className="text-secondary leading-relaxed mb-0">{s.desc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <WorkingTeam />
      <InstaGallery />
    </div>
  );
};

export default HowWeWork;
