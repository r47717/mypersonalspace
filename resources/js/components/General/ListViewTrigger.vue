<template>
    <div class="trigger">
        <div class="large-icons" @click="onClickLargeIcons" title="большие иконки">
            <div></div>
        </div>
        <div class="small-icons" @click="onClickSmallIcons" title="малые иконки">
            <div></div>
        </div>
        <div class="list" @click="onClickList" title="список">
            <div></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ListViewTrigger",
    methods: {
        onClickLargeIcons() {
            this.$emit('click-view', 'large-icons');
        },
        onClickSmallIcons() {
            this.$emit('click-view', 'small-icons');
        },
        onClickList() {
            this.$emit('click-view', 'list');
        },
    }
}
</script>

<style scoped lang="scss">
$bg_cell: #555555;

.trigger {
    position: relative;
    display: flex;
    height: 30px;
    width: 90px;

    div {
        flex-grow: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    div.large-icons {
        div {
            flex: 0 0 20px;
            height: 20px;
            background: $bg_cell;
        }
    }

    div.small-icons {
        div {
            flex: 0 0 10px;
            height: 10px;
            background: $bg_cell;
        }
    }

    div.list {
        div {
            flex: 0 0 20px;
            height: 5px;
            background: $bg_cell;
        }
    }
}
</style>
