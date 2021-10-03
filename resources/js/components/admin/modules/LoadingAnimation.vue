<template>
<div id="loading-animation">
    <div class="overlay"></div>
    <div class="spanner">
        <div class="loading-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <p>Please Wait</p>
    </div>
</div>
</template>

<script>
export default {
    name: 'LoadingAnimation',
    data() {
        return {}
    },
    created() {},
    methods: {},
    components: {}
}
</script>

<style scoped>
.spanner {
    background: #fff !important;
    z-index: 999999;
    width: 80%;
    margin: 0 10%;
    color: #000;
    text-align: left;
    padding-left: 15px;
}

.spanner p {
    display: inline-block;
    padding-left: 20px;
    font-weight: 400;
    color: #000 !important;
}

.spanner.show,
.overlay.show {
    opacity: 1;
}

.loading-ring {
    display: inline-block;
    position: relative;
    width: 40px;
    height: 40px;
    padding-top: 15px;
}

.loading-ring div {
    box-sizing: border-box;
    display: block;
    position: absolute;
    width: 30px;
    height: 30px;
    margin: 2px;
    border: 2px solid #099B88;
    border-radius: 50%;
    animation: loading-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: #099B88 transparent transparent transparent;
}

.loading-ring div:nth-child(1) {
    animation-delay: -0.45s;
}

.loading-ring div:nth-child(2) {
    animation-delay: -0.3s;
}

.loading-ring div:nth-child(3) {
    animation-delay: -0.15s;
}

@keyframes loading-ring {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
