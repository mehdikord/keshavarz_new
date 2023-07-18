
<template>
    <section class="section">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        دیدگاه شما درمورد کوکو
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <q-carousel
                        v-model="slide"
                        transition-prev="scale"
                        transition-next="scale"
                        swipeable
                        animated
                        navigation
                        padding
                        arrows
                        class="bg-transparent"
                    >

                        <q-carousel-slide v-for="i in 8" :name="i" >
                            <div class="row justify-center">
                                <div class="col-md-5">
                                    <div class="testimonial-card">
                                        <i class="fas fa-quote-left"></i>
                                        <p class="font-17">
                                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون
                                        </p>
                                        <h5>Mehdi Kord</h5>
                                        <ul>
                                        </ul>
                                        <img src="/front/images/avatar/01.jpg" alt="testimonial">
                                    </div>

                                </div>

                            </div>
                        </q-carousel-slide>


                    </q-carousel>
                </div>
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

export default defineComponent({
    name: "Front_Index_Comments",
    data(){
        return {
            slide:1,
            lorem:'fsfsfsdfsdfsd sfsdfsdfgs sdfsdf'
        }
    }
})
</script>
