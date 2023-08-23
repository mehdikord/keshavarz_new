<script>
export default {
    name: "Front_Profile_Provider"
}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <q-img class="search-img" src="/front/images/tractor_provider.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    ارائه خدمات کشاورزی
                </strong>
                <p class="text-justify q-mt-md subtitle text-indigo">
                    کاربر گرامی شما در این صفحه میتوانید اطلاعات خود را مربوط ارائه خدمات کشاورزی تکمیل کنید تا کشاورزانی که به دنبال خدمات کشاورزی مرتبط با شما هستند اطلاعات تماس شما را دریافت کنند.
                </p>
            </div>
            <div class="q-mt-lg">
                <template v-if="!this.AuthUserCheck()">
                    <q-banner rounded class="bg-orange-9 text-center">
                        <strong class="auth-text text-white">
                            کاربر گرامی برای تکمیل اطلاعات مربوط به ارائه خدمات خود ، ابتدا باید وارد حساب کاربری خود شوید
                        </strong>
                        <div class="q-mt-lg q-pb-md">
                            <q-btn :to="{name:'profile'}" color="white" glossy text-color="dark" class="auth-btn">ثبت نام / ورود به حساب</q-btn>
                        </div>
                    </q-banner>
                </template>
                <template v-else>
                    <q-card>
                        <q-card-section class="info-title bg-teal-7 text-white">
                            اطلاعات مربوط به موقعیت جغرافیایی و محدوده فعالیت
                        </q-card-section>
                        <q-card-section>
                            sd
                        </q-card-section>
                    </q-card>
                </template>
            </div>
        </div>
    </div>
</template>

<style scoped>
.title{
    font-size: 18px;
}
.subtitle{
    font-size: 16px;
}
.search-img{
    width: 80px;
}
.auth-text{
    font-size: 14px;
}
.auth-btn{
    font-size: 14px;
}
.info-title{
    font-size: 15px;
    font-weight: 500;
}
@media only screen and (max-width: 600px) {

    .title{
        font-size: 15px;
    }
    .subtitle{
        font-size: 13px;
    }
    .search-img{
        width: 70px;
    }
    .auth-text{
        font-size: 13px;
    }
    .auth-btn{
        font-size: 13px;
    }
    .info-title{
        font-size: 14px;
        font-weight: 450;
        text-align: center;
    }
}
</style>
