require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.trans = string => _.get(window.i18n, string);

Vue.component('today', require('./components/Today.vue').default);
Vue.component('new-note', require('./components/NewNote.vue').default);
Vue.component('new-file', require('./components/NewFile.vue').default);
Vue.component('tasks', require('./components/Tasks.vue').default);

const app = new Vue({
    el: '#app',
});
