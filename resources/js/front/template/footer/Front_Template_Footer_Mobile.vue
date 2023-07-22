
<template>
    <div class="mobile-menu">
        <a href="compare.html" title="Compare List" class="pt-3">
            <i class="fas fa-user font-20"></i><span>پروفایل</span>
        </a>
        <a href="wishlist.html" title="Wishlist" class="pt-3">
            <i class="fas fa-heart font-20"></i><span>برگزیده</span><sup>0</sup>
        </a>
        <a href="" title="Home Page" class="pt-3">
            <i class="fas fa-home font-20"></i><span>کوکوکافی</span>
        </a>
        <button class="cate-btn pt-3" title="Category List">
            <i class="fas fa-list font-20"></i><span>دسته‌بندی</span>
        </button>
        <button class="cart-btn pt-3" title="Cartlist">
            <i class="fas fa-shopping-basket font-20"></i><span>سبد‌خرید</span><sup>9+</sup>
        </button>
    </div>
</template>

<style scoped>

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Template_Footer_Mobile"
})
</script>
