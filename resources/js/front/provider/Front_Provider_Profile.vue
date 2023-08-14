<script>
export default {
    name: "Front_Provider_Profile",
    data(){
        return {
            ImageDialog:[],

        }
    }
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
                <div class="text-right q-mb-sm">
                    <q-btn :to="{name : 'search'}" color="red" icon-right="fas fa-arrow-left" class="back-btn">بازگشت</q-btn>
                </div>
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
                                    <p class="text-justify bio">
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی
                                    </p>
                                </div>
                            </div>
                        </div>
                    </q-card-section>
                </q-card>
                <q-card flat class="bg-grey-1 q-mt-md">
                    <q-card-section>
                        <strong class="text-indigo pro-head">خدمات قابل ارائه توسط مهدی کرد</strong>
                        <q-separator class="q-mt-md"/>
                        <div class="row q-mt-lg justify-center" >
                            <div v-for="i in 6" class="col-xl-4 col-lg-4 col-sm-12 col-xs-12">
                                <div class="extra-padding">
                                    <q-expansion-item
                                        class="shadow-6 overflow-hidden"
                                        style="border-radius: 20px"
                                        header-class="bg-green-7 text-white"
                                        expand-icon-class="text-white"
                                    >
                                        <template v-slot:header>
                                            <div  class="pro-box">
                                                <span class="pro-title">بزرکار گندم :</span>
                                                <span class="pro-price">
                                                    350,000
                                                    <span class="pro-currency">تومان</span>
                                                    /
                                                    <span class="pro-price-type">در هکتار</span>
                                                </span>
                                            </div>
                                        </template>
                                        <q-card>
                                            <q-card-section>
                                                <div class="form-box" v-for="i in 4">
                                                    <span class="form-title text-red">سال ساخت : </span>
                                                    <span class="form-text "> 1395 </span>
                                                    <q-separator class="q-mt-sm"/>
                                                </div>
                                            </q-card-section>
                                        </q-card>
                                    </q-expansion-item>

                                </div>
                            </div>
                        </div>
                    </q-card-section>
                </q-card>
                <q-card flat class="bg-green-1 q-mt-lg q-mb-xl">
                    <q-card-section>
                        <strong class="text-indigo pro-head">گالری تصاویر</strong>
                        <q-separator class="q-mt-md"/>
                        <div class="row q-mt-lg justify-center">
                            <div v-for="i in 8" class="col-xl-2 col-lg-2 col-sm-4 col-xs-4 q-mb-md text-center">
                                <q-img @click="ImageDialog[i] = true" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Harrier_Hound_-Pedigree_Harrier.jpg/1200px-Harrier_Hound_-Pedigree_Harrier.jpg" class="rounded-borders gallery-image"/>
                                <q-dialog
                                    v-model="ImageDialog[i]"
                                >
                                    <q-card class="image-dialog">
                                        <q-card-section class="q-pt-none">
                                            <q-img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Harrier_Hound_-Pedigree_Harrier.jpg/1200px-Harrier_Hound_-Pedigree_Harrier.jpg"/>

                                        </q-card-section>
                                        <q-card-actions align="right" class="bg-white text-red">
                                            <q-btn flat label="بستن" v-close-popup />
                                        </q-card-actions>
                                    </q-card>
                                </q-dialog>

                            </div>
                        </div>
                    </q-card-section>
                </q-card>
            </div>
        </div>
    </div>
</template>

<style scoped>
.extra-padding{
    padding: 8px 10px ;
}
.pro-box{
 width: 100%;
    padding: 6px 0;
}
.form-box{
    padding: 10px 0;
}
.gallery-image{
    width: 150px;
    height: 150px;
    cursor: zoom-in;
}
.image-dialog{
    width: 800px;
}
.form-title{
    font-size: 15px;
    font-weight: 600;
}
.form-text{
    font-size: 15px;
    margin-left: 5px;
}
.pro-price-type{
    font-size: 13px;
}
.pro-title{
    font-size: 15px;
    font-weight: 600;
}
.pro-currency{
    font-size: 13px;
}
.pro-price{
    font-size: 17px;
    font-weight: 600;
    margin-left: 5px;
}
.pro-head{
    font-size: 17px;
}
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

    .extra-padding{
        padding: 5px 0 ;
    }
    .title{
        font-size: 15px;
    }
    .search-img{
        width: 45px;
    }

    .pro-box{
        width: 100%;
        padding: 6px 0;
    }
    .form-box{
        padding: 6px 0;
    }
    .gallery-image{
        width: 100px;
        height: 100px;
        cursor: zoom-in;
    }
    .image-dialog{
        width: 100%;
    }
    .form-title{
        font-size: 14px;
        font-weight: 600;
    }
    .form-text{
        font-size: 13px;
        margin-left: 5px;
    }
    .pro-price-type{
        font-size: 12px;
    }
    .pro-title{
        font-size: 13px;
        font-weight: 600;
    }
    .pro-currency{
        font-size: 11px;
    }
    .pro-price{
        font-size: 14px;
        font-weight: 600;
        margin-left: 2px;
    }
    .pro-head{
        font-size: 14px;
    }
    .title{
        font-size: 18px;
    }
    .search-img{
        width: 80px;
    }
    .profile-image{
        width: 70px;
        height: 70px;
        border-radius: 50%;
       margin-bottom: 15px;
    }
    .info-box{
        margin-bottom: 10px;
    }
    .info-title{
        font-size: 12px;
        font-weight: 500;
    }
    .info-text{
        font-size:13px ;
        font-weight: 500;
    }
    .bio{
        font-size: 13px;
    }
    .back-btn{
        font-size: 12px;
    }


}



</style>
