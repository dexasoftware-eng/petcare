import React, { useState } from 'react';
import { Link, useSearchParams } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import InstaGallery from '../components/Home/InstaGallery';
import { blogPosts } from '../data/blog';

const Blog = () => {
  const [searchParams] = useSearchParams();
  const categoryFilter = searchParams.get('category');

  const [searchQuery, setSearchQuery] = useState('');

  const filteredPosts = blogPosts.filter(post => {
    const matchesCategory = !categoryFilter || post.category.toLowerCase() === categoryFilter.toLowerCase();
    const matchesSearch = !searchQuery || post.title.toLowerCase().includes(searchQuery.toLowerCase()) || post.content.toLowerCase().includes(searchQuery.toLowerCase());
    return matchesCategory && matchesSearch;
  });

  return (
    <div className="blog-page">
      <PageBanner title="Our Blog" />

      <section className="gap">
        <div className="container">
          {/* Filter / Search header */}
          <div className="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-5 gap-3">
            <h3 className="mb-0">
              {categoryFilter ? `Category: ${categoryFilter}` : 'All Articles & Pet Guides'}
            </h3>
            <div style={{ maxWidth: '300px', width: '100%' }}>
              <input
                type="text"
                placeholder="Search articles..."
                className="form-control"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
              />
            </div>
          </div>

          <div className="row g-4">
            {filteredPosts.map(post => (
              <div key={post.id} className="col-lg-4 col-md-6">
                <div className="blog-style h-100 d-flex flex-column">
                  <figure className="mb-0 overflow-hidden position-relative">
                    <img src={post.img} alt={post.title} className="w-100" style={{ height: '220px', objectFit: 'cover' }} />
                  </figure>
                  <Link to={`/blog?category=${encodeURIComponent(post.category)}`}>
                    <h6>{post.category}</h6>
                  </Link>
                  <div className="blog-style-text flex-grow-1 d-flex flex-column justify-content-between">
                    <h5>
                      {post.date.day}
                      <span>{post.date.monthYear}</span>
                    </h5>
                    <div>
                      <Link to={`/blog/${post.id}`}>
                        <h3>{post.title}</h3>
                      </Link>
                      <p>{post.excerpt}</p>
                      <div className="d-flex align-items-center mt-3">
                        <img src={post.authorImg} alt={post.author} className="rounded-circle me-2" style={{ width: '40px', height: '40px' }} />
                        <h4>{post.author}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default Blog;
