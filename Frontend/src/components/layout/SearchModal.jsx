import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useCart } from '../../context/CartContext';

const SearchModal = () => {
  const { isSearchOpen, setIsSearchOpen } = useCart();
  const [searchTerm, setSearchTerm] = useState('');
  const navigate = useNavigate();

  if (!isSearchOpen) return null;

  const handleSubmit = (e) => {
    e.preventDefault();
    if (searchTerm.trim()) {
      setIsSearchOpen(false);
      navigate(`/shop?search=${encodeURIComponent(searchTerm.trim())}`);
    }
  };

  return (
    <div
      className="search-popup active"
      style={{
        position: 'fixed',
        top: 0,
        left: 0,
        width: '100vw',
        height: '100vh',
        backgroundColor: 'rgba(0, 0, 0, 0.9)',
        zIndex: 9999999,
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        padding: '20px'
      }}
    >
      <button
        className="close-search"
        onClick={() => setIsSearchOpen(false)}
        style={{
          position: 'absolute',
          top: '30px',
          right: '30px',
          background: 'none',
          border: 'none',
          color: '#ffffff',
          fontSize: '28px',
          cursor: 'pointer'
        }}
      >
        <i className="fa-solid fa-xmark"></i>
      </button>

      <div style={{ maxWidth: '600px', width: '100%' }}>
        <form onSubmit={handleSubmit}>
          <div
            className="form-group position-relative"
            style={{
              display: 'flex',
              borderBottom: '2px solid #fa441d'
            }}
          >
            <input
              type="search"
              name="search-field"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              placeholder="Search products, services, articles..."
              autoFocus
              required
              style={{
                width: '100%',
                background: 'transparent',
                border: 'none',
                color: '#ffffff',
                fontSize: '24px',
                padding: '15px 10px',
                outline: 'none'
              }}
            />
            <button
              type="submit"
              style={{
                background: 'none',
                border: 'none',
                color: '#fa441d',
                fontSize: '24px',
                padding: '0 15px',
                cursor: 'pointer'
              }}
            >
              <i className="fa fa-search"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default SearchModal;
