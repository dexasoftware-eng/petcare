import React, { useState } from 'react';
import { useAuth } from '../../context/AuthContext';
import { Link } from '../../router/Router';

export default function VetDashboard() {
  const { user, logout, logoutAll } = useAuth();

  const [appointments, setAppointments] = useState([
    {
      id: 101,
      petName: 'Bella',
      species: 'Canine (Labrador)',
      ownerName: 'Robert King',
      time: '10:30 AM',
      reason: 'Routine Vaccination & Dental Check',
      status: 'Scheduled',
    },
    {
      id: 102,
      petName: 'Oliver',
      species: 'Feline (Persian)',
      ownerName: 'Emily Clark',
      time: '11:45 AM',
      reason: 'Skin Allergy & Rash Evaluation',
      status: 'In Progress',
    },
    {
      id: 103,
      petName: 'Max',
      species: 'Canine (German Shepherd)',
      ownerName: 'David Lee',
      time: '02:15 PM',
      reason: 'Post-Surgical Followup Inspection',
      status: 'Scheduled',
    },
  ]);

  const [notification, setNotification] = useState('');

  const completeAppointment = (id) => {
    setAppointments(
      appointments.map((a) => (a.id === id ? { ...a, status: 'Completed' } : a))
    );
    setNotification('Consultation marked as completed.');
    setTimeout(() => setNotification(''), 3000);
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
                  backgroundColor: '#198754',
                  color: '#fff',
                  borderRadius: '20px',
                  fontSize: '12px',
                  fontWeight: 700,
                  textTransform: 'uppercase',
                  marginBottom: '8px',
                }}
              >
                <i className="fa-solid fa-user-doctor me-1"></i> Veterinarian Portal
              </span>
              <h2 style={{ fontSize: '36px', fontWeight: 800, margin: 0, color: '#222' }}>
                {user?.name}
              </h2>
              <div className="d-flex flex-wrap gap-3 text-muted mt-2" style={{ fontSize: '14px' }}>
                <span>
                  <i className="fa-solid fa-certificate text-warning me-1"></i>
                  {user?.profile?.specialization || 'Clinical Specialist'}
                </span>
                <span>
                  <i className="fa-solid fa-briefcase text-primary me-1"></i>
                  {user?.profile?.experience || '5+'} Years Practice
                </span>
                <span>
                  <i className="fa-solid fa-clinic-medical text-danger me-1"></i>
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
          {notification && (
            <div
              className="alert alert-success d-flex align-items-center mb-4"
              style={{ borderRadius: '12px' }}
            >
              <i className="fa-solid fa-circle-check me-2 fs-5"></i>
              <div>{notification}</div>
            </div>
          )}

          {/* Key Metrics */}
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
                    backgroundColor: '#e8f5e9',
                    color: '#2e7d32',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '22px',
                  }}
                >
                  <i className="fa-solid fa-calendar-day"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    {appointments.length}
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Today's Consults
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
                  <i className="fa-solid fa-users"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    48
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Active Patients
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
                  <i className="fa-solid fa-file-medical"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    6
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Pending Diagnostics
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
                    backgroundColor: '#f3e5f5',
                    color: '#7b1fa2',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '22px',
                  }}
                >
                  <i className="fa-solid fa-prescription"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    19
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Active Prescriptions
                  </span>
                </div>
              </div>
            </div>
          </div>

          {/* Appointments Table */}
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
                  Today's Consultation Schedule
                </h4>
                <p className="text-muted mb-0" style={{ fontSize: '14px' }}>
                  Manage scheduled checkups, surgical follow-ups, and patient clinical records
                </p>
              </div>
            </div>

            <div className="table-responsive">
              <table className="table align-middle">
                <thead style={{ backgroundColor: '#faf7f2' }}>
                  <tr>
                    <th style={{ padding: '12px 16px', borderRadius: '8px 0 0 8px' }}>TIME</th>
                    <th style={{ padding: '12px 16px' }}>PET / SPECIES</th>
                    <th style={{ padding: '12px 16px' }}>OWNER</th>
                    <th style={{ padding: '12px 16px' }}>REASON FOR VISIT</th>
                    <th style={{ padding: '12px 16px' }}>STATUS</th>
                    <th style={{ padding: '12px 16px', borderRadius: '0 8px 8px 0', textAlign: 'right' }}>
                      ACTION
                    </th>
                  </tr>
                </thead>
                <tbody>
                  {appointments.map((item) => (
                    <tr key={item.id} style={{ borderBottom: '1px solid #f0e6d6' }}>
                      <td style={{ padding: '16px', fontWeight: 700, color: '#fa441d' }}>
                        <i className="fa-regular fa-clock me-1"></i> {item.time}
                      </td>
                      <td style={{ padding: '16px' }}>
                        <div style={{ fontWeight: 700, color: '#222' }}>{item.petName}</div>
                        <div className="text-muted" style={{ fontSize: '12px' }}>
                          {item.species}
                        </div>
                      </td>
                      <td style={{ padding: '16px', fontWeight: 600 }}>{item.ownerName}</td>
                      <td style={{ padding: '16px', fontSize: '14px' }}>{item.reason}</td>
                      <td style={{ padding: '16px' }}>
                        <span
                          style={{
                            padding: '4px 10px',
                            borderRadius: '12px',
                            fontSize: '12px',
                            fontWeight: 700,
                            backgroundColor:
                              item.status === 'Completed'
                                ? '#e8f5e9'
                                : item.status === 'In Progress'
                                ? '#fff3e0'
                                : '#e3f2fd',
                            color:
                              item.status === 'Completed'
                                ? '#2e7d32'
                                : item.status === 'In Progress'
                                ? '#e65100'
                                : '#1565c0',
                          }}
                        >
                          {item.status}
                        </span>
                      </td>
                      <td style={{ padding: '16px', textAlign: 'right' }}>
                        {item.status !== 'Completed' ? (
                          <button
                            onClick={() => completeAppointment(item.id)}
                            className="button"
                            style={{
                              padding: '6px 14px',
                              fontSize: '12px',
                              borderRadius: '8px',
                              backgroundColor: '#fa441d',
                              color: '#fff',
                              border: 'none',
                              fontWeight: 600,
                            }}
                          >
                            Mark Complete
                          </button>
                        ) : (
                          <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                            <i className="fa-solid fa-check-double text-success me-1"></i> Done
                          </span>
                        )}
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
