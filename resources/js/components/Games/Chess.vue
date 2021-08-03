<template>
    <div class="card d-inline-block">
        <div class="card-header">Шахматы</div>
        <div class="card-body">
            <div class="cell">1</div>
        </div>
    </div>
</template>

<script>
import { ref, watch } from "vue";

const NN = 8;
const xOrt = ["a", "b", "c", "d", "e", "f", "g", "h"];
const yOrt = [1, 2, 3, 4, 5, 6, 7, 8];

export default {
    name: "chess",
    data() {
        return {};
    },

    setup() {
        const field = ref(
            new Array(8).map((_) => null).map((row) => new Array())
        );

        return {
            field,
        };
    },

    methods: {
        init() {
            const field = [];
            yOrt.forEach((row) =>
                xOrt.forEach((col) => {
                    field[col][row] = 0;
                })
            );
        },
    },
};
</script>

<style scoped></style>
