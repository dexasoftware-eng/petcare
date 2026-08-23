import React, { useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route, useLocation } from 'react-router-dom';
import { CartProvider } from './context/CartContext';

// Layout Components
import Header from './components/Layout/Header';
import Footer from './components/Layout/Footer';
import MobileNav from './components/Layout/MobileNav';
import CartModal from './components/Layout/CartModal';
import SearchModal from './components/Layout/SearchModal';
import ScrollToTop from './components/Layout/ScrollToTop';

// Pages
import Home from './pages/Home';
import About from './pages/About';
import Services from './pages/Services';
import ServiceDetails from './pages/ServiceDetails';
import Shop from './pages/Shop';
import ProductDetails from './pages/ProductDetails';
import Cart from './pages/Cart';
import Checkout from './pages/Checkout';
import Blog from './pages/Blog';
import BlogDetails from './pages/BlogDetails';
import Pricing from './pages/Pricing';
import TeamDetails from './pages/TeamDetails';
import HowWeWork from './pages/HowWeWork';
import History from './pages/History';
import Gallery from './pages/Gallery';
import Contact from './pages/Contact';
import Login from './pages/Login';
import NotFound from './pages/NotFound';

// Helper component to scroll window to top on route change
function RouteChangeScroll() {
  const { pathname } = useLocation();
  useEffect(() => {
    window.scrollTo(0, 0);
  }, [pathname]);
  return null;
}

function App() {
  return (
    <CartProvider>
      <Router>
        <RouteChangeScroll />
        <div className="app-layout d-flex flex-column min-vh-100 position-relative">
          <Header />
          <MobileNav />
          <CartModal />
          <SearchModal />
          <ScrollToTop />

          <main className="flex-grow-1">
            <Routes>
              {/* Home */}
              <Route path="/" element={<Home />} />
              <Route path="/index.html" element={<Home />} />
              <Route path="/home" element={<Home />} />

              {/* About */}
              <Route path="/about" element={<About />} />
              <Route path="/about.html" element={<About />} />

              {/* Services */}
              <Route path="/services" element={<Services />} />
              <Route path="/services.html" element={<Services />} />
              <Route path="/service-details" element={<ServiceDetails />} />
              <Route path="/service-details.html" element={<ServiceDetails />} />

              {/* Shop */}
              <Route path="/shop" element={<Shop />} />
              <Route path="/our-products.html" element={<Shop />} />
              <Route path="/product/:id" element={<ProductDetails />} />
              <Route path="/product-details" element={<ProductDetails />} />
              <Route path="/product-details.html" element={<ProductDetails />} />
              <Route path="/cart" element={<Cart />} />
              <Route path="/shop-cart.html" element={<Cart />} />
              <Route path="/checkout" element={<Checkout />} />
              <Route path="/cart-checkout.html" element={<Checkout />} />

              {/* Blog */}
              <Route path="/blog" element={<Blog />} />
              <Route path="/our-blog.html" element={<Blog />} />
              <Route path="/blog/:id" element={<BlogDetails />} />
              <Route path="/blog-details" element={<BlogDetails />} />
              <Route path="/blog-details.html" element={<BlogDetails />} />

              {/* Pages */}
              <Route path="/pricing" element={<Pricing />} />
              <Route path="/pricing-packages.html" element={<Pricing />} />
              <Route path="/team-details" element={<TeamDetails />} />
              <Route path="/team-details.html" element={<TeamDetails />} />
              <Route path="/team/:id" element={<TeamDetails />} />
              <Route path="/how-we-work" element={<HowWeWork />} />
              <Route path="/how-we-works.html" element={<HowWeWork />} />
              <Route path="/history" element={<History />} />
              <Route path="/history.html" element={<History />} />
              <Route path="/gallery" element={<Gallery />} />
              <Route path="/photo-gallery.html" element={<Gallery />} />
              <Route path="/contact" element={<Contact />} />
              <Route path="/contact.html" element={<Contact />} />
              <Route path="/login" element={<Login />} />
              <Route path="/login.html" element={<Login />} />

              {/* 404 Catch-All */}
              <Route path="*" element={<NotFound />} />
            </Routes>
          </main>

          <Footer />
        </div>
      </Router>
    </CartProvider>
  );
}

export default App;
