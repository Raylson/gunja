<template>
    <div class="admin-layout">
		<Sidebar/>
		<Header/>
        <div class="main">
            <router-view></router-view>
        </div>
        <a href="javascript:void(0)" class="back-to-top" id="back-top"></a>
	</div>
</template>

<script>
import Header from './Header'
import Sidebar from './Sidebar'
export default {
    name: "AdminLayout",
    data() {
        return {
        };
    },
    mounted() {
        console.log('Component mounted.')
    },
    components: {
	    Header,
	    Sidebar
	}
}
</script>

<style scoped>
.admin-layout {
    
}
</style>
