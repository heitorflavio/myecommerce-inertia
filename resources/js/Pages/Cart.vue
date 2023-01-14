<template>
  <div>
    <h1>teste</h1>
  </div>
</template>

<script>
export default {
    name: 'Cart',
    props: {
        product: {
            type: Array,
            required: true
        }
    },
    created() { 
        console.log(this.product)
    }
}
</script>

<style>

</style>