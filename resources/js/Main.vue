<template>
    <div class="main-container">
        <router-view></router-view>
	</div>
</template>

<script>
export default {
    name: 'Main',
    data() {
        return {
        };
    },
    mounted() {
        console.log('Component mounted.');
    },
    metaInfo: {
        // Children can override the title.
        //title: 'ABC',
        // Result: My Page Title ← My Site
        // If a child changes the title to "My Other Page Title",
        // it will become: My Other Page Title ← My Site
        //titleTemplate: '%s ← An IT Company',
    }
}
</script>

<style>
.invalid-feedback { display: block;}
.swal2-popup { width: auto !important; }
.swal2-title { font-size: 1rem !important; font-weight: 500 !important; }
.swal2-styled { padding: 10px !important;}
.vdatetime-input { border: none; width: 100%; }
.dropzone .dz-preview .dz-progress { opacity: 0 !important;}
#search-field { padding: 10px; border: 1px solid #ddd; }
</style>

<style>
.icon-success:before {
    border-radius: 50%;
    background-color: green;
    color: white;
}

.icon-danger:before {
    border-radius: 50%;
    background-color: red;
    color: white;
}

.table > thead {
    text-align: center;
}

.table > tbody > tr > td
{
    vertical-align: middle;
    text-align: center;
}

.pagination { justify-content: center; }
</style>
