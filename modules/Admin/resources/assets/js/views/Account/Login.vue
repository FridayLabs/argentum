<template>
    <CenterContent>
        <div class="container">
            <div class="row">
                <div :class="['col-md-4', 'col-md-offset-4', 'col-sm-6', 'col-sm-offset-3', 'col-xs-8', 'col-xs-offset-2', shakeAnimation ? 'shake': '']">
                    <h1 class="logo text-center">Argentum</h1>
                    <form @submit.prevent="login()">
                        <div :class="['form-group-lg', errors.has('email') ? 'has-error': '']">
                            <input class="form-control" type="email" placeholder="Your Email"
                                   v-model="email" v-validate.initial="email" data-rules="required|email">
                            <span v-if="errors.has('email')" class="help-block">{{errors.first('email')}}</span>
                        </div>
                        <div :class="['form-group-lg', errors.has('password') ? 'has-error': '']">
                            <input class="form-control" type="password" placeholder="Your Password"
                                   v-model="password" v-validate.initial="password" data-rules="required">
                            <span v-if="errors.has('password')" class="help-block">{{errors.first('password')}}</span>
                        </div>
                        <div class="form-group-lg text-right">
                            <button class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </CenterContent>
</template>

<script>
    export default {
        data () {
            return {
                email: '',
                password: '',
                shakeAnimation: false
            }
        },
        computed: {
            redirect () {
                return this.$route.query.redirect || '/'
            }
        },
        methods: {
            login () {
                this.$validator.validateAll()
                if (this.errors.any()) {
                    this.shake();
                    return;
                }
                this.$auth.login({
                    params: {email: this.email, password: this.password},
                    error: function () {
                        this.$validator.errorBag.add('email', 'User not found');
                        this.shake();
                    },
                    rememberMe: true,
                    redirect: this.redirect,
                });
            },
            shake: function() {
                this.shakeAnimation = true;
                var self = this;
                setTimeout(function() {
                    self.shakeAnimation = false;
                }, 1000);
            },
        }
    }
</script>
