<template>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <h1 class="title logo has-text-centered">Argentum</h1>
                <div class="columns">
                    <div class="column is-one-third is-offset-one-third">
                        <form @submit.prevent="login()">
                            <label class="label">Email</label>
                            <p class="control">
                                <input :class="['input', 'is-medium', errors.has('email') ? 'is-danger': '']"
                                       type="email" v-model="email" v-validate.initial="email"
                                       data-rules="required|email"
                                       placeholder="ivan@example.com">
                                <span v-if="errors.has('email')" class="help is-danger">{{errors.first('email')}}</span>
                            </p>
                            <label class="label">Password</label>
                            <p class="control">
                                <input :class="['input', 'is-medium', errors.has('password') ? 'is-danger': '']"
                                       type="password" v-model="password" v-validate.initial="password"
                                       data-rules="required"
                                       placeholder="Your password">
                                <span v-if="errors.has('password')"
                                      class="help is-danger">{{errors.first('password')}}</span>
                            </p>
                            <p class="control">
                                <button :class="['button', 'is-outlined', 'is-medium', 'is-primary']">
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
export default {
  data () {
    return {
      email: '',
      password: ''
    }
  },
  computed: {
    redirect () {
      return this.$route.query.redirect || '/dashboard'
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
