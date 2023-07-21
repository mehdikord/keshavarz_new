<template>
    <section class="">
        <div class="container">
            <div class="mt-2">
                <h1 class="title">لیست محصولات کوکوکافی</h1>
            </div>
            <div class="row content-reverse mt-3 sm-hide xs-hide">

                <div class="col-lg-3">
                    <div class="shop-widget-promo">
                        <a href="#">
                        <img src="/front/images/promo/shop/01.jpg" alt="promo">
                        </a>
                    </div>
                    <div class="shop-widget">
                        <filer_price></filer_price>
                    </div>
                    <div class="shop-widget">
                        <filter_category></filter_category>
                    </div>

                    <div class="shop-widget">
                        <filter_brand></filter_brand>
                    </div>
                    <div class="shop-widget">
                        <filter_rating></filter_rating>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="top-filter">
                                <filter_top></filter_top>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div v-for="i in 16" class="col-xl-3 col-lg-3 col-md-4 p-1">
                            <product_single_one></product_single_one>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bottom-paginate">
                                <p class="page-info">Showing 12 of 60 Results</p>
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#"><i
                                        class="fas fa-long-arrow-alt-right"></i></a></li>
                                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">...</li>
                                    <li class="page-item"><a class="page-link" href="#">60</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i
                                        class="fas fa-long-arrow-alt-left"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<style scoped>
.title{
    font-size: 18px;
    font-weight: 500;
}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Shop_Filter_Price from "./includes/Front_Shop_Filter_Price.vue";
import Front_Shop_Filter_Category from "./includes/Front_Shop_Filter_Category.vue";
import Front_Shop_Filter_Brand from "./includes/Front_Shop_Filter_Brand.vue";
import Front_Shop_Filter_Rating from "./includes/Front_Shop_Filter_Rating.vue";
import Front_Shop_Filter_Top from "./includes/Front_Shop_Filter_Top.vue";
import Front_Product_Single_One from "../products/Front_Product_Single_One.vue";

export default defineComponent({
    name: "Front_Shop_Index",
    components:{
        'filer_price' : Front_Shop_Filter_Price,
        'filter_category' : Front_Shop_Filter_Category,
        'filter_brand' : Front_Shop_Filter_Brand,
        'filter_rating' : Front_Shop_Filter_Rating,
        'filter_top' : Front_Shop_Filter_Top,
        'product_single_one' : Front_Product_Single_One
    }
})
</script>

