import React, { useState, useEffect } from 'react';
import { Link } from '../../router/Router';
import { healthyProducts, dealOfTheWeekData } from '../../data/templateData';

export default function HealthyProductsSection({ onAddToCart }) {
  const [wishlist, setWishlist] = useState({});
  const [timeLeft, setTimeLeft] = useState({
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0,
  });

  useEffect(() => {
    const calculateCountdown = () => {
      const now = new Date().getTime();
      let targetDate = new Date(new Date().getFullYear(), 11, 30).getTime();
      if (now > targetDate) {
        targetDate = new Date(new Date().getFullYear() + 1, 11, 30).getTime();
      }

      const distance = targetDate - now;
      if (distance > 0) {
        const second = 1000;
        const minute = second * 60;
        const hour = minute * 60;
        const day = hour * 24;

        setTimeLeft({
          days: Math.floor(distance / day),
          hours: Math.floor((distance % day) / hour),
          minutes: Math.floor((distance % hour) / minute),
          seconds: Math.floor((distance % minute) / second),
        });
      }
    };

    calculateCountdown();
    const interval = setInterval(calculateCountdown, 1000);
    return () => clearInterval(interval);
  }, []);

  const toggleWishlist = (productId) => {
    setWishlist((prev) => ({
      ...prev,
      [productId]: !prev[productId],
    }));
  };

  const handleAdd = (e, item) => {
    e.preventDefault();
    if (onAddToCart) {
      onAddToCart(item);
    }
  };

  return (
    <section
      className="gap section-healthy-product"
      style={{
        backgroundImage: 'url(/assets/img/healthy-product.png)',
        backgroundColor: '#f5f5f5',
      }}
    >
      <div className="container">
        <div className="heading">
          <img src="/assets/img/heading-img.png" alt="heading-img" />
          <h6>Find Healthy Product</h6>
          <h2>Healthy Products</h2>
        </div>

        <div className="row">
          {healthyProducts.map((prod, idx) => (
            <div
              key={prod.id}
              className={
                idx < 3
                  ? 'col-lg-3 col-md-4 col-sm-6'
                  : idx === 3
                  ? 'col-lg-3 col-md-6 col-sm-6'
                  : 'col-lg-3 col-md-6 col-sm-6'
              }
            >
              <div className={`healthy-product ${idx === 4 ? 'mb-lg-0' : ''}`}>
                <div className="healthy-product-img">
                  <img src={prod.image} alt={prod.title} />
                  <ul className="star">
                    {Array.from({ length: prod.rating }).map((_, i) => (
                      <li key={i}>
                        <i className="fa-solid fa-star"></i>
                      </li>
                    ))}
                  </ul>
                  <div className="add-to-cart">
                    <a
                      href="#"
                      onClick={(e) =>
                        handleAdd(e, {
                          id: prod.id,
                          name: prod.title,
                          price: parseFloat(prod.price.replace('$', '')),
                          quantity: 1,
                          image: prod.image,
                        })
                      }
                    >
                      Add to Cart
                    </a>
                    <button
                      type="button"
                      className="heart-wishlist"
                      onClick={() => toggleWishlist(prod.id)}
                      style={{ background: 'none', border: 'none', cursor: 'pointer' }}
                      aria-label="Add to wishlist"
                    >
                      <i className={wishlist[prod.id] ? 'fa-solid fa-heart' : 'fa-regular fa-heart'}></i>
                    </button>
                  </div>
                  {prod.discount && <h4>{prod.discount}</h4>}
                </div>
                <span>{prod.category}</span>
                <Link to="/our-products">{prod.title}</Link>
                <h6>
                  {prod.oldPrice && <del>{prod.oldPrice}</del>}
                  {prod.price}
                </h6>
              </div>
            </div>
          ))}

          <div className="col-lg-9">
            <div className="deal-of-the-week">
              <div className="healthy-product-img">
                <h6>{dealOfTheWeekData.title}</h6>
                <img src={dealOfTheWeekData.image} alt="deal of the week" />
                <ul className="star">
                  {Array.from({ length: dealOfTheWeekData.rating }).map((_, i) => (
                    <li key={i}>
                      <i className="fa-solid fa-star"></i>
                    </li>
                  ))}
                </ul>
              </div>
              <div className="healthy-product">
                <span>{dealOfTheWeekData.category}</span>
                <Link to="/our-products">{dealOfTheWeekData.productName}</Link>
                <h6>
                  <del>{dealOfTheWeekData.oldPrice}</del>
                  {dealOfTheWeekData.price}
                </h6>
                <h5>{dealOfTheWeekData.discountBadge}</h5>
                <div className="add-to-cart">
                  <a
                    href="#"
                    className="button"
                    onClick={(e) =>
                      handleAdd(e, {
                        id: 99,
                        name: dealOfTheWeekData.productName,
                        price: parseFloat(dealOfTheWeekData.price.replace('$', '')),
                        quantity: 1,
                        image: dealOfTheWeekData.image,
                      })
                    }
                  >
                    Add to Cart
                  </a>
                  <button
                    type="button"
                    className="heart-wishlist"
                    onClick={() => toggleWishlist('deal')}
                    style={{ background: 'none', border: 'none', cursor: 'pointer' }}
                    aria-label="Add to wishlist"
                  >
                    <i className={wishlist['deal'] ? 'fa-solid fa-heart' : 'fa-regular fa-heart'}></i>
                  </button>
                </div>
                <div id="countdown">
                  <ul>
                    <li>
                      <span id="days">{timeLeft.days}</span>days
                    </li>
                    <li>
                      <span id="hours">{timeLeft.hours}</span>Hour
                    </li>
                    <li>
                      <span id="minutes">{timeLeft.minutes}</span>Min
                    </li>
                    <li className="mb-0">
                      <span id="seconds">{timeLeft.seconds}</span>Sec
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
}
