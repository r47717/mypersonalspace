import "./bootstrap";
import "@fortawesome/fontawesome-free/js/brands";
import "@fortawesome/fontawesome-free/js/solid";
import "@fortawesome/fontawesome-free/js/regular";
import "@fortawesome/fontawesome-free/js/fontawesome";

import { createApp } from "vue";

const app = createApp({});

window.Vue = app;

app.config.globalProperties.trans = (string) => _.get(window.i18n, string);

app.component("today", require("./components/Today/Today.vue").default);
app.component("thoughts", require("./components/Thoughts.vue").default);
app.component("links", require("./components/Links.vue").default);
app.component("quotes", require("./components/Quotes.vue").default);
app.component("achievements", require("./components/Achievements.vue").default);
app.component("books", require("./components/Books.vue").default);
app.component("notes", require("./components/Notes/Notes.vue").default);
app.component("google-note", require("./components/Notes/GoogleNote").default);

app.component("tasks", require("./components/Tasks.vue").default);
app.component("tag-box", require("./components/TagBox.vue").default);

app.component("shop", require("./components/Shop/Shop.vue").default);
app.component("product", require("./components/Shop/Product.vue").default);
app.component(
    "new-product",
    require("./components/Shop/NewProduct.vue").default
);

app.component("games-tetris", require("./components/Games/Tetris").default);
app.component(
    "games-space-war",
    require("./components/Games/SpaceWar").default
);
app.component("games-balls", require("./components/Games/Balls").default);
app.component(
    "games-snake",
    require("./components/Games/Snake/SnakeGame").default
);
app.component("games-game15", require("./components/Games/Game15").default);
app.component("games-chess", require("./components/Games/Chess").default);
app.component("games-life", require("./components/Games/Life/Life").default);
app.component(
    "games-pendulum",
    require("./components/Games/Pendulum/Pendulum").default
);

const common = require("./components/common");
for (const item of Object.keys(common)) {
    app.component(item, common[item]);
}

app.mount("#app");
