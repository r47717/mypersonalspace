<template>
    <div>
        <div class="header d-flex justify-content-between mb-3">
            <div>{{ title }}</div>
            <div class="plus-icon" @click="onPlusClick">
                <i class="fas fa-plus"></i>
            </div>
        </div>
        <input
            v-for="(item, index) in internalItems"
            :key="index"
            type="text"
            class="list-input mb-1"
            @blur="onBlur"
            v-model="item.value"
            ref="itemRefs"
        />
    </div>
</template>

<script>
export default {
    name: "ListPlus",
    props: {
        title: {
            type: String,
        },
        items: {
            type: Array,
            default: function () {
                return [""];
            },
        },
    },
    data() {
        return {
            internalItems: [{ value: "" }],
        };
    },
    methods: {
        onBlur() {
            this.$emit("blur", this.clearedItems);
        },
        onPlusClick() {
            const length = this.internalItems.push({ value: "" });
            this.$nextTick(() => {
                this.$refs.itemRefs[length - 1].focus();
            });
        },
    },
    watch: {
        items(newItems) {
            this.internalItems = newItems.map((item) => ({ value: item }));
            if (this.internalItems.length === 0) {
                this.internalItems.push({ value: "" });
            }
        },
    },
    computed: {
        clearedItems() {
            return this.internalItems
                .map((itemObj) => itemObj.value)
                .filter((item) => item.trim().length > 0);
        },
    },
};
</script>

<style scoped>
.plus-icon {
    cursor: pointer;
}

.list-input {
    background: #eff8f1;
    border: none;
    width: 100%;
    padding: 0.5em 1em;
    outline: none;
}
</style>
