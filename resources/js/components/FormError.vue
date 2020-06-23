<template>
    <span class="has-error" >

        <slot></slot>
    </span>
</template>

<script>
    export default {
        props: ['errors'],
    }
</script>
<style>
    .has-error{
        color: red;
    }

</style>