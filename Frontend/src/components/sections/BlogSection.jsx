import React from 'react';
import { Link } from '../../router/Router';
import { blogArticles } from '../../data/templateData';

export default function BlogSection() {
  return (
    <section className="gap no-bottom">
      <div className="container">
        <div className="heading">
          <img src="/assets/img/heading-img.png" alt="heading-img" />
          <h6>Blog and News</h6>
          <h2>Recent Articles</h2>
        </div>
        <div className="row">
          {blogArticles.map((article, idx) => (
            <div key={article.id} className="col-lg-4 col-md-6">
              <div className={`blog-style ${idx === blogArticles.length - 1 ? 'mb-0' : ''}`}>
                <figure>
                  <img src={article.image} alt={article.title} />
                </figure>
                <Link to="/our-blog">
                  <h6>{article.category}</h6>
                </Link>
                <div className="blog-style-text">
                  <h5>
                    {article.day}
                    <span>{article.monthYear}</span>
                  </h5>
                  <div>
                    <Link to={article.link}>
                      <h3>{article.title}</h3>
                    </Link>
                    <p>{article.desc}</p>
                    <div className="d-flex align-items-center">
                      <img src={article.authorAvatar} alt={article.authorName} />
                      <h4>{article.authorName}</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
        <div className="btn-center">
          <Link to="/our-blog" className="button">
            View All News
          </Link>
        </div>
      </div>
    </section>
  );
}
