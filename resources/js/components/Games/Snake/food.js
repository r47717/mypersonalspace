export class Food {
    constructor(xMin, xMax, yMin, yMax) {
        this.xMin = xMin;
        this.xMax = xMax;
        this.yMin = yMin;
        this.yMax = yMax;
        this.points = [];
        this.delay = 10;
        this.delayCtr = 10;
    }

    run(field) {
        if (this.delayCtr === 0) {
            while (true) {
                let x = Math.round(Math.random() * (this.xMax - this.xMin));
                let y = Math.round(Math.random() * (this.yMax - this.yMin));
                if (field.isEmpty([x, y])) {
                    const num = Math.round(Math.random() * 8) + 1;
                    this.points.push([x, y, num]);
                    break;
                }
            }
            this.delayCtr = this.delay;
        } else {
            this.delayCtr--;
        }
    }

    isFood(p) {
        let found = 0;
        this.points.forEach((item) => {
            if (item[0] === p[0] && item[1] === p[1]) {
                found = item[2];
            }
        });

        return found;
    }

    eatFood(p) {
        let found = this.points.findIndex((item) => (item[0] === p[0] && item[1] === p[1]));

        if (found !== -1) {
            this.points.splice(found, 1);
        }
    }

    reset() {
        this.points = [];
    }

    draw(drawInterface) {
        this.points.forEach((p) => {
            drawInterface.drawFood(p[0], p[1], p[2]);
        });
    }
}
