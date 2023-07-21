
<template>
    <section class="intro-part">
        <div class="container">
            <div class="row intro-content">
                <div class="col-sm-6 col-lg-3">
                    <div class="intro-wrap">
                        <div class="intro-icon"><i class="fas fa-truck"></i></div>
                        <div class="intro-content">
                            <h5 class="mobile-title">ارسال سریع و رایگان</h5>
                            <p class="mobile-sub">
                                ارسال سریع و رایگان به سرار کشور و ارسال چند ساعته در شهر گرگان
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="intro-wrap">
                        <div class="intro-icon"><i class="fas fa-sync-alt"></i></div>
                        <div class="intro-content">
                            <h5 class="mobile-title">تضمین مرجوعی کالا</h5>
                            <p class="mobile-sub">
                                بازگشت کالا در صورت نارضایتی یا معیوب بودن محصول
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="intro-wrap">
                        <div class="intro-icon"><i class="fas fa-headset"></i></div>
                        <div class="intro-content">
                            <h5 class="mobile-title">پشتیبانی کامل</h5>
                            <p class="mobile-sub">
                                پشتیبانی تلفنی و آنلاین به صورت همه روزه در همه ساعات
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="intro-wrap">
                        <div class="intro-icon"><i class="fas fa-lock"></i></div>
                        <div class="intro-content">
                            <h5 class="mobile-title">پرداخت سریع و ایمن</h5>
                            <p class="mobile-sub">
                                اتصال به درگاه های رسمی و ایمن بانکی کشور و پرداخت آنلاین
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@media only screen and (max-width: 600px) {
    .mobile-title{
        font-size: 15px;
    }
    .mobile-sub{
        font-size: 13px;
    }
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Index_Tools"
})
</script>

