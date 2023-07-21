<template>
    <section class="q-mt-lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <div class="">
                        <q-carousel
                            class="for-slider rounded"
                            arrows
                            animated
                            v-model="slide"

                        >
                            <q-carousel-slide name="first" img-src="https://cafesupport.ir/blog/wp-content/uploads/2022/05/cup-coffee-with-pile-coffee-beans_1112-438.jpg">

                            </q-carousel-slide>
                            <q-carousel-slide name="second" img-src="https://caffejoo.ir/wp-content/uploads/2023/05/%D9%82%D9%87%D9%88%D9%87-%D8%AA%D8%A7%D9%85-%DA%A9%DB%8C%D9%86%D8%B2.webp">

                            </q-carousel-slide>
                            <q-carousel-slide name="third" img-src="https://cdn.quasar.dev/img/parallax2.jpg">

                            </q-carousel-slide>
                        </q-carousel>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <div class="home-grid-promo"><a href="#"><img src="/front/images/promo/home/01.jpg" alt="promo"></a></div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <div class="home-grid-promo"><a href="#"><img src="/front/images/promo/home/02.jpg" alt="promo"></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<style scoped>
.for-slider{
    height: 446px;
}
.custom-caption{
    text-align: center;
    padding: 12px;
    color: white;
    background-color: rgba(0, 0, 0, .3);
}
@media only screen and (max-width: 900px) {
    .for-slider{
        height: 300px;
    }
}
@media only screen and (max-width: 800px) {
    .for-slider{
        height: 250px;
    }
}
@media only screen and (max-width: 700px) {
    .for-slider{
        height: 220px;
    }
}


</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Index_Slider_Top",
    data(){
        return{
            slide:'first',
            autoplay:true
        }
    }
})
</script>

