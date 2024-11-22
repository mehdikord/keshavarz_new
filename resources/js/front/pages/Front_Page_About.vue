<script>
export default {
    name: "Front_Page_About"
}
</script>

<template>

    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <strong class="text-green-7 title q-ml-sm">
                    داستان شکل گیری ما
                </strong>
                <q-separator class="q-mt-md"/>
            </div>
            <div class="q-mt-md">
                <p class="text-justify text-about">
                    اپلیکیشن کشاورز از سال 1400 توسط جمعی از مهندسان جوان استان گلستان
                    <br>
                    در مرکز رشد دانشگاه گلستان تهیه و تولید شده است

                    تمامی اعضای این گروه از جامعه کشاورزی این استان میباشند و سال ها در حوزه کشاورزی فعالیت کرده اند
                    <br>
                    و با همکاری یکدیگر با هدف حل معظلات و مشکلات کشاورزان و دست اندرکاران حوزه کشاورزی گردهم امده اند تا در تمامی مراحل کاشت ، داشت و برداشت محصول همراه فعالان این حوزه قرار داشته باشند
                </p>
            </div>
            <div class="q-mt-lg text-center">
                <q-img class="ab-image" src="/front/images/about-bg.svg" width="80%"></q-img>
                <div class="q-mt-md">
                    <strong class="">
                        تمامی حقوق این وبسایت متعلق به شرکت مهندسی برق صعنتی و نوآوری الکتریکی کیانمهر میباشد
                    </strong>
                </div>

            </div>
        </div>
    </div>


</template>

<style scoped>
    .title{
        font-size: 22px;
    }
    .text-about{
        font-size: 16px;
    }
    .ab-image{
        width: 75%;
    }

@media only screen and (max-width: 600px) {
    .title{
        font-size: 18px;
    }
    .text-about{
        font-size: 14px;
    }
    .ab-image{
        width: 100%;
    }
}
</style>
