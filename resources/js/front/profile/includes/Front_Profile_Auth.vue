
<template>

    <div class="row justify-center">
        <div class="col-lg-7">
            <div class="card">
                <div class="auth_title text-center text-white bg-green-8">
                    ورود به حساب کاربری
                </div>

                <div class="card-body">
                    <div class="row mt-3 sm-hide xs-hide">
                        <div class="col-xl-4 col-lg-5">
                            <div class="text-center">
                                <q-img src="/front/images/auth-phone.png" class="auth-image"></q-img>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7">
                            <h2 class="auth-sub">
                                برای ورود به حساب کاربری شماره موبایل خود را وارد کنید
                            </h2>
                            <div dir="ltr" class="input-group mt-2">
                                <button class="btn auth-btn bg-green-8 text-white" type="button" id="button-addon1"><i class="fas fa-check"></i> ورود به حساب </button>
                                <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="text-center">
                            <q-img src="/front/images/auth-phone.png" class="auth-image"></q-img>
                        </div>
                        <div class="text-center">
                            <h2 class="auth-sub">
                                برای ورود به حساب کاربری شماره موبایل خود را وارد کنید
                            </h2>
                        </div>
                        <div class="mt-1 mb-4">
                            <input type="text" class="form-control" placeholder="" >
                        </div>
                        <div class="text-center mb-4">
                            <q-btn class="auth-btn-mobile w-100" color="success" icon-right="fas fa-check font-13" >ورود به حساب</q-btn>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</template>

<style scoped>
.auth_title{
    padding-top: 20px;
    padding-bottom: 20px;
    font-size: 17px;
    font-weight: 600;
}
.auth-image{
    width: 180px;
}
.auth-sub{
    font-size: 17px;
    font-weight: 400;
}
.auth-btn{
    padding: 10px 14px;

}
@media only screen and (max-width: 600px) {
    .auth_title{
        padding-top: 20px;
        padding-bottom: 20px;
        font-size: 15px;
        font-weight: 600;
    }
    .auth-image{
        width: 140px;
    }
    .auth-sub{
        font-size: 14px;
        font-weight: 400;
    }
    .auth-btn-mobile{
        padding: 8px 25px;
        font-size: 13px;
    }

}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Profile_Auth"
})
</script>
