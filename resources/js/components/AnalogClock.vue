<template>
    <div class="clock">
        <div class="component center"></div>
        <div class="component tick tick-major tick12"></div>
        <div class="component tick tick1"></div>
        <div class="component tick tick2"></div>
        <div class="component tick tick-major tick3"></div>
        <div class="component tick tick4"></div>
        <div class="component tick tick5"></div>
        <div class="component tick tick-major tick6"></div>
        <div class="component tick tick7"></div>
        <div class="component tick tick8"></div>
        <div class="component tick tick-major tick9"></div>
        <div class="component tick tick10"></div>
        <div class="component tick tick11"></div>
        <div
            class="component seconds"
            :style="{ transform: `rotate(${seconds * 6}deg)` }"
        ></div>
        <div
            class="component minutes"
            :style="{ transform: `rotate(${(minutes + seconds / 60) * 6}deg)` }"
        ></div>
        <div
            class="component hours"
            :style="{ transform: `rotate(${(hours + minutes / 60) * 30}deg)` }"
        ></div>
    </div>
</template>

<script>
import { onBeforeUnmount, onMounted, ref } from "vue";
export default {
    name: "analog clock",
    setup() {
        const hours = ref(0);
        const minutes = ref(0);
        const seconds = ref(0);
        const timer = ref(null);

        onMounted(() => {
            timer.value = setInterval(() => {
                const currentdate = new Date();
                hours.value = currentdate.getHours() % 12;
                minutes.value = currentdate.getMinutes();
                seconds.value = currentdate.getSeconds();
            }, 1000);
        });

        onBeforeUnmount(() => {
            if (timer) {
                clearInterval(timer);
            }
        });

        return { hours, minutes, seconds };
    },
};
</script>

<style scoped lang="scss">
.clock {
    --clockColor: #000;
    --tickWidth: 3px;
    --tickHeight: 16px;
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;

    .component {
        background: var(--clockColor);
    }

    .center {
        position: absolute;
        top: calc(50% - 7px);
        left: calc(50% - 7px);
        height: 14px;
        width: 14px;
        border-radius: 50%;
        z-index: 2000;
    }

    .tick {
        position: absolute;
        height: 50%;
        width: var(--tickWidth);
        bottom: 50%;
        left: calc(50% - var(--tickWidth) / 2);
        transform-origin: bottom center;
    }

    .tick:before {
        content: "";
        position: absolute;
        width: calc(var(--tickWidth) + 2px);
        height: 90%;
        top: 20%;
        left: -1px;
        background: #fff;
    }

    .tick-major:after {
        position: absolute;
        content: "";
        width: calc(var(--tickWidth) + 2px);
        height: 25px;
        top: 0;
        left: -2px;
        background: var(--clockColor);
    }

    .tick1 {
        transform: rotate(30deg);
    }
    .tick2 {
        transform: rotate(60deg);
    }
    .tick3 {
        transform: rotate(90deg);
    }
    .tick4 {
        transform: rotate(120deg);
    }
    .tick5 {
        transform: rotate(150deg);
    }
    .tick6 {
        transform: rotate(180deg);
    }
    .tick7 {
        transform: rotate(210deg);
    }
    .tick8 {
        transform: rotate(240deg);
    }
    .tick9 {
        transform: rotate(270deg);
    }
    .tick10 {
        transform: rotate(300deg);
    }
    .tick11 {
        transform: rotate(330deg);
    }

    .seconds {
        position: absolute;
        left: 50%;
        top: 0;
        width: 1px;
        height: 50%;
        transform-origin: bottom center;
    }

    .minutes {
        position: absolute;
        left: calc(50% - 3px / 2);
        top: 0;
        width: 3px;
        height: 50%;
        transform-origin: bottom center;
    }

    .hours {
        position: absolute;
        left: calc(50% - 3px);
        top: 20%;
        width: 6px;
        height: 30%;
        transform-origin: bottom center;
    }
}
</style>
