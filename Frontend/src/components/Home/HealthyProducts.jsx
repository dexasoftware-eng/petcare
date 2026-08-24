import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import SectionHeading from '../Common/SectionHeading';
import ProductCard from '../Common/ProductCard';
import StarRating from '../Common/StarRating';
import { products } from '../../data/products';
import { useCart } from '../../context/CartContext';

const HealthyProducts = () => {
  const { addToCart } = useCart();
  const regularProducts = products.slice(0, 5);
  const dealProduct = products.find(p => p.isDealOfWeek) || products[5];

  // Deal countdown timer state (days, hours, minutes, seconds)
  const [timeLeft, setTimeLeft] = useState({
    days: 14,
    hours: 8,
    minutes: 42,
    seconds: 30
  });

  useEffect(() => {
    const timer = setInterval(() => {
      setTimeLeft(prev => {
        if (prev.seconds > 0) {
          return { ...prev, seconds: prev.seconds - 1 };
        } else if (prev.minutes > 0) {
          return { ...prev, minutes: prev.minutes - 1, seconds: 59 };
        } else if (prev.hours > 0) {
          return { ...prev, hours: prev.hours - 1, minutes: 59, seconds: 59 };
        } else if (prev.days > 0) {
          return { ...prev, days: prev.days - 1, hours: 23, minutes: 59, seconds: 59 };
        }
        return prev;
      });
    }, 1000);
    return () => clearInterval(timer);
  }, []);

  return (
    <section
      className="gap section-healthy-product"
      style={{
        backgroundImage: 'url(/assets/img/healthy-product.png)',
        backgroundColor: '#f5f5f5'
      }}
    >
      <div className="container">
        <SectionHeading
          subTitle="Find Healthy Product"
          title="Healthy Products"
        />

        <div className="row g-4 mt-2">
          {regularProducts.map((product) => (
            <div key={product.id} className="col-lg-3 col-md-4 col-sm-6">
              <ProductCard product={product} />
            </div>
          ))}

          {/* Deal of the Week Banner */}
          <div className="col-lg-9">
            <div className="deal-of-the-week d-flex flex-column flex-md-row align-items-center">
              <div className="healthy-product-img position-relative text-center">
                <h6>Deal of the Week</h6>
                <img src={dealProduct.img} alt={dealProduct.name} />
                <StarRating rating={dealProduct.rating} />
              </div>

              <div className="healthy-product ps-md-4">
                <span>{dealProduct.category}</span>
                <Link to={`/product/${dealProduct.id}`}>
                  {dealProduct.name}
                </Link>
                <h6>
                  <del className="me-2">${dealProduct.oldPrice ? dealProduct.oldPrice.toFixed(2) : '32.00'}</del>
                  ${dealProduct.price.toFixed(2)}
                </h6>
                <h5>{dealProduct.discount || 'up to 14% off'}</h5>

                <div className="add-to-cart d-flex align-items-center gap-2 mb-3">
                  <button
                    className="button btn-sm border-0"
                    onClick={() => addToCart(dealProduct, 1)}
                  >
                    Add to Cart
                  </button>
                  <a href="#wishlist" className="heart-wishlist" onClick={(e) => e.preventDefault()}>
                    <i className="fa-regular fa-heart"></i>
                  </a>
                </div>

                <div id="countdown">
                  <ul className="list-unstyled d-flex gap-3 mb-0">
                    <li className="text-center">
                      <span id="days" className="d-block fw-bold">{String(timeLeft.days).padStart(2, '0')}</span>days
                    </li>
                    <li className="text-center">
                      <span id="hours" className="d-block fw-bold">{String(timeLeft.hours).padStart(2, '0')}</span>Hour
                    </li>
                    <li className="text-center">
                      <span id="minutes" className="d-block fw-bold">{String(timeLeft.minutes).padStart(2, '0')}</span>Min
                    </li>
                    <li className="text-center mb-0">
                      <span id="seconds" className="d-block fw-bold">{String(timeLeft.seconds).padStart(2, '0')}</span>Sec
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default HealthyProducts;
