<script>
import Front_Skeleton_Plans from "../skeleton/Front_Skeleton_Plans.vue";
import {mapActions} from "vuex";
import Front_Plans_Item from "./Front_Plans_Item.vue";

export default {
    name: "Front_Plans_Providers",
    mounted() {
        this.GetPlans();
    },
    data(){
        return{
            plans:[],
            loading:false,
        }
    },
    methods:{
        ...mapActions([
            "PlansStoreIndexProvider",
        ]),
        GetPlans(){
            this.loading=true;
            this.PlansStoreIndexProvider().then(res => {
                this.loading=false;
                this.plans = res.data.result;
            }).catch(error => {
                this.loading=false;
                return this.NotifyServerError();

            })
        }
    },
    components:{
        'skeleton' : Front_Skeleton_Plans,
        'plan_item' : Front_Plans_Item,
    }
}
</script>

<template>
    <div class="row">

        <div v-if="loading" v-for="i in 4" class="box-padding col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <skeleton/>
        </div>

        <div v-else v-for="plan in plans" class="box-padding col-xl-3 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <plan_item :item="plan"/>
        </div>

    </div>
</template>

<style scoped>
.box-padding{
    padding: 0 5px;
    margin-bottom: 15px;
}
</style>
