"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[63],{771:(t,e,n)=>{n.d(e,{Z:()=>i});var r=n(4015),a=n.n(r),o=n(3645),s=n.n(o)()(a());s.push([t.id,".main1{margin-top:4rem}@media only screen and (min-width:600px){.mdisplay{margin:0 auto;width:80%}}","",{version:3,sources:["webpack://./resources/js/components/pages/UserLayout.vue"],names:[],mappings:"AA8BA,OAAA,eAAA,CACA,yCACA,UAEA,aAAA,CADA,SAEA,CACA",sourcesContent:['<template>\r\n    <div class="user-layout">\r\n        <FrontendHeader/>\r\n        <div class="main1">\r\n            <router-view></router-view>\r\n        </div>\r\n\t</div>\r\n</template>\r\n\r\n<script>\r\nimport FrontendHeader from \'./modules/FrontendHeader\'\r\nexport default {\r\n    name: "UserLayout",\r\n    data() {\r\n        return {\r\n        };\r\n    },\r\n    mounted() {\r\n        console.log(\'Component mounted.\')\r\n    },\r\n    components: {\r\n        FrontendHeader\r\n\t}\r\n}\r\n<\/script>\r\n\r\n<style>\r\n.user-layout {\r\n    \r\n}\r\n.main1 { margin-top: 4rem; }\r\n@media only screen and (min-width: 600px) {\r\n    .mdisplay {\r\n        width: 80%;\r\n        margin: 0 auto;\r\n    }\r\n}\r\n</style>\r\n'],sourceRoot:""}]);const i=s},3368:(t,e,n)=>{n.d(e,{Z:()=>i});var r=n(4015),a=n.n(r),o=n(3645),s=n.n(o)()(a());s.push([t.id,".dropdown-menu[data-v-3ecd9084]{min-width:8rem}.dropdown-menu .dropdown-item[data-v-3ecd9084]{cursor:pointer}header ul li[data-v-3ecd9084]:last-child:before{display:none}header ul li[data-v-3ecd9084],header ul li[data-v-3ecd9084]:last-child{padding:0}.fa-expand[data-v-3ecd9084]:hover,.fa-sign-out-alt[data-v-3ecd9084]:hover{color:#0a58ca;cursor:pointer}","",{version:3,sources:["webpack://./resources/js/components/pages/modules/FrontendHeader.vue"],names:[],mappings:"AA2EA,gCAAA,cAAA,CACA,+CAAA,cAAA,CACA,gDAAA,YAAA,CAEA,uEAAA,SAAA,CACA,0EAAA,aAAA,CAAA,cAAA",sourcesContent:['<template>\r\n    <div class="header">\r\n\t\t<header>\r\n\t\t\t<div class="row">\r\n\t\t\t\t<div class="col-12 d-flex align-items-center justify-content-end pe-5">\r\n\t\t\t\t\t<div class="btn-group">\r\n\t\t\t\t\t\t<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">\r\n\t\t\t\t\t\t\tSettings\r\n\t\t\t\t\t\t</button>\r\n\t\t\t\t\t\t<ul class="dropdown-menu">\r\n\t\t\t\t\t\t\t\x3c!-- <li><a class="dropdown-item" @click="logout"> Profile</a></li> --\x3e\r\n\t\t\t\t\t\t\t<li><a class="dropdown-item" @click="logout"> Logout</a></li>\r\n\t\t\t\t\t\t\t<li v-if="userType == \'examiner\'"><a class="dropdown-item" href="/exam/enroll"> Enroll</a></li>\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</ul>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</header>\r\n\r\n\t\t<div class="position-fixed top-1 end-0 p-3 pt-1" style="z-index: 5; display:none;" id="toast-div">\r\n\t\t\t<div class="toast align-items-center text-white bg-danger border-0" id="toastDiv" role="alert" aria-live="assertive" aria-atomic="true">\r\n\t\t\t\t<div class="d-flex">\r\n\t\t\t\t\t<div class="toast-body">\r\n\t\t\t\t\t\t<p id="toastMessage"></p>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n</template>\r\n\r\n<script>\r\nexport default {\r\n    name: "FrontendHeader",\r\n    data() {\r\n        return {\r\n\t\t\trootUrl: process.env.MIX_APP_URL,\r\n\t\t\tuserType: JSON.parse(localStorage.getItem("user_detail")).user_type,\r\n        };\r\n    },\r\n    mounted() {\r\n        console.log(\'Component mounted.\')\r\n    },\r\n\tmethods: {\r\n\t\tlogout() {\r\n\t\t\tlet self = this;\r\n            axios.post(process.env.MIX_APP_URL+\'/api/logout\', {\'from\': \'admin\'}, {\r\n\t\t\t\theaders: {\r\n\t\t\t\t\t\'Authorization\': \'Bearer \'+localStorage.getItem("api_token") \r\n\t\t\t\t}\r\n\t\t\t}).then(function (response) {\r\n\t\t\t\tif(response.data.logout)\r\n\t\t\t\t{\r\n\t\t\t\t\tlocalStorage.removeItem("api_token");\r\n\t\t\t\t\tlocalStorage.removeItem("user_detail");\r\n\r\n\t\t\t\t\tif(response.data.user_type == \'examiner\')\r\n\t\t\t\t\t\tself.$router.push({path: \'/\'});\r\n\t\t\t\t\telse\r\n\t\t\t\t\t\tself.$router.push({path: \'/admin/login\'});\r\n\t\t\t\t}\r\n\t\t\t})\r\n\t\t\t.catch(error => {\r\n\t\t\t\tconsole.log(error.response.data.message);\r\n\t\t\t});\r\n\t\t},\r\n\t}\r\n}\r\n<\/script>\r\n\r\n<style scoped>\r\n.header {\r\n    \r\n}\r\n.dropdown-menu {min-width: 8rem;}\r\n.dropdown-menu .dropdown-item { cursor: pointer; }\r\nheader ul li:last-child:before { display: none;}\r\nheader ul li{ padding: 0; }\r\nheader ul li:last-child { padding: 0; }\r\n.fa-sign-out-alt:hover, .fa-expand:hover { cursor: pointer; color: #0a58ca; }\r\n</style>\r\n'],sourceRoot:""}]);const i=s},4063:(t,e,n)=>{n.r(e),n.d(e,{default:()=>p});const r={name:"FrontendHeader",data:function(){return{rootUrl:"https://bitsnepal.com.np",userType:JSON.parse(localStorage.getItem("user_detail")).user_type}},mounted:function(){console.log("Component mounted.")},methods:{logout:function(){var t=this;axios.post("https://bitsnepal.com.np/api/logout",{from:"admin"},{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(e){e.data.logout&&(localStorage.removeItem("api_token"),localStorage.removeItem("user_detail"),"examiner"==e.data.user_type?t.$router.push({path:"/"}):t.$router.push({path:"/admin/login"}))})).catch((function(t){console.log(t.response.data.message)}))}}};var a=n(3379),o=n.n(a),s=n(3368),i={insert:"head",singleton:!1};o()(s.Z,i);s.Z.locals;var d=n(1900);const l={name:"UserLayout",data:function(){return{}},mounted:function(){console.log("Component mounted.")},components:{FrontendHeader:(0,d.Z)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"header"},[n("header",[n("div",{staticClass:"row"},[n("div",{staticClass:"col-12 d-flex align-items-center justify-content-end pe-5"},[n("div",{staticClass:"btn-group"},[n("button",{staticClass:"btn btn-secondary btn-sm dropdown-toggle",attrs:{type:"button","data-bs-toggle":"dropdown","aria-expanded":"false"}},[t._v("\n\t\t\t\t\t\t\tSettings\n\t\t\t\t\t\t")]),t._v(" "),n("ul",{staticClass:"dropdown-menu"},[n("li",[n("a",{staticClass:"dropdown-item",on:{click:t.logout}},[t._v(" Logout")])]),t._v(" "),"examiner"==t.userType?n("li",[n("a",{staticClass:"dropdown-item",attrs:{href:"/exam/enroll"}},[t._v(" Enroll")])]):t._e()])])])])]),t._v(" "),t._m(0)])}),[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"position-fixed top-1 end-0 p-3 pt-1",staticStyle:{"z-index":"5",display:"none"},attrs:{id:"toast-div"}},[n("div",{staticClass:"toast align-items-center text-white bg-danger border-0",attrs:{id:"toastDiv",role:"alert","aria-live":"assertive","aria-atomic":"true"}},[n("div",{staticClass:"d-flex"},[n("div",{staticClass:"toast-body"},[n("p",{attrs:{id:"toastMessage"}})]),t._v(" "),n("button",{staticClass:"btn-close btn-close-white me-2 m-auto",attrs:{type:"button","data-bs-dismiss":"toast","aria-label":"Close"}})])])])}],!1,null,"3ecd9084",null).exports}};var c=n(771),u={insert:"head",singleton:!1};o()(c.Z,u);c.Z.locals;const p=(0,d.Z)(l,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"user-layout"},[n("FrontendHeader"),t._v(" "),n("div",{staticClass:"main1"},[n("router-view")],1)],1)}),[],!1,null,null,null).exports}}]);
//# sourceMappingURL=63.js.map