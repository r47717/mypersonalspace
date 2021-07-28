<template>
    <div class="card">
        <div class="card-body">
            <div class="mb-5" v-if="links.length > 0">
                <div class="" v-for="item in links" :data-id="item.id">
                    <a :href="item.link" target="_blank">{{
                        item.comment || item.link
                    }}</a>
                    <button
                        type="button"
                        class="close"
                        @click="onLinkRemove(item.id)"
                    >
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="mb-5 no-links">Тут будет ваша коллекция ссылок</div>
            </div>
            <input
                class="form-control"
                type="text"
                name="add-link"
                v-model="newLink.link"
                @keyup.enter="onEnter"
            />
            <input
                class="form-control"
                type="text"
                name="add-link-comment"
                v-model="newLink.comment"
                @keyup.enter="onEnter"
            />
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    async mounted() {
        await this.fetchLinks();
    },
    data() {
        return {
            links: [],
            newLink: {
                link: "",
                comment: "",
            },
        };
    },
    methods: {
        async fetchLinks() {
            const response = await axios.get("/fetch-links");
            this.links = (response.data && response.data.links) || [];
            console.log(this.links);
        },
        async onEnter() {
            if (this.newLink.link.trim().length) {
                await axios.post("/links", {
                    link: this.newLink.link,
                    comment: this.newLink.comment,
                });
                this.newLink = {
                    link: "",
                    comment: "",
                };
                await this.fetchLinks();
            }
        },
        async onLinkRemove(id) {
            await axios.delete(`/links/${id}`);
            await this.fetchLinks();
        },
    },
};
</script>

<style scoped lang="scss">
.no-links {
    font-style: italic;
}
</style>
