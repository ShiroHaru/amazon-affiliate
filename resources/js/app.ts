import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

import vueCounter from "./vueCounter";
import { createApp } from "vue/dist/vue.esm-bundler";
createApp({
    setup() {
        //カウンターを更新する
        const { counter } = vueCounter();
        return {
            counter,
        };
    },
}).mount("#counter");

const id: string=1;
console.log(id);

// import { createApp } from "vue/dist/vue.esm-bundler";

// const Counter = {
//     data() {
//         return {
//             counter: 0,
//         };
//     },
//     mounted() {
//         setInterval(() => {
//             this.counter++;
//         }, 1000);
//     },
// };
// createApp(Counter).mount("#counter");

import { User } from "./types";

let user = <User>{
    id: 1,
    name: "chigusa",
    email: "chigusa@xxxx",
};

console.log(user);