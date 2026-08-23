import React, { useState, useMemo } from 'react';
import { useSearchParams } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import ProductCard from '../components/Common/ProductCard';
import InstaGallery from '../components/Home/InstaGallery';
import { products } from '../data/products';

const categoriesList = [
  "All",
  "Cat Supplies",
  "Dog Supplies",
  "Animal Feed",
  "Accessories",
  "Horse Care"
];

const Shop = () => {
  const [searchParams, setSearchParams] = useSearchParams();
  const activeCategoryParam = searchParams.get('category');
  const searchParam = searchParams.get('search') || '';

  const [selectedCategory, setSelectedCategory] = useState(
    activeCategoryParam
      ? activeCategoryParam.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase())
      : "All"
  );
  const [sortBy, setSortBy] = useState("default");

  const filteredProducts = useMemo(() => {
    return products.filter(product => {
      const matchesCategory =
        selectedCategory === "All" ||
        product.category.toLowerCase() === selectedCategory.toLowerCase();
      const matchesSearch =
        !searchParam ||
        product.name.toLowerCase().includes(searchParam.toLowerCase()) ||
        product.description.toLowerCase().includes(searchParam.toLowerCase());
      return matchesCategory && matchesSearch;
    }).sort((a, b) => {
      if (sortBy === "price-low") return a.price - b.price;
      if (sortBy === "price-high") return b.price - a.price;
      if (sortBy === "rating") return b.rating - a.rating;
      return a.id - b.id;
    });
  }, [selectedCategory, searchParam, sortBy]);

  return (
    <div className="shop-page">
      <PageBanner title="Our Products" />

      <section className="gap">
        <div className="container">
          {/* Filter Bar & Sorting */}
          <div className="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3 p-3 rounded" style={{ background: '#fff8e5' }}>
            <div className="d-flex flex-wrap gap-2">
              {categoriesList.map(cat => (
                <button
                  key={cat}
                  onClick={() => {
                    setSelectedCategory(cat);
                    searchParams.delete('category');
                    setSearchParams(searchParams);
                  }}
                  className="btn btn-sm"
                  style={{
                    backgroundColor: selectedCategory === cat ? '#fa441d' : '#ffffff',
                    color: selectedCategory === cat ? '#ffffff' : '#222222',
                    borderRadius: '20px',
                    padding: '6px 18px',
                    fontWeight: '600',
                    border: '1px solid #fedc4f'
                  }}
                >
                  {cat}
                </button>
              ))}
            </div>

            <div className="d-flex align-items-center gap-2">
              <span className="fw-semibold text-muted text-nowrap">Sort by:</span>
              <select
                value={sortBy}
                onChange={(e) => setSortBy(e.target.value)}
                className="form-select form-select-sm"
                style={{ width: '180px', borderRadius: '8px' }}
              >
                <option value="default">Default sorting</option>
                <option value="price-low">Price: Low to High</option>
                <option value="price-high">Price: High to Low</option>
                <option value="rating">Highest Rated</option>
              </select>
            </div>
          </div>

          {searchParam && (
            <div className="mb-4">
              <h4>Showing search results for: <span style={{ color: '#fa441d' }}>"{searchParam}"</span></h4>
            </div>
          )}

          {/* Products Grid */}
          <div className="row g-4">
            {filteredProducts.length > 0 ? (
              filteredProducts.map(product => (
                <div key={product.id} className="col-lg-3 col-md-4 col-sm-6">
                  <ProductCard product={product} />
                </div>
              ))
            ) : (
              <div className="col-12 text-center py-5">
                <i className="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                <h3>No products found</h3>
                <p className="text-muted">Try adjusting your filters or search query.</p>
              </div>
            )}
          </div>
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default Shop;
