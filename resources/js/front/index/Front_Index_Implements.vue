<script>
import {mapActions} from "vuex";
import Front_Implement_Item from "../implement/Front_Implement_Item.vue";

export default {
    name: "Front_Index_Implements",
    components : {
        'implement_item' : Front_Implement_Item,
    },
    data(){
        return {
            loading:true,
            implements:null
        }
    },
    mounted() {
      this.Get_Implements();
    },
    methods : {
        ...mapActions([
            "ImplementsPublicSpecials"
        ]),

        Get_Implements(){
            this.ImplementsPublicSpecials(2).then(res => {
                this.implements = res.data.result;
                this.loading=false;
                console.log(this.implements)
            })

        }



    }
}
</script>

<template>
    <div v-if="!loading && implements.length > 0">
        <div class="text-center news-title font-iransans text-green-8">
            آیا با این ادوات آشنایی دارید ؟
        </div>
        <div class="row q-mt-md">
            <div v-for="implement in implements" class=" col-md-6 col-sm-12 col-xs-12">
                <implement_item :item="implement"></implement_item>
            </div>
        </div>
    </div>
</template>

<style scoped>
.news-title{
    font-size: 20px;
    font-weight: 600;
}

@media only screen and (max-width: 600px) {

    .news-title{
        font-size: 16px;
        font-weight: 600;
    }

}

</style>
