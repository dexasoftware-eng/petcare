import React, { useState } from 'react';
import { Link } from '../router/Router';

export default function CartCheckout() {
  const [isSuccess, setIsSuccess] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    setIsSuccess(true);
  };

  return (
    <>
      <section
        className="banner"
        style={{
          backgroundColor: '#fff8e5',
          backgroundImage: 'url(/assets/img/background.png)',
          padding: '80px 0',
          textAlign: 'center',
        }}
      >
        <div className="container">
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>Cart Checkout</h2>
          <ul
            className="breadcrumb"
            style={{
              display: 'flex',
              justifyContent: 'center',
              listStyle: 'none',
              padding: 0,
              margin: 0,
              gap: '10px',
              fontSize: '16px',
            }}
          >
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>/</li>
            <li>
              <Link to="/shop-cart">Cart</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d' }}>Checkout</li>
          </ul>
        </div>
      </section>

      <section className="gap">
        <div className="container">
          {isSuccess ? (
            <div className="text-center p-5" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
              <i className="fa-solid fa-circle-check" style={{ fontSize: '64px', color: '#fa441d', marginBottom: '20px' }}></i>
              <h2 style={{ fontWeight: 'bold' }}>Thank You for Your Order!</h2>
              <p className="mt-3">Your order has been received and is being processed by our team.</p>
              <Link to="/" className="button mt-4 d-inline-block">
                Return to Home
              </Link>
            </div>
          ) : (
            <form onSubmit={handleSubmit}>
              <div className="row">
                <div className="col-lg-7">
                  <div className="billing-details p-4" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                    <h3 style={{ fontWeight: 'bold', marginBottom: '25px' }}>Billing Details</h3>
                    <div className="row">
                      <div className="col-md-6 mb-3">
                        <label className="form-label font-semi-bold">First Name *</label>
                        <input type="text" className="form-control" required placeholder="John" />
                      </div>
                      <div className="col-md-6 mb-3">
                        <label className="form-label font-semi-bold">Last Name *</label>
                        <input type="text" className="form-control" required placeholder="Doe" />
                      </div>
                      <div className="col-12 mb-3">
                        <label className="form-label font-semi-bold">Email Address *</label>
                        <input type="email" className="form-control" required placeholder="john@example.com" />
                      </div>
                      <div className="col-12 mb-3">
                        <label className="form-label font-semi-bold">Street Address *</label>
                        <input type="text" className="form-control" required placeholder="House number and street name" />
                      </div>
                      <div className="col-md-6 mb-3">
                        <label className="form-label font-semi-bold">Town / City *</label>
                        <input type="text" className="form-control" required placeholder="New York" />
                      </div>
                      <div className="col-md-6 mb-3">
                        <label className="form-label font-semi-bold">Postcode / ZIP *</label>
                        <input type="text" className="form-control" required placeholder="10001" />
                      </div>
                      <div className="col-12 mb-3">
                        <label className="form-label font-semi-bold">Phone Number *</label>
                        <input type="tel" className="form-control" required placeholder="+1 234 567 8900" />
                      </div>
                    </div>
                  </div>
                </div>

                <div className="col-lg-5 mt-4 mt-lg-0">
                  <div className="checkout-side p-4" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                    <h3 style={{ fontWeight: 'bold', marginBottom: '20px' }}>Your Order</h3>
                    <div className="d-flex justify-content-between mb-2">
                      <span>Brown Sandwich x 1</span>
                      <span>$10.50</span>
                    </div>
                    <div className="d-flex justify-content-between mb-3 pb-3" style={{ borderBottom: '1px solid #ddd' }}>
                      <span>Banana Leaves x 1</span>
                      <span>$12.60</span>
                    </div>
                    <div className="d-flex justify-content-between mb-2">
                      <span>Subtotal</span>
                      <span>$23.10</span>
                    </div>
                    <div className="d-flex justify-content-between mb-3 pb-3" style={{ borderBottom: '1px solid #ddd' }}>
                      <span>Shipping</span>
                      <span>Free</span>
                    </div>
                    <div className="d-flex justify-content-between mb-4">
                      <strong style={{ fontSize: '20px' }}>Total</strong>
                      <strong style={{ fontSize: '20px', color: '#fa441d' }}>$23.10</strong>
                    </div>

                    <button type="submit" className="button w-100 text-center">
                      Place Order
                    </button>
                  </div>
                </div>
              </div>
            </form>
          )}
        </div>
      </section>
    </>
  );
}
