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
          <div class="row q-mt-sm items-center">
              <div class="col-md-4 col-sm-12 col-xs-12 q-px-sm mobile-padding">
                  <q-card>
                      <q-img class="shadow-8" src="https://www.agrivi.com/wp-content/uploads/2021/05/Best-Farm-Practices-for-Profitable-Farming-1200x565.jpeg">
                          <div class="absolute-bottom text-center text-box">
                              <strong class="banner-title">
                                  دریافت خدمات کشاورزی
                              </strong>
                          </div>
                      </q-img>
                  </q-card>
                  <q-card class="q-mt-md">
                      <q-img class="shadow-8" src="https://www.hashmicro.com/blog/wp-content/uploads/2022/09/Gautam-Adani-IRMA-Speech.jpg">
                          <div class="absolute-bottom text-center text-box">
                              <strong class="banner-title">
                                  ارائه خدمات کشاورزی
                              </strong>
                          </div>
                      </q-img>
                  </q-card>
              </div>
              <div class="col-md-8 col-sm-12 col-xs-12 q-px-sm mobile-padding">
                  <q-carousel
                      class="for-slider shadow-8 rounded-borders"
                      animated
                      v-model="slide"
                      navigation
                      infinite
                      :autoplay="true"
                      arrows
                      transition-prev="slide-right"
                      transition-next="slide-left"

                  >
                      <q-carousel-slide :name="1" img-src="https://cdn.quasar.dev/img/mountains.jpg" />
                      <q-carousel-slide :name="2" img-src="https://cdn.quasar.dev/img/parallax1.jpg" />
                      <q-carousel-slide :name="3" img-src="https://cdn.quasar.dev/img/parallax2.jpg" />
                      <q-carousel-slide :name="4" img-src="https://cdn.quasar.dev/img/quasar.jpg" />
                  </q-carousel>
              </div>
          </div>
            <div class="col-lg-12 q-mt-lg q-px-sm mobile-padding">
                <q-card class="">
                    <q-card-section class="bg-green-7">
                        <span class="news-title text-white">
                            آخرین اخبار حوزه کشاورزی
                        </span>
                        <q-btn :to="{name:'news'}" class="float-right news-btn" color="yellow-9" text-color="black">مشاهده همه خبرها</q-btn>
                    </q-card-section>
                    <q-card-section>
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
                    </q-card-section>

                </q-card>
            </div>
        </div>
    </div>
</template>

<style scoped>
.text-box{
    background-color: rgba(0,0,0,0.75);
}
.banner-title{
    font-size: 16px;
}
.for-slider{

    height: 465px;
}
.title{
    font-size: 24px;
}
.subtitle{
    margin-top: 13px;
    font-size: 16px;
}
.news-title{
    font-size: 18px;
    font-weight: 500;
}

@media only screen and (max-width: 600px) {
    .banner-title{
        font-size: 14px;
    }
    .for-slider{
        margin-top: 10px;
        height: 200px;
    }
    .title{
        font-size: 24px;
    }
    .subtitle{
        margin-top: 13px;
        font-size: 16px;
    }
    .news-title{

        font-size: 14px;
        font-weight: 500;
    }
    .mobile-padding{
        padding: 0 0 !important;
    }
    .news-btn{
        font-size: 12px;
    }

}
</style>
