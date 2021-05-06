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
                        <textarea name="brilliant-idea" class="form-control w-100 h-100" v-model="ideaOfTheDay"
                                  @blur="onBlur"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card accomplishments">
                    <div class="card-header acc-header">
                        <div>Достижения</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 accomplishments-items">
                                <p>1. <input type="text" class="form-control" @blur="onBlur" v-model="achievements[0]">
                                </p>
                                <p>2. <input type="text" class="form-control" @blur="onBlur" v-model="achievements[1]">
                                </p>
                                <p>3. <input type="text" class="form-control" @blur="onBlur" v-model="achievements[2]">
                                </p>
                            </div>
                            <div class="col-lg-6 accomplishments-items">
                                <p>4. <input type="text" class="form-control" @blur="onBlur" v-model="achievements[3]">
                                </p>
                                <p>5. <input type="text" class="form-control" @blur="onBlur" v-model="achievements[4]">
                                </p>
                                <p>6. <input type="text" class="form-control" @blur="onBlur" v-model="achievements[5]">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-5 mb-2 mb-lg-0 offset-1">
                <div class="card">
                    <div class="card-header">Сегодня награждаются за примерное поведение</div>
                    <div class="card-body">
                        <input type="text" class="form-control" @blur="onBlur" v-model="likes[0]">
                        <input type="text" class="form-control mt-1" @blur="onBlur" v-model="likes[1]">
                        <input type="text" class="form-control mt-1" @blur="onBlur" v-model="likes[2]">
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-2 mb-lg-0">
                <div class="card">
                    <div class="card-header">Сегодня наказываются за пакости</div>
                    <div class="card-body">
                        <input type="text" class="form-control" @blur="onBlur" v-model="dislikes[0]">
                        <input type="text" class="form-control mt-1" @blur="onBlur" v-model="dislikes[1]">
                        <input type="text" class="form-control mt-1" @blur="onBlur" v-model="dislikes[2]">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Today",
    data() {
        return {
            mood: 4,
            ideaOfTheDay: '',
            achievements: [],
            likes: [],
            dislikes: [],
        }
    },
    async mounted() {
        const response = await axios.get(`/today`);
        const {idea, mood, thanks, nothanks, accomplishments} = response.data.data
        this.mood = mood
        this.ideaOfTheDay = idea
        this.achievements = accomplishments ? JSON.parse(accomplishments) : []
        this.likes = thanks ? JSON.parse(thanks) : []
        this.dislikes = nothanks ? JSON.parse(nothanks) : []
    },
    methods: {
        onMoodChange(mood) {
            this.mood = mood
            this.onBlur()
        },
        onBlur() {
            const data = {
                mood: this.mood,
                idea: this.ideaOfTheDay,
                achievements: this.achievements,
                likes: this.likes,
                dislikes: this.dislikes,
            }
            console.log(data)
            axios.post(`/today`, data)
        },
    }
}
</script>

<style scoped>

</style>
