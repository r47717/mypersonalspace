<template>
    <div>
        <div class="row">
            <div class="col-xl-2 col-lg-3 mb-2 mb-lg-0">
                <div class="card">
                    <div class="card-header">Настроение</div>
                    <div class="card-body d-flex justify-content-center">
                        <mood :index="moodIndex" @mood-changed="onMoodChanged"></mood>
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
                        <textarea name="brilliant-idea" class="form-control w-100 h-100" v-model="idea" @input="updateNeeded = true"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card accomplishments">
                    <div class="card-header">Достижения</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 accomplishments-items">
                                <p>1. <input type="text" class="form-control" v-model="acc[0]" @input="updateNeeded = true"></p>
                                <p>2. <input type="text" class="form-control" v-model="acc[1]" @input="updateNeeded = true"></p>
                                <p>3. <input type="text" class="form-control" v-model="acc[2]" @input="updateNeeded = true"></p>
                            </div>
                            <div class="col-lg-6 accomplishments-items">
                                <p>4. <input type="text" class="form-control" v-model="acc[3]" @input="updateNeeded = true"></p>
                                <p>5. <input type="text" class="form-control" v-model="acc[4]" @input="updateNeeded = true"></p>
                                <p>6. <input type="text" class="form-control" v-model="acc[5]" @input="updateNeeded = true"></p>
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
                        <input type="text" class="form-control" v-model="thanks[0]" @input="updateNeeded = true">
                        <input type="text" class="form-control mt-1" v-model="thanks[1]" @input="updateNeeded = true">
                        <input type="text" class="form-control mt-1" v-model="thanks[2]" @input="updateNeeded = true">
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-2 mb-lg-0">
                <div class="card">
                    <div class="card-header">Сегодня наказываются за пакости</div>
                    <div class="card-body">
                        <input type="text" class="form-control" v-model="nothanks[0]" @input="updateNeeded = true">
                        <input type="text" class="form-control mt-1" v-model="nothanks[1]" @input="updateNeeded = true">
                        <input type="text" class="form-control mt-1" v-model="nothanks[2]" @input="updateNeeded = true">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Mood from "./Mood";
    import Quote from "./Quote";

    export default {
        name: "Today",

        components: {
            'mood': Mood,
            'quote': Quote
        },

        async mounted() {
            this.parseRetrievedData(await this.fetch());
            setInterval(() => {
                if (this.updateNeeded) {
                    this.updateNeeded = false;
                    this.save();
                }
            }, 500);
        },

        data() {
            return {
                data: null,
                updateNeeded: false,
                moodIndex: 0,
                idea: '',
                acc: [],
                thanks: [],
                nothanks: []
            }
        },

        computed: {
            accomplishments() {
                return this.acc.reduce((accum, item) => {
                    return accum === "" ? item : `${accum}\n${item}`;
                }, "");
            },
            thanks_aggregated() {
                return this.thanks.reduce((accum, item) => {
                    return accum === "" ? item : `${accum}\n${item}`;
                }, "");
            },
            nothanks_aggregated() {
                return this.nothanks.reduce((accum, item) => {
                    return accum === "" ? item : `${accum}\n${item}`;
                }, "");
            }
        },

        methods: {
            async fetch() {
                return await axios.get('/today');
            },
            parseRetrievedData(response) {
                const data = response.data && response.data.data  || {};
                this.moodIndex = data.mood || 0;
                this.idea = data.idea || "";
                this.acc = data.accomplishments ? data.accomplishments.split("\n") : [];
                this.thanks = data.thanks ? data.thanks.split("\n") : [];
                this.nothanks = data.nothanks ? data.nothanks.split("\n") : [];
            },
            save() {
                axios.post('/today', {
                    mood: this.moodIndex,
                    idea: this.idea,
                    accomplishments: this.accomplishments,
                    thanks: this.thanks_aggregated,
                    nothanks: this.nothanks_aggregated,
                })
            },
            onMoodChanged(index) {
                this.moodIndex = index;
                this.updateNeeded = true;
            }
        }
    }
</script>

<style scoped>

</style>
