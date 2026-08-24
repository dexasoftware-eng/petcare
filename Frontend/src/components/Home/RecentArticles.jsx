import React from 'react';
import { Link } from 'react-router-dom';
import SectionHeading from '../Common/SectionHeading';
import { blogPosts } from '../../data/blog';

const RecentArticles = () => {
  const recent = blogPosts.slice(0, 3);

  return (
    <section className="gap no-bottom">
      <div className="container">
        <SectionHeading
          subTitle="Blog and News"
          title="Recent Articles"
        />

        <div className="row g-4 mt-2">
          {recent.map((post, idx) => (
            <div
              key={post.id}
              className={`col-lg-4 col-md-6 ${idx === recent.length - 1 ? 'mb-0' : ''}`}
            >
              <div className="blog-style">
                <figure className="mb-0 overflow-hidden">
                  <img src={post.img} alt={post.title} className="w-100" />
                </figure>
                <Link to={`/blog?category=${encodeURIComponent(post.category)}`}>
                  <h6>{post.category}</h6>
                </Link>
                <div className="blog-style-text">
                  <h5>
                    {post.date.day}
                    <span>{post.date.monthYear}</span>
                  </h5>
                  <div>
                    <Link to={`/blog/${post.id}`}>
                      <h3>{post.title}</h3>
                    </Link>
                    <p>{post.excerpt}</p>
                    <div className="d-flex align-items-center">
                      <img src={post.authorImg} alt={post.author} className="rounded-circle me-2" />
                      <h4>{post.author}</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>

        <div className="btn-center text-center mt-5">
          <Link to="/blog" className="button">
            View All News
          </Link>
        </div>
      </div>
    </section>
  );
};

export default RecentArticles;
