const { createApp } = Vue;

createApp({
    data() {
        return {
            message: "Hello Vue!",
        };
    },
    mounted() {
        // console.log(`the component is now mounted.`)
        alert("vuejs mounted");
    },
}).mount("#texttospeechmodal");
