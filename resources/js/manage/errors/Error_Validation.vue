<template>
  <div v-if="errors" :class="classes"  v-for="(error,index) in errors" :key="index">

    {{ error }}
  </div>
</template>

<script>
export default {
  name: "Error_Validation",
  props : ['errors','classes']
}
</script>

<style scoped>

</style>
