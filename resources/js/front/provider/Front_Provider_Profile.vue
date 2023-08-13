<script>
export default {
    name: "Front_Provider_Profile"
}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <q-img class="search-img" src="/front/images/provider.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    کاربر خدمات دهنده
                </strong>
                <p class="text-justify q-mt-md">
                    در این صفحه میتوانید اطلاعات کاربری و همه خدمات قابل ارائه توسط این کاربر را مشاهده کنید
                    و همچنین برای اطلاعات بیشتر تصاویر ادوات کاربر را از بخش گالری مشاهده نمایید
                </p>
            </div>
            <div class="q-mt-xl">
                <q-card flat class="bg-green-1">
                    <q-card-section>
                        <div class="row">
                            <div class="col-lg-2 col-md-2">
                                <q-img src="/front/images/farmer.png" class="profile-image"/>
                            </div>
                            <div class="col-lg-10 col-md-10">
                                <div class="info-box">
                                    <span class="info-title text-red">نام : </span>
                                    <span class="info-text text-dark">مهدی کرد </span>
                                </div>
                                <div class="info-box">
                                    <span class="info-title text-red">شماره تماس : </span>
                                    <span class="info-text text-dark">09117926950 </span>
                                </div>
                                <div class="info-box">
                                    <span class="info-title text-red">درباره کاربر : </span>
                                    <p class="text-justify">
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی
                                    </p>
                                </div>
                            </div>
                        </div>
                    </q-card-section>
                </q-card>
                <q-card flat class="bg-grey-1 q-mt-md">
                    <q-card-section>
                        <strong class="text-indigo">خدمات قابل ارائه توسط مهدی کرد</strong>
                        <q-separator class="q-mt-md"/>
                    </q-card-section>
                </q-card>
            </div>
        </div>
    </div>
</template>

<style scoped>
.title{
    font-size: 18px;
}
.search-img{
    width: 80px;
}
.profile-image{
    width: 120px;
    height: 120px;
    border-radius: 50%;
}
.info-box{
    margin-bottom: 10px;
}
.info-title{
    font-size: 13px;
    font-weight: 500;
}
.info-text{
    font-size:14px ;
    font-weight: 500;
}




@media only screen and (max-width: 600px) {

    .title{
        font-size: 15px;
    }
    .search-img{
        width: 45px;
    }
}



</style>
