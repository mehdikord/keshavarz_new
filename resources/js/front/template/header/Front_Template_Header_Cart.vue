<template>
    <aside class="cart-sidebar">
        <div class="cart-header">
            <div class="cart-total">
                <i class="fas fa-shopping-basket"></i>
                <span class="me-2">محصولات در سبد خرید (5)</span>
            </div>
            <button class="cart-close">
                <i class="icofont-close text-danger"></i>
            </button>
        </div>
        <ul class="cart-list">

            <li v-for="i in 4" class="cart-item">
                <cart_single_one></cart_single_one>
            </li>

        </ul>
        <div class="cart-footer">
            <button class="coupon-btn">آیا کد تخفیف دارید ؟</button>
            <form class="coupon-form">
                <input type="text" placeholder="کد تخفیف را وارد کنید">
                <button type="submit">
                    <span>ثبت کد</span>
                </button>
            </form>
            <a class="cart-checkout-btn" href="checkout.html">
                <span class="checkout-label">ثبت نهایی سفارشات</span>
                <span class="checkout-price">385,000</span>
            </a>
        </div>
    </aside>

</template>

<style scoped>
.checkout-price{
   font-size: 17px;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {
    .checkout-price{
        font-size: 15px;
        font-weight: 500;
    }
}

</style>
<script>
import {defineComponent} from 'vue'
import Front_Cart_Single_One from "../../cart/Front_Cart_Single_One.vue";

export default defineComponent({
    name: "Front_Template_Header_Cart",
    components :{
        'cart_single_one' : Front_Cart_Single_One,
    }
})
</script>

