require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.trans = string => _.get(window.i18n, string);

Vue.component('today', require('./components/Today.vue').default);
Vue.component('thoughts', require('./components/Thoughts.vue').default);
Vue.component('quotes', require('./components/Quotes.vue').default);
Vue.component('achievements', require('./components/Achievements.vue').default);
Vue.component('books', require('./components/Books.vue').default);
Vue.component('new-note', require('./components/NewNote.vue').default);
Vue.component('tasks', require('./components/Tasks.vue').default);

const app = new Vue({
    el: '#app',
});

