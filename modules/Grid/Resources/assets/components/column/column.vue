<template>
    <div v-bind:class="classObject">
        <slot></slot>
    </div>
</template>
<script>
    export default{
        props: {
            size: {
                type: Object,
                default: {xs: 12}
            },
            offset: {
                type: Object
            },
            visibility: {
                type: Object
            }
        },
        computed: {
            classObject: function () {
                var cls = '';
                for (let size in this.size) {
                    cls += ' col-' + size + '-' + this.size[size];
                }

                for (let offset in this.offset) {
                    cls += ' col-' + offset + '-offset-' + this.offset[offset];
                }

                for (let visibility in this.visibility) {
                    cls += (this.visibility[visibility] == true ? ' visible' : ' hidden') + '-' + visibility;
                }

                return cls;
            }
        }
    }
</script>
