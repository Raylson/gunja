"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[307],{8177:(t,e,a)=>{a.d(e,{Z:()=>i});var n=a(4015),s=a.n(n),r=a(3645),l=a.n(r)()(s());l.push([t.id,"","",{version:3,sources:[],names:[],mappings:"",sourceRoot:""}]);const i=l},1491:(t,e,a)=>{a.d(e,{Z:()=>i});var n=a(4015),s=a.n(n),r=a(3645),l=a.n(r)()(s());l.push([t.id,".fa-expand[data-v-167a0b2e]:hover,.fa-sign-out-alt[data-v-167a0b2e]:hover{color:#0a58ca;cursor:pointer}","",{version:3,sources:["webpack://./resources/js/components/admin/modules/Header.vue"],names:[],mappings:"AAiHA,0EAAA,aAAA,CAAA,cAAA",sourcesContent:['<template>\r\n    <div class="header">\r\n\t\t<header>\r\n\t\t\t<div class="row">\r\n\t\t\t\t<div class="col-6 d-flex align-items-center">\r\n\t\t\t\t\t<a href="#">\r\n\t\t\t\t\t\t<div class="burger">\r\n\t\t\t\t\t\t\t<span class="line"></span>\r\n\t\t\t\t\t\t\t<span class="line"></span>\r\n\t\t\t\t\t\t\t<span class="line"></span>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</a>\r\n\t\t\t\t\t\x3c!-- <div class="input-group">\r\n\t\t\t\t\t\t<span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>\r\n\t\t\t\t\t\t<input type="text" class="form-control" placeholder="Search">\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class="form-check form-switch">\r\n\t\t\t\t\t\t<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">\r\n\t\t\t\t\t\t<label class="form-check-label" for="flexSwitchCheckDefault">Dark Mode</label>\r\n\t\t\t\t\t</div> --\x3e\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class="col-6 d-flex align-items-center justify-content-end">\r\n\t\t\t\t\t<ul>\r\n\t\t\t\t\t\t<li><a @click="toggleFullScreen"><i class="fas fa-expand"></i></a></li>\r\n\t\t\t\t\t\t\x3c!-- <li><a href="#"><i class="far fa-bell"></i></a><span class="badge">10</span></li> --\x3e\r\n\t\t\t\t\t\t<li class="h-user-info d-flex align-items-center">\r\n\t\t\t\t\t\t\t<a href="#"><img :src="rootUrl+\'/storage/\'+user.avatar" class="img-fluid rounded-circle border" width="50px" alt=""></a>\r\n\t\t\t\t\t\t\t<a href="#"><p> Hey, {{ user.first_name+(user.middle_name !=null ? \' \'+user.middle_name : \'\')+(user.last_name !=null ? \' \'+user.last_name : \'\') }}</p>\r\n\t\t\t\t\t\t\t\t\x3c!-- <span>Business Profile</span> --\x3e\r\n\t\t\t\t\t\t\t</a>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t<li @click="logout"><i class="fas fa-sign-out-alt"></i></li>\r\n\t\t\t\t\t\t\x3c!-- <li><a href="#"><i class="fas fa-th-large"></i></a></li> --\x3e\r\n\t\t\t\t\t</ul>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</header>\r\n\r\n\t\t<div class="position-fixed top-1 end-0 p-3 pt-1" style="z-index: 5; display:none;" id="toast-div">\r\n\t\t\t<div class="toast align-items-center text-white bg-danger border-0" id="toastDiv" role="alert" aria-live="assertive" aria-atomic="true">\r\n\t\t\t\t<div class="d-flex">\r\n\t\t\t\t\t<div class="toast-body">\r\n\t\t\t\t\t\t<p id="toastMessage"></p>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n</template>\r\n\r\n<script>\r\nexport default {\r\n    name: "Header",\r\n    data() {\r\n        return {\r\n\t\t\trootUrl: process.env.MIX_APP_URL,\r\n\t\t\tuser: JSON.parse(localStorage.getItem("user_detail")),\r\n        };\r\n    },\r\n    mounted() {\r\n        console.log(\'Component mounted.\')\r\n    },\r\n\tmethods: {\r\n\t\tlogout() {\r\n\t\t\tlet self = this;\r\n            axios.post(process.env.MIX_APP_URL+\'/api/logout\', {\'from\': \'admin\'}, {\r\n\t\t\t\theaders: {\r\n\t\t\t\t\t\'Authorization\': \'Bearer \'+localStorage.getItem("api_token") \r\n\t\t\t\t}\r\n\t\t\t}).then(function (response) {\r\n\t\t\t\tif(response.data.logout)\r\n\t\t\t\t{\r\n\t\t\t\t\tlocalStorage.removeItem("api_token");\r\n\t\t\t\t\tlocalStorage.removeItem("user_detail");\r\n\t\t\t\t\tself.$router.push({\r\n\t\t\t\t\t\tpath: \'/admin/login\'\r\n\t\t\t\t\t});\r\n\t\t\t\t}\r\n\t\t\t})\r\n\t\t\t.catch(error => {\r\n\t\t\t\tconsole.log(error.response.data.message);\r\n\t\t\t});\r\n\t\t},\r\n\r\n\t\ttoggleFullScreen() {\r\n\t\t\tif ((document.fullScreenElement && document.fullScreenElement !== null) ||    \r\n\t\t\t(!document.mozFullScreen && !document.webkitIsFullScreen)) {\r\n\t\t\t\tif (document.documentElement.requestFullScreen) {  \r\n\t\t\t\tdocument.documentElement.requestFullScreen();  \r\n\t\t\t\t} else if (document.documentElement.mozRequestFullScreen) {  \r\n\t\t\t\tdocument.documentElement.mozRequestFullScreen();  \r\n\t\t\t\t} else if (document.documentElement.webkitRequestFullScreen) {  \r\n\t\t\t\tdocument.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  \r\n\t\t\t\t}  \r\n\t\t\t} else {  \r\n\t\t\t\tif (document.cancelFullScreen) {  \r\n\t\t\t\tdocument.cancelFullScreen();  \r\n\t\t\t\t} else if (document.mozCancelFullScreen) {  \r\n\t\t\t\tdocument.mozCancelFullScreen();  \r\n\t\t\t\t} else if (document.webkitCancelFullScreen) {  \r\n\t\t\t\tdocument.webkitCancelFullScreen();  \r\n\t\t\t\t}  \r\n\t\t\t}  \r\n\t\t}\r\n\t}\r\n}\r\n<\/script>\r\n\r\n<style scoped>\r\n.header {\r\n    \r\n}\r\n.fa-sign-out-alt:hover, .fa-expand:hover { cursor: pointer; color: #0a58ca; }\r\n</style>\r\n'],sourceRoot:""}]);const i=l},6529:(t,e,a)=>{a.d(e,{Z:()=>i});var n=a(4015),s=a.n(n),r=a(3645),l=a.n(r)()(s());l.push([t.id,".nav-active[data-v-0a822bc4]{background:#08acda}.nav-active a[data-v-0a822bc4],.nav-active a[data-v-0a822bc4]:hover{color:#fff!important}","",{version:3,sources:["webpack://./resources/js/components/admin/modules/Sidebar.vue"],names:[],mappings:"AAwEA,6BAAA,kBAAA,CACA,oEAAA,oBAAA",sourcesContent:['<template>\r\n    <div class="sidenav">\r\n\t\t<div class="logo d-flex align-items-center justify-content-center">\r\n\t\t\t<a href="/admin/dashboard"><img :src="logo" class="img-fluid" alt=""></a>\r\n\t\t</div>\r\n\t\t<ul class="s-nav" v-if="userType == \'superadmin\'">\r\n\t\t\t<li class="nav-label">MAIN MENU</li>\r\n\t\t\t\x3c!-- <li>\r\n\t\t\t\t<a href="#"><i class="fas fa-th-large"></i> Dashboard <span><i class="fas fa-angle-right"></i></span></a>\r\n\t\t\t\t<ul>\r\n\t\t\t\t\t<li><a href="#">Light</a></li>\r\n\t\t\t\t\t<li><a href="#">Dark</a></li>\r\n\t\t\t\t</ul>\r\n\t\t\t</li> --\x3e\r\n\t\t\t<li>\r\n\t\t\t\t<a href="/admin/dashboard"><i class="fas fa-th-large"></i> Dashboard </a>\r\n\t\t\t</li>\r\n\t\t\t<li :class="{\'nav-active\' : $route.name === \'SiteSetting\'}">\r\n\t\t\t\t<a href="/admin/settings"><i class="fas fa-cog"></i> Site Settings </a>\r\n\t\t\t</li>\r\n\t\t\t<li class="nav-label">APPS</li>\r\n\t\t\t<li :class="{\'nav-active\' : [\'Users\', \'User\', \'Create User\', \'Edit User\'].includes($route.name)}">\r\n\t\t\t\t<a href="/admin/users"><i class="fas fa-users"></i> Manage Users</a>\r\n\t\t\t</li>\r\n\t\t\t<li :class="{\'nav-active\' : [\'Categories\', \'Create Category\', \'Edit Category\'].includes($route.name)}">\r\n\t\t\t\t<a href="/admin/categories"><i class="fas fa-list-alt"></i> Manage Categories </a>\r\n\t\t\t</li>\r\n\r\n\t\t\t<li :class="{\'nav-active\' : [\'SubCategories\', \'Create SubCategory\', \'Edit SubCategory\'].includes($route.name)}">\r\n\t\t\t\t<a href="/admin/sub-categories"><i class="fas fa-list-alt"></i> Manage SubCategories </a>\r\n\t\t\t</li>\r\n\r\n\t\t\t<li :class="{\'nav-active\' : [\'Questions\', \'Create Question\', \'Edit Question\'].includes($route.name)}">\r\n\t\t\t\t<a href="/admin/questions"><i class="fas fa-question-circle"></i> Manage Questions </a>\r\n\t\t\t</li>\r\n\t\t\t<li>\r\n\t\t\t\t<a href="/examiners/verified/list" target="_blank"><i class="fas fa-comment-dots"></i> Assessments </a>\r\n\t\t\t</li>\r\n\r\n\t\t\t\x3c!-- <li :class="{\'nav-active\' : [\'Examiners\', \'Examiner Detail\'].includes($route.name)}">\r\n\t\t\t\t<a href="/admin/examiners"><i class="fas fa-cog"></i> Manage Examiners </a>\r\n\t\t\t</li> --\x3e\r\n\r\n\t\t\t\x3c!-- <li :class="{\'nav-active\' : [\'Assessments\', \'Create Assessment\', \'Edit Assessment\'].includes($route.name)}">\r\n\t\t\t\t<a href="/admin/assessments"><i class="fas fa-cog"></i> Manage Assessments </a>\r\n\t\t\t</li> --\x3e\r\n\t\t</ul>\r\n\t</div>\r\n</template>\r\n\r\n<script>\r\nexport default {\r\n    name: "Sidebar",\r\n    data() {\r\n        return {\r\n\t\t\tlogo: \'\',\r\n\t\t\trootUrl: process.env.MIX_APP_URL,\r\n\t\t\tuserType: JSON.parse(localStorage.getItem("user_detail")).user_type,\r\n        };\r\n    },\r\n    mounted() {\r\n\t\tthis.logo = this.rootUrl+\'/storage/\'+window.Laravel.website_logo;\r\n        console.log(\'Component mounted.\')\r\n    }\r\n}\r\n<\/script>\r\n\r\n<style scoped>\r\n.sidenav {\r\n    \r\n}\r\n\r\n.nav-active { background: #08ACDA; }\r\n.nav-active a, .nav-active a:hover { color: #fff !important;}\r\n</style>\r\n'],sourceRoot:""}]);const i=l},7307:(t,e,a)=>{a.r(e),a.d(e,{default:()=>p});const n={name:"Header",data:function(){return{rootUrl:"https://bitsnepal.com.np",user:JSON.parse(localStorage.getItem("user_detail"))}},mounted:function(){console.log("Component mounted.")},methods:{logout:function(){var t=this;axios.post("https://bitsnepal.com.np/api/logout",{from:"admin"},{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(e){e.data.logout&&(localStorage.removeItem("api_token"),localStorage.removeItem("user_detail"),t.$router.push({path:"/admin/login"}))})).catch((function(t){console.log(t.response.data.message)}))},toggleFullScreen:function(){document.fullScreenElement&&null!==document.fullScreenElement||!document.mozFullScreen&&!document.webkitIsFullScreen?document.documentElement.requestFullScreen?document.documentElement.requestFullScreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullScreen&&document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT):document.cancelFullScreen?document.cancelFullScreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitCancelFullScreen&&document.webkitCancelFullScreen()}}};var s=a(3379),r=a.n(s),l=a(1491),i={insert:"head",singleton:!1};r()(l.Z,i);l.Z.locals;var o=a(1900);const c=(0,o.Z)(n,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"header"},[a("header",[a("div",{staticClass:"row"},[t._m(0),t._v(" "),a("div",{staticClass:"col-6 d-flex align-items-center justify-content-end"},[a("ul",[a("li",[a("a",{on:{click:t.toggleFullScreen}},[a("i",{staticClass:"fas fa-expand"})])]),t._v(" "),a("li",{staticClass:"h-user-info d-flex align-items-center"},[a("a",{attrs:{href:"#"}},[a("img",{staticClass:"img-fluid rounded-circle border",attrs:{src:t.rootUrl+"/storage/"+t.user.avatar,width:"50px",alt:""}})]),t._v(" "),a("a",{attrs:{href:"#"}},[a("p",[t._v(" Hey, "+t._s(t.user.first_name+(null!=t.user.middle_name?" "+t.user.middle_name:"")+(null!=t.user.last_name?" "+t.user.last_name:"")))])])]),t._v(" "),a("li",{on:{click:t.logout}},[a("i",{staticClass:"fas fa-sign-out-alt"})])])])])]),t._v(" "),t._m(1)])}),[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"col-6 d-flex align-items-center"},[a("a",{attrs:{href:"#"}},[a("div",{staticClass:"burger"},[a("span",{staticClass:"line"}),t._v(" "),a("span",{staticClass:"line"}),t._v(" "),a("span",{staticClass:"line"})])])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"position-fixed top-1 end-0 p-3 pt-1",staticStyle:{"z-index":"5",display:"none"},attrs:{id:"toast-div"}},[a("div",{staticClass:"toast align-items-center text-white bg-danger border-0",attrs:{id:"toastDiv",role:"alert","aria-live":"assertive","aria-atomic":"true"}},[a("div",{staticClass:"d-flex"},[a("div",{staticClass:"toast-body"},[a("p",{attrs:{id:"toastMessage"}})]),t._v(" "),a("button",{staticClass:"btn-close btn-close-white me-2 m-auto",attrs:{type:"button","data-bs-dismiss":"toast","aria-label":"Close"}})])])])}],!1,null,"167a0b2e",null).exports;const u={name:"Sidebar",data:function(){return{logo:"",rootUrl:"https://bitsnepal.com.np",userType:JSON.parse(localStorage.getItem("user_detail")).user_type}},mounted:function(){this.logo=this.rootUrl+"/storage/"+window.Laravel.website_logo,console.log("Component mounted.")}};var d=a(6529),m={insert:"head",singleton:!1};r()(d.Z,m);d.Z.locals;const f={name:"AdminLayout",data:function(){return{}},mounted:function(){console.log("Component mounted.")},components:{Header:c,Sidebar:(0,o.Z)(u,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"sidenav"},[a("div",{staticClass:"logo d-flex align-items-center justify-content-center"},[a("a",{attrs:{href:"/admin/dashboard"}},[a("img",{staticClass:"img-fluid",attrs:{src:t.logo,alt:""}})])]),t._v(" "),"superadmin"==t.userType?a("ul",{staticClass:"s-nav"},[a("li",{staticClass:"nav-label"},[t._v("MAIN MENU")]),t._v(" "),t._m(0),t._v(" "),a("li",{class:{"nav-active":"SiteSetting"===t.$route.name}},[t._m(1)]),t._v(" "),a("li",{staticClass:"nav-label"},[t._v("APPS")]),t._v(" "),a("li",{class:{"nav-active":["Users","User","Create User","Edit User"].includes(t.$route.name)}},[t._m(2)]),t._v(" "),a("li",{class:{"nav-active":["Categories","Create Category","Edit Category"].includes(t.$route.name)}},[t._m(3)]),t._v(" "),a("li",{class:{"nav-active":["SubCategories","Create SubCategory","Edit SubCategory"].includes(t.$route.name)}},[t._m(4)]),t._v(" "),a("li",{class:{"nav-active":["Questions","Create Question","Edit Question"].includes(t.$route.name)}},[t._m(5)]),t._v(" "),t._m(6)]):t._e()])}),[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("li",[a("a",{attrs:{href:"/admin/dashboard"}},[a("i",{staticClass:"fas fa-th-large"}),t._v(" Dashboard ")])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("a",{attrs:{href:"/admin/settings"}},[a("i",{staticClass:"fas fa-cog"}),t._v(" Site Settings ")])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("a",{attrs:{href:"/admin/users"}},[a("i",{staticClass:"fas fa-users"}),t._v(" Manage Users")])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("a",{attrs:{href:"/admin/categories"}},[a("i",{staticClass:"fas fa-list-alt"}),t._v(" Manage Categories ")])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("a",{attrs:{href:"/admin/sub-categories"}},[a("i",{staticClass:"fas fa-list-alt"}),t._v(" Manage SubCategories ")])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("a",{attrs:{href:"/admin/questions"}},[a("i",{staticClass:"fas fa-question-circle"}),t._v(" Manage Questions ")])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("li",[a("a",{attrs:{href:"/examiners/verified/list",target:"_blank"}},[a("i",{staticClass:"fas fa-comment-dots"}),t._v(" Assessments ")])])}],!1,null,"0a822bc4",null).exports}};var v=a(8177),g={insert:"head",singleton:!1};r()(v.Z,g);v.Z.locals;const p=(0,o.Z)(f,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"admin-layout"},[a("Sidebar"),t._v(" "),a("Header"),t._v(" "),a("div",{staticClass:"main"},[a("router-view")],1),t._v(" "),a("a",{staticClass:"back-to-top",attrs:{href:"javascript:void(0)",id:"back-top"}})],1)}),[],!1,null,"52c6d7d2",null).exports}}]);
//# sourceMappingURL=307.js.map