import React from 'react';
import { Link, useLocation } from '../../router/Router';

export default function RoleRegisterSwitcher({ currentRole = '' }) {
  const location = useLocation();
  const activePath = location.pathname;

  const roles = [
    {
      id: 'owner',
      title: 'Pet Owner',
      subtitle: 'For pet parents & caretakers',
      icon: 'fa-solid fa-paw',
      path: '/register/owner',
      badgeColor: '#fa441d',
      activeBg: '#fa441d',
      activeColor: '#ffffff',
    },
    {
      id: 'veterinarian',
      title: 'Veterinarian',
      subtitle: 'For licensed clinic doctors',
      icon: 'fa-solid fa-user-doctor',
      path: '/register/veterinarian',
      badgeColor: '#198754',
      activeBg: '#198754',
      activeColor: '#ffffff',
    },
    {
      id: 'shelter',
      title: 'Animal Shelter',
      subtitle: 'For rescues & sanctuaries',
      icon: 'fa-solid fa-house-chimney-medical',
      path: '/register/shelter',
      badgeColor: '#7b1fa2',
      activeBg: '#7b1fa2',
      activeColor: '#ffffff',
    },
  ];

  return (
    <div className="role-switcher-container mb-4">
      <div
        className="d-flex flex-column flex-md-row gap-3 justify-content-between align-items-stretch"
        style={{ width: '100%' }}
      >
        {roles.map((role) => {
          const isActive =
            currentRole === role.id ||
            activePath === role.path ||
            activePath === `${role.path}.html`;

          return (
            <Link
              key={role.id}
              to={role.path}
              className="role-card-btn text-decoration-none"
              style={{
                flex: 1,
                display: 'flex',
                alignItems: 'center',
                gap: '14px',
                padding: '14px 18px',
                borderRadius: '16px',
                backgroundColor: isActive ? role.activeBg : '#ffffff',
                color: isActive ? role.activeColor : '#222222',
                border: isActive
                  ? `2px solid ${role.activeBg}`
                  : '1.5px solid #ebdcc5',
                boxShadow: isActive
                  ? '0 10px 25px rgba(250, 68, 29, 0.25)'
                  : '0 4px 12px rgba(0, 0, 0, 0.03)',
                transition: 'all 0.25s cubic-bezier(0.4, 0, 0.2, 1)',
                cursor: 'pointer',
                position: 'relative',
                overflow: 'hidden',
              }}
            >
              {/* Icon Bubble */}
              <div
                style={{
                  width: '44px',
                  height: '44px',
                  borderRadius: '12px',
                  backgroundColor: isActive
                    ? 'rgba(255, 255, 255, 0.2)'
                    : '#fff3e0',
                  color: isActive ? '#ffffff' : role.badgeColor,
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  fontSize: '20px',
                  flexShrink: 0,
                  transition: 'transform 0.2s ease',
                }}
              >
                <i className={role.icon}></i>
              </div>

              {/* Text Info */}
              <div style={{ flex: 1, minWidth: 0, textAlign: 'left' }}>
                <div
                  style={{
                    fontSize: '15px',
                    fontWeight: 800,
                    lineHeight: '1.2',
                    marginBottom: '2px',
                    color: isActive ? '#ffffff' : '#1a1a1a',
                    letterSpacing: '-0.2px',
                  }}
                >
                  {role.title}
                </div>
                <div
                  style={{
                    fontSize: '11px',
                    fontWeight: 500,
                    color: isActive ? 'rgba(255, 255, 255, 0.85)' : '#777777',
                    lineHeight: '1.2',
                    whiteSpace: 'nowrap',
                    overflow: 'hidden',
                    textOverflow: 'ellipsis',
                  }}
                >
                  {role.subtitle}
                </div>
              </div>

              {/* Checkmark or indicator on active */}
              {isActive ? (
                <div
                  style={{
                    fontSize: '14px',
                    color: '#ffffff',
                    display: 'flex',
                    alignItems: 'center',
                  }}
                >
                  <i className="fa-solid fa-circle-check"></i>
                </div>
              ) : (
                <div
                  style={{
                    fontSize: '12px',
                    color: '#bbb',
                    display: 'flex',
                    alignItems: 'center',
                  }}
                >
                  <i className="fa-solid fa-chevron-right"></i>
                </div>
              )}
            </Link>
          );
        })}
      </div>
    </div>
  );
}
