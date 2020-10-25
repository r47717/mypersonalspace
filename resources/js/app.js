require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.trans = string => _.get(window.i18n, string);

Vue.component('today', require('./components/Today.vue').default);
Vue.component('thoughts', require('./components/Thoughts.vue').default);
Vue.component('books', require('./components/Books.vue').default);
Vue.component('new-note', require('./components/NewNote.vue').default);
Vue.component('new-file', require('./components/NewFile.vue').default);
Vue.component('tasks', require('./components/Tasks.vue').default);

const app = new Vue({
    el: '#app',
});


// misc JS code for server rendered things

$(() => {
    $("#new-note-text").on('input', (el) => {
        const { value } = el.target;
        if (!value || value.trim().length === 0) {
            $("#new-note-button").prop('disabled', true);
        } else {
            $("#new-note-button").prop('disabled', false);
        }
    })
});
