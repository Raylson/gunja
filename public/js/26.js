"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[26],{8026:(t,e,a)=>{a.r(e),a.d(e,{default:()=>o});var s=a(9669),r=a.n(s);const i={name:"CreateSubCategory",props:{},data:function(){return{errors:[],categories:[],category:{title:"",category_id:"",score:""}}},methods:{goBack:function(){this.$router.replace({path:"/admin/sub-categories"})},createCategory:function(){var t=this,e=new FormData;for(var a in this.category)e.append(a,this.category[a]);$(".btn-submit").attr("disabled","disabled"),$(".btn-submit").html("Submitting..."),r().post("https://encompass.fncci.org/api/sub-categories",e,{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(e){if($(".btn-submit").removeAttr("disabled"),$(".btn-submit").html("Submit"),e.data.errors&&(t.errors=e.data.errors),e.data.status&&"success"==e.data.status&&t.$router.push({path:"/admin/sub-categories"}),e.data.status&&"failed"==e.data.status){var a=e.data.message,s=e.data.status;t.$store.commit("showToastMessage",{message:a,status:s})}})).catch((function(e){$(".btn-submit").removeAttr("disabled"),$(".btn-submit").html("Submit"),e.response&&e.response.data.errors&&(t.errors=e.response.data.errors)}))},clearForm:function(){this.category={title:"",category_id:"",score:""}}},mounted:function(){var t=this;r().get("https://encompass.fncci.org/api/category-lists",{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(e){e.data.all_categories.length&&(t.categories=e.data.all_categories)})).catch((function(t){console.log(t.response)}))},watch:{}};const o=(0,a(1900).Z)(i,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"create-category"},[t._m(0),t._v(" "),a("div",{staticClass:"row create"},[a("div",{staticClass:"col-12"},[a("div",{staticClass:"card"},[a("div",{staticClass:"card-body"},[a("form",{staticClass:"create-category",on:{submit:function(e){return e.preventDefault(),t.createCategory.apply(null,arguments)}}},[a("div",{staticClass:"row mb-3 align-items-center"},[t._m(1),t._v(" "),a("div",{staticClass:"col-9"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.category.title,expression:"category.title"}],staticClass:"form-control",attrs:{type:"text",id:"title",name:"title",required:""},domProps:{value:t.category.title},on:{input:function(e){e.target.composing||t.$set(t.category,"title",e.target.value)}}}),t._v(" "),Object.keys(t.errors).length?a("span",{staticClass:"invalid-feedback",attrs:{role:"alert"}},[a("strong",[t._v(t._s(t.errors.title))])]):t._e()])]),t._v(" "),a("div",{staticClass:"row mb-3 align-items-center"},[t._m(2),t._v(" "),a("div",{staticClass:"col-9"},[a("select",{directives:[{name:"model",rawName:"v-model",value:t.category.category_id,expression:"category.category_id"}],staticClass:"form-control",attrs:{id:"category_id",name:"category_id",required:""},on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.category,"category_id",e.target.multiple?a:a[0])}}},[a("option",{attrs:{value:""}},[t._v("Select Category")]),t._v(" "),t._l(t.categories,(function(e){return[a("option",{key:e.id,domProps:{value:e.id}},[t._v(t._s(e.title))])]}))],2),t._v(" "),Object.keys(t.errors).length?a("span",{staticClass:"invalid-feedback",attrs:{role:"alert"}},[a("strong",[t._v(t._s(t.errors.category_id))])]):t._e()])]),t._v(" "),a("div",{staticClass:"row mb-3 align-items-center"},[t._m(3),t._v(" "),a("div",{staticClass:"col-9"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.category.score,expression:"category.score"}],staticClass:"form-control",attrs:{type:"number",id:"score",name:"score",required:""},domProps:{value:t.category.score},on:{input:function(e){e.target.composing||t.$set(t.category,"score",e.target.value)}}}),t._v(" "),Object.keys(t.errors).length?a("span",{staticClass:"invalid-feedback",attrs:{role:"alert"}},[a("strong",[t._v(t._s(t.errors.score))])]):t._e()])]),t._v(" "),a("div",{staticClass:"row"},[a("hr"),t._v(" "),a("div",{staticClass:"col-8 offset-3"},[a("button",{staticClass:"btn btn-primary btn-submit",attrs:{type:"submit"}},[t._v("Submit")]),t._v(" "),a("button",{staticClass:"btn btn-danger",attrs:{type:"button"},on:{click:t.clearForm}},[t._v("Clear")])])])])])])])])])}),[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"page-title-box"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col"},[a("h4",{staticClass:"page-title"},[t._v("Add New Sub Category")]),t._v(" "),a("ol",{staticClass:"breadcrumb"},[a("li",{staticClass:"breadcrumb-item"},[a("a",{attrs:{href:"/admin/dashboard"}},[t._v("Dashboard")])]),t._v(" "),a("li",{staticClass:"breadcrumb-item"},[a("a",{attrs:{href:"/admin/sub-categories"}},[t._v("Sub Category")])]),t._v(" "),a("li",{staticClass:"breadcrumb-item active"},[t._v("Create")])])])])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"col-3"},[a("label",{staticClass:"form-label",attrs:{for:"title"}},[t._v("Title"),a("span",{staticClass:"text-danger"},[t._v("*")])])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"col-3"},[a("label",{staticClass:"form-label",attrs:{for:"category_id"}},[t._v("Category "),a("span",{staticClass:"text-danger"},[t._v("*")])])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"col-3"},[a("label",{staticClass:"form-label",attrs:{for:"score"}},[t._v("Score"),a("span",{staticClass:"text-danger"},[t._v("*")])])])}],!1,null,"75d350bc",null).exports}}]);
//# sourceMappingURL=26.js.map