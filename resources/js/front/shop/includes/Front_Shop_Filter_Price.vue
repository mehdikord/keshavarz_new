
<template>
    <h6 class="shop-widget-title font-15">تعیین بازه قیمت</h6>
    <form>
        <div class="shop-widget-group">
            <input type="text" placeholder="از مبلغ">
            <input type="text" placeholder="تا مبلغ">
        </div>
        <button class="shop-widget-btn">
            <i class="fas fa-search"></i><span>ثبت قیمت </span>
        </button>
    </form>
</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Shop_Filter_Price"
})
</script>
