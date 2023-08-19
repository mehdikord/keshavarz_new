<script>
import Front_Skeleton_Plans from "../skeleton/Front_Skeleton_Plans.vue";

export default {
    name: "Front_Plans_Customers",
    components:{
        'skeleton' : Front_Skeleton_Plans,
    }
}
</script>

<template>
    <div class="row">
        <div v-for="i in 4" class="box-padding col-xl-3">
            <skeleton></skeleton>
        </div>
    </div>
</template>

<style scoped>
.box-padding{
    padding: 0 5px;
}
</style>
