
<template>
    <section class="section">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h2>client's feedback</h2>
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
                        control-color="white"
                        navigation
                        padding
                        arrows
                        class="bg-transparent"
                    >

                        <q-carousel-slide name="1" class="column no-wrap flex-center">
                            <div class="row justify-center">
                                <div class="col-md-6">
                                    sdssdsdsd
                                </div>
                            </div>

                        </q-carousel-slide>
                        <q-carousel-slide name="2" class="column no-wrap flex-center">

                        </q-carousel-slide>

                    </q-carousel>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Index_Comments",
    data(){
        return {
            slide:'style',
            lorem:'fsfsfsdfsdfsd sfsdfsdfgs sdfsdf'
        }
    }
})
</script>
