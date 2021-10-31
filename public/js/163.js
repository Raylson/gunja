"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[163],{1163:(t,e,s)=>{s.r(e),s.d(e,{default:()=>n});var a=s(9669),r=s.n(a);const i={name:"EditQuestion",props:{},data:function(){return{errors:[],categories:[],subCategories:[],answerError:!1,question:{question:"",category_id:"",sub_category_id:"",score:""},answers:[]}},methods:{goBack:function(){this.$router.replace({path:"/admin/questions"})},editQuestion:function(){var t=this;if(""==t.answers[0].answer_0)return t.answerError=!0,!1;var e=new FormData;for(var s in this.question)e.append(s,this.question[s]);e.append("answers",JSON.stringify(t.answers)),e.append("_method","PUT"),$(".btn-submit").attr("disabled","disabled"),$(".btn-submit").html("Submitting..."),r().post("https://encompass.fncci.org/api/questions/"+t.$route.params.id,e,{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(e){if($(".btn-submit").removeAttr("disabled"),$(".btn-submit").html("Submit"),e.data.errors&&(t.errors=e.data.errors),e.data.status&&"success"==e.data.status&&t.$router.push({path:"/admin/questions"}),e.data.status&&"failed"==e.data.status){var s=e.data.message,a=e.data.status;t.$store.commit("showToastMessage",{message:s,status:a})}})).catch((function(e){$(".btn-submit").removeAttr("disabled"),$(".btn-submit").html("Submit"),e.response&&e.response.data.errors&&(t.errors=e.response.data.errors)}))},loadSubCategories:function(t){var e=this;r().get("https://encompass.fncci.org/api/list-sub-categories/"+t,{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(t){t.data.status&&"success"==t.data.status&&(e.subCategories=t.data.all_subCategories)})).catch((function(t){console.log(t.response)}))},addAns:function(t,e){e.push({answer_0:"",answer_1:"",answer_2:"",answer_3:"",answer_4:"",answer_5:""})},removeAns:function(t,e){e.splice(t,1)}},mounted:function(){var t=this;r().get("https://encompass.fncci.org/api/questions/"+t.$route.params.id,{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(e){t.question=e.data.question,t.answers=e.data.answers,t.loadSubCategories(e.data.question.category_id)})).catch((function(e){t.$router.push({path:"/admin/login"})})),r().get("https://encompass.fncci.org/api/category-lists",{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(e){e.data.all_categories.length&&(t.categories=e.data.all_categories)})).catch((function(t){console.log(t.response)}))},watch:{"question.category_id":function(t){""==t?(this.subCategories=[],this.question.sub_category_id=""):this.loadSubCategories(t)},answers:{handler:function(t,e){""==t[0].answer_0?this.answerError=!0:this.answerError=!1},deep:!0}}};const n=(0,s(1900).Z)(i,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"edit-question"},[t._m(0),t._v(" "),s("div",{staticClass:"row edit"},[s("div",{staticClass:"col-12"},[s("div",{staticClass:"card"},[s("div",{staticClass:"card-body"},[s("form",{staticClass:"edit-question",on:{submit:function(e){return e.preventDefault(),t.editQuestion.apply(null,arguments)}}},[s("div",{staticClass:"row mb-3 align-items-center"},[t._m(1),t._v(" "),s("div",{staticClass:"col-9"},[s("input",{directives:[{name:"model",rawName:"v-model",value:t.question.question,expression:"question.question"}],staticClass:"form-control",attrs:{type:"text",id:"question",name:"question",required:""},domProps:{value:t.question.question},on:{input:function(e){e.target.composing||t.$set(t.question,"question",e.target.value)}}}),t._v(" "),Object.keys(t.errors).length?s("span",{staticClass:"invalid-feedback",attrs:{role:"alert"}},[s("strong",[t._v(t._s(t.errors.question))])]):t._e()])]),t._v(" "),s("div",{staticClass:"row mb-3 align-items-center"},[t._m(2),t._v(" "),s("div",{staticClass:"col-9"},[s("select",{directives:[{name:"model",rawName:"v-model",value:t.question.category_id,expression:"question.category_id"}],staticClass:"form-control",attrs:{id:"category_id",name:"category_id",required:""},on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.question,"category_id",e.target.multiple?s:s[0])}}},[s("option",{attrs:{value:""}},[t._v("Select Category")]),t._v(" "),t._l(t.categories,(function(e){return[s("option",{key:e.id,domProps:{value:e.id}},[t._v(t._s(e.title))])]}))],2),t._v(" "),Object.keys(t.errors).length?s("span",{staticClass:"invalid-feedback",attrs:{role:"alert"}},[s("strong",[t._v(t._s(t.errors.category_id))])]):t._e()])]),t._v(" "),s("div",{staticClass:"row mb-3 align-items-center"},[t._m(3),t._v(" "),s("div",{staticClass:"col-9"},[s("select",{directives:[{name:"model",rawName:"v-model",value:t.question.sub_category_id,expression:"question.sub_category_id"}],staticClass:"form-control",attrs:{id:"sub_category_id",name:"sub_category_id",required:""},on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.question,"sub_category_id",e.target.multiple?s:s[0])}}},[s("option",{attrs:{value:""}},[t._v("Select SubCategory")]),t._v(" "),t._l(t.subCategories,(function(e){return[s("option",{key:e.id,domProps:{value:e.id}},[t._v(t._s(e.title))])]}))],2),t._v(" "),Object.keys(t.errors).length?s("span",{staticClass:"invalid-feedback",attrs:{role:"alert"}},[s("strong",[t._v(t._s(t.errors.sub_category_id))])]):t._e()])]),t._v(" "),s("div",{staticClass:"row mb-3 align-items-center"},[t._m(4),t._v(" "),s("div",{staticClass:"col-9"},[s("input",{directives:[{name:"model",rawName:"v-model",value:t.question.score,expression:"question.score"}],staticClass:"form-control",attrs:{type:"text",id:"score",name:"score",required:""},domProps:{value:t.question.score},on:{input:function(e){e.target.composing||t.$set(t.question,"score",e.target.value)}}}),t._v(" "),Object.keys(t.errors).length?s("span",{staticClass:"invalid-feedback",attrs:{role:"alert"}},[s("strong",[t._v(t._s(t.errors.score))])]):t._e()])]),t._v(" "),s("div",{staticClass:"row"},[t._l(t.answers,(function(e,a){return[s("div",{key:"ans-"+a,staticClass:"col-4 border p-2 mt-2"},[s("div",{staticClass:"col-12 mb-3 align-items-center text-center fw-bold"},[s("label",{staticClass:"text-decoration-underline",attrs:{for:"answer-0-"+a}},[t._v("Answer "+t._s(a+1))])]),t._v(" "),s("div",{staticClass:"col-12 mb-3 align-items-center"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.answer_0,expression:"input.answer_0"}],staticClass:"form-control form-control-sm",attrs:{type:"text",id:"answer-0-"+a},domProps:{value:e.answer_0},on:{input:function(s){s.target.composing||t.$set(e,"answer_0",s.target.value)}}})]),t._v(" "),s("div",{staticClass:"col-12 mb-3 align-items-center"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.answer_1,expression:"input.answer_1"}],staticClass:"form-control form-control-sm",attrs:{type:"text",id:"answer-1-"+a},domProps:{value:e.answer_1},on:{input:function(s){s.target.composing||t.$set(e,"answer_1",s.target.value)}}})]),t._v(" "),s("div",{staticClass:"col-12 mb-3 align-items-center"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.answer_2,expression:"input.answer_2"}],staticClass:"form-control form-control-sm",attrs:{type:"text",id:"answer-2-"+a},domProps:{value:e.answer_2},on:{input:function(s){s.target.composing||t.$set(e,"answer_2",s.target.value)}}})]),t._v(" "),s("div",{staticClass:"col-12 mb-3 align-items-center"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.answer_3,expression:"input.answer_3"}],staticClass:"form-control form-control-sm",attrs:{type:"text",id:"answer-3-"+a},domProps:{value:e.answer_3},on:{input:function(s){s.target.composing||t.$set(e,"answer_3",s.target.value)}}})]),t._v(" "),s("div",{staticClass:"col-12 mb-3 align-items-center"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.answer_4,expression:"input.answer_4"}],staticClass:"form-control form-control-sm",attrs:{type:"text",id:"answer-4-"+a},domProps:{value:e.answer_4},on:{input:function(s){s.target.composing||t.$set(e,"answer_4",s.target.value)}}})]),t._v(" "),s("div",{staticClass:"col-12 mb-3 align-items-center"},[s("input",{directives:[{name:"model",rawName:"v-model",value:e.answer_5,expression:"input.answer_5"}],staticClass:"form-control form-control-sm",attrs:{type:"text",id:"answer-5-"+a},domProps:{value:e.answer_5},on:{input:function(s){s.target.composing||t.$set(e,"answer_5",s.target.value)}}})]),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.answers.length>1&&a>0,expression:"answers.length > 1 && index > 0"}],key:"ansbtn-"+a,staticClass:"col-12 align-items-center mt-2 mb-2"},[s("a",{staticClass:"btn btn-danger btn-sm",staticStyle:{width:"auto",margin:"0 auto"},attrs:{href:"javascript:void(0);"},on:{click:function(e){return t.removeAns(a,t.answers)}}},[s("i",{staticClass:"fas fa-minus"}),t._v(" Remove")])])])]}))],2),t._v(" "),s("div",{staticClass:"row mt-2 mb-2"},[t.answerError?s("div",{staticClass:"col-12 mb-2"},[s("p",{staticClass:"text-danger"},[t._v("Enter any one answer.")])]):t._e(),t._v(" "),s("div",{staticClass:"col-auto"},[s("a",{staticClass:"btn btn-default btn-sm w-100",attrs:{href:"javascript:void(0);"},on:{click:function(e){return t.addAns(t.input,t.answers)}}},[s("i",{staticClass:"fas fa-plus"}),t._v(" Add Q&A")])])]),t._v(" "),t._m(5)])])])])])])}),[function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"page-title-box"},[s("div",{staticClass:"row"},[s("div",{staticClass:"col"},[s("h4",{staticClass:"page-title"},[t._v("Edit Question")]),t._v(" "),s("ol",{staticClass:"breadcrumb"},[s("li",{staticClass:"breadcrumb-item"},[s("a",{attrs:{href:"/admin/dashboard"}},[t._v("Dashboard")])]),t._v(" "),s("li",{staticClass:"breadcrumb-item"},[s("a",{attrs:{href:"/admin/questions"}},[t._v("Question")])]),t._v(" "),s("li",{staticClass:"breadcrumb-item active"},[t._v("Edit")])])])])])},function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"col-3"},[s("label",{staticClass:"form-label",attrs:{for:"question"}},[t._v("Question"),s("span",{staticClass:"text-danger"},[t._v("*")])])])},function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"col-3"},[s("label",{staticClass:"form-label",attrs:{for:"category_id"}},[t._v("Category "),s("span",{staticClass:"text-danger"},[t._v("*")])])])},function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"col-3"},[s("label",{staticClass:"form-label",attrs:{for:"sub_category_id"}},[t._v("SubCategory "),s("span",{staticClass:"text-danger"},[t._v("*")])])])},function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"col-3"},[s("label",{staticClass:"form-label",attrs:{for:"score"}},[t._v("Score"),s("span",{staticClass:"text-danger"},[t._v("*")])])])},function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"row"},[s("hr"),t._v(" "),s("div",{staticClass:"col-8 offset-3"},[s("button",{staticClass:"btn btn-primary btn-submit",attrs:{type:"submit"}},[t._v("Submit")])])])}],!1,null,"7d7d9224",null).exports}}]);
//# sourceMappingURL=163.js.map