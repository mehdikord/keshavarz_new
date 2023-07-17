<template>
    <section class="q-mt-lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 order-1 order-lg-0 order-xl-0">
                    <div class="row">
                        <div class="col-sm-6 col-lg-12">
                            <div class="home-grid-promo"><a href="#"><img src="/front/images/promo/home/01.jpg" alt="promo"></a></div>
                        </div>
                        <div class="col-sm-6 col-lg-12">
                            <div class="home-grid-promo"><a href="#"><img src="/front/images/promo/home/02.jpg" alt="promo"></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="">
                    <q-carousel
                        class="rounded"
                        arrows
                        animated
                        v-model="slide"
                        height="445px"
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
            </div>
        </div>
    </section>




<!--    <section class="q-pb-lg container">-->
<!--        <q-carousel-->
<!--            class="rounded for-slider"-->
<!--            swipeable-->
<!--            animated-->
<!--            v-model="slide"-->
<!--            :autoplay="autoplay"-->
<!--            infinite-->
<!--            height=""-->
<!--        >-->
<!--            <q-carousel-slide :name="1" img-src="https://sbkoffie.com/common/sliders/slider-1.jpg" />-->
<!--            <q-carousel-slide :name="2" img-src="https://sbkoffie.com/common/sliders/slider-2.jpg" />-->
<!--            <q-carousel-slide :name="3" img-src="https://sbkoffie.com/common/sliders/slider-3.jpg" />-->


<!--            <template v-slot:control>-->

<!--                <q-carousel-control-->
<!--                    position="bottom-right"-->
<!--                    class="q-gutter-xs"-->
<!--                >-->
<!--                    <q-btn outline round color="grey" text-color="withe" icon="fa fa-arrow-right"-->
<!--                        @click="$refs.carousel.previous()"-->
<!--                    />-->
<!--                    <q-btn round outline color="grey" text-color="withe" icon="fa fa-arrow-left"-->
<!--                        @click="$refs.carousel.next()"-->
<!--                    />-->
<!--                </q-carousel-control>-->
<!--            </template>-->
<!--        </q-carousel>-->
<!--    </section>-->
</template>

<style scoped>
.for-slider{
}
.custom-caption{
    text-align: center;
    padding: 12px;
    color: white;
    background-color: rgba(0, 0, 0, .3);
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

