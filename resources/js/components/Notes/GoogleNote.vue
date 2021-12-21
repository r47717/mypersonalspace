<template>
    <div
        class="note-container"
        :style="{ background: `${colors[bgColorIndex].color}` }"
    >
        <div>
            <h4>{{ title }}</h4>
            <div>{{ text }}</div>
        </div>
        <div class="tick-mark" title="Выбрать заметку">
            <div class="tick-left"></div>
            <div class="tick-right"></div>
        </div>
        <div class="pin-mark" title="Закрепить заметку">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="#aaaaaa"
                class="bi bi-pin"
                viewBox="0 0 16 16"
            >
                <path
                    d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A5.921 5.921 0 0 1 5 6.708V2.277a2.77 2.77 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354zm1.58 1.408-.002-.001.002.001zm-.002-.001.002.001A.5.5 0 0 1 6 2v5a.5.5 0 0 1-.276.447h-.002l-.012.007-.054.03a4.922 4.922 0 0 0-.827.58c-.318.278-.585.596-.725.936h7.792c-.14-.34-.407-.658-.725-.936a4.915 4.915 0 0 0-.881-.61l-.012-.006h-.002A.5.5 0 0 1 10 7V2a.5.5 0 0 1 .295-.458 1.775 1.775 0 0 0 .351-.271c.08-.08.155-.17.214-.271H5.14c.06.1.133.191.214.271a1.78 1.78 0 0 0 .37.282z"
                />
            </svg>
        </div>
        <div class="bottom-tools">
            <div
                class="tools-item tools-reminder"
                title="Сохранить напоминание"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-bell"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"
                    />
                </svg>
            </div>

            <div class="tools-item tools-coauthors" title="Соавторы">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="#aaa"
                    class="bi bi-person-plus"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"
                    />
                    <path
                        fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"
                    />
                </svg>
            </div>

            <div class="tools-item tools-colors" title="Изменить цвет">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-palette"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm4 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM5.5 7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"
                    />
                    <path
                        d="M16 8c0 3.15-1.866 2.585-3.567 2.07C11.42 9.763 10.465 9.473 10 10c-.603.683-.475 1.819-.351 2.92C9.826 14.495 9.996 16 8 16a8 8 0 1 1 8-8zm-8 7c.611 0 .654-.171.655-.176.078-.146.124-.464.07-1.119-.014-.168-.037-.37-.061-.591-.052-.464-.112-1.005-.118-1.462-.01-.707.083-1.61.704-2.314.369-.417.845-.578 1.272-.618.404-.038.812.026 1.16.104.343.077.702.186 1.025.284l.028.008c.346.105.658.199.953.266.653.148.904.083.991.024C14.717 9.38 15 9.161 15 8a7 7 0 1 0-7 7z"
                    />
                </svg>
                <div class="palette">
                    <div
                        class="palette-color"
                        v-for="(item, index) in colors"
                        :key="index"
                        :title="item.title"
                        :style="{ background: item.color }"
                        @click="bgColorIndex = index"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            v-if="index === bgColorIndex"
                            fill="rgba(0,0,0,0.4)"
                            class="bi bi-check2"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"
                            />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="tools-item tools-picture" title="Добавить картинку">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-image"
                    viewBox="0 0 16 16"
                >
                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                    <path
                        d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"
                    />
                </svg>
            </div>

            <div class="tools-item tools-archive" title="Архивировать">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-archive"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"
                    />
                </svg>
            </div>

            <div class="tools-item tools-more" title="Ещё" @click="onMenuClick">
                <div class="dot dot1"></div>
                <div class="dot dot2"></div>
                <div class="dot dot3"></div>
                <div class="tools-menu" v-if="menuVisible">
                    <ul>
                        <li>Удалить заметку</li>
                        <li>Добавить ярлык</li>
                        <li>Добавить рисунок</li>
                        <li>Создать копию</li>
                        <li>В виде списка</li>
                        <li>Скопировать в Google Документы</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "GoogleNote",
    props: ["title", "text"],
    data() {
        return {
            menuVisible: false,
            colors: [
                { title: "По умолчанию", color: "#ffffff" },
                { title: "Красный", color: "#f28b82" },
                { title: "Оранжевый", color: "#fbbc04" },
                { title: "Жёлтый", color: "#fff475" },
                { title: "Зелёный", color: "#ccff90" },
                { title: "Сине-зелёный", color: "#a7ffeb" },
                { title: "Синий", color: "#cbf0f8" },
                { title: "Тёмно-синий", color: "#aecbfa" },
                { title: "Фиолетовый", color: "#d7aefb" },
                { title: "Розовый", color: "#fdcfe8" },
                { title: "Коричневый", color: "#e6c9a8" },
                { title: "Серый", color: "#e8eaed" },
            ],
            bgColorIndex: 0,
        };
    },
    methods: {
        onMenuClick() {
            this.menuVisible = !this.menuVisible;
        },
    },
};
</script>

<style lang="scss">
.note-container {
    text-align: left;
    display: inline-block;
    color: #000000;
    border: 1px solid #dddddd;
    border-radius: 8px;
    padding: 15px 15px 80px 15px;
    line-height: 1.4;
    font-weight: 400;
    position: relative;
    min-width: 300px;
    min-height: 200px;

    h4 {
        margin-top: 0;
        font-weight: normal;
        font-size: 1.1em;
    }

    .tick-mark {
        background: #000000;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        position: absolute;
        top: -8px;
        left: -8px;
        color: #ffffff;
        cursor: pointer;
        opacity: 0;

        .tick-left {
            position: absolute;
            background: #ffffff;
            top: 11px;
            left: 5px;
            height: 2px;
            width: 5px;
            transform: rotate(45grad);
        }

        .tick-right {
            position: absolute;
            background: #ffffff;
            top: 9px;
            left: 7px;
            height: 2px;
            width: 10px;
            transform: rotate(145grad);
        }
    }

    .pin-mark {
        position: absolute;
        width: 30px;
        height: 30px;
        top: 5px;
        right: 10px;
        border-radius: 50%;
        cursor: pointer;
        opacity: 0;

        svg {
            transform: translate(7px, 9px);
        }

        &:hover {
            background: #eeeeee;

            svg {
                transition: all 1300ms;
                fill: #333;
            }
        }
    }

    .bottom-tools {
        opacity: 0;
        position: absolute;
        bottom: 15px;
        left: 15px;
        right: 15px;
        display: flex;
        justify-content: space-between;

        .tools-item {
            cursor: pointer;
            min-width: 30px;
            min-height: 30px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;

            &:hover {
                background: #eee;
            }
        }

        .tools-coauthors {
            cursor: not-allowed;
        }

        .tools-colors {
            position: relative;

            &:hover {
                .palette {
                    opacity: 1;
                    transition: all 300ms;
                }
            }

            .palette {
                position: absolute;
                padding: 5px;
                background: #fff;
                bottom: 25px;
                left: 5px;
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                grid-gap: 3px;
                border: 1px solid #dddddd;
                border-radius: 8px;
                box-shadow: -2px 2px 4px #dddddd, 2px 2px 4px #dddddd;
                opacity: 0;

                .palette-color {
                    width: 25px;
                    height: 25px;
                    border-radius: 50%;
                    box-sizing: border-box;
                    border: 1px solid #ddd;
                    display: flex;
                    justify-content: center;
                    align-items: center;

                    &:hover {
                        border: 1px solid #333;
                    }
                }
            }
        }

        .tools-more {
            position: relative;

            .dot {
                position: absolute;
                background: #000000;
                width: 0px;
                height: 0px;
                border: 2px solid black;
                border-radius: 50%;
                left: 50%;
                transform: translate(-50%);
            }

            .dot1 {
                top: 20%;
            }

            .dot2 {
                top: 50%;
                transform: translate(-50%, -50%);
            }

            .dot3 {
                bottom: 20%;
            }

            .tools-menu {
                position: absolute;
                top: 30px;
                left: 0;
                background: #fff;
                border: 1px solid #dddddd;
                border-radius: 8px;
                box-shadow: -2px 2px 4px #dddddd, 2px 2px 4px #dddddd;
                z-index: 2000;

                ul {
                    list-style-type: none;
                    padding: 0;
                    white-space: nowrap;
                    margin-block-start: 0.5em;
                    margin-block-end: 0.5em;

                    li {
                        display: block;
                        font-size: 0.9em;
                        padding: 10px 15px 10px 20px;

                        &:hover {
                            background: #eee;
                        }
                    }
                }
            }
        }
    }

    &:hover {
        transition: all 300ms;
        box-shadow: -2px 2px 4px #dddddd, 2px 2px 4px #dddddd;

        .tick-mark {
            transition: opacity 700ms;
            opacity: 1;
        }

        .pin-mark {
            transition: opacity 700ms;
            opacity: 1;
        }

        .bottom-tools {
            transition: opacity 700ms;
            opacity: 1;
        }
    }
}
</style>
