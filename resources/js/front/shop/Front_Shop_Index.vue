<template>
    <section class="">
        <div class="container">
            <div class="">
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
                        <filter_price></filter_price>
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
            <div class="row xl-hide lg-hide md-hide">
                <div class="col-12">
                    <q-btn @click="filter_dialog = true" color="blue-grey-9" icon="fas fa-list" class="font-13" flat>فیلتر ها</q-btn>
                    <q-dialog v-model="filter_dialog">
                        <q-card>
                            <q-card-section >
                                <h6 class="font-16 ">فیلتر ها</h6>
                            </q-card-section>
                            <q-separator />

                            <q-card-section style="max-height: 65vh" class="scroll">
                                <filter_price></filter_price>
                                <q-separator />
                                <filter_category></filter_category>
                                <q-separator />
                                <filter_brand></filter_brand>
                                <q-separator/>
                                <filter_rating></filter_rating>
                            </q-card-section>
                            <q-separator />
                            <q-card-section class="text-center">
                                <q-btn flat color="dark" size="sm" class="font-12" icon-right="fas fa-times">حذف فیلترها</q-btn>
                                <q-btn flat color="success" size="sm" class="font-12" icon-right="fas fa-check">اعمال فیلتر </q-btn>

                            </q-card-section>
                        </q-card>
                    </q-dialog>
                    <q-btn @click="sort_dialog = true" color="blue-grey-9" icon="fas fa-sort" class="font-13" flat> پرفروش ترین</q-btn>
                    <q-dialog v-model="sort_dialog" full-width>
                        <q-card>
                            <q-card-section>
                                <h6 class="font-16">مشاهده بر اساس </h6>
                            </q-card-section>
                            <q-separator />

                            <q-card-section >
                                <select class="form-control">
                                    <option>مرتبط ترین</option>
                                    <option>جدید ترین</option>
                                    <option>پرفروش ترین</option>
                                    <option>پربازدید ترین</option>
                                    <option>گران ترین</option>
                                    <option>ارزان ترین</option>
                                </select>
                            </q-card-section>
                        </q-card>
                    </q-dialog>

                    <hr>



                </div>
                <div v-for="i in 2" class="col-12 p-1">
                    <product_single_two></product_single_two>
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
@media only screen and (max-width: 600px) {
    .title{
        font-size: 15px;
        font-weight: 500;
    }
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
import Front_Product_Single_Two from "../products/Front_Product_Single_Two.vue";

export default defineComponent({
    name: "Front_Shop_Index",
    components:{
        'filter_price' : Front_Shop_Filter_Price,
        'filter_category' : Front_Shop_Filter_Category,
        'filter_brand' : Front_Shop_Filter_Brand,
        'filter_rating' : Front_Shop_Filter_Rating,
        'filter_top' : Front_Shop_Filter_Top,
        'product_single_one' : Front_Product_Single_One,
        'product_single_two' : Front_Product_Single_Two
    },
    data(){
        return{
            filter_dialog : false,
            sort_dialog : false,
            options: [
                'Google', 'Facebook', 'Twitter', 'Apple', 'Oracle'
            ]
        }
    }
})
</script>

