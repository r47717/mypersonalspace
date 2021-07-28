import { DrawInterface, Field, Point } from "./field";

export class Food {
    private points: Array<Point>;
    private readonly delay: number;
    private delayCtr: number;

    constructor(
        private readonly xMin: number,
        private readonly xMax: number,
        private readonly yMin: number,
        private readonly yMax: number
    ) {
        this.points = [];
        this.delay = 10;
        this.delayCtr = 10;
    }

    run(field: Field) {
        if (this.delayCtr === 0) {
            while (true) {
                let x = Math.round(Math.random() * (this.xMax - this.xMin));
                let y = Math.round(Math.random() * (this.yMax - this.yMin));
                if (field.isEmpty([x, y, undefined])) {
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

    isFood(p: Point) {
        let found = 0;
        this.points.forEach((item) => {
            if (item[0] === p[0] && item[1] === p[1]) {
                found = item[2] || 0;
            }
        });

        return found;
    }

    eatFood(p: Point) {
        let found = this.points.findIndex(
            (item) => item[0] === p[0] && item[1] === p[1]
        );

        if (found !== -1) {
            this.points.splice(found, 1);
        }
    }

    reset() {
        this.points = [];
    }

    draw(drawInterface: DrawInterface) {
        this.points.forEach((p) => {
            drawInterface.drawFood(p[0], p[1], p[2] || 0);
        });
    }
}
