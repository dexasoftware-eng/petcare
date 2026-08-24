import React, { createContext, useContext, useState, useEffect } from 'react';

const RouterContext = createContext({
  currentPath: window.location.pathname,
  navigate: () => {},
});

export function BrowserRouter({ children }) {
  const [currentPath, setCurrentPath] = useState(window.location.pathname);

  useEffect(() => {
    const handlePopState = () => {
      setCurrentPath(window.location.pathname);
    };

    window.addEventListener('popstate', handlePopState);
    return () => window.removeEventListener('popstate', handlePopState);
  }, []);

  const navigate = (to) => {
    if (
      to.startsWith('http://') ||
      to.startsWith('https://') ||
      to.startsWith('mailto:') ||
      to.startsWith('tel:')
    ) {
      window.location.href = to;
      return;
    }
    window.history.pushState({}, '', to);
    setCurrentPath(to);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  return (
    <RouterContext.Provider value={{ currentPath, navigate }}>
      {children}
    </RouterContext.Provider>
  );
}

export function useRouter() {
  return useContext(RouterContext);
}

export function useNavigate() {
  const { navigate } = useContext(RouterContext);
  return navigate;
}

export function useLocation() {
  const { currentPath } = useContext(RouterContext);
  return { pathname: currentPath, search: window.location.search };
}

export function Link({ to, children, className = '', activeClassName = 'active', onClick, ...props }) {
  const { currentPath, navigate } = useContext(RouterContext);
  const isActive = currentPath === to;

  const handleClick = (e) => {
    if (onClick) onClick(e);
    if (
      !e.defaultPrevented &&
      !props.target &&
      !to.startsWith('http') &&
      !to.startsWith('mailto:') &&
      !to.startsWith('tel:') &&
      !to.startsWith('#')
    ) {
      e.preventDefault();
      navigate(to);
    }
  };

  const combinedClass = `${className} ${isActive ? activeClassName : ''}`.trim();

  return (
    <a href={to} className={combinedClass} onClick={handleClick} {...props}>
      {children}
    </a>
  );
}

export function Routes({ children }) {
  const { currentPath } = useContext(RouterContext);

  let exactMatch = null;
  let prefixMatch = null;
  let fallbackMatch = null;

  React.Children.forEach(children, (child) => {
    if (React.isValidElement(child)) {
      const { path, element } = child.props;
      if (path === currentPath) {
        if (!exactMatch) exactMatch = element;
      } else if (path !== '*' && path !== '/' && currentPath.startsWith(path)) {
        if (!prefixMatch) prefixMatch = element;
      } else if (path === '*') {
        if (!fallbackMatch) fallbackMatch = element;
      }
    }
  });

  return exactMatch || prefixMatch || fallbackMatch || null;
}

export function Route({ path, element }) {
  return null;
}
