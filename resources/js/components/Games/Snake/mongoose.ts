import { DrawInterface, Field, Point } from "./field";

export class Mongoose {
    points: Array<Point>;
    delay: number;
    delayCtr: number;

    constructor(
        private readonly xMin: number,
        private readonly xMax: number,
        private readonly yMin: number,
        private readonly yMax: number
    ) {
        this.points = [];
        this.delay = 20;
        this.delayCtr = 20;
    }

    run(field: Field) {
        if (this.delayCtr === 0) {
            while (true) {
                const x = Math.round(Math.random() * (this.xMax - this.xMin));
                const y = Math.round(Math.random() * (this.yMax - this.yMin));
                if (field.isEmpty([x, y, undefined])) {
                    this.points.push([x, y, undefined]);
                    break;
                }
            }
            this.delayCtr = this.delay;
        } else {
            this.delayCtr--;
        }
    }

    isMongoose(p: Point) {
        return !!this.points.find(
            (item) => item[0] === p[0] && item[1] === p[1]
        );
    }

    draw(drawInterface: DrawInterface) {
        this.points.forEach((p) => drawInterface.drawMongoose(p[0], p[1]));
    }

    reset() {
        this.points = [];
    }
}
