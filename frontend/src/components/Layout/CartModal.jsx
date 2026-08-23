import React from 'react';
import { Link } from 'react-router-dom';
import { useCart } from '../../context/CartContext';

const CartModal = () => {
  const { isCartOpen, setIsCartOpen, cartItems, removeFromCart, cartTotal } = useCart();

  if (!isCartOpen) return null;

  return (
    <div
      id="lightbox"
      className="lightbox clearfix active"
      style={{
        display: 'block',
        position: 'fixed',
        top: 0,
        left: 0,
        width: '100vw',
        height: '100vh',
        backgroundColor: 'rgba(0, 0, 0, 0.75)',
        zIndex: 999999,
        transition: 'opacity 0.3s ease'
      }}
      onClick={() => setIsCartOpen(false)}
    >
      <div
        className="white_content"
        style={{
          position: 'absolute',
          top: '50%',
          left: '50%',
          transform: 'translate(-50%, -50%)',
          background: '#ffffff',
          borderRadius: '20px',
          padding: '40px 30px',
          maxWidth: '450px',
          width: '90%',
          boxShadow: '0 20px 40px rgba(0,0,0,0.2)'
        }}
        onClick={(e) => e.stopPropagation()}
      >
        <a
          href="#close"
          className="textright"
          id="close"
          onClick={(e) => {
            e.preventDefault();
            setIsCartOpen(false);
          }}
          style={{
            position: 'absolute',
            top: '15px',
            right: '20px',
            fontSize: '22px',
            color: '#222222'
          }}
        >
          <i className="fa-regular fa-circle-xmark"></i>
        </a>

        <div className="cart-popup">
          {cartItems.length === 0 ? (
            <div className="text-center py-4">
              <i className="fa-solid fa-basket-shopping fa-3x text-muted mb-3"></i>
              <p className="mb-0">Your cart is currently empty.</p>
            </div>
          ) : (
            <>
              <ul className="list-unstyled mb-0">
                {cartItems.map((item) => (
                  <li
                    key={item.id}
                    className="d-flex align-items-center position-relative mb-3 pb-3 border-bottom"
                  >
                    <div
                      className="p-img light-bg me-3 p-2 rounded"
                      style={{ background: '#f8f8f8', width: '70px', height: '70px', display: 'flex', alignItems: 'center', justifyContent: 'center' }}
                    >
                      <img
                        src={item.img}
                        alt={item.name}
                        style={{ maxWidth: '100%', maxHeight: '100%', objectFit: 'contain' }}
                      />
                    </div>
                    <div className="p-data flex-grow-1">
                      <h3
                        className="font-semi-bold mb-1"
                        style={{ fontSize: '16px', color: '#222' }}
                      >
                        {item.name}
                      </h3>
                      <p
                        className="theme-clr font-semi-bold mb-0"
                        style={{ color: '#fa441d', fontWeight: '600' }}
                      >
                        {item.quantity} x ${item.price.toFixed(2)}
                      </p>
                    </div>
                    <a
                      href="#remove"
                      onClick={(e) => {
                        e.preventDefault();
                        removeFromCart(item.id);
                      }}
                      style={{ color: '#fa441d', fontSize: '18px', cursor: 'pointer' }}
                    >
                      <i className="fa-solid fa-xmark"></i>
                    </a>
                  </li>
                ))}
              </ul>

              <div className="cart-total d-flex align-items-center justify-content-between mt-3 mb-3">
                <span className="font-semi-bold" style={{ fontWeight: '700', fontSize: '18px' }}>Total:</span>
                <span className="font-semi-bold" style={{ fontWeight: '700', fontSize: '20px', color: '#fa441d' }}>
                  ${cartTotal}
                </span>
              </div>

              <div className="cart-btns d-flex align-items-center justify-content-between gap-3">
                <Link
                  className="font-bold button btn-sm w-50 text-center"
                  to="/cart"
                  onClick={() => setIsCartOpen(false)}
                  style={{
                    background: '#f5f5f5',
                    color: '#222',
                    padding: '10px 15px',
                    borderRadius: '8px',
                    fontWeight: 'bold',
                    display: 'inline-block'
                  }}
                >
                  View Cart
                </Link>

                <Link
                  className="font-bold theme-bg-clr text-white checkout w-50 text-center"
                  to="/checkout"
                  onClick={() => setIsCartOpen(false)}
                  style={{
                    background: '#fa441d',
                    color: '#fff',
                    padding: '10px 15px',
                    borderRadius: '8px',
                    fontWeight: 'bold',
                    display: 'inline-block'
                  }}
                >
                  Checkout
                </Link>
              </div>
            </>
          )}
        </div>
      </div>
    </div>
  );
};

export default CartModal;
