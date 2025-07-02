import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Add CSRF token to all requests
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// Add request/response interceptors for better error handling
window.axios.interceptors.request.use(function (config) {
    // Show loading state if needed
    return config;
}, function (error) {
    return Promise.reject(error);
});

window.axios.interceptors.response.use(function (response) {
    // Hide loading state if needed
    return response;
}, function (error) {
    // Handle common errors
    if (error.response) {
        switch (error.response.status) {
            case 401:
                // Unauthorized - redirect to login
                window.location.href = '/login';
                break;
            case 403:
                // Forbidden
                console.error('Access forbidden');
                break;
            case 404:
                // Not found
                console.error('Resource not found');
                break;
            case 422:
                // Validation errors
                console.error('Validation errors:', error.response.data.errors);
                break;
            case 500:
                // Server error
                console.error('Server error');
                break;
        }
    }
    return Promise.reject(error);
});