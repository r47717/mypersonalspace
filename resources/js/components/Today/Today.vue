<template>
    <div>
        <div class="row">
            <div class="col-xl-2 col-lg-3 mb-2 mb-lg-0">
                <div class="card">
                    <div class="card-header">Настроение</div>
                    <div class="card-body d-flex justify-content-center">
                        <mood :value="mood" @change="onMoodChange"></mood>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-4 mb-2 mb-lg-0">
                <div class="card h-100">
                    <div class="card-header">Цитата дня</div>
                    <div class="card-body">
                        <quote></quote>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5">
                <div class="card h-100">
                    <div class="card-header">Идея дня</div>
                    <div class="card-body">
                        <textarea
                            name="brilliant-idea"
                            class="form-control w-100 h-100"
                            v-model="ideaOfTheDay"
                            @blur="onBlur"
                        ></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4"></div>
        <div class="row mt-4">
            <div class="col-xl-7">
                <div class="card accomplishments">
                    <div class="card-body">
                        <list-plus
                            title="Достижения"
                            :items="achievements"
                            @blur="onBlurAchievements"
                        ></list-plus>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 mb-2 mb-lg-0">
                <div class="card mb-5">
                    <div class="card-body">
                        <list-plus
                            title="Сегодня награждаются за примерное поведение"
                            :items="likes"
                            @blur="onBlurLikes"
                        ></list-plus>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <list-plus
                            title="Сегодня наказываются за пакости"
                            :items="dislikes"
                            @blur="onBlurDislikes"
                        ></list-plus>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Today",
    data() {
        return {
            mood: 4,
            ideaOfTheDay: "",
            achievements: [],
            likes: [],
            dislikes: [],
        };
    },
    async mounted() {
        const response = await axios.get(`/today`);
        if (response.data && response.data.data) {
            const { idea, mood, thanks, nothanks, accomplishments } =
                response.data.data;
            this.mood = mood;
            this.ideaOfTheDay = idea || "";
            this.achievements = accomplishments
                ? JSON.parse(accomplishments)
                : [];
            this.likes = thanks ? JSON.parse(thanks) : [];
            this.dislikes = nothanks ? JSON.parse(nothanks) : [];
        }
    },
    methods: {
        onMoodChange(mood) {
            this.mood = mood;
            this.onBlur();
        },
        onBlur() {
            const data = {
                mood: this.mood,
                idea: this.ideaOfTheDay || "",
                achievements: this.achievements,
                likes: this.likes,
                dislikes: this.dislikes,
            };
            console.log(data);
            axios.post(`/today`, data);
        },
        onBlurAchievements(items) {
            this.achievements = items;
            this.onBlur();
        },
        onBlurDislikes(items) {
            this.dislikes = items;
            this.onBlur();
        },
        onBlurLikes(items) {
            this.likes = items;
            this.onBlur();
        },
    },
};
</script>

<style scoped></style>
