import React, { useState } from 'react';
import { useAuth } from '../../context/AuthContext';
import { Link } from '../../router/Router';

export default function ShelterDashboard() {
  const { user, logout, logoutAll } = useAuth();

  const [rescues, setRescues] = useState([
    {
      id: 1,
      name: 'Barnaby',
      type: 'Dog (Beagle Mix)',
      intakeDate: '12 Aug 2026',
      status: 'Available',
      healthStatus: 'Vaccinated & Neutered',
    },
    {
      id: 2,
      name: 'Daisy & Clover',
      type: 'Bonded Pair (Domestic Short Hair)',
      intakeDate: '18 Aug 2026',
      status: 'Pending Adoption',
      healthStatus: 'Microchipped',
    },
    {
      id: 3,
      name: 'Shadow',
      type: 'Dog (Husky)',
      intakeDate: '21 Aug 2026',
      status: 'In Rehabilitation',
      healthStatus: 'Deworming & Therapy',
    },
  ]);

  const [showAddModal, setShowAddModal] = useState(false);
  const [newRescue, setNewRescue] = useState({ name: '', type: '', healthStatus: '' });
  const [msg, setMsg] = useState('');

  const handleAddRescue = (e) => {
    e.preventDefault();
    if (!newRescue.name) return;

    setRescues([
      ...rescues,
      {
        id: Date.now(),
        name: newRescue.name,
        type: newRescue.type,
        intakeDate: new Date().toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }),
        status: 'Available',
        healthStatus: newRescue.healthStatus || 'Health Screen Pending',
      },
    ]);
    setNewRescue({ name: '', type: '', healthStatus: '' });
    setShowAddModal(false);
    setMsg('New rescue pet added to intake roster!');
    setTimeout(() => setMsg(''), 3000);
  };

  return (
    <>
      <section
        className="banner"
        style={{
          backgroundColor: '#fff8e5',
          backgroundImage: 'url(/assets/img/background.png)',
          padding: '60px 0',
        }}
      >
        <div className="container">
          <div className="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
              <span
                style={{
                  display: 'inline-block',
                  padding: '4px 12px',
                  backgroundColor: '#7b1fa2',
                  color: '#fff',
                  borderRadius: '20px',
                  fontSize: '12px',
                  fontWeight: 700,
                  textTransform: 'uppercase',
                  marginBottom: '8px',
                }}
              >
                <i className="fa-solid fa-house-chimney-medical me-1"></i> Shelter & Rescue Hub
              </span>
              <h2 style={{ fontSize: '36px', fontWeight: 800, margin: 0, color: '#222' }}>
                {user?.profile?.shelterName || user?.name}
              </h2>
              <div className="d-flex flex-wrap gap-3 text-muted mt-2" style={{ fontSize: '14px' }}>
                <span>
                  <i className="fa-solid fa-user-tie text-primary me-1"></i>
                  Contact: {user?.name}
                </span>
                <span>
                  <i className="fa-solid fa-envelope text-warning me-1"></i>
                  {user?.email}
                </span>
                <span>
                  <i className="fa-solid fa-location-dot text-danger me-1"></i>
                  {user?.address}
                </span>
              </div>
            </div>
            <div className="d-flex gap-2">
              <button
                onClick={logout}
                className="button btn-outline"
                style={{
                  padding: '10px 20px',
                  borderRadius: '10px',
                  border: '1px solid #fa441d',
                  color: '#fa441d',
                  backgroundColor: '#fff',
                  fontWeight: 600,
                }}
              >
                <i className="fa-solid fa-right-from-bracket me-1"></i> Sign Out
              </button>
              <button
                onClick={logoutAll}
                className="button"
                style={{
                  padding: '10px 20px',
                  borderRadius: '10px',
                  backgroundColor: '#222',
                  color: '#fff',
                  border: 'none',
                  fontWeight: 600,
                }}
              >
                <i className="fa-solid fa-shield-virus me-1"></i> Revoke All Sessions
              </button>
            </div>
          </div>
        </div>
      </section>

      <section className="gap" style={{ padding: '60px 0' }}>
        <div className="container">
          {msg && (
            <div
              className="alert alert-success d-flex align-items-center mb-4"
              style={{ borderRadius: '12px' }}
            >
              <i className="fa-solid fa-circle-check me-2 fs-5"></i>
              <div>{msg}</div>
            </div>
          )}

          {/* Metrics */}
          <div className="row g-4 mb-5">
            <div className="col-lg-3 col-sm-6">
              <div
                className="p-4"
                style={{
                  backgroundColor: '#fff',
                  borderRadius: '18px',
                  boxShadow: '0 8px 24px rgba(0,0,0,0.04)',
                  border: '1px solid #faeedb',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '16px',
                }}
              >
                <div
                  style={{
                    width: '54px',
                    height: '54px',
                    borderRadius: '14px',
                    backgroundColor: '#f3e5f5',
                    color: '#7b1fa2',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '22px',
                  }}
                >
                  <i className="fa-solid fa-paw"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    {rescues.length}
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Animals in Shelter
                  </span>
                </div>
              </div>
            </div>

            <div className="col-lg-3 col-sm-6">
              <div
                className="p-4"
                style={{
                  backgroundColor: '#fff',
                  borderRadius: '18px',
                  boxShadow: '0 8px 24px rgba(0,0,0,0.04)',
                  border: '1px solid #faeedb',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '16px',
                }}
              >
                <div
                  style={{
                    width: '54px',
                    height: '54px',
                    borderRadius: '14px',
                    backgroundColor: '#e3f2fd',
                    color: '#1565c0',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '22px',
                  }}
                >
                  <i className="fa-solid fa-file-signature"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    14
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Pending Applications
                  </span>
                </div>
              </div>
            </div>

            <div className="col-lg-3 col-sm-6">
              <div
                className="p-4"
                style={{
                  backgroundColor: '#fff',
                  borderRadius: '18px',
                  boxShadow: '0 8px 24px rgba(0,0,0,0.04)',
                  border: '1px solid #faeedb',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '16px',
                }}
              >
                <div
                  style={{
                    width: '54px',
                    height: '54px',
                    borderRadius: '14px',
                    backgroundColor: '#e8f5e9',
                    color: '#2e7d32',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '22px',
                  }}
                >
                  <i className="fa-solid fa-house-user"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    28
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Adopted This Month
                  </span>
                </div>
              </div>
            </div>

            <div className="col-lg-3 col-sm-6">
              <div
                className="p-4"
                style={{
                  backgroundColor: '#fff',
                  borderRadius: '18px',
                  boxShadow: '0 8px 24px rgba(0,0,0,0.04)',
                  border: '1px solid #faeedb',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '16px',
                }}
              >
                <div
                  style={{
                    width: '54px',
                    height: '54px',
                    borderRadius: '14px',
                    backgroundColor: '#fff3e0',
                    color: '#e65100',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '22px',
                  }}
                >
                  <i className="fa-solid fa-heart-pulse"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    5
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Medical In-Progress
                  </span>
                </div>
              </div>
            </div>
          </div>

          {/* Intakes Table & Controls */}
          <div
            className="p-4"
            style={{
              backgroundColor: '#fff',
              borderRadius: '20px',
              boxShadow: '0 10px 30px rgba(0,0,0,0.05)',
              border: '1px solid #f0e6d6',
            }}
          >
            <div className="d-flex justify-content-between align-items-center mb-4">
              <div>
                <h4 style={{ fontWeight: 800, margin: 0, color: '#222' }}>
                  Shelter Intake & Adoption Roster
                </h4>
                <p className="text-muted mb-0" style={{ fontSize: '14px' }}>
                  Manage resident rescue animals, update adoption statuses, and publish profiles
                </p>
              </div>
              <button
                onClick={() => setShowAddModal(!showAddModal)}
                className="button"
                style={{
                  padding: '10px 20px',
                  borderRadius: '12px',
                  backgroundColor: '#7b1fa2',
                  color: '#fff',
                  fontWeight: 600,
                  border: 'none',
                }}
              >
                <i className="fa-solid fa-plus me-1"></i> New Animal Intake
              </button>
            </div>

            {showAddModal && (
              <div
                className="p-4 mb-4"
                style={{
                  backgroundColor: '#fbf4ff',
                  borderRadius: '16px',
                  border: '1px solid #ebd4f7',
                }}
              >
                <h5 style={{ fontWeight: 700, marginBottom: '14px' }}>Register Incoming Rescue Animal</h5>
                <form onSubmit={handleAddRescue}>
                  <div className="row g-3">
                    <div className="col-md-4">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '13px' }}>
                        Animal Name
                      </label>
                      <input
                        type="text"
                        className="form-control"
                        placeholder="e.g. Copper"
                        value={newRescue.name}
                        onChange={(e) => setNewRescue({ ...newRescue, name: e.target.value })}
                        required
                      />
                    </div>
                    <div className="col-md-4">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '13px' }}>
                        Species / Breed
                      </label>
                      <input
                        type="text"
                        className="form-control"
                        placeholder="e.g. Hound Mix"
                        value={newRescue.type}
                        onChange={(e) => setNewRescue({ ...newRescue, type: e.target.value })}
                        required
                      />
                    </div>
                    <div className="col-md-4">
                      <label className="form-label" style={{ fontWeight: 600, fontSize: '13px' }}>
                        Medical / Health Summary
                      </label>
                      <input
                        type="text"
                        className="form-control"
                        placeholder="e.g. Spayed & Vaccinated"
                        value={newRescue.healthStatus}
                        onChange={(e) => setNewRescue({ ...newRescue, healthStatus: e.target.value })}
                      />
                    </div>
                    <div className="col-12 d-flex justify-content-end gap-2 mt-3">
                      <button
                        type="button"
                        onClick={() => setShowAddModal(false)}
                        className="button btn-outline"
                        style={{ padding: '8px 16px', borderRadius: '8px' }}
                      >
                        Cancel
                      </button>
                      <button
                        type="submit"
                        className="button"
                        style={{
                          padding: '8px 20px',
                          borderRadius: '8px',
                          backgroundColor: '#7b1fa2',
                          color: '#fff',
                          border: 'none',
                        }}
                      >
                        Save Intake
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            )}

            <div className="table-responsive">
              <table className="table align-middle">
                <thead style={{ backgroundColor: '#faf7f2' }}>
                  <tr>
                    <th style={{ padding: '12px 16px', borderRadius: '8px 0 0 8px' }}>ANIMAL NAME</th>
                    <th style={{ padding: '12px 16px' }}>SPECIES / BREED</th>
                    <th style={{ padding: '12px 16px' }}>INTAKE DATE</th>
                    <th style={{ padding: '12px 16px' }}>HEALTH RECORD</th>
                    <th style={{ padding: '12px 16px', borderRadius: '0 8px 8px 0' }}>ADOPTION STATUS</th>
                  </tr>
                </thead>
                <tbody>
                  {rescues.map((item) => (
                    <tr key={item.id} style={{ borderBottom: '1px solid #f0e6d6' }}>
                      <td style={{ padding: '16px', fontWeight: 700, color: '#222' }}>
                        <i className="fa-solid fa-paw text-muted me-2"></i>
                        {item.name}
                      </td>
                      <td style={{ padding: '16px', color: '#555' }}>{item.type}</td>
                      <td style={{ padding: '16px', fontSize: '13px' }}>{item.intakeDate}</td>
                      <td style={{ padding: '16px', fontSize: '13px' }}>
                        <span className="badge bg-light text-dark border">
                          <i className="fa-solid fa-notes-medical text-success me-1"></i>
                          {item.healthStatus}
                        </span>
                      </td>
                      <td style={{ padding: '16px' }}>
                        <span
                          style={{
                            padding: '4px 12px',
                            borderRadius: '12px',
                            fontSize: '12px',
                            fontWeight: 700,
                            backgroundColor:
                              item.status === 'Available'
                                ? '#e8f5e9'
                                : item.status === 'Pending Adoption'
                                ? '#fff3e0'
                                : '#e3f2fd',
                            color:
                              item.status === 'Available'
                                ? '#2e7d32'
                                : item.status === 'Pending Adoption'
                                ? '#e65100'
                                : '#1565c0',
                          }}
                        >
                          {item.status}
                        </span>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
