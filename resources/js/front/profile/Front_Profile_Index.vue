
<template>

    <div class="container">
<!--        <div class="mt-5">-->
<!--            <profile_auth></profile_auth>-->
<!--        </div>-->

        <div class="mt-5">
            <div class="row">
                <div class="col-lg-3 p-1">
                    <div class="card bg-white">
                        <div class="card-body">
                            <div class="row pb-4">
                                <div class="col-2">
                                    <span class="header-user">
                                        <img src="/front/images/user.png" alt="user" class="profile-img">
                                    </span>
                                </div>
                                <div class="col-10">
                                    <strong class="me-3 font-15">مهدی کرد</strong>
                                    <q-icon name="fas fa-pen" class="float-right font-17 pointer" color="blue-8"></q-icon>
                                    <br>
                                    <div dir="ltr" class="me-3 mt-2 text-left phone-text text-muted">0911 792 6950</div>
                                </div>
                            </div>
                            <hr>
                            <q-list>
                                <q-item clickable v-ripple class="pt-3 pb-3 bg-teal-7 text-white">
                                    <q-item-section avatar>
                                        <q-img src="/front/images/home.png" size="24px" />
                                    </q-item-section>
                                    <q-item-section class="menu-text">خلاصه فعالیت ها</q-item-section>
                                </q-item>
                                <q-separator color="grey"/>
                                <q-item clickable v-ripple class="pt-3 pb-3">
                                    <q-item-section avatar>
                                        <q-img src="/front/images/shopping-bags.png" size="24px" />
                                    </q-item-section>
                                    <q-item-section class="menu-text">سفارش ها</q-item-section>
                                </q-item>
                                <q-separator color="grey"/>
                                <q-item clickable v-ripple class="pt-3 pb-3">
                                    <q-item-section avatar>
                                        <q-img src="/front/images/favorite.png" size="24px" />
                                    </q-item-section>
                                    <q-item-section class="menu-text">علاقه‌مندی ها</q-item-section>
                                </q-item>
                                <q-separator color="grey"/>
                                <q-item clickable v-ripple class="pt-3 pb-3">
                                    <q-item-section avatar>
                                        <q-img src="/front/images/location.png" size="24px" />
                                    </q-item-section>
                                    <q-item-section class="menu-text">آدرس ها</q-item-section>
                                </q-item>
                                <q-separator color="grey"/>
                                <q-item clickable v-ripple class="pt-3 pb-3">
                                    <q-item-section avatar>
                                        <q-img src="/front/images/comments.png" size="24px" />
                                    </q-item-section>
                                    <q-item-section class="menu-text">دیدگاه‌ ها</q-item-section>
                                </q-item>
                                <q-separator color="grey"/>
                                <q-item clickable v-ripple class="pt-3 pb-3">
                                    <q-item-section avatar>
                                        <q-img src="/front/images/user-setting.png" size="24px" />
                                    </q-item-section>
                                    <q-item-section class="menu-text">تنظیمات حساب کاربری</q-item-section>
                                </q-item>


                            </q-list>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 p-1">
                    <div class="card">
                        <div class="card-body">
                            sdsdsddsdd
                        </div>
                    </div>

                </div>

            </div>
        </div>


    </div>
</template>

<style scoped>
.profile-img{
    width: 55px;
    height: 55px;
}
.phone-text{
    font-weight: 600;
}
.menu-text{
    font-weight: 500;
}
</style>
<script>
import {defineComponent} from 'vue'
import Front_Profile_Auth from "./includes/Front_Profile_Auth.vue";

export default defineComponent({
    name: "Front_Profile_Index",
    components:{
        'profile_auth' : Front_Profile_Auth,
    }
})
</script>
