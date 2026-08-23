import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import InstaGallery from '../components/Home/InstaGallery';
import { useCart } from '../context/CartContext';

const Cart = () => {
  const { cartItems, updateQuantity, removeFromCart, cartTotal, clearCart } = useCart();
  const [coupon, setCoupon] = useState('');
  const [discount, setDiscount] = useState(0);
  const [couponApplied, setCouponApplied] = useState(false);

  const handleApplyCoupon = (e) => {
    e.preventDefault();
    if (coupon.trim().toUpperCase() === 'PATTE10') {
      setDiscount(parseFloat((parseFloat(cartTotal) * 0.1).toFixed(2)));
      setCouponApplied(true);
    } else {
      alert('Invalid coupon code. Try PATTE10 for 10% off!');
    }
  };

  const finalTotal = (parseFloat(cartTotal) - discount).toFixed(2);

  return (
    <div className="cart-page">
      <PageBanner title="Shop Cart" parentPage="Shop" parentLink="/shop" />

      <section className="gap">
        <div className="container">
          {cartItems.length === 0 ? (
            <div className="text-center py-5">
              <i className="fa-solid fa-basket-shopping fa-4x text-muted mb-3"></i>
              <h2>Your cart is currently empty</h2>
              <p className="text-muted mb-4">Looks like you haven't added any pet supplies or treats to your cart yet.</p>
              <Link to="/shop" className="button">
                Return to Shop
              </Link>
            </div>
          ) : (
            <div className="row g-5">
              {/* Cart Table */}
              <div className="col-lg-8">
                <div className="table-responsive rounded border mb-4">
                  <table className="table table-hover align-middle mb-0">
                    <thead style={{ backgroundColor: '#fff8e5' }}>
                      <tr>
                        <th scope="col" className="py-3 ps-4">Product</th>
                        <th scope="col" className="py-3">Price</th>
                        <th scope="col" className="py-3">Quantity</th>
                        <th scope="col" className="py-3">Subtotal</th>
                        <th scope="col" className="py-3 text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      {cartItems.map((item) => (
                        <tr key={item.id}>
                          <td className="ps-4 py-3">
                            <div className="d-flex align-items-center gap-3">
                              <img
                                src={item.img}
                                alt={item.name}
                                style={{ width: '60px', height: '60px', objectFit: 'contain', backgroundColor: '#f8f8f8', padding: '4px', borderRadius: '8px' }}
                              />
                              <div>
                                <h6 className="mb-0 fw-bold">{item.name}</h6>
                              </div>
                            </div>
                          </td>
                          <td>${item.price.toFixed(2)}</td>
                          <td>
                            <div className="d-flex align-items-center border rounded" style={{ width: '110px' }}>
                              <button
                                className="btn btn-sm btn-link text-dark px-2"
                                onClick={() => updateQuantity(item.id, item.quantity - 1)}
                              >
                                <i className="fa-solid fa-minus"></i>
                              </button>
                              <span className="flex-grow-1 text-center fw-bold">{item.quantity}</span>
                              <button
                                className="btn btn-sm btn-link text-dark px-2"
                                onClick={() => updateQuantity(item.id, item.quantity + 1)}
                              >
                                <i className="fa-solid fa-plus"></i>
                              </button>
                            </div>
                          </td>
                          <td className="fw-bold" style={{ color: '#fa441d' }}>
                            ${(item.price * item.quantity).toFixed(2)}
                          </td>
                          <td className="text-center">
                            <button
                              className="btn btn-sm btn-link text-danger"
                              onClick={() => removeFromCart(item.id)}
                            >
                              <i className="fa-solid fa-trash-can"></i>
                            </button>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>

                <div className="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                  <form onSubmit={handleApplyCoupon} className="d-flex gap-2 w-100 max-w-sm" style={{ maxWidth: '350px' }}>
                    <input
                      type="text"
                      className="form-control form-control-sm"
                      placeholder="Coupon code (PATTE10)"
                      value={coupon}
                      onChange={(e) => setCoupon(e.target.value)}
                    />
                    <button type="submit" className="button btn-sm border-0 text-nowrap">
                      Apply
                    </button>
                  </form>

                  <button
                    className="btn btn-outline-secondary btn-sm"
                    onClick={clearCart}
                  >
                    Clear Cart
                  </button>
                </div>
              </div>

              {/* Cart Summary */}
              <div className="col-lg-4">
                <div className="p-4 rounded border" style={{ backgroundColor: '#fff8e5', borderColor: '#fedc4f' }}>
                  <h4 className="mb-4">Cart Totals</h4>
                  <div className="d-flex justify-content-between mb-2">
                    <span className="text-muted">Subtotal</span>
                    <span className="fw-bold">${cartTotal}</span>
                  </div>

                  {couponApplied && (
                    <div className="d-flex justify-content-between mb-2 text-success">
                      <span>Discount (10%)</span>
                      <span>-${discount.toFixed(2)}</span>
                    </div>
                  )}

                  <div className="d-flex justify-content-between mb-3 pb-3 border-bottom">
                    <span className="text-muted">Shipping</span>
                    <span className="text-success fw-semibold">Free Express</span>
                  </div>

                  <div className="d-flex justify-content-between mb-4">
                    <span className="fs-5 fw-bold">Total</span>
                    <span className="fs-4 fw-bold" style={{ color: '#fa441d' }}>${finalTotal}</span>
                  </div>

                  <Link to="/checkout" className="button w-100 text-center py-3">
                    Proceed to Checkout
                  </Link>
                </div>
              </div>
            </div>
          )}
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default Cart;
