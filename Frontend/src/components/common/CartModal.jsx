import React from 'react';
import { Link } from '../../router/Router';

export default function CartModal({ isOpen, onClose, cartItems, onRemoveItem }) {
  const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0).toFixed(2);

  return (
    <>
      <div id="lightbox" className={`lightbox clearfix ${isOpen ? 'active' : ''}`} style={{ display: 'block' }}>
        <div
          className="white_content"
          style={{
            position: 'fixed',
            top: 0,
            right: isOpen ? '0' : '-1000px',
            width: isOpen ? '360px' : '0',
            maxWidth: '90vw',
            height: '100vh',
            backgroundColor: '#fff',
            zIndex: 9999,
            transition: 'right 0.35s ease-in-out, opacity 0.35s ease-in-out',
            opacity: isOpen ? 1 : 0,
            overflowY: 'auto',
            padding: '30px 20px',
            boxShadow: isOpen ? '-5px 0 25px rgba(0,0,0,0.15)' : 'none',
          }}
        >
          <button
            type="button"
            className="textright"
            id="close"
            onClick={onClose}
            style={{ background: 'none', border: 'none', cursor: 'pointer', float: 'right', fontSize: '24px' }}
            aria-label="Close cart"
          >
            <i className="fa-regular fa-circle-xmark"></i>
          </button>
          <div style={{ clear: 'both' }}></div>

          <div className="cart-popup show-cart" style={{ display: 'block', padding: '10px 0' }}>
            {cartItems.length === 0 ? (
              <div style={{ textAlign: 'center', padding: '40px 0' }}>
                <p>Your cart is empty.</p>
              </div>
            ) : (
              <ul>
                {cartItems.map((item) => (
                  <li key={item.id} className="d-flex align-items-center position-relative mb-3">
                    <div className="p-img light-bg" style={{ width: '65px', height: '65px', flexShrink: 0, display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                      <img src={item.image} alt={item.name} style={{ maxHeight: '100%', maxWidth: '100%', objectFit: 'contain' }} />
                    </div>
                    <div className="p-data ms-3">
                      <h3 className="font-semi-bold" style={{ fontSize: '16px', margin: '0 0 5px 0' }}>{item.name}</h3>
                      <p className="theme-clr font-semi-bold" style={{ margin: 0 }}>
                        {item.quantity} x ${item.price.toFixed(2)}
                      </p>
                    </div>
                    <button
                      type="button"
                      id="cross"
                      onClick={() => onRemoveItem(item.id)}
                      style={{
                        background: 'none',
                        border: 'none',
                        cursor: 'pointer',
                        position: 'absolute',
                        right: '0',
                        top: '50%',
                        transform: 'translateY(-50%)',
                        color: '#999',
                        fontSize: '18px',
                      }}
                      aria-label="Remove item"
                    >
                      <i className="fa-solid fa-xmark"></i>
                    </button>
                  </li>
                ))}
              </ul>
            )}

            {cartItems.length > 0 && (
              <>
                <div className="cart-total d-flex align-items-center justify-content-between my-3 pt-3" style={{ borderTop: '1px solid #eee' }}>
                  <span className="font-semi-bold" style={{ fontSize: '18px', fontWeight: 'bold' }}>Total:</span>
                  <span className="font-semi-bold" style={{ fontSize: '18px', fontWeight: 'bold', color: '#fa441d' }}>${total}</span>
                </div>

                <div className="cart-btns d-flex align-items-center justify-content-between mt-4">
                  <Link className="font-bold button" to="/shop-cart" onClick={onClose} style={{ padding: '10px 18px', fontSize: '14px' }}>
                    View Cart
                  </Link>
                  <Link className="font-bold button checkout" to="/cart-checkout" onClick={onClose} style={{ padding: '10px 18px', fontSize: '14px' }}>
                    Checkout
                  </Link>
                </div>
              </>
            )}
          </div>
        </div>
      </div>

      {isOpen && (
        <div
          onClick={onClose}
          style={{
            position: 'fixed',
            inset: 0,
            backgroundColor: 'rgba(0, 0, 0, 0.5)',
            zIndex: 9998,
            transition: 'opacity 0.3s ease',
          }}
        />
      )}
    </>
  );
}
