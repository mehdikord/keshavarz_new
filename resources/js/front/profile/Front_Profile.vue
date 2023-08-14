<script>
export default {
    name: "Front_Profile",
    data(){
        return {
            login_form :true,
            login_loading :false,
            errors:[],
            countDown:120,
            login:{
                phone:null,
                referral:null
            }
        }

    },
    methods : {
        Login(){
            if (!this.login.phone){
                return this.NotifyError("شماره موبایل خود را وارد کنید")
            }
            this.login_loading=true;
            axios.post('users/auth',this.login).then(res => {
                console.log(res.data);
                this.login_loading=false;


            }).catch(error => {

                if (error.response.status === 422) {
                    this.errors = error.response.data
                    this.login_loading = false;

                }
            })
            this.login_form=false;
            this.countDownTimer();

        },
        countDownTimer () {
            if (this.countDown > 0) {
                setTimeout(() => {
                    this.countDown -= 1
                    this.countDownTimer()
                }, 1000)
            }
        }
    },

}
</script>

<template>
    <div class="row q-mt-xl justify-center">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <q-slide-transition>
                <q-card v-if="login_form" class="shadow-5">
                <q-card-section class="bg-green-7 text-center text-white">
                    <strong class="login-title">ورود / ثبت نام در کشاورز</strong>
                </q-card-section>
                <q-card-section>
                    <div class="q-mt-md text-center">
                        <q-img src="/front/images/register.png" class="image"></q-img>
                        <p class="info-text q-mt-lg">
                             برای ورود به حساب کاربری یا ثبت نام در کشاورز کافیست شماره موبایل خود را وارد کنید
                        </p>
                    </div>
                    <div class="input-box">
                        <q-input v-model="login.phone" dir="ltr" rounded outlined color="green-8" label="شماره موبایل" placeholder="09XX XXX XXXX" />
                        <div class="referral">
                            <div class="text-red q-mb-sm">اگر کاربر جدید کشاورز هستید ، میتوانید شماره معرف خود را وارد کنید</div>
                            <q-input v-model="login.referral" dir="ltr" rounded outlined color="green-8" label="شماره معرف (اختیاری)" placeholder="09XX XXX XXXX" />
                        </div>
                    </div>
                    <div class="btn-box text-center">
                        <q-btn @click="Login" :loading="login_loading" class="btn-class" color="green-8" rounded icon-right="fas fa-check">ثبت شماره موبایل</q-btn>
                    </div>

                </q-card-section>
            </q-card>
                <q-card v-else class="shadow-5">
                <q-card-section class="bg-green-7 text-center text-white">
                    <strong class="login-title">ورود / ثبت نام در کشاورز</strong>
                </q-card-section>
                <q-card-section>
                    <div class="q-mt-md text-center">
                        <q-img src="/front/images/sms.png" class="image"></q-img>
                        <p class="info-text q-mt-lg">
                              کد ارسال شده به شماره موبایل خود را وارد کنید
                        </p>
                    </div>
                    <div class="sms-input-box">
                        <q-input  dir="ltr" rounded outlined color="green-8" label="کد ارسال شده به موبایل" placeholder="1 2 3 4 5 6" />
                    </div>
                    <div class="q-mb-md">
                        <q-knob
                            :min="0"
                            :max="120"
                            :model-value="countDown"
                            :inner-min="0"
                            show-value
                            track-color="grey-8"
                            size="45px"
                            readonly
                            color="teal"
                        />
                        <q-btn flat color="red" class="q-ml-xs" :disable="countDown > 0">ارسال مجدد کد تایید </q-btn>
                    </div>
                    <div class="btn-box text-center">
                        <q-btn class="btn-class" color="green-8" rounded icon-right="fas fa-check">ارسال کد </q-btn>
                    </div>
                    <div class="text-center q-mb-sm">
                        <strong class="change-number text-blue cursor-pointer">تغییر شماره موبایل </strong>
                    </div>

                </q-card-section>
            </q-card>
            </q-slide-transition>
        </div>
    </div>
</template>

<style scoped>
.login-title{
    font-size: 18px;
}
.image{
    width: 130px;
}
.info-text{
    font-size: 15px;
}
.input-box{
    margin-top: 40px;
    margin-bottom: 45px;
    padding: 0 15px;
}
.sms-input-box{
    margin-top: 40px;
    margin-bottom: 18px;
    padding: 0 15px;
}
.referral{
    margin-top: 25px;
}
.btn-box{
    padding: 0 15px;
    margin-bottom: 25px;

}
.btn-class{
    width: 100%;
    font-size: 15px;
    padding: 14px 5px;
}



</style>
