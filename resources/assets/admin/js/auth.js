module.exports = {
    user: {
        authenticated: false,
        profile: null
    },
    login(context, email, password) {
        Vue.http.post(
            '/api/admin/login',
            {
                email: email,
                password: password
            }
        ).then(response => {
            localStorage.setItem('token', response.data.meta.token)
            Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token')

            this.user.authenticated = true
            this.user.profile = response.data.data

            router.go({
                name: 'dashboard'
            });
        }, response => {
            context.errors['email'].push('User with this credentials is not found');
            context.isLoading = false;
        })
    },
    signout() {
        localStorage.removeItem('token')
        this.user.authenticated = false
        this.user.profile = null

        router.go({
            name: 'login'
        })
    }
}