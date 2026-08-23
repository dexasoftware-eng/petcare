import React, { useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import StarRating from '../components/Common/StarRating';
import ProductCard from '../components/Common/ProductCard';
import InstaGallery from '../components/Home/InstaGallery';
import { products } from '../data/products';
import { useCart } from '../context/CartContext';

const ProductDetails = () => {
  const { id } = useParams();
  const { addToCart } = useCart();
  const [quantity, setQuantity] = useState(1);
  const [activeTab, setActiveTab] = useState('desc');

  const product = products.find(p => p.id === parseInt(id || '1')) || products[0];
  const relatedProducts = products.filter(p => p.id !== product.id).slice(0, 4);

  return (
    <div className="product-details-page">
      <PageBanner title={product.name} parentPage="Shop" parentLink="/shop" />

      <section className="gap">
        <div className="container">
          <div className="row align-items-center g-5">
            {/* Product Image */}
            <div className="col-lg-6">
              <div
                className="product-main-img p-5 text-center rounded position-relative"
                style={{ backgroundColor: '#fff8e5', border: '1px solid #fedc4f' }}
              >
                {product.discount && (
                  <span
                    className="position-absolute top-0 start-0 m-3 px-3 py-1 rounded text-white fw-bold"
                    style={{ backgroundColor: '#fa441d' }}
                  >
                    {product.discount}
                  </span>
                )}
                <img
                  src={product.img}
                  alt={product.name}
                  className="img-fluid"
                  style={{ maxHeight: '380px', objectFit: 'contain' }}
                />
              </div>
            </div>

            {/* Product Info */}
            <div className="col-lg-6">
              <div className="product-info">
                <span className="text-uppercase fw-bold text-muted small">{product.category}</span>
                <h2 className="mt-1 mb-2">{product.name}</h2>

                <div className="d-flex align-items-center gap-2 mb-3">
                  <StarRating rating={product.rating} />
                  <span className="text-muted small">(4.9 out of 5 based on 28 customer reviews)</span>
                </div>

                <div className="d-flex align-items-center gap-3 mb-4">
                  {product.oldPrice && (
                    <span className="text-decoration-line-through text-muted fs-4">
                      ${product.oldPrice.toFixed(2)}
                    </span>
                  )}
                  <span className="fs-2 fw-bold" style={{ color: '#fa441d' }}>
                    ${product.price.toFixed(2)}
                  </span>
                </div>

                <p className="text-secondary mb-4 leading-relaxed">
                  {product.description}
                </p>

                {/* Quantity and Add to Cart */}
                <div className="d-flex align-items-center gap-3 mb-4">
                  <div
                    className="d-flex align-items-center border rounded"
                    style={{ background: '#f8f8f8', borderColor: '#e0e0e0' }}
                  >
                    <button
                      className="btn btn-link text-dark px-3 py-2"
                      onClick={() => setQuantity(prev => Math.max(1, prev - 1))}
                    >
                      <i className="fa-solid fa-minus"></i>
                    </button>
                    <span className="px-3 fw-bold">{quantity}</span>
                    <button
                      className="btn btn-link text-dark px-3 py-2"
                      onClick={() => setQuantity(prev => prev + 1)}
                    >
                      <i className="fa-solid fa-plus"></i>
                    </button>
                  </div>

                  <button
                    className="button border-0 px-4 py-3"
                    onClick={() => addToCart(product, quantity)}
                  >
                    Add to Cart
                  </button>
                </div>

                <div className="product-meta pt-3 border-top">
                  <p className="mb-1"><strong>SKU:</strong> <span className="text-muted">{product.sku}</span></p>
                  <p className="mb-1"><strong>Category:</strong> <Link to={`/shop?category=${encodeURIComponent(product.category)}`} className="text-muted">{product.category}</Link></p>
                  <p className="mb-0"><strong>Availability:</strong> <span className="text-success fw-semibold">In Stock (Next-day delivery available)</span></p>
                </div>
              </div>
            </div>
          </div>

          {/* Product Tabs */}
          <div className="product-tabs mt-5 pt-4">
            <ul className="nav nav-tabs border-bottom mb-4">
              <li className="nav-item">
                <button
                  className={`nav-link fw-bold border-0 ${activeTab === 'desc' ? 'active text-danger border-bottom border-danger border-3' : 'text-muted'}`}
                  onClick={() => setActiveTab('desc')}
                  style={{ background: 'transparent' }}
                >
                  Description
                </button>
              </li>
              <li className="nav-item">
                <button
                  className={`nav-link fw-bold border-0 ${activeTab === 'info' ? 'active text-danger border-bottom border-danger border-3' : 'text-muted'}`}
                  onClick={() => setActiveTab('info')}
                  style={{ background: 'transparent' }}
                >
                  Additional Information
                </button>
              </li>
              <li className="nav-item">
                <button
                  className={`nav-link fw-bold border-0 ${activeTab === 'reviews' ? 'active text-danger border-bottom border-danger border-3' : 'text-muted'}`}
                  onClick={() => setActiveTab('reviews')}
                  style={{ background: 'transparent' }}
                >
                  Reviews (3)
                </button>
              </li>
            </ul>

            <div className="tab-content p-4 rounded" style={{ background: '#fcfcfc', border: '1px solid #f0f0f0' }}>
              {activeTab === 'desc' && (
                <div>
                  <h4>Comprehensive Nutritional Description</h4>
                  <p className="text-secondary leading-relaxed">
                    Formulated by certified veterinary nutritionists, this premium formula delivers balanced protein, essential micronutrients, vitamins, and antioxidants designed specifically to support optimal digestive health, coat shine, and immune stamina. Made with humanely sourced ingredients without synthetic preservatives.
                  </p>
                </div>
              )}
              {activeTab === 'info' && (
                <div>
                  <table className="table table-bordered mb-0">
                    <tbody>
                      <tr><th style={{ width: '200px' }}>Weight</th><td>1.5 kg / 3.3 lbs</td></tr>
                      <tr><th>Dimensions</th><td>25 x 15 x 35 cm</td></tr>
                      <tr><th>Life Stage</th><td>Adult / All Breeds</td></tr>
                      <tr><th>Key Ingredients</th><td>Dehydrated Protein, Brown Rice, Omega-3 Fish Oil, Pumpkin Fiber</td></tr>
                    </tbody>
                  </table>
                </div>
              )}
              {activeTab === 'reviews' && (
                <div>
                  <div className="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                    <img src="/assets/img/man.jpg" alt="Reviewer" className="rounded-circle" style={{ width: '50px', height: '50px' }} />
                    <div>
                      <div className="d-flex align-items-center gap-2">
                        <h6 className="mb-0">David Miller</h6>
                        <StarRating rating={5} />
                      </div>
                      <small className="text-muted">Verified Buyer - August 2026</small>
                      <p className="mb-0 text-secondary mt-1">My dogs absolutely adore this feed! Noticeable difference in coat shine in just 2 weeks.</p>
                    </div>
                  </div>
                </div>
              )}
            </div>
          </div>

          {/* Related Products */}
          <div className="related-products mt-5 pt-5">
            <h3 className="mb-4 text-center">Related Products</h3>
            <div className="row g-4">
              {relatedProducts.map(rel => (
                <div key={rel.id} className="col-lg-3 col-md-6">
                  <ProductCard product={rel} />
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default ProductDetails;
