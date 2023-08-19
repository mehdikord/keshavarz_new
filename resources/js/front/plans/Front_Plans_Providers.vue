<script>
import Front_Skeleton_Plans from "../skeleton/Front_Skeleton_Plans.vue";

export default {
    name: "Front_Plans_Providers",
    components:{
        'skeleton' : Front_Skeleton_Plans,
    }
}
</script>

<template>
    <div class="row">
        <div v-for="i in 3" class="box-padding col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <skeleton ></skeleton>
        </div>
    </div>
</template>

<style scoped>
.box-padding{
    padding: 0 5px;
    margin-bottom: 15px;
}
</style>
