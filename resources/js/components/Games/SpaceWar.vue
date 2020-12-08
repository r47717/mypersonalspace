<template>
    <div class="card d-inline-flex">
        <div class="card-header">Звёздные Войны</div>
        <div class="card-body">
            <div class="stopped" v-if="stopped">Игра окончена</div>
            <canvas width="600" height="600" class="field" tabindex=-1 ref="field" @keydown="onKeyDown"/>
        </div>
    </div>
</template>

<script>
const WW = 600;
const HH = 600;
const DX = 10;
const DY = 10;
const NX = WW / DX;
const NY = HH / DY;

export default {
    name: "SpaceWar",
    data() {
        return {
            stopped: false,
            map: [],
            speed: 500, // ms
            timer: null,
            fieldColor: "eeeeee",
            weaponColor: "000000",
            weaponSize: 10,
            weaponPos: 10,
            weapon: [],
        }
    },
    mounted() {
        this.initField();
        this.initWeapon();
        this.$refs.field.focus();
        this.timer = setInterval(this.go, this.speed);
    },
    beforeDestroy() {
        clearInterval(this.timer);
    },
    methods: {
        initField() {
            this.map = new Array(NY).fill(0).map(row => new Array(NX).fill(0));
        },
        initWeapon() {
            this.weapon = []
        },
        paint() {
            const ctx = this.$refs.field.getContext('2d');

            ctx.fillStyle = `#${this.fieldColor}`;
            ctx.fillRect(0, 0, WW, HH);

            this.drawWeapon();
        },
        go() {
            this.paint();
        },
        onKeyDown(event) {
            switch (event.keyCode) {
                case 32: // space
                    this.fire();
                    break;
                case 37: // left
                    this.moveLeft();
                    break;
                case 39: // right
                    this.moveRight();
                    break;
            }
            this.paint();
        },
        moveLeft() {
            if (this.weaponPos > 0) {
                this.weaponPos--;
            }
        },
        moveRight() {
            if (this.weaponPos + this.weaponSize > NX - 1) {
                this.weaponPos++;
            }
        },
        fire() {
            console.log('fire!');
        },
        drawWeapon() {
            const ctx = this.$refs.field.getContext('2d');

            ctx.fillStyle = `#${this.weaponColor}`;
            ctx.fillRect(0, 0, WW, HH);
        }
    }
}
</script>

<style scoped>

</style>
