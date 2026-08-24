import React from 'react';

export default function LightboxModal({ isOpen, imageSrc, onClose, onNext, onPrev }) {
  if (!isOpen || !imageSrc) return null;

  return (
    <div
      className="fancybox-container fancybox-is-open"
      style={{
        position: 'fixed',
        inset: 0,
        backgroundColor: 'rgba(30, 30, 30, 0.92)',
        zIndex: 99999,
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
      }}
      onClick={onClose}
    >
      <button
        type="button"
        onClick={onClose}
        style={{
          position: 'absolute',
          top: '20px',
          right: '25px',
          background: 'none',
          border: 'none',
          color: '#fff',
          fontSize: '32px',
          cursor: 'pointer',
          zIndex: 100000,
        }}
        aria-label="Close image preview"
      >
        <i className="fa-solid fa-xmark"></i>
      </button>

      {onPrev && (
        <button
          type="button"
          onClick={(e) => {
            e.stopPropagation();
            onPrev();
          }}
          style={{
            position: 'absolute',
            left: '20px',
            background: 'rgba(0,0,0,0.5)',
            border: 'none',
            color: '#fff',
            fontSize: '24px',
            width: '48px',
            height: '48px',
            borderRadius: '50%',
            cursor: 'pointer',
            zIndex: 100000,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
          }}
          aria-label="Previous image"
        >
          <i className="fa-solid fa-chevron-left"></i>
        </button>
      )}

      <div
        style={{ maxWidth: '85vw', maxHeight: '85vh', position: 'relative' }}
        onClick={(e) => e.stopPropagation()}
      >
        <img
          src={imageSrc}
          alt="Gallery Preview"
          style={{
            maxWidth: '100%',
            maxHeight: '85vh',
            objectFit: 'contain',
            borderRadius: '8px',
            boxShadow: '0 10px 40px rgba(0,0,0,0.5)',
          }}
        />
      </div>

      {onNext && (
        <button
          type="button"
          onClick={(e) => {
            e.stopPropagation();
            onNext();
          }}
          style={{
            position: 'absolute',
            right: '20px',
            background: 'rgba(0,0,0,0.5)',
            border: 'none',
            color: '#fff',
            fontSize: '24px',
            width: '48px',
            height: '48px',
            borderRadius: '50%',
            cursor: 'pointer',
            zIndex: 100000,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
          }}
          aria-label="Next image"
        >
          <i className="fa-solid fa-chevron-right"></i>
        </button>
      )}
    </div>
  );
}
