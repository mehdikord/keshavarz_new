
<template>
    <h6 class="shop-widget-title font-15">براساس برند </h6>
    <form><input class="shop-widget-search" type="text" placeholder="برند محصولات ...">
        <ul class="shop-widget-list shop-widget-scroll">
            <li v-for="i in 8">
                <div class="shop-widget-content">
                    <input type="checkbox" id="brand1">
                    <label for="brand1">برند {{i}}</label>
                </div>
                <span class="shop-widget-number">(13)</span>
            </li>

        </ul>
        <button class="shop-widget-btn">
            <i class="far fa-trash-alt"></i><span>حذف فیلتر</span>
        </button>
    </form>
</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Shop_Filter_Brand"
})
</script>
