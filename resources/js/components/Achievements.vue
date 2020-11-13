<template>
    <div class="card">
        <div class="card-header">Мои достижения</div>
        <div class="card-body">
            <div class="mb-5" v-if="achievements.length > 0">
                <div class="" v-for="item in achievements" :data-id="item.id">
                    {{ item.achievement }}
                    <button type="button" class="close" @click="onAchievementRemove(item.id)">
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="mb-5 no-achievements">Достижений нет? Даже не верится...</div>
            </div>
            <input class="form-control" type="text" name="add-achievement" v-model="newAchievement" @keyup.enter="onEnter">
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        async mounted() {
            await this.fetchAchievements();
        },
        data() {
            return {
                achievements: [],
                newAchievement: ''
            }
        },
        methods: {
            async fetchAchievements() {
                const response = await axios.get('/fetch-achievements');
                this.achievements = response.data && response.data.achievements || [];
                console.log(this.achievements);
            },
            async onEnter() {
                if(this.newAchievement.trim().length) {
                    await axios.post('/achievements', {
                        achievement: this.newAchievement
                    });
                    this.newAchievement = '';
                    await this.fetchAchievements();
                }
            },
            async onAchievementRemove(id) {
                await axios.delete(`/achievements/${id}`);
                await this.fetchAchievements();
            }
        }
    }
</script>

<style scoped lang="scss">
    .no-achievements {
        font-style: italic;
    }
</style>
