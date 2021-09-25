<template>
    <div class="card d-inline-flex">
        <div class="card-header">Маятник</div>
        <div class="card-body">
            <canvas width="1000" height="600" ref="fieldRef" />
            <div></div>
        </div>
    </div>
</template>

<script>
import { onMounted, onBeforeUnmount, ref } from "vue";
import {} from "./params";

export default {
    name: "Pendulum",

    setup() {
        const fieldRef = ref(null);
        const timer = ref(null);

        const resetTimer = () => {
            if (timer.value) {
                clearInterval(timer.value);
            }
            // timer.value = setInterval(go, speed.value);
        };

        const paint = () => {};

        const restart = () => {
            paint();
            resetTimer();
        };

        onMounted(() => {
            restart();
        });

        onBeforeUnmount(() => {
            if (timer.value) {
                clearInterval(timer.value);
            }
        });

        return {
            fieldRef,
            initCount,
            speedUp,
            speedDown,
            speedDefault,
            restart,
        };
    },
};
</script>

<style scoped></style>
