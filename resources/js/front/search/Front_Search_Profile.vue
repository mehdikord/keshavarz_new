<script>
export default {
    name: "Front_Search_Profile"
}
</script>

<template>

    <q-card class="bg-grey-1 rounded">
        <q-card-section class="q-pa-xs">
            <div class="row items-center">
                <div class="col-lg-2 col-sm-3 col-xs-3 q-pa-sm mobile-padding text-center">
                    <q-img  src="/front/images/farmer.png" class="image" />
                </div>
                <div class="col-lg-10 col-sm-9 col-xs-9 info-padding">
                    <div class="info-box">
                        <span class="info-title text-green-7">نام : </span>
                        <span class="info-text text-dark">مهدی کرد </span>
                    </div>
                    <div class="info-box">
                        <span class="info-title text-green-7">شماره تماس : </span>
                        <span v-show="false" class="info-text text-dark" dir="ltr">0911 792 6950</span>
                        <span class="info-error text-red" dir="ltr">
                            برای مشاهده وارد حساب کاربری خود شوید
                            <q-icon name="fas fa-triangle-exclamation"></q-icon>

                        </span>
                    </div>
                    <div class="info-box">
                        <span class="info-title text-green-7">فاصله از شما : </span>
                        <span class="info-text text-dark">18 کیلومتر </span>
                    </div>
                    <div class="info-box">
                        <span class="info-title text-green-7">قیمت : </span>
                        <span class="info-text text-dark">
                            <strong class="text-red">280,000</strong>
                            <span class="currency">تومان</span>
                            /
                            <span>در هکتار</span>
                        </span>
                    </div>
                    <div class="btn-box">
                        <q-btn color="positive" class="float-right info-btn q-ml-sm" icon="fas fa-phone q-mr-xs" disable>تماس</q-btn>
                        <q-btn :to="{name : 'provider_profile',params:{code:'23423'}}" color="positive" class="float-right info-btn" icon="fas fa-user q-mr-xs">مشاهده پروفایل</q-btn>
                    </div>
                </div>
            </div>
        </q-card-section>
    </q-card>
</template>

<style scoped>
.mobile-padding{

}
.info-padding{
    padding-bottom: 8px;
    padding-right: 10px;
}
.info-btn{
    font-size: 13px;
}
.image{
    width: 100px;
}
.currency{
    font-size: 12px;
    margin-left: 4px;
}
.btn-box{
    margin-top: 10px;
}
.info-box{
    margin-top: 11px;
}
.info-title{
    font-size: 13px;
    font-weight: 600;
}
.info-text{
    font-size: 14px;
    font-weight: 600;
    margin-left: 3px;
}
.info-error{
    font-size: 13px;
    font-weight: 500;
    margin-left: 3px;
}

@media only screen and (max-width: 600px) {
    .mobile-padding{
        padding: 0 0;
    }
    .info-padding{
        padding-bottom: 3px;
        padding-right: 3px;
    }
    .info-btn{
        font-size: 12px;
    }
    .image{
        width: 70px;
    }
    .currency{
        font-size: 10px;
        margin-left: 4px;
    }
    .btn-box{
        margin-top: 16px;
    }
    .info-box{
        margin-top: 11px;
    }
    .info-title{
        font-size: 12px;
        font-weight: 600;
    }
    .info-text{
        font-size: 13px;
        font-weight: 600;
        margin-left: 3px;
    }
    .info-error{
        font-size: 12px;
        font-weight: 500;
        margin-left: 3px;
    }
}

</style>
