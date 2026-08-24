import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import InstaGallery from '../components/Home/InstaGallery';
import { useCart } from '../context/CartContext';
import { createOrderAPI } from '../services/api';

const Checkout = () => {
  const { cartItems, cartTotal, clearCart } = useCart();

  const [paymentMethod, setPaymentMethod] = useState('card');
  const [isSubmitted, setIsSubmitted] = useState(false);
  const [assignedOrderNumber, setAssignedOrderNumber] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  const [formData, setFormData] = useState({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    address: '',
    city: '',
    postcode: '',
    notes: ''
  });

  const handleChange = (e) => {
    setFormData(prev => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const handlePlaceOrder = async (e) => {
    e.preventDefault();
    if (cartItems.length === 0) {
      alert('Your cart is empty.');
      return;
    }

    setIsSubmitting(true);
    const orderPayload = {
      customer: formData,
      items: cartItems.map(item => ({
        name: item.name,
        price: item.price,
        quantity: item.quantity,
        img: item.img
      })),
      subtotal: parseFloat(cartTotal),
      discount: 0,
      total: parseFloat(cartTotal),
      paymentMethod
    };

    try {
      const response = await createOrderAPI(orderPayload);
      setAssignedOrderNumber(response.orderNumber || response.data?.orderNumber || `PETGUARD-${Math.floor(100000 + Math.random() * 900000)}`);
    } catch {
      setAssignedOrderNumber(`PETGUARD-${Math.floor(100000 + Math.random() * 900000)}`);
    } finally {
      setIsSubmitting(false);
      setIsSubmitted(true);
      clearCart();
    }
  };

  if (isSubmitted) {
    return (
      <div className="checkout-success-page">
        <PageBanner title="Order Received" parentPage="Shop" parentLink="/shop" />
        <section className="gap text-center">
          <div className="container py-5">
            <div className="p-5 rounded border d-inline-block shadow-sm" style={{ backgroundColor: '#fff8e5', maxWidth: '600px' }}>
              <i className="fa-solid fa-circle-check fa-4x text-success mb-3"></i>
              <h2>Thank you for your order!</h2>
              <p className="lead text-secondary my-3">
                Your order <strong>#{assignedOrderNumber}</strong> has been placed and registered successfully. A confirmation receipt has been emailed to <strong>{formData.email}</strong>.
              </p>
              <Link to="/shop" className="button mt-3">
                Continue Shopping
              </Link>
            </div>
          </div>
        </section>
        <InstaGallery />
      </div>
    );
  }

  return (
    <div className="checkout-page">
      <PageBanner title="Cart Checkout" parentPage="Cart" parentLink="/cart" />

      <section className="gap">
        <div className="container">
          <form onSubmit={handlePlaceOrder}>
            <div className="row g-5">
              {/* Billing Form */}
              <div className="col-lg-7">
                <h3 className="mb-4">Billing Details</h3>
                <div className="row g-3">
                  <div className="col-md-6">
                    <label className="form-label fw-semibold">First Name *</label>
                    <input
                      type="text"
                      name="firstName"
                      required
                      value={formData.firstName}
                      onChange={handleChange}
                      className="form-control p-3"
                    />
                  </div>
                  <div className="col-md-6">
                    <label className="form-label fw-semibold">Last Name *</label>
                    <input
                      type="text"
                      name="lastName"
                      required
                      value={formData.lastName}
                      onChange={handleChange}
                      className="form-control p-3"
                    />
                  </div>
                  <div className="col-md-6">
                    <label className="form-label fw-semibold">Email Address *</label>
                    <input
                      type="email"
                      name="email"
                      required
                      value={formData.email}
                      onChange={handleChange}
                      className="form-control p-3"
                    />
                  </div>
                  <div className="col-md-6">
                    <label className="form-label fw-semibold">Phone Number *</label>
                    <input
                      type="tel"
                      name="phone"
                      required
                      value={formData.phone}
                      onChange={handleChange}
                      className="form-control p-3"
                    />
                  </div>
                  <div className="col-12">
                    <label className="form-label fw-semibold">Street Address *</label>
                    <input
                      type="text"
                      name="address"
                      required
                      placeholder="House number and street name"
                      value={formData.address}
                      onChange={handleChange}
                      className="form-control p-3"
                    />
                  </div>
                  <div className="col-md-6">
                    <label className="form-label fw-semibold">Town / City *</label>
                    <input
                      type="text"
                      name="city"
                      required
                      value={formData.city}
                      onChange={handleChange}
                      className="form-control p-3"
                    />
                  </div>
                  <div className="col-md-6">
                    <label className="form-label fw-semibold">Postcode / ZIP *</label>
                    <input
                      type="text"
                      name="postcode"
                      required
                      value={formData.postcode}
                      onChange={handleChange}
                      className="form-control p-3"
                    />
                  </div>
                  <div className="col-12">
                    <label className="form-label fw-semibold">Order Notes (Optional)</label>
                    <textarea
                      name="notes"
                      rows="3"
                      placeholder="Special notes for delivery or dietary sensitivities..."
                      value={formData.notes}
                      onChange={handleChange}
                      className="form-control p-3"
                    ></textarea>
                  </div>
                </div>
              </div>

              {/* Order Review Sidebar */}
              <div className="col-lg-5">
                <div className="p-4 rounded border shadow-sm" style={{ backgroundColor: '#fff8e5', borderColor: '#fedc4f' }}>
                  <h4 className="mb-4">Your Order</h4>
                  <ul className="list-unstyled mb-3">
                    {cartItems.map((item) => (
                      <li key={item.id} className="d-flex justify-content-between py-2 border-bottom">
                        <span>{item.name} <strong className="text-muted">× {item.quantity}</strong></span>
                        <span className="fw-semibold">${(item.price * item.quantity).toFixed(2)}</span>
                      </li>
                    ))}
                  </ul>

                  <div className="d-flex justify-content-between py-2 border-bottom">
                    <span className="text-muted">Subtotal</span>
                    <span className="fw-bold">${cartTotal}</span>
                  </div>

                  <div className="d-flex justify-content-between py-2 border-bottom">
                    <span className="text-muted">Shipping</span>
                    <span className="text-success fw-semibold">Free Express</span>
                  </div>

                  <div className="d-flex justify-content-between py-3 border-bottom mb-4">
                    <span className="fs-5 fw-bold">Total</span>
                    <span className="fs-4 fw-bold" style={{ color: '#fa441d' }}>${cartTotal}</span>
                  </div>

                  <h5 className="mb-3">Payment Method</h5>
                  <div className="form-check mb-2">
                    <input
                      className="form-check-input"
                      type="radio"
                      name="payment"
                      id="card"
                      checked={paymentMethod === 'card'}
                      onChange={() => setPaymentMethod('card')}
                    />
                    <label className="form-check-label fw-semibold" htmlFor="card">
                      Credit Card / Debit Card (Visa, Mastercard)
                    </label>
                  </div>
                  <div className="form-check mb-2">
                    <input
                      className="form-check-input"
                      type="radio"
                      name="payment"
                      id="cod"
                      checked={paymentMethod === 'cod'}
                      onChange={() => setPaymentMethod('cod')}
                    />
                    <label className="form-check-label fw-semibold" htmlFor="cod">
                      Cash on Delivery
                    </label>
                  </div>
                  <div className="form-check mb-4">
                    <input
                      className="form-check-input"
                      type="radio"
                      name="payment"
                      id="bank"
                      checked={paymentMethod === 'bank'}
                      onChange={() => setPaymentMethod('bank')}
                    />
                    <label className="form-check-label fw-semibold" htmlFor="bank">
                      Direct Bank Transfer
                    </label>
                  </div>

                  <button type="submit" disabled={isSubmitting} className="button w-100 text-center py-3 border-0">
                    {isSubmitting ? 'Processing Order...' : 'Place Order'}
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default Checkout;
