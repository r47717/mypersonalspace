<template>
    <div class="card">
        <div class="card-header">Теги</div>
        <div class="card-body">
            <div v-if="tags.length > 0">
                <a class="tag-label" v-for="tag in tags" href="#" @click="tagClicked(tag.id)">
                        {{ tag.tag }}
                </a>
            </div>
            <div v-if="tags.length === 0">
                <i>Пока нет тегов</i>
            </div>
            <input type="text" placeholder="Новый тег" name="newTag" v-model="newTag" @keyup.enter="onEnter">
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        async mounted() {
            await this.fetchTags();
        },
        data() {
            return {
                tags: [],
                newTag: "",
            }
        },
        methods: {
            async fetchTags() {
                const response = await axios.get('/tags');
                this.tags = response.data && response.data.tags || [];
            },
            async onEnter() {
                if (this.newTag.trim().length > 0) {
                    await axios.post('/tags', {
                        newTag: this.newTag,
                    });
                    this.newTag = '';
                    await this.fetchTags();
                }
            },
            tagClicked(id) {
                this.$emit('tag-clicked', id);
            }
        }
    }
</script>

<style scoped lang="scss">
    a.tag-label {
        display: inline-block;
        padding: 2px 4px;
        background: #95c5ed;
        color: #ffffff;
        border: none;
        border-radius: 7px;
        min-width: 30px;
        margin: 4px;
        text-decoration: none;
        text-align: center;
    }
    a.tag-label:hover {
        background: #4aa0e6;
    }
</style>
