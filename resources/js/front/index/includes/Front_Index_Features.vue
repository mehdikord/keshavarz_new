
<template>
    <section class="section feature-part">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        پیشنهاد های کوکو
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-for="i in 6" class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 p-1">
                    <product_single_two></product_single_two>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25">
                        <a href="" class="btn btn-outline for-link-all">
                            <i class="fas fa-eye"></i><span>مشاهده همه محصولات کوکو</span>
                        </a>
                    </div>
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
    .for-link-all{
        font-size: 13px;
    }
}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Product_Single_Two from "../../products/Front_Product_Single_Two.vue";

export default defineComponent({
    name: "Front_Index_Features",
    components : {
        'product_single_two' : Front_Product_Single_Two,
    }
})
</script>

