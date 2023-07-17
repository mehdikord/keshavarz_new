<template>
    <div class="product-card">
        <div class="product-media">
            <div class="product-label">
                <label class="label-text new">جدید</label>
            </div>
            <button class="product-wish wish">
                <i class="fas fa-heart"></i>
            </button>
            <a class="product-image" href="product-video.html">
                <img src="https://tamkins.com/wp-content/uploads/2022/11/Layer-30-1200x1200.png" alt="product">
            </a>

        </div>
        <div class="product-content">
            <h6 class="product-name">
                قهوه 70 - 30
            </h6>
            <div class="product-rating">
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="icofont-star"></i>
            </div>
            <h6 class="product-price mt-2">
                <span>150,000<small></small></span>
            </h6>
            <button class="product-add pt-2 pb-2" title="افزودن این محصول به سبد خرید">
                <span>افزودن به سبد</span>
                <i class="fas fa-shopping-basket me-2"></i>
            </button>
            <div class="product-action">
                <button class="action-minus" title="Quantity Minus">
                    <i class="icofont-minus">
                    </i>
                </button>
                <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
                <button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Product_Single_One"
})
</script>

