<template>
    <div class="card d-inline-flex">
        <div class="card-header">Маятник</div>
        <LocalComponent />
        <div class="card-body">
            <canvas ref="canvas" />
            <div class="d-flex justify-content-between">
                <div>
                    <Fab @click="onClickAmpUp">
                        <ArrowUp />
                    </Fab>
                    <Fab @click="onClickAmpDown">
                        <ArrowDown />
                    </Fab>
                </div>
                <Fab @click="restart">
                    <Restart />
                </Fab>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, onBeforeUnmount, ref, computed, watch } from "vue";
import { WW, HH, length } from "./params";

export default {
    name: "Pendulum",

    setup() {
        const canvas = ref(null);
        const ctx = ref(null);
        const timer = ref(null);
        const t = ref(0);
        const speed = ref(10);
        const cx = ref(WW / 2);
        const cy = ref(HH / 2);
        const angle = ref(0); // radians
        const rc = ref(10);
        const r = ref(20);
        const A = ref(2);
        const x = computed(() => cx.value + length * Math.sin(angle.value));
        const y = computed(() => cy.value + length * Math.cos(angle.value));

        const resetTimer = () => {
            if (timer.value) {
                clearInterval(timer.value);
            }
            timer.value = setInterval(go, speed.value);
        };

        function go() {
            const g = 9.8;
            const w = Math.sqrt(g / length);
            const dt = speed.value / 100;
            angle.value -= A.value * w * Math.sin(w * t.value + 1.5) * dt;
            t.value += dt;
        }

        function paint() {
            clearCanvas();
            drawPendulum();
        }

        watch(angle, () => paint());

        function clearCanvas() {
            ctx.value.fillStyle = "white";
            ctx.value.fillRect(0, 0, WW, HH);
            ctx.value.strokeStyle = "black";
            ctx.value.lineWidth = 1;
            ctx.value.strokeRect(0, 0, WW, HH);
        }

        function drawPendulum() {
            ctx.value.beginPath();
            ctx.value.strokeStyle = "black";
            ctx.value.lineWidth = 1;
            ctx.value.moveTo(cx.value, cy.value);
            ctx.value.lineTo(x.value, y.value);
            ctx.value.closePath();
            ctx.value.stroke();

            ctx.value.beginPath();
            ctx.value.fillStyle = "green";
            ctx.value.setLineDash([1, 15]);
            ctx.value.arc(cx.value, cy.value, length, 0, 2 * Math.PI, true);
            ctx.value.closePath();
            ctx.value.stroke();

            ctx.value.setLineDash([]);

            ctx.value.beginPath();
            ctx.value.fillStyle = "black";
            ctx.value.arc(cx.value, cy.value, rc.value, 0, 2 * Math.PI, true);
            ctx.value.closePath();
            ctx.value.fill();

            ctx.value.beginPath();
            ctx.value.fillStyle = "black";
            ctx.value.arc(x.value, y.value, r.value, 0, 2 * Math.PI, true);
            ctx.value.closePath();
            ctx.value.fill();
        }

        const restart = () => {
            A.value = 2;
            t.value = 0;
            angle.value = 0;
            paint();
            resetTimer();
        };

        function onClickAmpUp() {
            if (A.value < 4) {
                A.value += 0.2;
            }
        }

        function onClickAmpDown() {
            if (A.value > 0.2) {
                A.value -= 0.2;
            }
        }

        onMounted(() => {
            ctx.value = canvas.value.getContext("2d");
            canvas.value.setAttribute("width", WW);
            canvas.value.setAttribute("height", HH);

            restart();
        });

        onBeforeUnmount(() => {
            if (timer.value) {
                clearInterval(timer.value);
            }
        });

        return {
            canvas,
            onClickAmpUp,
            onClickAmpDown,
            restart,
            A,
        };
    },
};
</script>

<style scoped></style>
