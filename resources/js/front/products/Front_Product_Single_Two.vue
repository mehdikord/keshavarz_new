
<template>
    <div class="feature-card">
        <div class="feature-media">
            <div class="feature-label">
                <label class="label-text feat">پیشنهاد ما</label>
            </div>
            <button class="feature-wish wish"><i class="fas fa-heart"></i></button>
            <a class="feature-image" href="product-video.html">
                <img src="https://tamkins.com/wp-content/uploads/2022/11/Layer-14-1200x1200.png" alt="product">
            </a>

        </div>
        <div class="feature-content">
            <h6 class="feature-name">
                <a href="product-video.html">قهوه 50-50 تام کینز</a>
            </h6>
            <div class="feature-rating">
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="icofont-star"></i>

            </div>
            <h6 class="feature-price mt-2">
                <span>160,000<small> تومان </small></span>
            </h6>
            <p class="feature-desc">
                این یکی از طولانی‌ترین رادیوگیک‌ها است، از مداخله‌های دولتی به نفع کاربران آمازون
            </p>
            <button class="product-add pt-2 pb-2" title="افزودن این محصول به سبد خرید">
                <span>افزودن به سبد</span>
                <i class="fas fa-shopping-basket me-2"></i>
            </button>
            <div class="product-action">
                <button class="action-minus" title="Quantity Minus">
                    <i class="icofont-minus"></i>
                </button>
                <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
                <button class="action-plus" title="Quantity Plus">
                    <i class="icofont-plus"></i>
                </button>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Product_Single_Two"
})
</script>
