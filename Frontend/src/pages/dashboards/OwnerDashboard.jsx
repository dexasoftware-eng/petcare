import React, { useState } from 'react';
import { useAuth } from '../../context/AuthContext';
import { Link } from '../../router/Router';

export default function OwnerDashboard() {
  const { user, logout, logoutAll } = useAuth();
  const [pets, setPets] = useState([
    {
      id: 1,
      name: 'Milo',
      breed: 'Golden Retriever',
      age: '3 yrs',
      gender: 'Male',
      weight: '31 kg',
      vaccination: 'Up to Date',
      avatar: '/assets/img/dog-1.png',
    },
    {
      id: 2,
      name: 'Luna',
      breed: 'British Shorthair',
      age: '1.5 yrs',
      gender: 'Female',
      weight: '4.2 kg',
      vaccination: 'Due in 2 Weeks',
      avatar: '/assets/img/cat-1.png',
    },
  ]);

  const [showAddPet, setShowAddPet] = useState(false);
  const [newPet, setNewPet] = useState({ name: '', breed: '', age: '', gender: 'Male', weight: '' });
  const [actionSuccess, setActionSuccess] = useState('');

  const handleAddPet = (e) => {
    e.preventDefault();
    if (!newPet.name) return;

    setPets([
      ...pets,
      {
        id: Date.now(),
        ...newPet,
        vaccination: 'Scheduled',
        avatar: '/assets/img/dog-1.png',
      },
    ]);
    setNewPet({ name: '', breed: '', age: '', gender: 'Male', weight: '' });
    setShowAddPet(false);
    setActionSuccess('Pet profile created successfully!');
    setTimeout(() => setActionSuccess(''), 3000);
  };

  return (
    <>
      {/* Banner */}
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
                  backgroundColor: '#fa441d',
                  color: '#fff',
                  borderRadius: '20px',
                  fontSize: '12px',
                  fontWeight: 700,
                  textTransform: 'uppercase',
                  marginBottom: '8px',
                }}
              >
                <i className="fa-solid fa-paw me-1"></i> Pet Owner Portal
              </span>
              <h2 style={{ fontSize: '36px', fontWeight: 800, margin: 0, color: '#222' }}>
                Welcome back, {user?.name}!
              </h2>
              <p className="text-muted mt-1 mb-0" style={{ fontSize: '15px' }}>
                <i className="fa-solid fa-envelope me-1"></i> {user?.email} •{' '}
                <i className="fa-solid fa-location-dot me-1"></i> {user?.address}
              </p>
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

      {/* Main Dashboard Body */}
      <section className="gap" style={{ padding: '60px 0' }}>
        <div className="container">
          {actionSuccess && (
            <div
              className="alert alert-success d-flex align-items-center mb-4"
              style={{ borderRadius: '12px' }}
            >
              <i className="fa-solid fa-circle-check me-2 fs-5"></i>
              <div>{actionSuccess}</div>
            </div>
          )}

          {/* Quick Metrics */}
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
                    backgroundColor: '#fff3e0',
                    color: '#fa441d',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '22px',
                  }}
                >
                  <i className="fa-solid fa-dog"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    {pets.length}
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Registered Pets
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
                  <i className="fa-solid fa-stethoscope"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    1
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Upcoming Checkup
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
                  <i className="fa-solid fa-cart-shopping"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    3
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Care Orders
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
                  <i className="fa-solid fa-bell"></i>
                </div>
                <div>
                  <h4 style={{ fontSize: '24px', fontWeight: 800, margin: 0, color: '#222' }}>
                    2
                  </h4>
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    Health Reminders
                  </span>
                </div>
              </div>
            </div>
          </div>

          {/* Pet Profiles Section */}
          <div className="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h3 style={{ fontWeight: 800, color: '#222', margin: 0 }}>My Companion Pets</h3>
              <p className="text-muted mb-0">Track vaccination timelines, dietary schedules, and records</p>
            </div>
            <button
              onClick={() => setShowAddPet(!showAddPet)}
              className="button"
              style={{
                padding: '10px 20px',
                borderRadius: '12px',
                backgroundColor: '#fa441d',
                color: '#fff',
                fontWeight: 600,
                border: 'none',
              }}
            >
              <i className="fa-solid fa-plus me-1"></i> Add New Pet
            </button>
          </div>

          {/* Add Pet Form Modal / Dropdown */}
          {showAddPet && (
            <div
              className="p-4 mb-4"
              style={{
                backgroundColor: '#fff8e5',
                borderRadius: '20px',
                border: '1px solid #fce3b8',
              }}
            >
              <h5 style={{ fontWeight: 700, marginBottom: '16px' }}>Register Companion Pet</h5>
              <form onSubmit={handleAddPet}>
                <div className="row g-3">
                  <div className="col-md-3">
                    <label className="form-label" style={{ fontWeight: 600, fontSize: '13px' }}>
                      Pet Name
                    </label>
                    <input
                      type="text"
                      className="form-control"
                      placeholder="e.g. Rocky"
                      value={newPet.name}
                      onChange={(e) => setNewPet({ ...newPet, name: e.target.value })}
                      required
                    />
                  </div>
                  <div className="col-md-3">
                    <label className="form-label" style={{ fontWeight: 600, fontSize: '13px' }}>
                      Breed / Species
                    </label>
                    <input
                      type="text"
                      className="form-control"
                      placeholder="e.g. Labrador Retriever"
                      value={newPet.breed}
                      onChange={(e) => setNewPet({ ...newPet, breed: e.target.value })}
                      required
                    />
                  </div>
                  <div className="col-md-2">
                    <label className="form-label" style={{ fontWeight: 600, fontSize: '13px' }}>
                      Age
                    </label>
                    <input
                      type="text"
                      className="form-control"
                      placeholder="e.g. 2 yrs"
                      value={newPet.age}
                      onChange={(e) => setNewPet({ ...newPet, age: e.target.value })}
                    />
                  </div>
                  <div className="col-md-2">
                    <label className="form-label" style={{ fontWeight: 600, fontSize: '13px' }}>
                      Gender
                    </label>
                    <select
                      className="form-select"
                      value={newPet.gender}
                      onChange={(e) => setNewPet({ ...newPet, gender: e.target.value })}
                    >
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div className="col-md-2">
                    <label className="form-label" style={{ fontWeight: 600, fontSize: '13px' }}>
                      Weight
                    </label>
                    <input
                      type="text"
                      className="form-control"
                      placeholder="e.g. 15 kg"
                      value={newPet.weight}
                      onChange={(e) => setNewPet({ ...newPet, weight: e.target.value })}
                    />
                  </div>
                  <div className="col-12 d-flex justify-content-end gap-2 mt-3">
                    <button
                      type="button"
                      onClick={() => setShowAddPet(false)}
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
                        backgroundColor: '#fa441d',
                        color: '#fff',
                        border: 'none',
                      }}
                    >
                      Save Pet Profile
                    </button>
                  </div>
                </div>
              </form>
            </div>
          )}

          {/* Pet Cards List */}
          <div className="row g-4">
            {pets.map((pet) => (
              <div key={pet.id} className="col-lg-6">
                <div
                  className="p-4"
                  style={{
                    backgroundColor: '#fff',
                    borderRadius: '20px',
                    boxShadow: '0 10px 30px rgba(0,0,0,0.05)',
                    border: '1px solid #f0e6d6',
                  }}
                >
                  <div className="d-flex justify-content-between align-items-start mb-3">
                    <div className="d-flex align-items-center gap-3">
                      <div
                        style={{
                          width: '60px',
                          height: '60px',
                          borderRadius: '16px',
                          backgroundColor: '#fff8e5',
                          border: '1px solid #fce3b8',
                          display: 'flex',
                          alignItems: 'center',
                          justifyContent: 'center',
                          fontSize: '28px',
                          color: '#fa441d',
                        }}
                      >
                        <i className="fa-solid fa-paw"></i>
                      </div>
                      <div>
                        <h4 style={{ fontWeight: 800, margin: 0, color: '#222' }}>{pet.name}</h4>
                        <span className="text-muted" style={{ fontSize: '14px' }}>
                          {pet.breed}
                        </span>
                      </div>
                    </div>
                    <span
                      style={{
                        padding: '4px 10px',
                        borderRadius: '20px',
                        fontSize: '12px',
                        fontWeight: 700,
                        backgroundColor:
                          pet.vaccination === 'Up to Date' ? '#e8f5e9' : '#fff3e0',
                        color: pet.vaccination === 'Up to Date' ? '#2e7d32' : '#e65100',
                      }}
                    >
                      {pet.vaccination}
                    </span>
                  </div>

                  <div className="row g-2 mb-3 text-center">
                    <div className="col-4">
                      <div
                        className="p-2"
                        style={{ backgroundColor: '#faf7f2', borderRadius: '10px' }}
                      >
                        <div className="text-muted" style={{ fontSize: '11px', fontWeight: 600 }}>
                          AGE
                        </div>
                        <div style={{ fontWeight: 700, fontSize: '14px' }}>{pet.age}</div>
                      </div>
                    </div>
                    <div className="col-4">
                      <div
                        className="p-2"
                        style={{ backgroundColor: '#faf7f2', borderRadius: '10px' }}
                      >
                        <div className="text-muted" style={{ fontSize: '11px', fontWeight: 600 }}>
                          GENDER
                        </div>
                        <div style={{ fontWeight: 700, fontSize: '14px' }}>{pet.gender}</div>
                      </div>
                    </div>
                    <div className="col-4">
                      <div
                        className="p-2"
                        style={{ backgroundColor: '#faf7f2', borderRadius: '10px' }}
                      >
                        <div className="text-muted" style={{ fontSize: '11px', fontWeight: 600 }}>
                          WEIGHT
                        </div>
                        <div style={{ fontWeight: 700, fontSize: '14px' }}>{pet.weight}</div>
                      </div>
                    </div>
                  </div>

                  <div className="d-flex justify-content-between align-items-center pt-2">
                    <Link
                      to="/services"
                      style={{ color: '#fa441d', fontWeight: 600, fontSize: '14px', textDecoration: 'none' }}
                    >
                      <i className="fa-solid fa-calendar-check me-1"></i> Book Checkup
                    </Link>
                    <Link
                      to="/our-products"
                      style={{ color: '#222', fontWeight: 600, fontSize: '14px', textDecoration: 'none' }}
                    >
                      <i className="fa-solid fa-bag-shopping me-1"></i> Buy Supplies
                    </Link>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </>
  );
}
