import React, { useState, useEffect } from 'react';
import { useNavigate } from '../../router/Router';

export default function SearchModal({ isOpen, onClose }) {
  const [searchTerm, setSearchTerm] = useState('');
  const navigate = useNavigate();

  useEffect(() => {
    if (isOpen) {
      document.body.classList.add('search-active');
    } else {
      document.body.classList.remove('search-active');
    }
    return () => {
      document.body.classList.remove('search-active');
    };
  }, [isOpen]);

  const handleSubmit = (e) => {
    e.preventDefault();
    if (searchTerm.trim()) {
      onClose();
      navigate('/our-products');
    }
  };

  return (
    <div className={`search-popup ${isOpen ? 'active' : ''}`} style={{ display: isOpen ? 'block' : 'none' }}>
      <button
        type="button"
        className="close-search"
        onClick={onClose}
        style={{ cursor: 'pointer' }}
        aria-label="Close search"
      >
        <i className="fa-solid fa-arrow-right"></i>
      </button>
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <input
            type="search"
            name="search-field"
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            placeholder="Search Here"
            required
            autoFocus={isOpen}
          />
          <button type="submit" aria-label="Submit search">
            <i className="fa fa-search"></i>
          </button>
        </div>
      </form>
    </div>
  );
}
