<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reset Password</div>

                    <div class="card-body">
                        <template v-if="showErrorMessage || showSuccessMessage">
                            <div class="alert" :class="showErrorMessage ? 'alert-danger' : 'alert-success'" role="alert" v-html="message"></div>
                        </template>

                        <form method="POST" @submit.prevent="resetPassword">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" :class="(errors.length && errors.email.length) ? 'is-invalid' : ''" name="email" required autocomplete="email" autofocus>
                                    <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                                        <strong>{{ errors.email }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" v-model="password" type="password" class="form-control" :class="(errors.length && errors.password.length) ? 'is-invalid' : ''" name="password" required autocomplete="new-password">                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" v-model="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                                    <strong>{{ errors.password }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-10">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
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
import axios from "axios";

export default {
    name: 'PasswordResetToken',
    data() {
        return {
            token: this.$route.params.token,
            password: '',
            password_confirmation: '',
            showErrorMessage: false,
            showSuccessMessage: false,
            email: '',
            message: '',
            errors: ''
        }
    },
    methods: {
        resetPassword() {
            let self = this;
            self.errors = '';
            self.message = '';
            self.showErrorMessage = false;
            self.showSuccessMessage = false;

            axios.post(process.env.MIX_APP_URL+'/api/password/reset', {
                token: self.token,
                email: self.email,
                password: self.password,
                password_confirmation: self.password_confirmation
            }).then(function (response) {
                self.message = response.data.message;
                self.showSuccessMessage = true;

                if(response.data.errors)
                    self.errors = response.data.errors;
                else
                {
                    self.password = '';
                    self.password_confirmation = '';
                    self.email = '';
                }

                this.timerMessageHide();
            })
            .catch(error => {
                if(error.response)
                {
                    self.message = error.response.data.message;
                    self.showErrorMessage = true;
                    if(error.response.data.errors)
                    {
                        self.errors = error.response.data.errors;
                    }
                }
                
                this.timerMessageHide();
            });
        },

        timerMessageHide() {
            setTimeout(() => {
                this.message = '';
                this.showSuccessMessage = false;
                this.showErrorMessage = false;
            }, 2000);
        }
    }
}
</script>

<style>
.invalid-feedback { display: block;}
.mt-10 { margin-top: 10px; }
.form-control {
    opacity: 1 !important;
}
</style>
