<template>
  <div class="create-category">
    <div class="page-title-box">
			<div class="row">
				<div class="col">
					<h4 class="page-title">Add New Category</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="/admin/categories">Category</a></li>
						<li class="breadcrumb-item active">Create</li>
					</ol>
				</div><!--end col-->	
			</div><!--end row-->                                                              
		</div>
		<div class="row create">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
            <form class="create-category" @submit.prevent="createCategory">
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
  name: 'CreateCategory',
  props: {
  },
  data: () => {
    return {
      errors: [],
      category: {
        title: ''
      }
    }
  },
  methods: {
    goBack() {
      this.$router.replace({path: '/admin/categories'})
    },
    
    createCategory() {
      let self = this;
      // Submit the form to create new price list
      var formData = new FormData();
      for ( var key in this.category ) {
          formData.append(key, this.category[key]);
      }

      $('.btn-submit').attr('disabled', 'disabled');
			$('.btn-submit').html('Submitting...');
      
      axios.post(process.env.MIX_APP_URL+'/api/categories', formData, {
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
          self.$router.push({ path: '/admin/categories' });
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

    clearForm() {
      this.category = {
        title: ''
      }
    }
  },
  mounted: function(){
    let self = this;
  },
  watch: {
  }
}


</script>
<style scoped>
</style>