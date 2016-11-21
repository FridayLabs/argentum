<template>
    <div class="vert-table">
        <div class="vert-center">
            <div class="center-block">
                <slot></slot>
            </div>
        </div>
    </div>
</template>
<script>
    export default {}
</script>
<style>
    .vert-table {
        display: table;
        height: 100%;
        width: 100%;
    }

    .vert-center {
        display: table-cell;
        vertical-align: middle;
        height: 100%;
        width: 100%;
    }
</style>
