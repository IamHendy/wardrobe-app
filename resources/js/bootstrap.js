import axios from 'axios';
window.axios = axios;

// Ensure that cookies (and session data) are sent with each request
window.axios.defaults.withCredentials = true;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: Please ensure a meta tag with name "csrf-token" is present in your HTML head.');
}
