<template>
    <div class="card">
        <div class="card-body">
            <div class="mb-5" v-if="achievements.length > 0">
                <div class="" v-for="item in achievements" :data-id="item.id">
                    {{ item.achievement }}
                    (<span v-for="tag in item.tags">{{ tag.tag }}&nbsp;</span>)
                    <button
                        type="button"
                        class="close"
                        @click="onAchievementRemove(item.id)"
                    >
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="mb-5 no-achievements">
                    Достижений нет? Даже не верится...
                </div>
            </div>
            <input
                class="form-control mb-3"
                type="text"
                name="add-achievement"
                v-model="newAchievement"
                @keyup.enter="onEnter"
            />
            <div>
                <div v-for="tag in newTags">{{ tag }}</div>
            </div>
            <tag-box @tag-clicked="onTagClicked"></tag-box>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    async mounted() {
        await this.fetchAchievements();
    },
    data() {
        return {
            achievements: [],
            newAchievement: "",
            newTags: [],
        };
    },
    methods: {
        async fetchAchievements() {
            const response = await axios.get("/fetch-achievements");
            this.achievements =
                (response.data && response.data.achievements) || [];
            console.log(this.achievements);
        },
        async onEnter() {
            if (this.newAchievement.trim().length) {
                await axios.post("/achievements", {
                    achievement: this.newAchievement,
                    tags: this.newTags.length ? this.newTags.join(" ") : null,
                });
                this.newAchievement = "";
                this.newTags = [];
                await this.fetchAchievements();
            }
        },
        async onAchievementRemove(id) {
            await axios.delete(`/achievements/${id}`);
            await this.fetchAchievements();
        },
        async onTagClicked(id) {
            if (!this.newTags.includes(id)) {
                this.newTags.push(id);
            }
        },
    },
};
</script>

<style scoped lang="scss">
.no-achievements {
    font-style: italic;
}
</style>
