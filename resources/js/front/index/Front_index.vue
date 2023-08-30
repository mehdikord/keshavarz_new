<script>
import Front_Skeleton_News from "../skeleton/Front_Skeleton_News.vue";
import Front_News_Item from "../news/Front_News_Item.vue";

export default {
    name: "Front_index",
    created() {
      this.GetNews();
    },
    components : {
        'skeleton_news' : Front_Skeleton_News,
        'news_item' : Front_News_Item
    },
    data(){
        return{
            slide:1,
            news:[],
            news_loading:false,
        }
    },
    methods : {
        GetNews(){
            this.news_loading=true;
            axios.get('public/news/latest').then(res => {
                this.news = res.data.result;
                this.news_loading=false;
            }).catch(error => {
                this.news_loading=false;
                return this.NotifyServerError();
            })
        }
    }
}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="row items-center">
                <div class="col-md-12 col-sm-12 col-xs-12 q-px-sm mobile-padding">
                  <q-carousel
                      class="for-slider rounded-borders"
                      animated
                      v-model="slide"
                      navigation
                      infinite
                      :autoplay="true"
                      arrows
                      transition-prev="slide-right"
                      transition-next="slide-left"
                  >
                      <q-carousel-slide :name="1" img-src="https://www.pixelstalk.net/wp-content/uploads/images1/Windmill-farm-wallpaper-hd.jpg" />
                      <q-carousel-slide :name="2" img-src="https://www.pixelstalk.net/wp-content/uploads/images1/Farm-landscape-hd-wallpapers.jpg" />
                      <q-carousel-slide :name="3" img-src="https://www.pixelstalk.net/wp-content/uploads/images1/Images-Farm-Free-download.jpg" />
                      <q-carousel-slide :name="4" img-src="https://www.pixelstalk.net/wp-content/uploads/images1/Best-Farm-Images.jpg" />
                  </q-carousel>
              </div>
            </div>
            <div class="col-lg-12 q-mt-md q-px-sm row mobile-padding">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6 q-px-xs q-mb-sm">
                    <router-link :to="{name:'search'}">
                        <q-card class=" cursor-pointer">
                            <q-card-section class="item-box bg-green-6">
                                <div class="text-center item-box-text font-iransans text-white">
                                    دریافت خدمات کشاورزی
                                </div>
                            </q-card-section>
                        </q-card>
                    </router-link>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6 q-px-xs q-mb-sm">
                    <q-card class=" cursor-pointer">
                        <router-link :to="{name:'profile_provider'}">
                            <q-card-section class="item-box bg-deep-orange-6">
                            <div class="text-center item-box-text font-iransans text-white">
                                ارائه خدمات کشاورزی
                            </div>
                        </q-card-section>
                        </router-link>
                    </q-card>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6 q-px-xs q-mb-sm">
                    <q-card class=" cursor-pointer">
                        <router-link :to="{name:'profile_provider'}">
                            <q-card-section class="item-box bg-blue-7">
                            <div class="text-center item-box-text font-iransans text-white">
                                درخواست ثبت ادوات
                            </div>
                        </q-card-section>
                        </router-link>
                    </q-card>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6 q-px-xs q-mb-sm">
                    <q-card class=" cursor-pointer">
                        <router-link :to="{name:'plans'}">
                            <q-card-section class="item-box bg-yellow-9">
                            <div class="text-center item-box-text font-iransans text-white">
                                خرید و لیست اشتراک ها
                            </div>
                        </q-card-section>
                        </router-link>
                    </q-card>
                </div>

            </div>
            <div class="col-lg-12 q-mt-xl q-px-sm mobile-padding">
                <div class="q-mt-lg q-mb-lg news-title font-iransans text-green-8">
                    آخرین اخبار حوزه کشاورزی
                </div>
                <div class="row">
                    <template v-if="news_loading">
                        <template v-for="i in 3">
                            <div class="col-12">
                                <skeleton_news></skeleton_news>
                            </div>
                            <div class="col-12 q-mt-xs q-mb-xs">
                                <q-separator/>
                            </div>
                        </template>
                    </template>
                    <template v-else v-for="item in news">
                        <div class="col-12">
                            <news_item :item="item"></news_item>
                        </div>
                        <div class="col-12 q-mt-xs q-mb-xs">
                            <q-separator/>
                        </div>
                    </template>
                </div>
                <div class="text-center news-all ">
                    <router-link class="text-red-6" :to="{name : 'news'}">
                        مشاهده همه خبر ها
                    </router-link>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>
.for-slider{

    height: 465px;
}
.news-title{
    font-size: 22px;
    font-weight: 600;
}
.item-box{
    padding-top: 38px;
    padding-bottom: 38px;
}
.item-box-text{
    font-size: 20px;
    font-weight: 600;
}
.news-all{
    margin-top: 30px;
    margin-bottom: 30px;
    font-size: 20px;
    font-weight: 600;
}

@media only screen and (max-width: 600px) {

    .for-slider{
        margin-top: 10px;
        height: 200px;
    }
    .news-title{
        font-size: 18px;
        font-weight: 600;
    }
    .mobile-padding{
        padding: 0 0 !important;
    }
    .news-btn{
        font-size: 12px;
    }
    .item-box{
        padding-top: 35px;
        padding-bottom: 35px;
    }
    .item-box-text{
        font-size: 14px;
        font-weight: 600;
    }
    .news-all{
        margin-top: 20px;
        margin-bottom: 25px;
        font-size: 18px;
        font-weight: 600;
    }

}
</style>
