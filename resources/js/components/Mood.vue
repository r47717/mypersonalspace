<template>
    <div :class="this.images[this.index]" @click="onClick"></div>
</template>

<script>
    export default {
        name: "Mood",
        props: [
            'index'
        ],
        mounted() {
            this.currIndex = this.index;
        },
        data() {
            return {
                currIndex: 0,
                images: [
                    'm1', 'm2', 'm3', 'm4', 'm5', 'm6',
                    'm7', 'm8', 'm9', 'm10', 'm11', 'm12',
                    'm13', 'm14', 'm15', 'm16', 'm17', 'm18',
                    'm19', 'm20', 'm21', 'm22', 'm23', 'm24'
                ]
            }
        },
        methods: {
            onClick() {
                if (++this.currIndex >= this.images.length) {
                    this.currIndex = 0;
                }
                this.$emit('mood-changed', this.currIndex);
            }
        }
    }
</script>

<style scoped>
    div {
        height: 100px;
        width: 100px;
        background-repeat: no-repeat;
        background-size: 640px 432px;
        background-image: url("/img/mood.png");
        cursor: pointer;
    }

    .m1 {
        background-position: 0 0;
    }

    .m2 {
        background-position: -111px 0;
    }

    .m3 {
        background-position: -217px 0;
    }

    .m4 {
        background-position: -325px 0;
    }

    .m5 {
        background-position: -432px 0;
    }

    .m6 {
        background-position: -539px 0;
    }

    .m7 {
        background-position: 0 -103px;
    }

    .m8 {
        background-position: -111px -103px;
    }

    .m9 {
        background-position: -217px -103px;
    }

    .m10 {
        background-position: -325px -103px;
    }

    .m11 {
        background-position: -432px -103px;
    }

    .m12 {
        background-position: -539px -103px;
    }


    .m13 {
        background-position: 0 -217px;
    }

    .m14 {
        background-position: -111px -217px;
    }

    .m15 {
        background-position: -217px -216px;
    }

    .m16 {
        background-position: -325px -218px;
    }

    .m17 {
        background-position: -432px -214px;
    }

    .m18 {
        background-position: -539px -217px;
    }

    .m19 {
        background-position: 0 -332px;
    }

    .m20 {
        background-position: -111px -332px;
    }

    .m21 {
        background-position: -217px -332px;
    }

    .m22 {
        background-position: -325px -332px;
    }

    .m23 {
        background-position: -432px -332px;
    }

    .m24 {
        background-position: -539px -332px;
    }

</style>
