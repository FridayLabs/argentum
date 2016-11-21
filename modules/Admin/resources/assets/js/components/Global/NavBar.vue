<template>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <router-link to="/" :class="['navbar-brand']">Argentum</router-link>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <router-link to="/">Dashboard</router-link>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><router-link to="/">Settings</router-link></li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
    export default {}
</script>
<style>
    .navbar-brand {
        color: #0e0e0e;
        font-weight: 400;
        font-size: 20px;
        letter-spacing: 10px;
        text-transform: uppercase;
    }
</style>
