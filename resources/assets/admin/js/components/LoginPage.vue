<template>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <h1 class="title logo has-text-centered">Argentum</h1>
                <div class="columns">
                    <div class="column is-one-third is-offset-one-third">
                        <form v-on:submit.prevent="login">
                            <label class="label">Email</label>
                            <p class="control">
                                <input :class="['input', 'is-medium', this.errors.email.length ? 'is-danger': '']"
                                       type="email" v-model="email"
                                       placeholder="ivan@example.com" required>
                                <span v-for="error in this.errors.email" class="help is-danger">{{ error }}</span>
                            </p>
                            <label class="label">Password</label>
                            <p class="control">
                                <input :class="['input', 'is-medium', this.errors.password.length ? 'is-danger': '']"
                                       type="password" v-model="password"
                                       placeholder="Your password" required>
                                <span v-for="error in this.errors.password" class="help is-danger">{{ error }}</span>
                            </p>
                            <p class="control">
                                <button :class="['button', 'is-outlined', 'is-medium', 'is-primary', isLoading ? 'is-loading' : '']">
                                    Login
                                </button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    var auth = require('../auth');
    export default{
        data() {
            return {
                email: '',
                password: '',
                isLoading: false,
                errors: {
                    email: [],
                    password: [],
                }
            }
        },
        methods: {
            validateEmail: function (email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            validate: function () {
                this.errors = {email: [], password: []};
                if (this.email.length < 1) this.errors['email'].push('Email is required');
                if (!this.validateEmail(this.email)) this.errors['email'].push('This email is invalid');

                if (this.password.length < 1) this.errors['password'].push('Password is required');
                return this.errors['email'].length === 0 && this.errors['password'].length === 0;
            },
            login: function () {
                if (!this.validate()) {
                    return;
                }
                this.isLoading = true;
                auth.login(this, this.email, this.password);
            }
        }
    }
</script>
