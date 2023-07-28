<template>
    <div class="product-card">
        <div class="product-media text-center">
            <div class="product-label">

            </div>
            <button class="product-wish wish">
                <i class="fas fa-heart"></i>
            </button>
            <a class="product-image " href="product-video.html">
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
        </div>
    </div>
</template>

<style scoped>
.product-image img {
    width: 185px;
}
.product-name{
    font-size: 14px;
}
.product-rating > i{
    font-size: 12px !important;
}
.product-price{
    font-size: 15px;
}
.product-add{
    font-size: 14px;
}
@media only screen and (max-width: 600px) {
    .product-image img {
        width: 125px;
    }
    .label-text{
        font-size: 11px;
    }
    .product-name{
        font-size: 14px;
    }
    .product-rating > i{
        font-size: 10px !important;
    }
    .product-price{
        font-size: 14px;
    }
    .product-add{
        font-size: 12px;
    }
    .product-add > i{
        display: block;
        font-size: 10px;
    }
    .action-input .action-plus .action-minus{
        font-size: 13px !important;
    }
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Product_Single_Recent"
})
</script>

