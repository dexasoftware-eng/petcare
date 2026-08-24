import React, { useState } from 'react';
import { Link } from '../router/Router';
import HealthyProductsSection from '../components/sections/HealthyProductsSection';
import InstagramGallery from '../components/sections/InstagramGallery';

export default function ProductDetails({ onAddToCart, onOpenLightbox }) {
  const [quantity, setQuantity] = useState(1);
  const [selectedImg, setSelectedImg] = useState('/assets/img/food-1.png');

  const handleAdd = () => {
    if (onAddToCart) {
      onAddToCart({
        id: 1,
        name: 'Procan Adult Dog Food',
        price: 32.0,
        quantity: quantity,
        image: selectedImg,
      });
    }
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
          <h2 style={{ fontSize: '42px', fontWeight: 'bold', marginBottom: '10px' }}>Product Details</h2>
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
              <Link to="/our-products">Products</Link>
            </li>
            <li>/</li>
            <li className="active" style={{ color: '#fa441d' }}>Procan Adult Dog Food</li>
          </ul>
        </div>
      </section>

      <section className="gap">
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-6">
              <div className="pd-main-img text-center p-4" style={{ backgroundColor: '#fff8e5', borderRadius: '16px' }}>
                <img src={selectedImg} alt="Product Detail" style={{ maxHeight: '350px', objectFit: 'contain' }} />
              </div>
              <div className="d-flex justify-content-center gap-3 mt-3">
                {['/assets/img/food-1.png', '/assets/img/food-2.png', '/assets/img/food-3.png'].map((src, i) => (
                  <div
                    key={i}
                    onClick={() => setSelectedImg(src)}
                    style={{
                      width: '70px',
                      height: '70px',
                      padding: '8px',
                      backgroundColor: '#fff8e5',
                      borderRadius: '8px',
                      cursor: 'pointer',
                      border: selectedImg === src ? '2px solid #fa441d' : '1px solid transparent',
                    }}
                  >
                    <img src={src} alt="thumb" style={{ width: '100%', height: '100%', objectFit: 'contain' }} />
                  </div>
                ))}
              </div>
            </div>

            <div className="col-lg-6">
              <div className="product-info ps-lg-4 mt-4 mt-lg-0">
                <span style={{ color: '#fa441d', fontWeight: 'bold' }}>Animal Feed</span>
                <h2 style={{ fontSize: '32px', fontWeight: 'bold', margin: '10px 0' }}>Procan Adult Dog Food</h2>
                <ul className="star d-flex gap-1 mb-3" style={{ listStyle: 'none', padding: 0, color: '#febb02' }}>
                  {[1, 2, 3, 4, 5].map((s) => (
                    <li key={s}><i className="fa-solid fa-star"></i></li>
                  ))}
                </ul>
                <h3 style={{ fontSize: '26px', color: '#fa441d', fontWeight: 'bold', marginBottom: '15px' }}>$32.00</h3>
                <p style={{ lineHeight: '1.8', marginBottom: '25px' }}>
                  Premium organic dog food formulated specifically for active adult dogs. High in protein, essential fatty acids, vitamins, and prebiotics to support healthy digestion, shiny coat, and vibrant energy.
                </p>

                <div className="d-flex align-items-center gap-3 mb-4">
                  <div className="d-flex align-items-center border rounded px-2" style={{ backgroundColor: '#fff' }}>
                    <button
                      type="button"
                      onClick={() => setQuantity((q) => Math.max(1, q - 1))}
                      style={{ background: 'none', border: 'none', padding: '8px 12px', fontSize: '18px', cursor: 'pointer' }}
                    >
                      -
                    </button>
                    <span style={{ padding: '0 12px', fontWeight: 'bold' }}>{quantity}</span>
                    <button
                      type="button"
                      onClick={() => setQuantity((q) => q + 1)}
                      style={{ background: 'none', border: 'none', padding: '8px 12px', fontSize: '18px', cursor: 'pointer' }}
                    >
                      +
                    </button>
                  </div>
                  <button type="button" className="button" onClick={handleAdd}>
                    Add to Cart
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <HealthyProductsSection onAddToCart={onAddToCart} />
      <InstagramGallery onOpenLightbox={onOpenLightbox} />
    </>
  );
}
