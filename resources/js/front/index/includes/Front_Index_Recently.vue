<template>

    <section class="section recent-part">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                       پرطرفدار های کوکو
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-6" v-for="i in 6">
                    <product_single_one></product_single_one>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25">
                        <a href="shop-4column.html" class="btn btn-outline">
                            <i class="fas fa-eye"></i><span>مشاهده همه محصولات</span>
                        </a>
                    </div>
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
import Front_Product_Single_One from "../../products/Front_Product_Single_One.vue";

export default defineComponent({
    name: "Front_Index_Recently",
    components : {
        'product_single_one' : Front_Product_Single_One,
    }
})
</script>

