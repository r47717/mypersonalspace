export class Mongoose {
    constructor(xMin, xMax, yMin, yMax) {
        this.xMin = xMin;
        this.yMin = yMin;
        this.xMax = xMax;
        this.yMax = yMax;

        this.points = [];
        this.delay = 20;
        this.delayCtr = 20;
    }

    run(field) {
        if (this.delayCtr === 0) {
            while (true) {
                const x = Math.round(Math.random() * (this.xMax - this.xMin));
                const y = Math.round(Math.random() * (this.yMax - this.yMin));
                if (field.isEmpty([x, y])) {
                    this.points.push([x, y]);
                    break;
                }
            }
            this.delayCtr = this.delay;
        } else {
            this.delayCtr--;
        }
    }

    isMongoose(p) {
        return !!this.points.find((item) => (item[0] === p[0] && item[1] === p[1]));
    }

    draw(drawInterface) {
        this.points.forEach((p) => drawInterface.drawMongoose(p[0], p[1]));
    }

    reset() {
        this.points = [];
    }
}
