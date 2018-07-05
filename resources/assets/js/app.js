window.Vue = require('vue');
window.$ = require('jquery');

var VueResource = require('vue-resource');
var VueSelectize = require('vue2-selectize');

Vue.component('video-player', require('./components/VideoPlayer.vue'));
Vue.component('video-upload', require('./components/VideoUpload.vue'));
Vue.component('subscribe-button', require('./components/SubscribeButton.vue'));
Vue.component('video-voting', require('./components/VideoVoting.vue'));
Vue.component('video-comments', require('./components/VideoComments.vue'));
Vue.component('image-upload', require('./components/ImageUpload.vue'));

Vue.use(VueResource);
Vue.use(VueSelectize);

const app = new Vue({
    el: '#app',
    data: window.codetube,
});
