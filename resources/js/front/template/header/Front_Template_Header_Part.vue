<template>
    <header class="header-part">
        <div class="container">
            <div class="header-content">
                <div class="header-media-group">
                    <button class="header-user">
                        <img src="/front/images/user.png" alt="user">
                    </button>
                    <a href="index.html">
                        <img src="/front/images/logo.png" alt="logo">
                    </a>
                    <button class="header-src">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <a href="index.html" class="header-logo">
                    <img src="/front/images/logo.png" alt="logo">
                </a>
                <a href="login.html" class="header-widget" title="My Account">
                    <img src="/front/images/user.png" alt="user"><span>حساب کاربری</span>
                </a>
                <form class="header-form">
                    <input type="text" placeholder="جستجو در محصولات ...">
                    <button><i class="fas fa-search"></i></button>
                </form>
                <div class="header-widget-group">

                    <a href="" class="header-widget" title="علاقه مندی ها"><i class="fas fa-heart"></i><sup>0</sup>
                    </a>
                    <button class="header-widget header-cart" title="سبد خرید">
                        <i class="fas fa-shopping-basket"></i><sup>9+</sup><span>مجموع سبد خرید<small>345.00</small></span>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <header_cart></header_cart>


</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'
import Front_Template_Header_Cart from "./Front_Template_Header_Cart.vue";

export default defineComponent({
    name: "Front_Template_Header_Part",
    components : {
        'header_cart' : Front_Template_Header_Cart,
    }
})
</script>

