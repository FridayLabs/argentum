<template>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <h1 class="title logo has-text-centered">Argentum</h1>
                <div class="columns">
                    <div class="column is-one-third is-offset-one-third">
                        <form @submit.prevent="login(account)">
                            <label class="label">Email</label>
                            <p class="control">
                                <input :class="['input', 'is-medium', errors.has('email') ? 'is-danger': '']"
                                       type="email" v-model="account.name" v-validate data-rules="required|email"
                                       placeholder="ivan@example.com" required>
                                <span v-if="errors.has('email')" class="help is-danger">{{errors.first('email')}}</span>
                            </p>
                            <label class="label">Password</label>
                            <p class="control">
                                <input :class="['input', 'is-medium', errors.has('password') ? 'is-danger': '']"
                                       type="password" v-model="account.password" v-validate data-rules="required"
                                       placeholder="Your password" required>
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
      account: {}
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
      .then((response) => {
        return this.getAccount({id: 'me'})
      })
      .then((response) => {
        this.$router.push(this.redirect)
      })
      .catch(() => {})
    },
    getAccount(params) {
        return this.$store.dispatch('getAccount', params);
    },
    callLogin() {
        return this.$store.dispatch('login', {email: this.account.name, password: this.account.password});
    }
  }
}
</script>
