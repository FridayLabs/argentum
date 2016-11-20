<template>
    <div v-bind:class="classObject">
        <slot></slot>
    </div>
</template>
<script>
    export default{
        props: {
            isfullwidth: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            classObject: function () {
                return this.isfullwidth == true ? 'container-fluid' : 'container';
            }
        }
    }
</script>
