<script>
import Front_Skeleton_News from "../skeleton/Front_Skeleton_News.vue";
import Front_News_Item from "../news/Front_News_Item.vue";
import Front_Index_Weather from "./Front_Index_Weather.vue";

export default {
    name: "Front_index",
    created() {
      this.GetNews();
      this.GetSlider();
      this.listenForChanges();
    },
    components : {
        'skeleton_news' : Front_Skeleton_News,
        'news_item' : Front_News_Item,
        'index_weather' : Front_Index_Weather,
    },
    data(){
        return{
            slide:1,
            news:[],
            slider:[],
            news_loading:true,
            slider_loading:true,
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
        },
        GetSlider(){
            axios.get('public/slider').then(res => {
                this.slider = res.data.result;
                this.slider_loading=false;
            }).catch(error => {
                this.slider_loading=false;
                return this.NotifyServerError();
            })
        },

        listenForChanges() {

            Echo.channel('news-channel')
                .listen('my-eventv', post => {
                    if (! ('Notification' in window)) {
                        alert('Web Notification is not supported');
                        return;
                    }
                    Notification.requestPermission( permission => {
                        let notification = new Notification('Awesome Website', {
                            body: post,
                            // optional image url
                        });
                        // link to page on clicking the notification
                        notification.onclick = () => {
                            window.open(window.location.href);
                        };
                    });
                })
        }


    }
}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">


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
                        <router-link :to="{name:'implements_request'}">
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
                <div class="q-mt-lg q-mb-lg news-title font-iransans text-green-8 text-center">
                    آخرین اخبار حوزه کشاورزی
                </div>
                <q-separator class="q-mt-sm q-mb-sm"/>
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
                <div class="text-center news-all">
                    <q-btn :to="{name : 'news'}" color="green-8 q-pa-sm q-px-md news-all" glossy>مشاهده همه خبر ها </q-btn>
                </div>
            </div>
            <div class="col-12">
                <q-separator/>
            </div>
            <div class="col-lg-12 q-mt-lg q-px-sm mobile-padding">
                <div class="font-iransans text-green-8">
                    <strong class="font-16">مجوز های کشاورز</strong>
                </div>
                <div class="q-mt-lg">
                    <div class="row justify-center">
                        <div class="col-md-3">
                            <a referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/u?id=392965&code=aaNhobh3KdXmTZ9y8UNknp9dZGZ8t5Fo'><img referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=392965&code=aaNhobh3KdXmTZ9y8UNknp9dZGZ8t5Fo' alt='' style='cursor:pointer' code='aaNhobh3KdXmTZ9y8UNknp9dZGZ8t5Fo'></a>
                        </div>
                        <div class="col-md-3">
                            <img referrerpolicy='origin' id = 'rgvjfukznbqejxlzjxlzjzpe' style = 'cursor:pointer' onclick = 'window.open("https://logo.samandehi.ir/Verify.aspx?id=362117&p=xlaogvkauiwkrfthrfthjyoe", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' alt = 'logo-samandehi' src = 'https://logo.samandehi.ir/logo.aspx?id=362117&p=qftiwlbqodrfnbpdnbpdyndt' />
                        </div>
                    </div>
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
    margin-top: 18px;
    margin-bottom: 30px;
    font-size: 16px;
    font-weight: 500;
}

@media only screen and (max-width: 600px) {

    .for-slider{
        margin-top: 10px;
        height: 200px;
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
    .item-box{
        padding-top: 35px;
        padding-bottom: 35px;
    }
    .item-box-text{
        font-size: 14px;
        font-weight: 600;
    }
    .news-all{
        margin-top: 15px;
        margin-bottom: 25px;
        font-size: 18px;
        font-weight: 600;
    }

}
</style>
