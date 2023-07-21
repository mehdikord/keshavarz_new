<template>
    <footer class="footer-part">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="footer-widget"><a class="footer-logo" href="#">
                        <img src="/front/images/logo.png" alt="logo"></a>
                        <p class="footer-desc text-justify">
                             با افتخار و از عمیق‌ترین اعماق لذت‌بخشی‌ها، فروشگاه آنلاین کوکو، به شما تمامی محصولاتی که در خوردن آن‌ها لذت و احساسات زیبایی را تجربه خواهید کرد، ارائه می‌دهد؛ از آرامش بخش‌ترین دم‌کننده‌های قهوه تا شکلات‌های دلنشین و شگفت‌انگیز. با بهترین محصولات و ارائه تنوع فراوان، در این فروشگاه می‌توانید به همه‌ی این شگفتی‌ها دسترسی داشته باشید و تجربه‌ی یک معاشقه واقعی با محصولات ما را تجربه نمایید !
                        </p>
                        <ul class="footer-social">
                            <li><a class="icofont-facebook" href="#"></a></li>
                            <li><a class="icofont-twitter" href="#"></a></li>
                            <li><a class="icofont-linkedin" href="#"></a></li>
                            <li><a class="icofont-instagram" href="#"></a></li>
                            <li><a class="icofont-pinterest" href="#"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="footer-widget contact">
                        <h3 class="footer-title">تماس با ما</h3>
                        <ul class="footer-contact">
                            <li><i class="icofont-ui-email"></i>
                                <p>
                                    <span>cococoffee@Gmail.com</span>

                                </p>
                            </li>
                            <li>
                                <i class="icofont-ui-touch-phone"></i>
                                <p dir="ltr">
                                    <span>0911 792 6950</span>
                                    <span>0911 123 4568</span>
                                </p>
                            </li>
                            <li>
                                <i class="icofont-location-pin"></i>
                                <p>
                                    گلستان، گرگان، بلوار صیاد شیرازی نبش صیاد 22
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="footer-widget">
                        <h3 class="footer-title">لینک های مفید</h3>
                        <div class="footer-links">
                            <ul>
                                <li><a href="#">حساب کاربری</a></li>

                            </ul>
                            <ul>
                                <li><a href="#">قوانین و مقررات</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="footer-bottom">
                        <p class="footer-copytext">&copy; تمامی منابع و اطلاعات برای فروشگاه کوکوکافی محفوظ است - 1402 </p>
                        <div class="footer-card">
                            <a href="#">شسیبیسشب</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
.footer-title{
    font-size: 20px;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {

    .footer-title{
        font-size: 16px;
        font-weight: 600;
    }
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Template_Footer_Main"
})
</script>

