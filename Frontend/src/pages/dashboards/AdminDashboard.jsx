import React, { useState, useEffect, useCallback } from 'react';
import { useAuth } from '../../context/AuthContext';
import { authService } from '../../services/auth.service';

export default function AdminDashboard() {
  const { user, logout, logoutAll } = useAuth();

  const [activeTab, setActiveTab] = useState('users'); // 'users', 'audit', 'stats'
  const [stats, setStats] = useState({
    totalUsers: 0,
    roleBreakdown: { owner: 0, veterinarian: 0, shelter: 0, admin: 0 },
    activeSessionsCount: 0,
    recentAuditEvents24h: 0,
  });

  const [users, setUsers] = useState([]);
  const [userPagination, setUserPagination] = useState({ page: 1, totalPages: 1, totalItems: 0 });
  const [roleFilter, setRoleFilter] = useState('');
  const [statusFilter, setStatusFilter] = useState('');
  const [searchQuery, setSearchQuery] = useState('');

  const [auditLogs, setAuditLogs] = useState([]);
  const [auditPagination, setAuditPagination] = useState({ page: 1, totalPages: 1, totalItems: 0 });

  const [loading, setLoading] = useState(false);
  const [statusActionMsg, setStatusActionMsg] = useState('');
  const [errorMsg, setErrorMsg] = useState('');

  const fetchStats = useCallback(async () => {
    try {
      const res = await authService.getAdminStats();
      if (res.success && res.data) {
        setStats(res.data);
      }
    } catch {
      // Keep existing stats on failure
    }
  }, []);

  const fetchUsers = useCallback(async (page = 1) => {
    setLoading(true);
    try {
      const res = await authService.getAdminUsers({
        page,
        limit: 10,
        role: roleFilter || undefined,
        status: statusFilter || undefined,
        search: searchQuery || undefined,
      });
      if (res.success && res.data) {
        setUsers(res.data.users);
        setUserPagination(res.data.pagination);
      }
    } catch (err) {
      setErrorMsg(err.response?.data?.message || 'Failed to fetch users');
    } finally {
      setLoading(false);
    }
  }, [roleFilter, statusFilter, searchQuery]);

  const fetchAuditLogs = useCallback(async (page = 1) => {
    setLoading(true);
    try {
      const res = await authService.getAdminAuditLogs({ page, limit: 15 });
      if (res.success && res.data) {
        setAuditLogs(res.data.logs);
        setAuditPagination(res.data.pagination);
      }
    } catch (err) {
      setErrorMsg(err.response?.data?.message || 'Failed to fetch audit logs');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchStats();
  }, [fetchStats]);

  useEffect(() => {
    if (activeTab === 'users') {
      fetchUsers(userPagination.page);
    } else if (activeTab === 'audit') {
      fetchAuditLogs(auditPagination.page);
    }
  }, [activeTab, fetchUsers, fetchAuditLogs, userPagination.page, auditPagination.page]);

  const handleUpdateStatus = async (targetUserId, newStatus) => {
    try {
      setStatusActionMsg('');
      setErrorMsg('');
      const res = await authService.updateAdminUserStatus(targetUserId, newStatus);
      if (res.success) {
        setStatusActionMsg(`User status updated to ${newStatus}`);
        fetchUsers(userPagination.page);
        fetchStats();
        setTimeout(() => setStatusActionMsg(''), 3000);
      }
    } catch (err) {
      setErrorMsg(err.response?.data?.message || 'Failed to update user status');
    }
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
                <i className="fa-solid fa-user-shield me-1"></i> Root Administration
              </span>
              <h2 style={{ fontSize: '36px', fontWeight: 800, margin: 0, color: '#222' }}>
                System Administration Console
              </h2>
              <p className="text-muted mt-1 mb-0" style={{ fontSize: '14px' }}>
                Logged in as <strong>{user?.name}</strong> ({user?.email})
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

      {/* Main Admin Content */}
      <section className="gap" style={{ padding: '50px 0' }}>
        <div className="container">
          {statusActionMsg && (
            <div
              className="alert alert-success d-flex align-items-center mb-4"
              style={{ borderRadius: '12px' }}
            >
              <i className="fa-solid fa-circle-check me-2 fs-5"></i>
              <div>{statusActionMsg}</div>
            </div>
          )}

          {errorMsg && (
            <div
              className="alert alert-danger d-flex align-items-center mb-4"
              style={{ borderRadius: '12px' }}
            >
              <i className="fa-solid fa-circle-exclamation me-2 fs-5"></i>
              <div>{errorMsg}</div>
            </div>
          )}

          {/* Platform Metrics */}
          <div className="row g-4 mb-5">
            <div className="col-lg-3 col-sm-6">
              <div
                className="p-4"
                style={{
                  backgroundColor: '#fff',
                  borderRadius: '18px',
                  boxShadow: '0 8px 24px rgba(0,0,0,0.04)',
                  border: '1px solid #faeedb',
                }}
              >
                <div className="d-flex justify-content-between align-items-center mb-2">
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    TOTAL ACCOUNTS
                  </span>
                  <div
                    style={{
                      width: '40px',
                      height: '40px',
                      borderRadius: '10px',
                      backgroundColor: '#fff3e0',
                      color: '#fa441d',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                    }}
                  >
                    <i className="fa-solid fa-users"></i>
                  </div>
                </div>
                <h3 style={{ fontSize: '28px', fontWeight: 800, margin: 0, color: '#222' }}>
                  {stats.totalUsers}
                </h3>
                <div className="mt-2 text-muted" style={{ fontSize: '12px' }}>
                  {stats.roleBreakdown.owner} Owners • {stats.roleBreakdown.veterinarian} Vets • {stats.roleBreakdown.shelter} Shelters
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
                }}
              >
                <div className="d-flex justify-content-between align-items-center mb-2">
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    VET CLINICS
                  </span>
                  <div
                    style={{
                      width: '40px',
                      height: '40px',
                      borderRadius: '10px',
                      backgroundColor: '#e8f5e9',
                      color: '#2e7d32',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                    }}
                  >
                    <i className="fa-solid fa-user-doctor"></i>
                  </div>
                </div>
                <h3 style={{ fontSize: '28px', fontWeight: 800, margin: 0, color: '#222' }}>
                  {stats.roleBreakdown.veterinarian}
                </h3>
                <div className="mt-2 text-muted" style={{ fontSize: '12px' }}>
                  Verified Veterinarians
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
                }}
              >
                <div className="d-flex justify-content-between align-items-center mb-2">
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    ACTIVE SESSIONS
                  </span>
                  <div
                    style={{
                      width: '40px',
                      height: '40px',
                      borderRadius: '10px',
                      backgroundColor: '#e3f2fd',
                      color: '#1565c0',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                    }}
                  >
                    <i className="fa-solid fa-network-wired"></i>
                  </div>
                </div>
                <h3 style={{ fontSize: '28px', fontWeight: 800, margin: 0, color: '#222' }}>
                  {stats.activeSessionsCount}
                </h3>
                <div className="mt-2 text-muted" style={{ fontSize: '12px' }}>
                  Active HttpOnly Sessions
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
                }}
              >
                <div className="d-flex justify-content-between align-items-center mb-2">
                  <span className="text-muted" style={{ fontSize: '13px', fontWeight: 600 }}>
                    24H AUDIT EVENTS
                  </span>
                  <div
                    style={{
                      width: '40px',
                      height: '40px',
                      borderRadius: '10px',
                      backgroundColor: '#f3e5f5',
                      color: '#7b1fa2',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                    }}
                  >
                    <i className="fa-solid fa-shield-halved"></i>
                  </div>
                </div>
                <h3 style={{ fontSize: '28px', fontWeight: 800, margin: 0, color: '#222' }}>
                  {stats.recentAuditEvents24h}
                </h3>
                <div className="mt-2 text-muted" style={{ fontSize: '12px' }}>
                  Security & Auth Events
                </div>
              </div>
            </div>
          </div>

          {/* Navigation Tabs */}
          <div className="d-flex gap-3 mb-4">
            <button
              onClick={() => setActiveTab('users')}
              className={`button ${activeTab === 'users' ? '' : 'btn-outline'}`}
              style={{
                backgroundColor: activeTab === 'users' ? '#fa441d' : 'transparent',
                color: activeTab === 'users' ? '#fff' : '#222',
                border: '1px solid #fa441d',
                padding: '10px 24px',
                borderRadius: '12px',
                fontWeight: 700,
              }}
            >
              <i className="fa-solid fa-users-gear me-1"></i> User Management
            </button>
            <button
              onClick={() => setActiveTab('audit')}
              className={`button ${activeTab === 'audit' ? '' : 'btn-outline'}`}
              style={{
                backgroundColor: activeTab === 'audit' ? '#fa441d' : 'transparent',
                color: activeTab === 'audit' ? '#fff' : '#222',
                border: '1px solid #fa441d',
                padding: '10px 24px',
                borderRadius: '12px',
                fontWeight: 700,
              }}
            >
              <i className="fa-solid fa-list-check me-1"></i> Security Audit Logs
            </button>
          </div>

          {/* TAB 1: User Management */}
          {activeTab === 'users' && (
            <div
              className="p-4"
              style={{
                backgroundColor: '#fff',
                borderRadius: '20px',
                boxShadow: '0 10px 30px rgba(0,0,0,0.05)',
                border: '1px solid #f0e6d6',
              }}
            >
              {/* Filters */}
              <div className="row g-3 mb-4">
                <div className="col-md-4">
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Search name, email, or phone..."
                    value={searchQuery}
                    onChange={(e) => setSearchQuery(e.target.value)}
                    style={{ borderRadius: '10px', padding: '10px 14px' }}
                  />
                </div>
                <div className="col-md-3">
                  <select
                    className="form-select"
                    value={roleFilter}
                    onChange={(e) => setRoleFilter(e.target.value)}
                    style={{ borderRadius: '10px', padding: '10px 14px' }}
                  >
                    <option value="">All Roles</option>
                    <option value="owner">Pet Owner</option>
                    <option value="veterinarian">Veterinarian</option>
                    <option value="shelter">Shelter</option>
                    <option value="admin">Administrator</option>
                  </select>
                </div>
                <div className="col-md-3">
                  <select
                    className="form-select"
                    value={statusFilter}
                    onChange={(e) => setStatusFilter(e.target.value)}
                    style={{ borderRadius: '10px', padding: '10px 14px' }}
                  >
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="suspended">Suspended</option>
                    <option value="disabled">Disabled</option>
                  </select>
                </div>
                <div className="col-md-2 d-flex">
                  <button
                    onClick={() => fetchUsers(1)}
                    className="button w-100"
                    style={{
                      borderRadius: '10px',
                      backgroundColor: '#fa441d',
                      color: '#fff',
                      border: 'none',
                      fontWeight: 600,
                    }}
                  >
                    <i className="fa-solid fa-filter me-1"></i> Filter
                  </button>
                </div>
              </div>

              {/* Table */}
              <div className="table-responsive">
                <table className="table align-middle">
                  <thead style={{ backgroundColor: '#faf7f2' }}>
                    <tr>
                      <th style={{ padding: '12px 16px', borderRadius: '8px 0 0 8px' }}>USER</th>
                      <th style={{ padding: '12px 16px' }}>ROLE</th>
                      <th style={{ padding: '12px 16px' }}>CONTACT</th>
                      <th style={{ padding: '12px 16px' }}>STATUS</th>
                      <th style={{ padding: '12px 16px', borderRadius: '0 8px 8px 0', textAlign: 'right' }}>
                        ADMIN CONTROLS
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    {loading ? (
                      <tr>
                        <td colSpan="5" className="text-center py-5">
                          <div className="spinner-border text-danger" role="status"></div>
                        </td>
                      </tr>
                    ) : users.length === 0 ? (
                      <tr>
                        <td colSpan="5" className="text-center py-4 text-muted">
                          No users matching search filters
                        </td>
                      </tr>
                    ) : (
                      users.map((u) => (
                        <tr key={u.id} style={{ borderBottom: '1px solid #f0e6d6' }}>
                          <td style={{ padding: '16px' }}>
                            <div style={{ fontWeight: 700, color: '#222' }}>{u.name}</div>
                            <div className="text-muted" style={{ fontSize: '13px' }}>
                              {u.email}
                            </div>
                          </td>
                          <td style={{ padding: '16px' }}>
                            <span
                              style={{
                                padding: '4px 10px',
                                borderRadius: '12px',
                                fontSize: '12px',
                                fontWeight: 700,
                                textTransform: 'capitalize',
                                backgroundColor:
                                  u.role === 'admin'
                                    ? '#fee2e2'
                                    : u.role === 'veterinarian'
                                    ? '#dcfce7'
                                    : u.role === 'shelter'
                                    ? '#f3e8ff'
                                    : '#e0f2fe',
                                color:
                                  u.role === 'admin'
                                    ? '#991b1b'
                                    : u.role === 'veterinarian'
                                    ? '#166534'
                                    : u.role === 'shelter'
                                    ? '#6b21a8'
                                    : '#075985',
                              }}
                            >
                              {u.role}
                            </span>
                          </td>
                          <td style={{ padding: '16px', fontSize: '13px' }}>
                            <div>{u.phone}</div>
                            <div className="text-muted">{u.address}</div>
                          </td>
                          <td style={{ padding: '16px' }}>
                            <span
                              style={{
                                padding: '4px 10px',
                                borderRadius: '12px',
                                fontSize: '12px',
                                fontWeight: 700,
                                textTransform: 'capitalize',
                                backgroundColor:
                                  u.status === 'active'
                                    ? '#e8f5e9'
                                    : u.status === 'suspended'
                                    ? '#ffebee'
                                    : '#fff3e0',
                                color:
                                  u.status === 'active'
                                    ? '#2e7d32'
                                    : u.status === 'suspended'
                                    ? '#c62828'
                                    : '#e65100',
                              }}
                            >
                              {u.status}
                            </span>
                          </td>
                          <td style={{ padding: '16px', textAlign: 'right' }}>
                            {u.role !== 'admin' && (
                              <div className="btn-group">
                                {u.status !== 'active' && (
                                  <button
                                    onClick={() => handleUpdateStatus(u.id, 'active')}
                                    className="btn btn-sm btn-outline-success"
                                    title="Activate Account"
                                  >
                                    Activate
                                  </button>
                                )}
                                {u.status !== 'suspended' && (
                                  <button
                                    onClick={() => handleUpdateStatus(u.id, 'suspended')}
                                    className="btn btn-sm btn-outline-warning"
                                    title="Suspend Account"
                                  >
                                    Suspend
                                  </button>
                                )}
                                {u.status !== 'disabled' && (
                                  <button
                                    onClick={() => handleUpdateStatus(u.id, 'disabled')}
                                    className="btn btn-sm btn-outline-danger"
                                    title="Disable Account"
                                  >
                                    Disable
                                  </button>
                                )}
                              </div>
                            )}
                          </td>
                        </tr>
                      ))
                    )}
                  </tbody>
                </table>
              </div>

              {/* Pagination */}
              {userPagination.totalPages > 1 && (
                <div className="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                  <span className="text-muted" style={{ fontSize: '13px' }}>
                    Showing page {userPagination.page} of {userPagination.totalPages} (
                    {userPagination.totalItems} total users)
                  </span>
                  <div className="d-flex gap-2">
                    <button
                      onClick={() => fetchUsers(userPagination.page - 1)}
                      disabled={userPagination.page <= 1}
                      className="btn btn-sm btn-outline-secondary"
                    >
                      Previous
                    </button>
                    <button
                      onClick={() => fetchUsers(userPagination.page + 1)}
                      disabled={userPagination.page >= userPagination.totalPages}
                      className="btn btn-sm btn-outline-secondary"
                    >
                      Next
                    </button>
                  </div>
                </div>
              )}
            </div>
          )}

          {/* TAB 2: Audit Logs */}
          {activeTab === 'audit' && (
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
                    Security Audit Trail
                  </h4>
                  <p className="text-muted mb-0" style={{ fontSize: '14px' }}>
                    Immutable records of authentications, registrations, password resets, and admin actions
                  </p>
                </div>
                <button
                  onClick={() => fetchAuditLogs(1)}
                  className="button btn-outline"
                  style={{ padding: '8px 16px', borderRadius: '8px', fontSize: '13px' }}
                >
                  <i className="fa-solid fa-rotate me-1"></i> Refresh Logs
                </button>
              </div>

              <div className="table-responsive">
                <table className="table align-middle">
                  <thead style={{ backgroundColor: '#faf7f2' }}>
                    <tr>
                      <th style={{ padding: '12px 16px', borderRadius: '8px 0 0 8px' }}>TIMESTAMP</th>
                      <th style={{ padding: '12px 16px' }}>ACTION</th>
                      <th style={{ padding: '12px 16px' }}>USER / INITIATOR</th>
                      <th style={{ padding: '12px 16px' }}>STATUS</th>
                      <th style={{ padding: '12px 16px', borderRadius: '0 8px 8px 0' }}>IP ADDRESS</th>
                    </tr>
                  </thead>
                  <tbody>
                    {loading ? (
                      <tr>
                        <td colSpan="5" className="text-center py-5">
                          <div className="spinner-border text-danger" role="status"></div>
                        </td>
                      </tr>
                    ) : auditLogs.length === 0 ? (
                      <tr>
                        <td colSpan="5" className="text-center py-4 text-muted">
                          No audit records found
                        </td>
                      </tr>
                    ) : (
                      auditLogs.map((log) => (
                        <tr key={log._id} style={{ borderBottom: '1px solid #f0e6d6' }}>
                          <td style={{ padding: '14px 16px', fontSize: '13px', color: '#555' }}>
                            {new Date(log.createdAt).toLocaleString()}
                          </td>
                          <td style={{ padding: '14px 16px' }}>
                            <code
                              style={{
                                padding: '3px 8px',
                                borderRadius: '6px',
                                backgroundColor: '#f1f5f9',
                                color: '#0f172a',
                                fontWeight: 700,
                                fontSize: '12px',
                              }}
                            >
                              {log.action}
                            </code>
                          </td>
                          <td style={{ padding: '14px 16px', fontSize: '13px' }}>
                            {log.userId?.name ? (
                              <div>
                                <strong>{log.userId.name}</strong> ({log.userId.role})
                              </div>
                            ) : (
                              <span className="text-muted">Unauthenticated / System</span>
                            )}
                          </td>
                          <td style={{ padding: '14px 16px' }}>
                            <span
                              style={{
                                padding: '3px 8px',
                                borderRadius: '10px',
                                fontSize: '11px',
                                fontWeight: 700,
                                backgroundColor: log.status === 'SUCCESS' ? '#e8f5e9' : '#ffebee',
                                color: log.status === 'SUCCESS' ? '#2e7d32' : '#c62828',
                              }}
                            >
                              {log.status}
                            </span>
                          </td>
                          <td style={{ padding: '14px 16px', fontSize: '12px', fontFamily: 'monospace' }}>
                            {log.ipAddress || 'unknown'}
                          </td>
                        </tr>
                      ))
                    )}
                  </tbody>
                </table>
              </div>

              {auditPagination.totalPages > 1 && (
                <div className="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                  <span className="text-muted" style={{ fontSize: '13px' }}>
                    Showing page {auditPagination.page} of {auditPagination.totalPages}
                  </span>
                  <div className="d-flex gap-2">
                    <button
                      onClick={() => fetchAuditLogs(auditPagination.page - 1)}
                      disabled={auditPagination.page <= 1}
                      className="btn btn-sm btn-outline-secondary"
                    >
                      Previous
                    </button>
                    <button
                      onClick={() => fetchAuditLogs(auditPagination.page + 1)}
                      disabled={auditPagination.page >= auditPagination.totalPages}
                      className="btn btn-sm btn-outline-secondary"
                    >
                      Next
                    </button>
                  </div>
                </div>
              )}
            </div>
          )}
        </div>
      </section>
    </>
  );
}
