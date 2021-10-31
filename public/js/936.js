"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[936],{7936:(t,a,e)=>{e.r(a),e.d(a,{default:()=>o});var s=e(9669),r=e.n(s);const i={name:"CreateCategory",props:{},data:function(){return{errors:[],category:{title:""}}},methods:{goBack:function(){this.$router.replace({path:"/admin/categories"})},createCategory:function(){var t=this,a=new FormData;for(var e in this.category)a.append(e,this.category[e]);$(".btn-submit").attr("disabled","disabled"),$(".btn-submit").html("Submitting..."),r().post("https://encompass.fncci.org/api/categories",a,{headers:{Authorization:"Bearer "+localStorage.getItem("api_token")}}).then((function(a){if($(".btn-submit").removeAttr("disabled"),$(".btn-submit").html("Submit"),a.data.errors&&(t.errors=a.data.errors),a.data.status&&"success"==a.data.status&&t.$router.push({path:"/admin/categories"}),a.data.status&&"failed"==a.data.status){var e=a.data.message,s=a.data.status;t.$store.commit("showToastMessage",{message:e,status:s})}})).catch((function(a){$(".btn-submit").removeAttr("disabled"),$(".btn-submit").html("Submit"),a.response&&a.response.data.errors&&(t.errors=a.response.data.errors)}))},clearForm:function(){this.category={title:""}}},mounted:function(){},watch:{}};const o=(0,e(1900).Z)(i,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"create-category"},[t._m(0),t._v(" "),e("div",{staticClass:"row create"},[e("div",{staticClass:"col-12"},[e("div",{staticClass:"card"},[e("div",{staticClass:"card-body"},[e("form",{staticClass:"create-category",on:{submit:function(a){return a.preventDefault(),t.createCategory.apply(null,arguments)}}},[e("div",{staticClass:"row mb-3 align-items-center"},[t._m(1),t._v(" "),e("div",{staticClass:"col-9"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.category.title,expression:"category.title"}],staticClass:"form-control",attrs:{type:"text",id:"title",name:"title",required:""},domProps:{value:t.category.title},on:{input:function(a){a.target.composing||t.$set(t.category,"title",a.target.value)}}}),t._v(" "),Object.keys(t.errors).length?e("span",{staticClass:"invalid-feedback",attrs:{role:"alert"}},[e("strong",[t._v(t._s(t.errors.title))])]):t._e()])]),t._v(" "),e("div",{staticClass:"row"},[e("hr"),t._v(" "),e("div",{staticClass:"col-8 offset-3"},[e("button",{staticClass:"btn btn-primary btn-submit",attrs:{type:"submit"}},[t._v("Submit")]),t._v(" "),e("button",{staticClass:"btn btn-danger",attrs:{type:"button"},on:{click:t.clearForm}},[t._v("Clear")])])])])])])])])])}),[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"page-title-box"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col"},[e("h4",{staticClass:"page-title"},[t._v("Add New Category")]),t._v(" "),e("ol",{staticClass:"breadcrumb"},[e("li",{staticClass:"breadcrumb-item"},[e("a",{attrs:{href:"/admin/dashboard"}},[t._v("Dashboard")])]),t._v(" "),e("li",{staticClass:"breadcrumb-item"},[e("a",{attrs:{href:"/admin/categories"}},[t._v("Category")])]),t._v(" "),e("li",{staticClass:"breadcrumb-item active"},[t._v("Create")])])])])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"col-3"},[e("label",{staticClass:"form-label",attrs:{for:"title"}},[t._v("Title"),e("span",{staticClass:"text-danger"},[t._v("*")])])])}],!1,null,"fee26e0c",null).exports}}]);
//# sourceMappingURL=936.js.map