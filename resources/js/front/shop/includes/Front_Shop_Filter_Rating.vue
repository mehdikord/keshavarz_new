
<template>
    <h6 class="shop-widget-title font-15">براساس امتیاز </h6>
    <form>
        <ul class="shop-widget-list">

            <li>
                <div class="shop-widget-content">
                    <input type="checkbox" id="feat2">
                    <label for="feat2">
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    </label>
                </div>
                <span class="shop-widget-number">(28)</span>
            </li>
            <li>
                <div class="shop-widget-content">
                    <input type="checkbox" id="feat2">
                    <label for="feat2">
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star active"></i>
                    <i class="fas fa-star"></i>
                    </label>
                </div>
                <span class="shop-widget-number">(28)</span>
            </li>
            <li>
                <div class="shop-widget-content">
                    <input type="checkbox" id="feat3">
                    <label for="feat3">
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </label>
                </div>
                <span class="shop-widget-number">(35)</span>
            </li>
            <li>
                <div class="shop-widget-content">
                    <input type="checkbox" id="feat3">
                    <label for="feat3">
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </label>
                </div>
                <span class="shop-widget-number">(35)</span>
            </li>
            <li>
                <div class="shop-widget-content">
                    <input type="checkbox" id="feat3">
                    <label for="feat3">
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </label>
                </div>
                <span class="shop-widget-number">(35)</span>
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
    name: "Front_Shop_Filter_Rating"
})
</script>
