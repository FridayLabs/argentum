<template>
  <div class="view-login">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
           <div class="panel panel-default">
            <div class="panel-body">
              logout redirect later
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>
</template>

<script>
export default {
  data () {
    return {
      account: {}
    }
  },
  methods: {
    logout () {
      this.$store.dispatch('logout');
    }
  }
}
</script>

<style></style>