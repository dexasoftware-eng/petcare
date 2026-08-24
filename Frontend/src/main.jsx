import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import './assets/css/bootstrap.min.css';
import './assets/css/owl.carousel.min.css';
import './assets/css/owl.theme.default.min.css';
import './assets/css/slick.css';
import './assets/css/slick-theme.css';
import './assets/css/jquery.fancybox.min.css';
import './assets/css/style.css';
import './assets/css/color.css';
import './assets/css/responsive.css';
import App from './App.jsx';

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <App />
  </StrictMode>,
);
