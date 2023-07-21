
<template>
    <section class="news-part">
        <div class="container container-mobile">
            <div class="row align-items-center">
                <div class="col-md-5 col-lg-6 col-xl-7 col-sm-12 col-xs-12">
                    <div class="news-text">
                        <h2 class=' subs-title'>تخیف های کوکو رو از دست نده</h2>
                        <p class="under-title">
                            ایمیل خود را وارد کنید و از تخفیف ها و مسابقه های کوکو باخبر شوید !
                        </p>
                    </div>
                </div>
                <div class="col-md-7 col-lg-6 col-xl-5 col-sm-12 col-xs-12">
                    <form class="news-form">
                        <input type="text" placeholder="آدرس ایمیل ...">
                        <button><span class="btn-mobile"><i class="icofont-ui-email"></i> عضویت در خبرنامه </span></button>
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
@media only screen and (max-width: 600px) {
    .subs-title{
        font-size: 20px;
        font-weight: 500;
        text-align: center;
    }
    .under-title{
        font-size: 15px;
        text-align: center;
    }
    .container-mobile{
        padding-left: 1px;
        padding-right: 1px;
        margin-left: 1px;
        margin-right: 1px;
    }
    .btn-mobile{
        font-size: 14px;
    }
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Index_Subscription"
})
</script>
