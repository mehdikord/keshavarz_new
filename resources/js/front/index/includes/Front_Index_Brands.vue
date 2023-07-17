
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
            <div class="">
                <q-carousel
                    v-model="slide"
                    transition-prev="slide-right"
                    transition-next="slide-left"
                    swipeable
                    animated
                    navigation
                    control-color="teal"
                    control-type="unelevated"
                    control-text-color="black"
                    class="bg-transparent"
                >
                    <q-carousel-slide :name="1" class="column no-wrap">
                        <div class="row fit">
                         <div v-for="i in 6" class="col-md-2">
                             <brands_one></brands_one>
                         </div>
                        </div>
                    </q-carousel-slide>
                    <q-carousel-slide :name="2" class="column no-wrap">
                        <div class="row fit">
                         <div v-for="i in 6" class="col-md-2">
                             <brands_one></brands_one>
                         </div>
                        </div>
                    </q-carousel-slide>
                </q-carousel>
            </div>
        </div>
    </section>
</template>

<style scoped>
.section-heading{
    font-size: 40px;
    font-weight: 700;
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
