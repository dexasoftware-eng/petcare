import React from 'react';
import { BrowserRouter, Routes, Route } from './router/Router';
import { AuthProvider } from './context/AuthContext';
import MainLayout from './components/layout/MainLayout';

// Public Marketing Pages
import Home from './pages/Home';
import About from './pages/About';
import Services from './pages/Services';
import ServiceDetails from './pages/ServiceDetails';
import OurProducts from './pages/OurProducts';
import ProductDetails from './pages/ProductDetails';
import ShopCart from './pages/ShopCart';
import CartCheckout from './pages/CartCheckout';
import OurBlog from './pages/OurBlog';
import BlogDetails from './pages/BlogDetails';
import TeamDetails from './pages/TeamDetails';
import HowWeWork from './pages/HowWeWork';
import History from './pages/History';
import PricingPackages from './pages/PricingPackages';
import PhotoGallery from './pages/PhotoGallery';
import Contact from './pages/Contact';

// Authentication Pages
import Login from './pages/auth/Login';
import OwnerRegister from './pages/auth/OwnerRegister';
import VeterinarianRegister from './pages/auth/VeterinarianRegister';
import ShelterRegister from './pages/auth/ShelterRegister';
import ForgotPassword from './pages/auth/ForgotPassword';
import ResetPassword from './pages/auth/ResetPassword';
import VerifyEmail from './pages/auth/VerifyEmail';

// Protected Role Dashboards
import OwnerDashboard from './pages/dashboards/OwnerDashboard';
import VetDashboard from './pages/dashboards/VetDashboard';
import ShelterDashboard from './pages/dashboards/ShelterDashboard';
import AdminDashboard from './pages/dashboards/AdminDashboard';

// Route Guards
import RoleRoute from './components/auth/RoleRoute';
import GuestRoute from './components/auth/GuestRoute';

function App() {
  return (
    <BrowserRouter>
      <AuthProvider>
        <MainLayout>
          <Routes>
            {/* Public Marketing & Shop Pages */}
            <Route path="/" element={<Home />} />
            <Route path="/index.html" element={<Home />} />
            <Route path="/index-2.html" element={<Home />} />
            <Route path="/index-3.html" element={<Home />} />
            <Route path="/about" element={<About />} />
            <Route path="/about.html" element={<About />} />
            <Route path="/services" element={<Services />} />
            <Route path="/services.html" element={<Services />} />
            <Route path="/service-details" element={<ServiceDetails />} />
            <Route path="/service-details.html" element={<ServiceDetails />} />
            <Route path="/our-products" element={<OurProducts />} />
            <Route path="/our-products.html" element={<OurProducts />} />
            <Route path="/product-details" element={<ProductDetails />} />
            <Route path="/product-details.html" element={<ProductDetails />} />
            <Route path="/shop-cart" element={<ShopCart />} />
            <Route path="/shop-cart.html" element={<ShopCart />} />
            <Route path="/cart-checkout" element={<CartCheckout />} />
            <Route path="/cart-checkout.html" element={<CartCheckout />} />
            <Route path="/our-blog" element={<OurBlog />} />
            <Route path="/our-blog.html" element={<OurBlog />} />
            <Route path="/blog-details" element={<BlogDetails />} />
            <Route path="/blog-details.html" element={<BlogDetails />} />
            <Route path="/team-details" element={<TeamDetails />} />
            <Route path="/team-details.html" element={<TeamDetails />} />
            <Route path="/how-we-works" element={<HowWeWork />} />
            <Route path="/how-we-works.html" element={<HowWeWork />} />
            <Route path="/history" element={<History />} />
            <Route path="/history.html" element={<History />} />
            <Route path="/pricing-packages" element={<PricingPackages />} />
            <Route path="/pricing-packages.html" element={<PricingPackages />} />
            <Route path="/photo-gallery" element={<PhotoGallery />} />
            <Route path="/photo-gallery.html" element={<PhotoGallery />} />
            <Route path="/contact" element={<Contact />} />
            <Route path="/contact.html" element={<Contact />} />

            {/* Guest-only Authentication Routes */}
            <Route
              path="/login"
              element={
                <GuestRoute>
                  <Login />
                </GuestRoute>
              }
            />
            <Route
              path="/login.html"
              element={
                <GuestRoute>
                  <Login />
                </GuestRoute>
              }
            />
            <Route
              path="/register/owner"
              element={
                <GuestRoute>
                  <OwnerRegister />
                </GuestRoute>
              }
            />
            <Route
              path="/register/veterinarian"
              element={
                <GuestRoute>
                  <VeterinarianRegister />
                </GuestRoute>
              }
            />
            <Route
              path="/register/shelter"
              element={
                <GuestRoute>
                  <ShelterRegister />
                </GuestRoute>
              }
            />
            <Route
              path="/forgot-password"
              element={
                <GuestRoute>
                  <ForgotPassword />
                </GuestRoute>
              }
            />
            <Route
              path="/reset-password"
              element={
                <GuestRoute>
                  <ResetPassword />
                </GuestRoute>
              }
            />
            <Route path="/verify-email" element={<VerifyEmail />} />

            {/* Protected Role-Based Dashboards */}
            <Route
              path="/owner/dashboard"
              element={
                <RoleRoute allowedRoles={['owner', 'admin']}>
                  <OwnerDashboard />
                </RoleRoute>
              }
            />
            <Route
              path="/veterinarian/dashboard"
              element={
                <RoleRoute allowedRoles={['veterinarian', 'admin']}>
                  <VetDashboard />
                </RoleRoute>
              }
            />
            <Route
              path="/shelter/dashboard"
              element={
                <RoleRoute allowedRoles={['shelter', 'admin']}>
                  <ShelterDashboard />
                </RoleRoute>
              }
            />
            <Route
              path="/admin/dashboard"
              element={
                <RoleRoute allowedRoles={['admin']}>
                  <AdminDashboard />
                </RoleRoute>
              }
            />

            {/* Catch-all fallback */}
            <Route path="*" element={<Home />} />
          </Routes>
        </MainLayout>
      </AuthProvider>
    </BrowserRouter>
  );
}

export default App;
