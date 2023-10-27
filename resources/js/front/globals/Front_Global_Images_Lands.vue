<script>
export default {
    name: "Front_Global_Images_Lands",
    data(){
        return {
        }
    },
    props :['image','width']
}
</script>

<template>
    <q-img
        v-if="image"
        :src="image"
        loading="lazy"
        spinner-color="green-8"
        class="image rounded"

    />
    <q-img
        v-else
        src="/front/images/land-default.png"
        loading="lazy"
        spinner-color="green-8"
        class="image rounded"
    />

</template>

<style scoped>
.image{
    width: 55px!important;
    height: 55px!important;
    border-radius: 7px;
    cursor: zoom-in;
}
.show-image{
    width: 800px;
}
.show-img{
    width: 100% !important;
}
</style>
