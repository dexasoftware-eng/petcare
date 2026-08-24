const sanitizeObject = (target) => {
  if (!target || typeof target !== 'object') {
    return target;
  }

  if (Array.isArray(target)) {
    return target.map((item) => sanitizeObject(item));
  }

  const cleaned = {};
  for (const key of Object.keys(target)) {
    // Strip leading dollar signs or dots from keys
    const sanitizedKey = key.replace(/^\$|\./g, '');
    cleaned[sanitizedKey] = sanitizeObject(target[key]);
  }
  return cleaned;
};

export const noSqlSanitize = (req, res, next) => {
  if (req.body) {
    req.body = sanitizeObject(req.body);
  }
  if (req.query) {
    req.query = sanitizeObject(req.query);
  }
  if (req.params) {
    req.params = sanitizeObject(req.params);
  }
  next();
};
