<template>
  <div class="edit-category">
    <div class="page-title-box">
			<div class="row">
				<div class="col">
					<h4 class="page-title">Edit Sub Category</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="/admin/sub-categories">Sub Category</a></li>
						<li class="breadcrumb-item active">Edit</li>
					</ol>
				</div><!--end col-->	
			</div><!--end row-->                                                              
		</div>
		<div class="row edit">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
            <form class="edit-category" @submit.prevent="editCategory">
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                </div>
                <div class="col-9">
                  <input type="text" class="form-control" id="title" name="title" v-model="category.title" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.title }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                </div>
                <div class="col-9">
                  <select class="form-control" id="category_id" name="category_id" v-model="category.category_id" required>
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
                  <label for="score" class="form-label">Score<span class="text-danger">*</span></label>
                </div>
                <div class="col-9">
                  <input type="number" class="form-control" id="score" name="score" v-model="category.score" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.score }}</strong>
                  </span>
                </div>
              </div>
              <div class="row">
                <hr>
                <div class="col-8 offset-3">
                  <button class="btn btn-primary btn-submit" type="submit">Submit</button>
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
  name: 'EditSubCategory',
  props: {
  },
  data: () => {
    return {
      errors: [],
      categories: [],
      category: {
        title: ''
      }
    }
  },
  methods: {
    goBack() {
      this.$router.replace({path: '/admin/sub-categories'})
    },
    
    editCategory() {
      let self = this;
      // Submit the form to edit new price list
      var formData = new FormData();
      for ( var key in this.category ) {
          formData.append(key, this.category[key]);
      }
      formData.append('_method', 'PUT');
      
      $('.btn-submit').attr('disabled', 'disabled');
			$('.btn-submit').html('Submitting...');

      axios.post(process.env.MIX_APP_URL+'/api/sub-categories/'+self.$route.params.id, formData, {
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
          self.$router.push({ path: '/admin/sub-categories' });
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
  },
  mounted: function(){
    let self = this;

    axios.get(process.env.MIX_APP_URL+'/api/sub-categories/' + self.$route.params.id, {
      headers: {
        'Authorization': 'Bearer '+localStorage.getItem("api_token") 
      }
    })
    .then(function (response) {
      self.category = response.data.category;
    }).catch(function (error) {
      self.$router.push({ path: '/admin/login' });
    });

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
  }
}


</script>
<style scoped>
</style>