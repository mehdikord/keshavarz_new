
<template>
    <h6 class="shop-widget-title font-15">براساس دسته ‌بندی</h6>
    <form>
        <input class="shop-widget-search" type="text" placeholder="دسته بندی ...">
        <ul class="shop-widget-list shop-widget-scroll">
            <li v-for="i in 6">
                <div class="shop-widget-content">
                    <input type="checkbox" id="cate1">
                    <label for="cate1">
                        دسته بندی {{i}}
                    </label>
                </div>
                <span class="shop-widget-number">(13)</span>
            </li>

        </ul>
        <button class="shop-widget-btn sm-hide xs-hide">
            <i class="far fa-trash-alt"></i><span>حذف فیلتر</span>
        </button>
    </form>
</template>

<style scoped>
@media only screen and (max-width: 600px) {
    .shop-widget-title{
        font-size: 13px!important;
    }
}

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Shop_Filter_Category"
})
</script>
