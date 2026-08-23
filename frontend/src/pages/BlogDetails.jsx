import React, { useState } from 'react';
import { useParams, Link } from 'react-router-dom';
import PageBanner from '../components/Common/PageBanner';
import InstaGallery from '../components/Home/InstaGallery';
import { blogPosts } from '../data/blog';

const BlogDetails = () => {
  const { id } = useParams();
  const post = blogPosts.find(p => p.id === parseInt(id || '1')) || blogPosts[0];
  const recentPosts = blogPosts.filter(p => p.id !== post.id).slice(0, 3);

  const [commentName, setCommentName] = useState('');
  const [commentText, setCommentText] = useState('');
  const [comments, setComments] = useState([
    {
      id: 1,
      name: "Emma Watson",
      date: "August 20, 2026",
      avatar: "/assets/img/comment-1.jpg",
      text: "This guide was profoundly helpful for my golden retriever puppy! The transition recommendations worked seamlessly."
    },
    {
      id: 2,
      name: "Marcus Vance",
      date: "August 22, 2026",
      avatar: "/assets/img/comment-2.jpg",
      text: "Clear, concise, and backed by genuine pet healthcare experience. Keep the amazing content coming!"
    }
  ]);

  const handleCommentSubmit = (e) => {
    e.preventDefault();
    if (commentName.trim() && commentText.trim()) {
      setComments(prev => [
        ...prev,
        {
          id: Date.now(),
          name: commentName.trim(),
          date: 'Just now',
          avatar: '/assets/img/comment-3.jpg',
          text: commentText.trim()
        }
      ]);
      setCommentName('');
      setCommentText('');
    }
  };

  return (
    <div className="blog-details-page">
      <PageBanner title="Blog Details" parentPage="News" parentLink="/blog" />

      <section className="gap">
        <div className="container">
          <div className="row g-5">
            {/* Main Article Content */}
            <div className="col-lg-8">
              <div className="blog-details-content">
                <img src={post.img} alt={post.title} className="w-100 rounded mb-4 shadow-sm" style={{ maxHeight: '420px', objectFit: 'cover' }} />

                <div className="d-flex align-items-center gap-3 mb-3">
                  <span className="badge px-3 py-2 text-white" style={{ backgroundColor: '#fa441d' }}>{post.category}</span>
                  <span className="text-muted"><i className="fa-regular fa-calendar me-1"></i>{post.date.day} {post.date.monthYear}</span>
                  <span className="text-muted"><i className="fa-regular fa-user me-1"></i>By {post.author}</span>
                </div>

                <h1 className="mb-4">{post.title}</h1>

                <p className="lead text-secondary leading-relaxed mb-4">
                  {post.content}
                </p>

                <p className="text-secondary leading-relaxed mb-4">
                  Pet nutritionists consistently emphasize the fundamental value of whole, bioavailable food sources tailored to your animal's lifestyle and age. Incorporating fiber-rich carbohydrates alongside clean protein aids digestion, stabilizes energy reserves, and supports long-term organ health.
                </p>

                {/* Blockquote callout */}
                <blockquote className="p-4 rounded border-start border-4 my-4" style={{ backgroundColor: '#fff8e5', borderColor: '#fa441d' }}>
                  <p className="fst-italic mb-2 fs-5 text-dark">
                    "A balanced diet is the cornerstone of preventative veterinary medicine. What we put in our pets' bowls directly determines their vigor and lifespan."
                  </p>
                  <footer className="blockquote-footer text-danger fw-bold">{post.author}</footer>
                </blockquote>

                <p className="text-secondary leading-relaxed mb-5">
                  Always consult with your registered veterinarian before executing radical alterations to your companion's diet, and ensure any transitions are staged gradually over 7 to 10 days to protect sensitive digestive tracts.
                </p>

                {/* Comments Section */}
                <div className="comments-section pt-5 border-top">
                  <h3 className="mb-4">Comments ({comments.length})</h3>
                  <div className="d-flex flex-column gap-4 mb-5">
                    {comments.map((c) => (
                      <div key={c.id} className="d-flex gap-3 p-3 rounded" style={{ backgroundColor: '#fcfcfc', border: '1px solid #f0f0f0' }}>
                        <img src={c.avatar} alt={c.name} className="rounded-circle" style={{ width: '50px', height: '50px', objectFit: 'cover' }} />
                        <div>
                          <div className="d-flex align-items-center gap-2">
                            <h6 className="mb-0 fw-bold">{c.name}</h6>
                            <small className="text-muted">• {c.date}</small>
                          </div>
                          <p className="mb-0 text-secondary mt-1">{c.text}</p>
                        </div>
                      </div>
                    ))}
                  </div>

                  {/* Comment Form */}
                  <h4 className="mb-3">Leave a Reply</h4>
                  <form onSubmit={handleCommentSubmit} className="row g-3">
                    <div className="col-md-6">
                      <input
                        type="text"
                        placeholder="Your Name *"
                        required
                        value={commentName}
                        onChange={(e) => setCommentName(e.target.value)}
                        className="form-control p-3"
                      />
                    </div>
                    <div className="col-md-6">
                      <input
                        type="email"
                        placeholder="Your Email *"
                        required
                        className="form-control p-3"
                      />
                    </div>
                    <div className="col-12">
                      <textarea
                        rows="4"
                        placeholder="Write your comment..."
                        required
                        value={commentText}
                        onChange={(e) => setCommentText(e.target.value)}
                        className="form-control p-3"
                      ></textarea>
                    </div>
                    <div className="col-12">
                      <button type="submit" className="button border-0">
                        Post Comment
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            {/* Sidebar */}
            <div className="col-lg-4">
              <div className="blog-sidebar">
                {/* Search */}
                <div className="p-4 rounded border mb-4" style={{ backgroundColor: '#fff8e5' }}>
                  <h5 className="mb-3">Search</h5>
                  <div className="input-group">
                    <input type="text" className="form-control" placeholder="Search..." />
                    <button className="button btn-sm border-0"><i className="fa-solid fa-search"></i></button>
                  </div>
                </div>

                {/* Recent Posts */}
                <div className="p-4 rounded border mb-4" style={{ backgroundColor: '#fff8e5' }}>
                  <h5 className="mb-3">Recent Posts</h5>
                  <ul className="list-unstyled mb-0">
                    {recentPosts.map((r) => (
                      <li key={r.id} className="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                        <img src={r.img} alt={r.title} className="rounded" style={{ width: '65px', height: '65px', objectFit: 'cover' }} />
                        <div>
                          <Link to={`/blog/${r.id}`} className="text-dark fw-bold small d-block mb-1">
                            {r.title}
                          </Link>
                          <small className="text-muted">{r.date.day} {r.date.monthYear}</small>
                        </div>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* Categories */}
                <div className="p-4 rounded border mb-4" style={{ backgroundColor: '#fff8e5' }}>
                  <h5 className="mb-3">Categories</h5>
                  <ul className="list-unstyled mb-0">
                    <li className="py-2 border-bottom d-flex justify-content-between"><Link to="/blog?category=Animal Care" className="text-dark">Animal Care</Link><span>(12)</span></li>
                    <li className="py-2 border-bottom d-flex justify-content-between"><Link to="/blog?category=Training" className="text-dark">Training</Link><span>(8)</span></li>
                    <li className="py-2 border-bottom d-flex justify-content-between"><Link to="/blog?category=Health" className="text-dark">Health</Link><span>(15)</span></li>
                    <li className="py-2 d-flex justify-content-between"><Link to="/blog?category=Therapy" className="text-dark">Therapy</Link><span>(6)</span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <InstaGallery />
    </div>
  );
};

export default BlogDetails;
