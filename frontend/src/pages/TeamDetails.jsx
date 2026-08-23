import React from 'react';
import { useParams, Link } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import InstaGallery from '../components/Home/InstaGallery';
import { team } from '../data/team';

const TeamDetails = () => {
  const { id } = useParams();
  const member = team.find(m => m.id === parseInt(id || '1')) || team[0];

  return (
    <div className="team-details-page">
      <PageBanner title={member.name} parentPage="Team" parentLink="/about" />

      <section className="gap">
        <div className="container">
          <div className="row align-items-center g-5">
            <div className="col-lg-5 text-center">
              <div className="position-relative d-inline-block">
                <img
                  src={member.img}
                  alt={member.name}
                  className="img-fluid rounded-4 shadow"
                  style={{ maxHeight: '420px', objectFit: 'cover' }}
                />
              </div>
            </div>

            <div className="col-lg-7">
              <span className="text-uppercase fw-bold text-muted small">{member.role}</span>
              <h2 className="mt-1 mb-3">{member.name}</h2>
              <p className="lead text-secondary leading-relaxed mb-4">
                {member.bio}
              </p>

              <div className="p-4 rounded border mb-4" style={{ backgroundColor: '#fff8e5' }}>
                <div className="row g-3">
                  <div className="col-sm-6">
                    <p className="mb-1 text-muted small">Direct Line:</p>
                    <a href={`tel:${member.phone}`} className="fw-bold text-dark">{member.phone}</a>
                  </div>
                  <div className="col-sm-6">
                    <p className="mb-1 text-muted small">Email Address:</p>
                    <a href={`mailto:${member.email}`} className="fw-bold text-dark">{member.email}</a>
                  </div>
                </div>
              </div>

              {/* Skills Progress */}
              <div className="skills-bars mb-4">
                <div className="mb-3">
                  <div className="d-flex justify-content-between fw-semibold mb-1">
                    <span>Canine Behavior & Training</span>
                    <span>95%</span>
                  </div>
                  <div className="progress" style={{ height: '8px' }}>
                    <div className="progress-bar" style={{ width: '95%', backgroundColor: '#fa441d' }}></div>
                  </div>
                </div>

                <div className="mb-3">
                  <div className="d-flex justify-content-between fw-semibold mb-1">
                    <span>Clinical Care & Nutrition</span>
                    <span>90%</span>
                  </div>
                  <div className="progress" style={{ height: '8px' }}>
                    <div className="progress-bar" style={{ width: '90%', backgroundColor: '#fedc4f' }}></div>
                  </div>
                </div>

                <div>
                  <div className="d-flex justify-content-between fw-semibold mb-1">
                    <span>Emergency First Aid</span>
                    <span>98%</span>
                  </div>
                  <div className="progress" style={{ height: '8px' }}>
                    <div className="progress-bar" style={{ width: '98%', backgroundColor: '#940c69' }}></div>
                  </div>
                </div>
              </div>

              <Link to="/contact" className="button">
                Schedule Consultation
              </Link>
            </div>
          </div>
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default TeamDetails;
