import "./bootstrap";
import "@fortawesome/fontawesome-free/js/brands";
import "@fortawesome/fontawesome-free/js/solid";
import "@fortawesome/fontawesome-free/js/regular";
import "@fortawesome/fontawesome-free/js/fontawesome";

import Vue from "vue";

window.Vue = Vue;

Vue.prototype.trans = (string) => _.get(window.i18n, string);

Vue.component("today", require("./components/Today/Today.vue").default);
Vue.component("mood", require("./components/Today/Mood.vue").default);
Vue.component("quote", require("./components/Today/Quote.vue").default);
Vue.component("list-plus", require("./components/Today/ListPlus.vue").default);

Vue.component("thoughts", require("./components/Thoughts.vue").default);
Vue.component("links", require("./components/Links.vue").default);
Vue.component("quotes", require("./components/Quotes.vue").default);
Vue.component("achievements", require("./components/Achievements.vue").default);
Vue.component("books", require("./components/Books.vue").default);

Vue.component("notes", require("./components/Notes/Notes.vue").default);
Vue.component(
    "note-type-select",
    require("./components/Notes/NoteTypeSelect").default
);
Vue.component("new-note", require("./components/Notes/NewNote.vue").default);
Vue.component(
    "generic-note",
    require("./components/Notes/GenericNote.vue").default
);
Vue.component("list-note", require("./components/Notes/ListNote.vue").default);
Vue.component(
    "reminder-note",
    require("./components/Notes/ReminderNote.vue").default
);
Vue.component(
    "experience-note",
    require("./components/Notes/ExperienceNote.vue").default
);
Vue.component("wish-note", require("./components/Notes/WishNote.vue").default);

Vue.component("tasks", require("./components/Tasks.vue").default);
Vue.component("tag-box", require("./components/TagBox.vue").default);

Vue.component("shop", require("./components/Shop/Shop.vue").default);
Vue.component("product", require("./components/Shop/Product.vue").default);
Vue.component(
    "new-product",
    require("./components/Shop/NewProduct.vue").default
);

Vue.component(
    "list-view-trigger",
    require("./components/General/ListViewTrigger.vue").default
);

Vue.component("games-tetris", require("./components/Games/Tetris").default);
Vue.component(
    "games-space-war",
    require("./components/Games/SpaceWar").default
);
Vue.component("games-balls", require("./components/Games/Balls").default);
Vue.component(
    "games-snake",
    require("./components/Games/Snake/SnakeGame").default
);
Vue.component("games-game15", require("./components/Games/Game15").default);

const app = new Vue({
    el: "#app",
});
