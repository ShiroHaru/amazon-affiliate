import { ref, onMounted } from "vue";

export default function vueCounter() {
    //リアクティブな参照
    let counter = ref(0);

    onMounted(() => {
        setInterval(() => {
            //valueを更新、画面も更新される
            counter.value++;
        }, 1000);
    });

    return {
        counter,
    };
}
