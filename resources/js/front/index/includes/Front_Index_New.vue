
<template>
    <section class="section niche-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        محصولات جدید کوکو رو از دست نده
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-0">
                    <div class="card mb-4">
                        <div class="card-body pt-2 pb-4 row justify-center nav">
                            <div v-for="i in 6" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 mt-3">
                                <a :href="'#tab_new_'+i" class="tab-link tab-link-title" :class="{'active' : i===1}"  data-bs-toggle="tab">
                                    <i class="fas fa-list"></i>
                                    <span>دسته بندی {{i}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div v-for="i in 6" class="tab-pane fade" :class="{'show active' : i===1}" :id="'tab_new_'+i">
                <div class="row justify-center">
                    <div v-for="i in 5" class="col-lg-2 col-md-3 col-sm-4 col-xs-6 p-1">
                        <product_single_one></product_single_one>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<style scoped>
.tab-link-title{
    font-size: 15px;
}
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
    .tab-link-title{
        font-size: 12px;
    }
}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Product_Single_One from "../../products/Front_Product_Single_One.vue";

export default defineComponent({
    name: "Front_Index_New",
    components : {
        'product_single_one' : Front_Product_Single_One
    }
})
</script>
