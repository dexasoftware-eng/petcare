import React from 'react';
import { Link } from 'react-router-dom';
import { useCart } from '../../context/CartContext';
import StarRating from './StarRating';

const ProductCard = ({ product }) => {
  const { addToCart } = useCart();

  return (
    <div className="healthy-product">
      <div className="healthy-product-img position-relative">
        <img src={product.img} alt={product.name} />
        <StarRating rating={product.rating} />
        <div className="add-to-cart">
          <a
            href="#add-to-cart"
            onClick={(e) => {
              e.preventDefault();
              addToCart(product, 1);
            }}
          >
            Add to Cart
          </a>
          <a href="#wishlist" className="heart-wishlist" onClick={(e) => e.preventDefault()}>
            <i className="fa-regular fa-heart"></i>
          </a>
        </div>
        {product.discount && <h4>{product.discount}</h4>}
      </div>
      <span>{product.category}</span>
      <Link to={`/product/${product.id}`}>{product.name}</Link>
      <h6>
        {product.oldPrice && <del className="me-1">${product.oldPrice.toFixed(2)}</del>}
        ${product.price.toFixed(2)}
      </h6>
    </div>
  );
};

export default ProductCard;
