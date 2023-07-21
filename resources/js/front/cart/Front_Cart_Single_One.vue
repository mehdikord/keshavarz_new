
<template>
    <div class="cart-media">
        <a href="#">
            <img src="https://tamkins.com/wp-content/uploads/2022/11/Layer-30-1200x1200.png" alt="product"></a>
        <button class="cart-delete">
            <i class="far fa-trash-alt"></i>
        </button>
    </div>
    <div class="cart-info-group">
        <div class="cart-info">
            <h6><a href="" class="product-name">نام محصول</a></h6>
            <p class="sub-price">20,000</p>
        </div>
        <div class="cart-action-group">
            <div class="product-action">
                <button class="action-minus" title="Quantity Minus">
                    <i class="icofont-minus"></i>
                </button>
                <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
                <button class="action-plus" title="Quantity Plus">
                    <i class="icofont-plus"></i>
                </button>
            </div>
            <h6 class="total-price">80,000</h6>
        </div>
    </div>
</template>

<style scoped>
.product-name{
    font-size: 15px;
    font-weight: 500;
}
.total-price{
    font-size: 19px;
}
@media only screen and (max-width: 600px) {
    .product-name{
        font-size: 14px;
        font-weight: 400;
    }
    .sub-price{
        font-size: 13px;
        margin-top: 3px;
    }
    .total-price{
        font-size: 15px;
    }
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Cart_Single_One"
})
</script>
