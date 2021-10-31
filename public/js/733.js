"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[733],{1324:(t,e,s)=>{s.d(e,{Z:()=>o});var r=s(4015),n=s.n(r),a=s(3645),l=s.n(a)()(n());l.push([t.id,".form-control[data-v-8e72e336]{opacity:1!important}","",{version:3,sources:["webpack://./resources/js/components/pages/ExaminerEnroll.vue"],names:[],mappings:"AA6HA,+BACA,mBACA",sourcesContent:['<template>\r\n    <div class="container">\r\n        <div class="row justify-content-center">\r\n            <div class="col-md-12">\r\n\t\t\t\t<div class="login-wrap bg-transparent">\r\n\t\t\t\t\t<div class="">\r\n\t\t\t\t\t\t<div class="col-md-6 border bg-white" style="margin: 0 auto;">\r\n\t\t\t\t\t\t\t<div class="lwrap">\r\n\t\t\t\t\t\t\t\t<a href="/"><img :src="logo" style="height: 60px;" class="img-fluid mb-4" alt=""></a>\r\n\t\t\t\t\t\t\t\t<template v-if="showMessage == true">\r\n\t\t\t\t\t\t\t\t\t<p class="alert alert-danger alert-dismissible fade show" role="alert">\r\n\t\t\t\t\t\t\t\t\t\t{{ message }}\r\n\t\t\t\t\t\t\t\t\t\t<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\r\n\t\t\t\t\t\t\t\t\t</p>\r\n\t\t\t                    </template>\r\n\t\t\t\t\t\t\t\t<template v-if="showSuccessMessage == true">\r\n\t\t\t\t\t\t\t\t\t<p class="alert alert-success alert-dismissible fade show" role="alert">\r\n\t\t\t\t\t\t\t\t\t\t{{ successMessage }}\r\n\t\t\t\t\t\t\t\t\t\t<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\r\n\t\t\t\t\t\t\t\t\t</p>\r\n\t\t\t                    </template>\r\n\t\t\t\t\t\t\t\t<h2>Enroll for Exam.</h2>\r\n\t\t\t\t\t\t\t\t<template v-if="loadComplete">\r\n\t\t\t\t\t\t\t\t\t<form v-if="!examiner" class="rd-form-icon" @submit.prevent="enroll">\r\n\t\t\t\t\t\t\t\t\t\t\x3c!-- <div class="mb-3">\r\n\t\t\t\t\t\t\t\t\t\t\t<label for="email" class="form-label mb-1">Email address</label>\r\n\t\t\t\t\t\t\t\t\t\t\t<div class="input-group mb-3">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class="f-icon">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<i class="fas fa-envelope"></i>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<input type="email" v-model="email" name="email" required autocomplete="email" autofocus class="form-control form-control-lg" aria-label="Email" id="email">\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</div> --\x3e\r\n\t\t\t\t\t\t\t\t\t\t<div class="row">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class="col-auto">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<button type="submit" class="btn btn-lg btn-default w-100 btn-submit">Enroll Now</button>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t</form>\r\n\t\t\t\t\t\t\t\t\t<div v-else>\r\n\t\t\t\t\t\t\t\t\t\t<h3><a :href="`/exam-now/${examiner.unique_key}`">Click Here: {{ rootUrl+\'/exam-now/\'+examiner.unique_key }}</a></h3>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</template>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n        </div>\r\n    </div>\r\n</template>\r\n\r\n<script>\r\nimport axios from "axios";\r\n\r\nexport default {\r\n    name: \'ExaminerEnroll\',\r\n    data() {\r\n        return {\r\n\t\t\tlogo: \'\',\r\n\t\t\tshowMessage: false,\r\n\t\t\tmessage: \'\',\r\n\t\t\tshowSuccessMessage: false,\r\n\t\t\tsuccessMessage: \'\',\r\n\t\t\trootUrl: process.env.MIX_APP_URL,\r\n            email: \'\',\r\n\t\t\tloadComplete: false,\r\n\t\t\texaminer: [],\r\n        }\r\n    },\r\n    methods: {\r\n        enroll() {\r\n            let self = this;\r\n\r\n\t\t\t$(\'.btn-submit\').attr(\'disabled\', \'disabled\');\r\n\t\t\t$(\'.btn-submit\').html(\'Enrolling...\');\r\n\r\n\t\t\tself.showSuccessMessage = false;\r\n\t\t\tself.successMessage = \'\';\r\n\r\n            axios.post(process.env.MIX_APP_URL+\'/api/examiners/enroll\', {}).then(function (response) {\r\n\t\t\t\tif(response.data.status == \'success\')\r\n                {\r\n\t\t\t\t\tself.showSuccessMessage = true;\r\n\t\t\t\t\tself.successMessage = response.data.message;\r\n\t\t\t\t\tself.email = \'\';\r\n\r\n\t\t\t\t\tself.checkEnroll();\r\n                }\r\n\t\t\t\t$(\'.btn-submit\').removeAttr(\'disabled\');\r\n\t\t\t\t$(\'.btn-submit\').html(\'Enroll Now\');\r\n            })\r\n            .catch(error => {\r\n\t\t\t\t$(\'.btn-submit\').removeAttr(\'disabled\');\r\n\t\t\t\t$(\'.btn-submit\').html(\'Enroll Now\');\r\n\r\n                self.message = error.response.data.message;\r\n                self.showMessage = true;\r\n            });\r\n        },\r\n\t\t\r\n\t\tcheckEnroll()\r\n\t\t{\r\n\t\t\tvar self = this;\r\n\t\t\taxios.get(process.env.MIX_APP_URL+\'/api/checkExam\', {\r\n\t\t\t\theaders: {\r\n\t\t\t\t\t\'Authorization\': \'Bearer \'+localStorage.getItem("api_token") \r\n\t\t\t\t}\r\n\t\t\t})\r\n\t\t\t.then(function (response) {\r\n\t\t\t\tself.loadComplete = true;\r\n\t\t\t\tself.examiner = response.data.examiner;\r\n\t\t\t}).catch(function (error) {\r\n\t\t\t\tself.$router.push({ path: \'/\' });\r\n\t\t\t});\r\n\t\t}\r\n    },\r\n\tmounted() {\r\n\t\tthis.checkEnroll();\r\n\t\tthis.logo = this.rootUrl+\'/storage/\'+window.Laravel.website_logo;\r\n\t}\r\n}\r\n<\/script>\r\n\r\n<style scoped>\r\n.form-control {\r\n    opacity: 1 !important;\r\n}\r\n</style>\r\n'],sourceRoot:""}]);const o=l},2733:(t,e,s)=>{s.r(e),s.d(e,{default:()=>m});var r=s(9669),n=s.n(r);const a={name:"ExaminerEnroll",data:function(){return{logo:"",showMessage:!1,message:"",showSuccessMessage:!1,successMessage:"",rootUrl:"https://encompass.fncci.org",email:"",loadComplete:!1,examiner:[]}},methods:{enroll:function(){var t=this;$(".btn-submit").attr("disabled","disabled"),$(".btn-submit").html("Enrolling..."),t.showSuccessMessage=!1,t.successMessage="",n().post("https://encompass.fncci.org/api/examiners/enroll",{}).then((function(e){"success"==e.data.status&&(t.showSuccessMessage=!0,t.successMessage=e.data.message,t.email="",t.checkEnroll()),$(".btn-submit").removeAttr("disabled"),$(".btn-submit").html("Enroll Now")})).catch((function(e){$(".btn-submit").removeAttr("disabled"),$(".btn-submit").html("Enroll Now"),t.message=e.response.data.message,t.showMessage=!0}))},checkEnroll:function(){var t=this;n().get("https://encompass.fncci.org/api/checkExam",{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(e){t.loadComplete=!0,t.examiner=e.data.examiner})).catch((function(e){t.$router.push({path:"/"})}))}},mounted:function(){this.checkEnroll(),this.logo=this.rootUrl+"/storage/"+window.Laravel.website_logo}};var l=s(3379),o=s.n(l),i=s(1324),c={insert:"head",singleton:!1};o()(i.Z,c);i.Z.locals;const m=(0,s(1900).Z)(a,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"container"},[s("div",{staticClass:"row justify-content-center"},[s("div",{staticClass:"col-md-12"},[s("div",{staticClass:"login-wrap bg-transparent"},[s("div",{},[s("div",{staticClass:"col-md-6 border bg-white",staticStyle:{margin:"0 auto"}},[s("div",{staticClass:"lwrap"},[s("a",{attrs:{href:"/"}},[s("img",{staticClass:"img-fluid mb-4",staticStyle:{height:"60px"},attrs:{src:t.logo,alt:""}})]),t._v(" "),1==t.showMessage?[s("p",{staticClass:"alert alert-danger alert-dismissible fade show",attrs:{role:"alert"}},[t._v("\n\t\t\t\t\t\t\t\t\t\t"+t._s(t.message)+"\n\t\t\t\t\t\t\t\t\t\t"),s("button",{staticClass:"btn-close",attrs:{type:"button","data-bs-dismiss":"alert","aria-label":"Close"}})])]:t._e(),t._v(" "),1==t.showSuccessMessage?[s("p",{staticClass:"alert alert-success alert-dismissible fade show",attrs:{role:"alert"}},[t._v("\n\t\t\t\t\t\t\t\t\t\t"+t._s(t.successMessage)+"\n\t\t\t\t\t\t\t\t\t\t"),s("button",{staticClass:"btn-close",attrs:{type:"button","data-bs-dismiss":"alert","aria-label":"Close"}})])]:t._e(),t._v(" "),s("h2",[t._v("Enroll for Exam.")]),t._v(" "),t.loadComplete?[t.examiner?s("div",[s("h3",[s("a",{attrs:{href:"/exam-now/"+t.examiner.unique_key}},[t._v("Click Here: "+t._s(t.rootUrl+"/exam-now/"+t.examiner.unique_key))])])]):s("form",{staticClass:"rd-form-icon",on:{submit:function(e){return e.preventDefault(),t.enroll.apply(null,arguments)}}},[t._m(0)])]:t._e()],2)])])])])])])}),[function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"row"},[s("div",{staticClass:"col-auto"},[s("button",{staticClass:"btn btn-lg btn-default w-100 btn-submit",attrs:{type:"submit"}},[t._v("Enroll Now")])])])}],!1,null,"8e72e336",null).exports}}]);
//# sourceMappingURL=733.js.map