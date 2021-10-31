<template>
    <div class="user-layout">
        <div class="main1">
            <router-view></router-view>
        </div>
	</div>
</template>

<script>
export default {
    name: "ExaminerLayout",
    data() {
        return {
        };
    },
    mounted() {
        console.log('Component mounted.')
    },
    components: {
	}
}
</script>

<style>
.user-layout {
    
}

@media only screen and (min-width: 600px) {
    .mdisplay {
        width: 80%;
        margin: 0 auto;
        margin-top: 5%;
    }
}
</style>
