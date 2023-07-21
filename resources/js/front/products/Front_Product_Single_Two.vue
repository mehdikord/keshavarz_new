
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
        <div class="feature-content text-left">
            <h6 class="product-name">
                <a href="">قهوه 50-50 تام کینز</a>
            </h6>
            <div class="product-rating float-left">
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="active icofont-star"></i>
                <i class="icofont-star"></i>

            </div>
            <div class="mt-4 mobile-price">
                160,000<small> تومان </small>
            </div>
            <p class="product-desc">
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
.feature-image img {
    width: 175px;
}
.product-name{
    font-size: 15px;
}
.product-rating > i{
    font-size: 12px !important;
}
.product-price{
    font-size: 16px;
}
.mobile-price{
    font-size: 16px;
    font-weight: 500;

}
.product-add{
    font-size: 14px;
}
.product-desc{
    font-size: 13px;
}
@media only screen and (max-width: 600px) {
    .feature-image img {
        width: 125px;
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
    .mobile-price{
        font-size: 14px;
        font-weight: 500;
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
    .label-text{
        font-size: 11px;
    }
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Product_Single_Two"
})
</script>
