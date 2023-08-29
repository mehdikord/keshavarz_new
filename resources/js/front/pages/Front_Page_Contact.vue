<script>
export default {
    name: "Front_Page_Contact",
    data(){
        return {
            contact:{
                name:null,
                phone:null,
                email:null,
                message:null,
            }
        }
    }
}
</script>

<template>

    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <strong class="text-green-7 title q-ml-sm">
                    تماس با تیم کشاورز
                </strong>
                <q-separator class="q-mt-md"/>
            </div>
            <div class="q-mt-md">
                <div class="google-map-box">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3286.559506268671!2d54.44121743145486!3d36.84253451569226!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f83361922a8cacf%3A0x41e8b20d45443161!2sGolestan%20University!5e0!3m2!1sen!2s!4v1690116995461!5m2!1sen!2s"
                        class="google-map__one"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            <div class="q-mt-xl row text-center">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 q-mb-lg">
                    <strong class="font-iransans contact-title text-green-7">شماره تماس :</strong>
                    <strong class="q-ml-sm contact-info">  09935270131 </strong>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 q-mb-lg">
                    <strong class="font-iransans contact-title text-green-7">آدرس ایمیل :</strong>
                    <strong class="q-ml-sm contact-info">  keshavarz.app@gmail.com </strong>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 q-mb-lg">
                    <strong class="font-iransans contact-title text-green-7">آدرس دفتر :</strong>
                    <strong class="q-ml-sm contact-add">  گلستان ، گرگان ، خیابان شهید بهشتی دانشگاه گلستان مرکز رشد </strong>
                </div>
            </div>
            <div class="q-mt-md q-mb-xl">
                <q-separator/>
            </div>
            <div class="q-mb-xl">
                <div class="form-title text-green-7 font-iransans text-center">
                    ارسال پیام به تیم کشاورز
                </div>
                <div class="q-mt-lg text-center form-info">
                    با ارسال پیام ، انتقادات و پیشنهادات به تیم کشاورز در راه توسعه بهتر به ما کمک کنید
                </div>
                <div class="q-mt-lg row justify-center">
                    <div class="col-xl-8 col-lg-9 col-md-10 col-sm-12 col-xs-12 row q-mt-md">
                        <div class="col-12 q-px-xs">
                            <q-input v-model="contact.name" outlined color="green-7" label="نام شما" :error="this.MixinValidationCheck(errors,'name')">
                                <template v-slot:error>
                                    <Error_Validation :errors="this.MixinValidation(errors,'name')"></Error_Validation>
                                </template>
                            </q-input>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 q-px-xs">
                            <q-input v-model="contact.phone" outlined color="green-7" label="شماره موبایل" :error="this.MixinValidationCheck(errors,'phone')">
                                <template v-slot:error>
                                    <Error_Validation :errors="this.MixinValidation(errors,'phone')"></Error_Validation>
                                </template>
                            </q-input>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12  q-px-xs">
                            <q-input v-model="contact.email" outlined color="green-7" label="ایمیل (اختیاری)" :error="this.MixinValidationCheck(errors,'email')">
                                <template v-slot:error>
                                    <Error_Validation :errors="this.MixinValidation(errors,'email')"></Error_Validation>
                                </template>
                            </q-input>
                        </div>
                        <div class="col-12 q-px-xs">
                            <q-input v-model="contact.message" type="textarea" outlined color="green-7" label="پیام شما" :error="this.MixinValidationCheck(errors,'message')">
                                <template v-slot:error>
                                    <Error_Validation :errors="this.MixinValidation(errors,'message')"></Error_Validation>
                                </template>
                            </q-input>
                        </div>
                        <div class="col-12 q-px-xs text-center q-mt-md">
                            <q-btn class="form-btn" color="positive" glossy icon="fas fa-message q-mr-sm">
                                ارسال پیام به کشاورز
                            </q-btn>
                        </div>

                        </div>



                </div>
            </div>

        </div>
    </div>


</template>

<style scoped>
    .title{
        font-size: 22px;
    }
    .google-map-box {
        position: relative;
        display: block;

    }
    .google-map__one {
        position: relative;
        display: block;
        border: none;
        height: 440px;
        width: 100%;
        border-radius:10px;
        /*mix-blend-mode: luminosity;*/
    }
    .contact-title{
        font-size: 18px;
    }
    .contact-info{
        font-size: 19px;
    }
    .contact-add{
        font-size: 17px;
    }
    .form-title{
        font-size: 20px;
        font-weight: 600;
    }
    .form-info{
        font-size: 17px;
    }
    .form-btn{
        font-size: 16px;
    }

@media only screen and (max-width: 600px) {
    .title{
        font-size: 18px;
    }
    .google-map__one {
        height: 300px;

        /*mix-blend-mode: luminosity;*/
    }
    .contact-title{
        font-size: 15px;
    }
    .contact-info{
        font-size: 16px;
    }
    .contact-add{
        font-size: 14px;
    }

    .form-title{
        font-size: 18px;
        font-weight: 600;
    }
    .form-info{
        font-size: 15px;
    }
    .form-btn{
        font-size: 14px;
    }

}
</style>
