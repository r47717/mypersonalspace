import { ref, watch } from 'vue';
import { NX, NY, WW, HH, DX, DY } from './params';

const getX = (index) => {
  return index % NX;
};

const getY = (index) => {
  return Math.floor(index / NX);
};

const getIndex = (x, y) => {
  return y * NX + x;
};

const getNeighborsCount = (field, index) => {
  const x = getX(index);
  const y = getY(index);

  const nb = new Array(8);
  nb[0] = [x === 0 ? NX - 1 : x - 1, y === 0 ? NY - 1 : y - 1]
  nb[1] = [x, y === 0 ? NY - 1 : y - 1]
  nb[2] = [x === NX - 1 ? 0 : x + 1, y === 0 ? NY - 1 : y - 1]
  nb[3] = [x === 0 ? NX - 1 : x - 1, y]
  nb[4] = [x === NX - 1 ? 0 : x + 1, y]
  nb[5] = [x === 0 ? NX - 1 : x - 1, y === NY - 1 ? 0 : y + 1]
  nb[6] = [x, y === NY - 1 ? 0 : y + 1]
  nb[7] = [x === NX - 1 ? 0 : x + 1,  y === NY - 1 ? 0 : y + 1]

  return nb.reduce((acc, curr) => acc + field[getIndex(curr[0], curr[1])], 0);
};


export default function useField() {
  const fieldRef = ref(null);
  const field = ref([]);
  const fieldColor = ref("eeeeee");
  const gridColor = ref("aaaaaa");
  const cellColor = ref("000000");
  const initCount = ref(300);

  const randomEntities = () => {
      for (let i = 0; i < initCount.value; i++) {
          let index;
          do {
              index = Math.floor(Math.random() * NX * NY)
          } while(field.value[index] !== 0);

          field.value[index] = 1;
      }
  }

  const initField = () => {
      field.value = new Array(NX * NY).fill(0);
      randomEntities();
  };

  const step = () => {
      const newField = field.value.slice();

      for (let index = 0; index < field.value.length; index++) {
          const count = getNeighborsCount(field.value, index)
          if (field.value[index] === 0 && count === 3) {
              newField[index] = 1;
          } else if (field.value[index] === 1 && (count > 3 || count < 2)) {
              newField[index] = 0;
          }
      }

      field.value = newField;
  };

  const paint = () => {
      const ctx = fieldRef.value.getContext("2d");

      ctx.fillStyle = `#${fieldColor.value}`;
      ctx.fillRect(0, 0, WW, HH);

      ctx.strokeStyle = `#${fieldColor.value}`;
      ctx.strokeRect(0, 0, WW, HH);

      ctx.strokeStyle = `#${gridColor.value}`;
      ctx.beginPath();

      let x = 0;
      while (x <= WW) {
          ctx.moveTo(x, 0);
          ctx.lineTo(x, HH);
          x += DX;
      }

      let y = 0;
      while (y <= HH) {
          ctx.moveTo(0, y);
          ctx.lineTo(WW, y);
          y += DY;
      }

      ctx.lineWidth = 1;
      ctx.closePath();
      ctx.stroke();

      field.value.map((cell, index) => {
          if (cell) {
              const y = getY(index);
              const x = getX(index);
              
              ctx.fillStyle = `#${cellColor.value}`;
              ctx.fillRect(x * DX, y * DY, DX, DY);
          }
      })
  };

  watch(field, () => {
    paint();
  })

  return { fieldRef, field, initField, initCount, step, paint }
}