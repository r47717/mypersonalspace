require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.trans = string => _.get(window.i18n, string);

Vue.component('thoughts', require('./components/Thoughts.vue').default);
Vue.component('links', require('./components/Links.vue').default);
Vue.component('quotes', require('./components/Quotes.vue').default);
Vue.component('quote', require('./components/Quote.vue').default);
Vue.component('mood', require('./components/Mood.vue').default);
Vue.component('achievements', require('./components/Achievements.vue').default);
Vue.component('books', require('./components/Books.vue').default);
Vue.component('notes', require('./components/Notes.vue').default);
Vue.component('new-note', require('./components/NewNote.vue').default);
Vue.component('tasks', require('./components/Tasks.vue').default);
Vue.component('tag-box', require('./components/TagBox.vue').default);
Vue.component('shop', require('./components/Shop.vue').default);

const app = new Vue({
    el: '#app',
});

