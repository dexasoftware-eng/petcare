import React, { useState } from 'react';
import { useLocation } from '../../router/Router';
import Header from './Header';
import MobileNav from './MobileNav';
import Footer from './Footer';
import CartModal from '../common/CartModal';
import SearchModal from '../common/SearchModal';
import LightboxModal from '../common/LightboxModal';
import ScrollToTop from '../common/ScrollToTop';
import Preloader from '../common/Preloader';
import { initialCartItems } from '../../data/templateData';

export default function MainLayout({ children }) {
  const location = useLocation();
  const pathname = location.pathname || '';
  const isAuthOrDashboard =
    pathname.startsWith('/login') ||
    pathname.startsWith('/register') ||
    pathname.startsWith('/forgot-password') ||
    pathname.startsWith('/reset-password') ||
    pathname.startsWith('/verify-email') ||
    pathname.startsWith('/dashboard');

  const [isMobileNavOpen, setIsMobileNavOpen] = useState(false);
  const [isCartOpen, setIsCartOpen] = useState(false);
  const [isSearchOpen, setIsSearchOpen] = useState(false);
  const [lightboxImage, setLightboxImage] = useState(null);
  const [cartItems, setCartItems] = useState(initialCartItems);

  const handleAddToCart = (item) => {
    setCartItems((prev) => {
      const existing = prev.find((i) => i.id === item.id);
      if (existing) {
        return prev.map((i) =>
          i.id === item.id ? { ...i, quantity: i.quantity + 1 } : i
        );
      }
      return [...prev, { ...item, quantity: 1 }];
    });
    setIsCartOpen(true);
  };

  const handleRemoveCartItem = (id) => {
    setCartItems((prev) => prev.filter((item) => item.id !== id));
  };

  if (isAuthOrDashboard) {
    return (
      <div className="auth-dashboard-wrapper">
        <main>
          {React.Children.map(children, (child) => {
            if (React.isValidElement(child)) {
              return React.cloneElement(child, {
                onAddToCart: handleAddToCart,
                onOpenLightbox: (src) => setLightboxImage(src),
              });
            }
            return child;
          })}
        </main>
      </div>
    );
  }

  return (
    <div className="main-wrapper">
      <Preloader />

      <Header
        onOpenCart={() => setIsCartOpen(true)}
        onOpenSearch={() => setIsSearchOpen(true)}
        onOpenMobileNav={() => setIsMobileNavOpen(true)}
      />

      <MobileNav
        isOpen={isMobileNavOpen}
        onClose={() => setIsMobileNavOpen(false)}
      />

      <main>
        {React.Children.map(children, (child) => {
          if (React.isValidElement(child)) {
            return React.cloneElement(child, {
              onAddToCart: handleAddToCart,
              onOpenLightbox: (src) => setLightboxImage(src),
            });
          }
          return child;
        })}
      </main>

      <Footer />

      <CartModal
        isOpen={isCartOpen}
        onClose={() => setIsCartOpen(false)}
        cartItems={cartItems}
        onRemoveItem={handleRemoveCartItem}
      />

      <SearchModal
        isOpen={isSearchOpen}
        onClose={() => setIsSearchOpen(false)}
      />

      <LightboxModal
        isOpen={!!lightboxImage}
        imageSrc={lightboxImage}
        onClose={() => setLightboxImage(null)}
      />

      <ScrollToTop />
    </div>
  );
}
