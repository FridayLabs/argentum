<template>
    <CenterContent>
        <h1 class="logo text-center">Argentum</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
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
                        <div class="form-group-lg">
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
                password: ''
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
                if (this.errors.any()) return
                this.callLogin()
                        .then((response) => this.getAccount({id: 'me'}))
                        .then((response) => this.$router.push(this.redirect))
                        .catch(() => this.$validator.errorBag.add('email', 'User not found'))
            },
            getAccount(params) {
                return this.$store.dispatch('getAccount', params);
            },
            callLogin() {
                return this.$store.dispatch('login', {email: this.email, password: this.password});
            }
        }
    }
</script>
