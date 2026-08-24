import React from 'react';
import { Link } from '../router/Router';

export default function ShopCart({ onAddToCart }) {
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
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>Shopping Cart</h2>
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
              <Link to="/our-products">Shop</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d' }}>Cart</li>
          </ul>
        </div>
      </section>

      <section className="gap">
        <div className="container">
          <div className="table-responsive">
            <table className="table" style={{ verticalAlign: 'middle' }}>
              <thead>
                <tr style={{ backgroundColor: '#fff8e5' }}>
                  <th style={{ padding: '15px' }}>Product</th>
                  <th style={{ padding: '15px' }}>Price</th>
                  <th style={{ padding: '15px' }}>Quantity</th>
                  <th style={{ padding: '15px' }}>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style={{ padding: '15px' }}>
                    <div className="d-flex align-items-center">
                      <img src="/assets/img/food-1.png" alt="food" style={{ width: '60px', marginRight: '15px' }} />
                      <span className="font-semi-bold">Brown Sandwich</span>
                    </div>
                  </td>
                  <td style={{ padding: '15px' }}>$10.50</td>
                  <td style={{ padding: '15px' }}>1</td>
                  <td style={{ padding: '15px', fontWeight: 'bold' }}>$10.50</td>
                </tr>
                <tr>
                  <td style={{ padding: '15px' }}>
                    <div className="d-flex align-items-center">
                      <img src="/assets/img/food-2.png" alt="food" style={{ width: '60px', marginRight: '15px' }} />
                      <span className="font-semi-bold">Banana Leaves</span>
                    </div>
                  </td>
                  <td style={{ padding: '15px' }}>$12.60</td>
                  <td style={{ padding: '15px' }}>1</td>
                  <td style={{ padding: '15px', fontWeight: 'bold' }}>$12.60</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div className="row justify-content-end mt-4">
            <div className="col-md-5">
              <div className="cart_totals p-4" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                <h4 style={{ fontWeight: 'bold', marginBottom: '20px' }}>Cart Totals</h4>
                <div className="d-flex justify-content-between mb-2">
                  <span>Subtotal</span>
                  <span>$23.10</span>
                </div>
                <div className="d-flex justify-content-between mb-3 pb-3" style={{ borderBottom: '1px solid #ddd' }}>
                  <span>Shipping</span>
                  <span>Free Shipping</span>
                </div>
                <div className="d-flex justify-content-between mb-4">
                  <strong style={{ fontSize: '20px' }}>Total</strong>
                  <strong style={{ fontSize: '20px', color: '#fa441d' }}>$23.10</strong>
                </div>
                <Link to="/cart-checkout" className="button w-100 text-center d-block">
                  Proceed to Checkout
                </Link>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
