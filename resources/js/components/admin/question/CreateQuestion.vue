<template>
  <div class="create-question">
    <div class="page-title-box">
			<div class="row">
				<div class="col">
					<h4 class="page-title">Add New Question</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="/admin/questions">Question</a></li>
						<li class="breadcrumb-item active">Create</li>
					</ol>
				</div><!--end col-->	
			</div><!--end row-->                                                              
		</div>
		<div class="row create">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
            <form class="create-question" @submit.prevent="createQuestion">
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="question" class="form-label">Question<span class="text-danger">*</span></label>
                </div>
                <div class="col-9">
                  <input type="text" class="form-control" id="question" name="question" v-model="question.question" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.question }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                </div>
                <div class="col-9">
                  <select class="form-control" id="category_id" name="category_id" v-model="question.category_id" required>
                    <option value="">Select Category</option>
                    <template v-for="cat in categories">
                      <option :key="cat.id" :value="cat.id">{{ cat.title }}</option>
                    </template>
                  </select>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.category_id }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="sub_category_id" class="form-label">SubCategory <span class="text-danger">*</span></label>
                </div>
                <div class="col-9">
                  <select class="form-control" id="sub_category_id" name="sub_category_id" v-model="question.sub_category_id" required>
                    <option value="">Select SubCategory</option>
                    <template v-for="subCat in subCategories">
                      <option :key="subCat.id" :value="subCat.id">{{ subCat.title }}</option>
                    </template>
                  </select>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.sub_category_id }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="score" class="form-label">Score<span class="text-danger">*</span></label>
                </div>
                <div class="col-9">
                  <input type="number" class="form-control" id="score" name="score" v-model="question.score" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.score }}</strong>
                  </span>
                </div>
              </div>
              <div class="row">
                <template v-for="(input, index) in answers">
                  <div class="col-4 border p-2 mt-2" :key="`ans-${index}`">
                    <div class="col-12 mb-3 align-items-center text-center fw-bold">
                        <label class="text-decoration-underline" :for="`answer-0-${index}`">Answer {{ index + 1 }}</label>
                    </div>
                    <div class="col-12 mb-3 align-items-center">                    
                        <input type="text" :id="`answer-0-${index}`" v-model="input.answer_0" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 mb-3 align-items-center">                    
                        <input type="text" :id="`answer-1-${index}`" v-model="input.answer_1" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 mb-3 align-items-center">                    
                        <input type="text" :id="`answer-2-${index}`" v-model="input.answer_2" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 mb-3 align-items-center">                    
                        <input type="text" :id="`answer-3-${index}`" v-model="input.answer_3" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 mb-3 align-items-center">                    
                        <input type="text" :id="`answer-4-${index}`" v-model="input.answer_4" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 mb-3 align-items-center">                    
                        <input type="text" :id="`answer-5-${index}`" v-model="input.answer_5" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 align-items-center mt-2 mb-2" :key="`ansbtn-${index}`" v-show="answers.length > 1 && index > 0">
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm" style="width:auto; margin:0 auto;" @click="removeAns(index, answers)"><i class="fas fa-minus"></i> Remove</a>
                    </div>
                  </div>
                </template>
              </div>
              <div class="row mt-2 mb-2">
                <div class="col-12 mb-2" v-if="answerError">
                  <p class="text-danger">Enter any one answer.</p>
                </div>
                <div class="col-auto">
                  <a href="javascript:void(0);" class="btn btn-default btn-sm w-100" @click="addAns(input, answers)"><i class="fas fa-plus"></i> Add Q&amp;A</a>
                </div>
              </div>
              <div class="row">
                <hr>
                <div class="col-8 offset-3">
                  <button class="btn btn-primary btn-submit" type="submit">Submit</button>
                  <button class="btn btn-danger" type="button" @click="clearForm">Clear</button>
                </div>
              </div>
            </form>
					</div>
				</div>		
			</div>
		</div>
  </div>
</template>

<script>
import axios from 'axios'
// import $ from 'jquery'
export default {
  name: 'CreateQuestion',
  props: {
  },
  data: () => {
    return {
      errors: [],
      categories: [],
      subCategories: [],
      answerError: false,
      question: {
        question: '',
        category_id: '',
        sub_category_id: '',
        score: '',
      },
      answers: [
        {
          answer_0: '',
          answer_1: '',
          answer_2: '',
          answer_3: '',
          answer_4: '',
          answer_5: '',
        }
      ],
    }
  },
  methods: {
    goBack() {
      this.$router.replace({path: '/admin/questions'})
    },
    
    createQuestion() {
      let self = this;

      if(self.answers[0].answer_0 == '')
      {
        self.answerError = true;
        return false;
      }

      // Submit the form to create
      var formData = new FormData();
      for ( var key in this.question ) {
          formData.append(key, this.question[key]);
      }

      formData.append('answers', JSON.stringify(self.answers));

      $('.btn-submit').attr('disabled', 'disabled');
			$('.btn-submit').html('Submitting...');

      axios.post(process.env.MIX_APP_URL+'/api/questions', formData, {
        headers: {
          'Authorization': 'Bearer '+localStorage.getItem("api_token")
        }
      })
      .then(function (response) {

        $('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('Submit');

        if(response.data.errors)
            self.errors = response.data.errors;

        if(response.data.status && response.data.status == 'success')
        {
          self.$router.push({ path: '/admin/questions' });
        }

        if(response.data.status && response.data.status == 'failed')
        {
          var message = response.data.message;
				  var status = response.data.status;
          self.$store.commit('showToastMessage', { message, status });
        }

      }).catch(function (error) {
        $('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('Submit');
        
        if(error.response)
        {
          if(error.response.data.errors)
          {
            self.errors = error.response.data.errors;
          }
        }
      });
    },

    loadSubCategories(categoryId) {

      let self = this;
      axios.get(process.env.MIX_APP_URL+'/api/list-sub-categories/'+categoryId, {
        headers: {
          'Authorization': 'Bearer '+localStorage.getItem("api_token") 
        }
      })
      .then(function (response) {
        if(response.data.status && response.data.status == 'success')
        {
          self.subCategories = response.data.all_subCategories;
        }
      }).catch(function (error) {
        console.log(error.response)        
        // self.$roter.push({ path: '/admin/login' });
      });
    },

    addAns(value, fieldType) {
      fieldType.push({ answer_0: "", answer_1: "", answer_2: "", answer_3: "", answer_4: "", answer_5: "" });
    },
    removeAns(index, fieldType) {
      fieldType.splice(index, 1);
    },

    clearForm() {
      this.question = {
        question: '',
        category_id: '',
        sub_category_id: '',
        score: '',
      }
    }
  },
  mounted: function(){
    let self = this;
    
    // Get list of all available categories
    axios.get(process.env.MIX_APP_URL+'/api/category-lists', {
      headers: {
        'Authorization': 'Bearer '+localStorage.getItem("api_token") 
      }
    })
    .then(function (response) {
      if(response.data.all_categories.length)
      {
        self.categories = response.data.all_categories;
      }
    }).catch(function (error) {
      console.log(error.response)
      // self.$router.push({ path: '/admin/login' });
    });
  },
  watch: {
    'question.category_id': function (val) {
      if(val == '')
      {
        this.subCategories = [];
        this.question.sub_category_id = '';
      }
      else
        this.loadSubCategories(val);
    },
    answers: {
      handler(val, oldVal) {
        if(val[0].answer_0 == '')
        {
          this.answerError = true;
        }
        else
          this.answerError = false;
      },
      deep: true
    },
  }
}


</script>
<style scoped>
</style>