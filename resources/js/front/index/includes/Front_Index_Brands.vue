
<template>
    <section class="section brand-part">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        برند های محبوب در کوکو
                    </div>
                </div>
            </div>
            <div class="row justify-center mt-2 mb-2">
                <div v-for="i in 6" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 mt-2 p-1">
                    <brands_one></brands_one>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.section-heading{
    font-size: 28px;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {
    .section-heading{
        font-size: 22px;
        font-weight: 600;
    }

}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Brand_One from "../../brands/Front_Brand_One.vue";

export default defineComponent({
    name: "Front_Index_Brands",
    components:{
      'brands_one' : Front_Brand_One,
    },
    data(){
        return{
            slide:1
        }
    }
})
</script>
