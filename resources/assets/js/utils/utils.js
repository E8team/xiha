export function getBaseUrl () {
  // return window.location.pathname.split('/')[0];
  return '/';
}
export function getCsrfToken () {
  const tokenMeta = document.head.querySelector('meta[name="csrf-token"]');
  return tokenMeta ? tokenMeta.content : '';
}

export function isLogin () {
  let jwtToken = localStorage.getItem('jwt_token');
  return !!jwtToken;
}

export function strLimit (str, limit, end = '...') {
  if (!str) {
    return '';
  }
  if (str.length < limit) {
    return str;
  }
  return str.substr(0, limit) + '...';
}
