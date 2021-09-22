<template>
    <div class="card d-inline-flex">
        <div class="card-header">Игра "Жизнь"</div>
        <div class="card-body">
            <canvas
                width="1000"
                height="600"
                ref="fieldRef"
            />
            <div>
                <div class="mt-3"><span>Начальный объём популяции: </span><input type="text" v-model="initCount" ></div>
                <div class="mt-3">
                    <button class="btn btn-warning" @click="speedUp">Ускорить</button>
                    <button class="btn btn-info ml-2" @click="speedDown">Замедлить</button>
                    <button class="btn btn-secondary ml-2 mr-5" @click="speedDefault">По умолчанию</button>
                    <button class="btn btn-primary ml-5" @click="restart">Рестарт</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, onBeforeUnmount, ref } from 'vue';
import useField from './field';
import { accelerationRate, defaultSpeed } from './params';

export default {
    name: "Life",

    setup() {
        const { fieldRef, initField, step, initCount } = useField();
        const speed = ref(defaultSpeed);
        const timer = ref(null);

        const resetTimer = () => {
            if (timer.value) {
                clearInterval(timer.value);
            }
            timer.value = setInterval(go, speed.value);
        };

        const restart = () => {
            initField();
            resetTimer();
        };

        onMounted(() => {
            restart();
        });

        onBeforeUnmount(() => {
            if (timer.value) {
                clearInterval(timer.value);
            }
        })

        const go = () => {
            step();
        };

        const speedUp = () => {
            speed.value *= accelerationRate;
            resetTimer();
        };

        const speedDown = () => {
            speed.value /= accelerationRate;
            resetTimer();
        };

        const speedDefault = () => {
            speed.value = defaultSpeed
            resetTimer();
        }

        return { fieldRef, initCount, speedUp, speedDown, speedDefault, restart }
    }
};
</script>

<style scoped></style>
