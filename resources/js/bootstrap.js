window._ = require('lodash');

window.axios = require('axios');
window.bootstrap = require('bootstrap');

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

import Alpine from './alpine'
 
window.Alpine = Alpine
 
Alpine.start()