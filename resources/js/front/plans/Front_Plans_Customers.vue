<script>
import Front_Skeleton_Plans from "../skeleton/Front_Skeleton_Plans.vue";
import Front_Plans_Item from "./Front_Plans_Item.vue";

export default {
    name: "Front_Plans_Customers",
    components:{
        'skeleton' : Front_Skeleton_Plans,
        'plan_item' : Front_Plans_Item,
    }
}
</script>

<template>
    <div class="row">
        <div v-for="i in 6" class="box-padding col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <plan_item :item="{name:'اشتراک طلایی 6 ماهه',access:6}"/>
        </div>
    </div>
</template>

<style scoped>
.box-padding{
    padding: 0 5px;
    margin-bottom: 15px;
}
</style>
