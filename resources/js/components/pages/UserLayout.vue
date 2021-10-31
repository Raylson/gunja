<template>
    <div class="user-layout">
        <FrontendHeader/>
        <div class="main1">
            <router-view></router-view>
        </div>
	</div>
</template>

<script>
import FrontendHeader from './modules/FrontendHeader'
export default {
    name: "UserLayout",
    data() {
        return {
        };
    },
    mounted() {
        console.log('Component mounted.')
    },
    components: {
        FrontendHeader
	}
}
</script>

<style>
.user-layout {
    
}
.main1 { margin-top: 4rem; }
@media only screen and (min-width: 600px) {
    .mdisplay {
        width: 80%;
        margin: 0 auto;
    }
}
</style>
