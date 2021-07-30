<template>
    <div class="m-4 d-flex flex-column align-items-center justify-content-center">
      <h1>{{ title }}</h1>
      <h2>{{ subtitle }}</h2>
  </div>
</template>

<script>
export default {
  name: 'WorkInProgress',
  props: ['title', 'subtitle']
}
</script>

<style lang="scss" scoped>
  $mainColor: red;
  h1 {
    color: $mainColor;
  }
</style>