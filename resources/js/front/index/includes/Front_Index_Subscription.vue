
<template>
    <section class="news-part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 col-lg-6 col-xl-7">
                    <div class="news-text">
                        <h2 class=' subs-title'>تخیف های کوکو رو از دست نده</h2>
                        <p>
                            ایمیل خود را وارد کنید و از تخفیف ها و مسابقه های کوکو باخبر شوید !
                        </p>
                    </div>
                </div>
                <div class="col-md-7 col-lg-6 col-xl-5">
                    <form class="news-form">
                        <input type="text" placeholder="آدرس ایمیل ...">
                        <button><span><i class="icofont-ui-email"></i> عضویت در خبرنامه </span></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.subs-title{
    font-size: 26px;
    font-weight: 500;
}
.news-part{
    background: url(/front/images/backgrounds/bg-coffee-wide.jpg);

}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Index_Subscription"
})
</script>
