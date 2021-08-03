<template>
    <div>
        <div class="mb-5" v-if="thoughts.length > 0">
            <div v-for="item in thoughts" :data-id="item.id">
                <div class="thought-container">
                    <span>{{ item.text }}</span>
                    <button
                        type="button"
                        class="close"
                        @click="onThoughtRemove(item.id)"
                    >
                        <span>&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="mb-5 no-thoughts">Идей пока нет. Добавите?</div>
        </div>
        <div class="new-thought">
            <input
                type="text"
                name="add-thought"
                v-model="newThought"
                placeholder="Добавить новую идею"
            />
            <button v-if="newThought.trim().length > 0" @click="addNewThought">
                {{ addThoughtText }}
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    async mounted() {
        await this.fetchThoughts();
    },
    data() {
        return {
            thoughts: [],
            newThought: "",
            dragging: false,
        };
    },
    methods: {
        async fetchThoughts() {
            const response = await axios.get("/fetch-thoughts");
            this.thoughts = (response.data && response.data.thoughts) || [];
            console.log(this.thoughts);
        },
        async addNewThought() {
            if (this.newThought.trim().length) {
                await axios.post("/thoughts", {
                    text: this.newThought,
                });
                this.newThought = "";
                await this.fetchThoughts();
            }
        },
        async onThoughtRemove(id) {
            await axios.delete(`/thoughts/${id}`);
            await this.fetchThoughts();
        },
    },
    computed: {
        addThoughtText() {
            return this.newThought.trim().length < 20
                ? "лучше бы подробнее..."
                : "добавить";
        },
    },
};
</script>

<style scoped lang="scss">
.no-thoughts {
    font-style: italic;
}

.thought-container {
    display: inline-flex;
    justify-content: space-between;
    align-items: center;
    min-width: 40%;
    background: white;
    padding: 15px 25px;
    margin-bottom: 10px;

    button {
        display: inline-block;
        margin-left: 20px;
        user-select: none;
    }
}

.new-thought {
    input {
        border: none;
        outline: none;
        background: white;
        padding: 15px 25px;
        min-width: 40%;
    }

    button {
        display: block;
        border: none;
        outline: none;
        margin-top: 10px;
        color: #888888;

        &:hover {
            color: #555555;
        }
    }
}
</style>
