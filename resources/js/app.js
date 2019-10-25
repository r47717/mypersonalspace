require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.trans = string => _.get(window.i18n, string);

Vue.component('mood', require('./components/Mood.vue').default);
Vue.component('quote', require('./components/Quote.vue').default);
Vue.component('new-note', require('./components/NewNote.vue').default);
Vue.component('new-file', require('./components/NewFile.vue').default);
Vue.component('tasks', require('./components/Tasks.vue').default);

const app = new Vue({
    el: '#app',
});
