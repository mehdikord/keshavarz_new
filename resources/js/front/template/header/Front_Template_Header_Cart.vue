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
                <div class="cart-media">
                    <a href="#">
                        <img src="/front/images/product/06.jpg" alt="product"></a>
                    <button class="cart-delete">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
                <div class="cart-info-group">
                    <div class="cart-info">
                        <h6><a href="product-single.html">نام محصول</a></h6>
                        <p>تومان - 20,000</p>
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
                        <h6>80,000</h6>
                    </div>
                </div>
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
                <span class="checkout-price">369.78</span>
            </a>
        </div>
    </aside>

</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Template_Header_Cart"
})
</script>

