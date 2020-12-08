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

Vue.component('notes', require('./components/Notes/Notes.vue').default);
Vue.component('note-type-select', require('./components/Notes/NoteTypeSelect').default);
Vue.component('new-note', require('./components/Notes/NewNote.vue').default);
Vue.component('generic-note', require('./components/Notes/GenericNote.vue').default);
Vue.component('list-note', require('./components/Notes/ListNote.vue').default);
Vue.component('reminder-note', require('./components/Notes/ReminderNote.vue').default);
Vue.component('experience-note', require('./components/Notes/ExperienceNote.vue').default);
Vue.component('wish-note', require('./components/Notes/WishNote.vue').default);

Vue.component('tasks', require('./components/Tasks.vue').default);
Vue.component('tag-box', require('./components/TagBox.vue').default);

Vue.component('shop', require('./components/Shop/Shop.vue').default);
Vue.component('product', require('./components/Shop/Product.vue').default);
Vue.component('new-product', require('./components/Shop/NewProduct.vue').default);

Vue.component('list-view-trigger', require('./components/General/ListViewTrigger.vue').default);

Vue.component('games-tetris', require('./components/Games/Tetris').default);
Vue.component('games-space-war', require('./components/Games/SpaceWar').default);


const app = new Vue({
    el: '#app',
});

