<script>
export default {
    name: "Manage_Global_Status",
    props:['status']
}
</script>

<template>
    <q-icon v-if="status" name="mdi-check-circle" color="positive" class="font-24"></q-icon>
    <q-icon v-else name="mdi-close-circle" color="red" class="font-24"></q-icon>

</template>

<style scoped>

</style>
