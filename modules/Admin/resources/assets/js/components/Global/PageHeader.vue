<template>
    <div class="row-flex header">
        <div class="col-xs-6">
            <h2>{{ title }}</h2>
        </div>
        <div class="col-xs-6 text-right">
            <slot></slot>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            title: {
                type: String,
                required: true
            }
        }
    }
</script>
<style>
    .header {
        margin: 20px 0 40px;
        align-items: center;
    }
    .header h2 {
        margin: 0;
    }
</style>
