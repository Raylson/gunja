"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[309],{9820:(t,s,e)=>{e.d(s,{Z:()=>o});var n=e(4015),a=e.n(n),r=e(3645),i=e.n(r)()(a());i.push([t.id,".login-wrap[data-v-20530970]{position:unset;transform:none;width:auto}.form-control[data-v-20530970]{opacity:1!important}","",{version:3,sources:["webpack://./resources/js/components/pages/ExamNow.vue"],names:[],mappings:"AA6KA,6BAAA,cAAA,CAAA,cAAA,CAAA,UAAA,CACA,+BACA,mBACA",sourcesContent:['<template>\r\n    <div class="container">\r\n        <div class="row justify-content-center">\r\n            <div class="col-md-12">\r\n\t\t\t\t<div class="row login-wrap mt-4 bg-transparent">\r\n\t\t\t\t\t<div class="">\r\n\t\t\t\t\t\t<div class="col-md-6 border bg-white" style="margin: 0 auto;">\r\n\t\t\t\t\t\t\t<div class="lwrap">\r\n\t\t\t\t\t\t\t\t<a href="/"><img :src="logo" style="height: 60px;" class="img-fluid mb-4" alt=""></a>\r\n\t\t\t\t\t\t\t\t<template v-if="showMessage == true">\r\n\t\t\t\t\t\t\t\t\t<p class="alert alert-danger alert-dismissible fade show" role="alert">\r\n\t\t\t\t\t\t\t\t\t\t{{ message }}\r\n\t\t\t\t\t\t\t\t\t\t<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\r\n\t\t\t\t\t\t\t\t\t</p>\r\n\t\t\t                    </template>\r\n\t\t\t\t\t\t\t\t<template v-if="showSuccessMessage == true">\r\n\t\t\t\t\t\t\t\t\t<p class="alert alert-success alert-dismissible fade show" role="alert">\r\n\t\t\t\t\t\t\t\t\t\t{{ successMessage }}\r\n\t\t\t\t\t\t\t\t\t\t<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\r\n\t\t\t\t\t\t\t\t\t</p>\r\n\t\t\t                    </template>\r\n\r\n\t\t\t\t\t\t\t\t<template v-if="loadComplete">\r\n\t\t\t\t\t\t\t\t\t<h3 v-if="validURL == false">Sorry! The link is invalid or you have already submitted the exam.</h3>\r\n\t\t\t\t\t\t\t\t\t\x3c!-- <h3 v-if="alreadySubmitted">Sorry! You have already submitted the exam.</h3> --\x3e\r\n\t\t\t\t\t\t\t\t\t<form v-if="validURL && !submitted" class="rd-form-icon" @submit.prevent="exam">\r\n\t\t\t\t\t\t\t\t\t\t<div class="row">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class="col-md-12">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<h3>Attend all the questions.</h3>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t<div class="col-md-12">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<template v-for="(question, index) in questions">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="row border p-2 mt-2" :key="`ques-${index}`">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="col-md-6 mb-3 align-items-center text-center fw-bold">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class="text-decoration-underline" :for="`question-0-${index}`">{{ question.question }}</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="col-md-6 mb-3 align-items-center">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="col-auto">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<template v-for="(ans, ansindex) in question.answers">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<select :key="`ans-${ansindex}`" class="form-control mb-2" id="answer_id" name="answer_id" v-model="answers[\'answer_\'+ans.id]" required>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option value="" checked>Select Answer</option>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option :value="`${ans.question_id}|${ans.id}|${ans.answer_0}|0`" v-if="ans.answer_0 != \'\'">{{ ans.answer_0 }}</option>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option :value="`${ans.question_id}|${ans.id}|${ans.answer_1}|1`" v-if="ans.answer_1 != \'\'">{{ ans.answer_1 }}</option>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option :value="`${ans.question_id}|${ans.id}|${ans.answer_2}|2`" v-if="ans.answer_2 != \'\'">{{ ans.answer_2 }}</option>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option :value="`${ans.question_id}|${ans.id}|${ans.answer_3}|3`" v-if="ans.answer_3 != \'\'">{{ ans.answer_3 }}</option>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option :value="`${ans.question_id}|${ans.id}|${ans.answer_4}|4`" v-if="ans.answer_4 != \'\'">{{ ans.answer_4 }}</option>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<option :value="`${ans.question_id}|${ans.id}|${ans.answer_5}|5`" v-if="ans.answer_5 != \'\'">{{ ans.answer_5 }}</option>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</select>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</template>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</template>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t<div class="col-auto" style="margin: 0 auto;">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<button type="submit" class="btn mt-3 btn-lg btn-default w-100 btn-submit">Submit</button>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t</form>\r\n\t\t\t\t\t\t\t\t</template>\r\n\t\t\t\t\t\t\t\t<h3 v-else>Loading...</h3>\r\n\t\t\t\t\t\t\t\t<h3 v-if="submitted" class="text-success">Thank you. Your exam has been submitted. <br/> Your Submission ID: <b>{{ submission_id }}</b></h3>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n        </div>\r\n    </div>\r\n</template>\r\n\r\n<script>\r\nimport axios from "axios";\r\n\r\nexport default {\r\n    name: \'ExamNow\',\r\n    data() {\r\n        return {\r\n\t\t\tlogo: \'\',\r\n\t\t\tvalidURL: false,\r\n\t\t\tshowMessage: false,\r\n\t\t\tmessage: \'\',\r\n\t\t\tshowSuccessMessage: false,\r\n\t\t\tsuccessMessage: \'\',\r\n\t\t\trootUrl: process.env.MIX_APP_URL,\r\n            questions: \'\',\r\n\t\t\tanswers: {},\r\n\t\t\tsubmitted: false,\r\n\t\t\talreadySubmitted: false,\r\n\t\t\tsubmission_id: \'\',\r\n\t\t\tloadComplete: false,\r\n        }\r\n    },\r\n    methods: {\r\n        exam() {\r\n            let self = this;\r\n\r\n\t\t\t$(\'.btn-submit\').attr(\'disabled\', \'disabled\');\r\n\t\t\t$(\'.btn-submit\').html(\'Submitting...\');\r\n\r\n\t\t\tself.showSuccessMessage = false;\r\n\t\t\tself.successMessage = \'\';\r\n\r\n\t\t\tvar formData = new FormData();\r\n\t\t\tformData.append(\'unique_key\', self.$route.params.uniqueKey);\r\n\t\t\tformData.append(\'answers\', JSON.stringify(self.answers));\r\n\r\n            axios.post(process.env.MIX_APP_URL+\'/api/examiners/exam-submit\', formData).then(function (response) {\r\n\t\t\t\tif(response.data.status == \'success\')\r\n                {\r\n\t\t\t\t\tself.showSuccessMessage = true;\r\n\t\t\t\t\tself.successMessage = response.data.message;\r\n\t\t\t\t\tself.submitted = true;\r\n\t\t\t\t\tself.submission_id = response.data.submission_id;\r\n                }\r\n\t\t\t\t$(\'.btn-submit\').removeAttr(\'disabled\');\r\n\t\t\t\t$(\'.btn-submit\').html(\'Submit\');\r\n            })\r\n            .catch(error => {\r\n\t\t\t\t$(\'.btn-submit\').removeAttr(\'disabled\');\r\n\t\t\t\t$(\'.btn-submit\').html(\'Submit\');\r\n\r\n                self.message = error.response.data.message;\r\n                self.showMessage = true;\r\n            });\r\n        },\r\n    },\r\n\tmounted() {\r\n\t\tvar self = this;\r\n\t\tself.logo = self.rootUrl+\'/storage/\'+window.Laravel.website_logo;\r\n\r\n\t\taxios.get(process.env.MIX_APP_URL+\'/api/examiners/exam-now/\' + self.$route.params.uniqueKey, {\r\n\t\t\theaders: {\r\n\t\t\t\t\'Authorization\': \'Bearer \'+localStorage.getItem("api_token") \r\n\t\t\t}\r\n\t\t})\r\n\t\t.then(function (response) {\r\n\t\t\tif(response.data.status == \'success\')\r\n\t\t\t{\r\n\t\t\t\tself.loadComplete = true;\r\n\t\t\t\tif(response.data.submission_id != \'\')\r\n\t\t\t\t{\r\n\t\t\t\t\tself.alreadySubmitted = true;\r\n\t\t\t\t}\r\n\t\t\t\telse\r\n\t\t\t\t{\r\n\t\t\t\t\tself.questions = response.data.questions;\r\n\t\t\t\t\tself.validURL = true;\r\n\r\n\t\t\t\t\tself.questions.forEach((queElement) => {\r\n\t\t\t\t\t\tqueElement.answers.forEach((ansElement) => {\r\n\t\t\t\t\t\t\tvar ansKey = \'answer_\'+ansElement.id;\r\n\t\t\t\t\t\t\t// var obj = {};\r\n\t\t\t\t\t\t\t// obj[ansKey] = \'\';\r\n\t\t\t\t\t\t\t// self.answers.push(obj);\r\n\r\n\t\t\t\t\t\t\tself.answers[ansKey] = \'\';\r\n\t\t\t\t\t\t});\r\n\t\t\t\t\t});\r\n\t\t\t\t}\r\n\t\t\t}\r\n\t\t\telse\r\n\t\t\t{\r\n\t\t\t\tself.validURL = false\r\n\t\t\t}\r\n\t\t}).catch(function (error) {\r\n\t\t\tself.$router.push({ path: \'/admin/login\' });\r\n\t\t});\r\n\t}\r\n}\r\n<\/script>\r\n\r\n<style scoped>\r\n.login-wrap { width:auto; transform: none; position: unset;}\r\n.form-control {\r\n    opacity: 1 !important;\r\n}\r\n</style>\r\n'],sourceRoot:""}]);const o=i},6309:(t,s,e)=>{e.r(s),e.d(s,{default:()=>d});var n=e(9669),a=e.n(n);const r={name:"ExamNow",data:function(){return{logo:"",validURL:!1,showMessage:!1,message:"",showSuccessMessage:!1,successMessage:"",rootUrl:"https://bitsnepal.com.np",questions:"",answers:{},submitted:!1,alreadySubmitted:!1,submission_id:"",loadComplete:!1}},methods:{exam:function(){var t=this;$(".btn-submit").attr("disabled","disabled"),$(".btn-submit").html("Submitting..."),t.showSuccessMessage=!1,t.successMessage="";var s=new FormData;s.append("unique_key",t.$route.params.uniqueKey),s.append("answers",JSON.stringify(t.answers)),a().post("https://bitsnepal.com.np/api/examiners/exam-submit",s).then((function(s){"success"==s.data.status&&(t.showSuccessMessage=!0,t.successMessage=s.data.message,t.submitted=!0,t.submission_id=s.data.submission_id),$(".btn-submit").removeAttr("disabled"),$(".btn-submit").html("Submit")})).catch((function(s){$(".btn-submit").removeAttr("disabled"),$(".btn-submit").html("Submit"),t.message=s.response.data.message,t.showMessage=!0}))}},mounted:function(){var t=this;t.logo=t.rootUrl+"/storage/"+window.Laravel.website_logo,a().get("https://bitsnepal.com.np/api/examiners/exam-now/"+t.$route.params.uniqueKey,{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(s){"success"==s.data.status?(t.loadComplete=!0,""!=s.data.submission_id?t.alreadySubmitted=!0:(t.questions=s.data.questions,t.validURL=!0,t.questions.forEach((function(s){s.answers.forEach((function(s){var e="answer_"+s.id;t.answers[e]=""}))})))):t.validURL=!1})).catch((function(s){t.$router.push({path:"/admin/login"})}))}};var i=e(3379),o=e.n(i),l=e(9820),u={insert:"head",singleton:!1};o()(l.Z,u);l.Z.locals;const d=(0,e(1900).Z)(r,(function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"container"},[e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-12"},[e("div",{staticClass:"row login-wrap mt-4 bg-transparent"},[e("div",{},[e("div",{staticClass:"col-md-6 border bg-white",staticStyle:{margin:"0 auto"}},[e("div",{staticClass:"lwrap"},[e("a",{attrs:{href:"/"}},[e("img",{staticClass:"img-fluid mb-4",staticStyle:{height:"60px"},attrs:{src:t.logo,alt:""}})]),t._v(" "),1==t.showMessage?[e("p",{staticClass:"alert alert-danger alert-dismissible fade show",attrs:{role:"alert"}},[t._v("\n\t\t\t\t\t\t\t\t\t\t"+t._s(t.message)+"\n\t\t\t\t\t\t\t\t\t\t"),e("button",{staticClass:"btn-close",attrs:{type:"button","data-bs-dismiss":"alert","aria-label":"Close"}})])]:t._e(),t._v(" "),1==t.showSuccessMessage?[e("p",{staticClass:"alert alert-success alert-dismissible fade show",attrs:{role:"alert"}},[t._v("\n\t\t\t\t\t\t\t\t\t\t"+t._s(t.successMessage)+"\n\t\t\t\t\t\t\t\t\t\t"),e("button",{staticClass:"btn-close",attrs:{type:"button","data-bs-dismiss":"alert","aria-label":"Close"}})])]:t._e(),t._v(" "),t.loadComplete?[0==t.validURL?e("h3",[t._v("Sorry! The link is invalid or you have already submitted the exam.")]):t._e(),t._v(" "),t.validURL&&!t.submitted?e("form",{staticClass:"rd-form-icon",on:{submit:function(s){return s.preventDefault(),t.exam.apply(null,arguments)}}},[e("div",{staticClass:"row"},[t._m(0),t._v(" "),e("div",{staticClass:"col-md-12"},[t._l(t.questions,(function(s,n){return[e("div",{key:"ques-"+n,staticClass:"row border p-2 mt-2"},[e("div",{staticClass:"col-md-6 mb-3 align-items-center text-center fw-bold"},[e("label",{staticClass:"text-decoration-underline",attrs:{for:"question-0-"+n}},[t._v(t._s(s.question))])]),t._v(" "),e("div",{staticClass:"col-md-6 mb-3 align-items-center"},[e("div",{staticClass:"col-auto"},[t._l(s.answers,(function(s,n){return[e("select",{directives:[{name:"model",rawName:"v-model",value:t.answers["answer_"+s.id],expression:"answers['answer_'+ans.id]"}],key:"ans-"+n,staticClass:"form-control mb-2",attrs:{id:"answer_id",name:"answer_id",required:""},on:{change:function(e){var n=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.answers,"answer_"+s.id,e.target.multiple?n:n[0])}}},[e("option",{attrs:{value:"",checked:""}},[t._v("Select Answer")]),t._v(" "),""!=s.answer_0?e("option",{domProps:{value:s.question_id+"|"+s.id+"|"+s.answer_0+"|0"}},[t._v(t._s(s.answer_0))]):t._e(),t._v(" "),""!=s.answer_1?e("option",{domProps:{value:s.question_id+"|"+s.id+"|"+s.answer_1+"|1"}},[t._v(t._s(s.answer_1))]):t._e(),t._v(" "),""!=s.answer_2?e("option",{domProps:{value:s.question_id+"|"+s.id+"|"+s.answer_2+"|2"}},[t._v(t._s(s.answer_2))]):t._e(),t._v(" "),""!=s.answer_3?e("option",{domProps:{value:s.question_id+"|"+s.id+"|"+s.answer_3+"|3"}},[t._v(t._s(s.answer_3))]):t._e(),t._v(" "),""!=s.answer_4?e("option",{domProps:{value:s.question_id+"|"+s.id+"|"+s.answer_4+"|4"}},[t._v(t._s(s.answer_4))]):t._e(),t._v(" "),""!=s.answer_5?e("option",{domProps:{value:s.question_id+"|"+s.id+"|"+s.answer_5+"|5"}},[t._v(t._s(s.answer_5))]):t._e()])]}))],2)])])]}))],2),t._v(" "),t._m(1)])]):t._e()]:e("h3",[t._v("Loading...")]),t._v(" "),t.submitted?e("h3",{staticClass:"text-success"},[t._v("Thank you. Your exam has been submitted. "),e("br"),t._v(" Your Submission ID: "),e("b",[t._v(t._s(t.submission_id))])]):t._e()],2)])])])])])])}),[function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"col-md-12"},[e("h3",[t._v("Attend all the questions.")])])},function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"col-auto",staticStyle:{margin:"0 auto"}},[e("button",{staticClass:"btn mt-3 btn-lg btn-default w-100 btn-submit",attrs:{type:"submit"}},[t._v("Submit")])])}],!1,null,"20530970",null).exports}}]);
//# sourceMappingURL=309.js.map