<script>
import news_item from "./Front_News_Item.vue";
import skeleton_news from "../skeleton/Front_Skeleton_News.vue";

export default {
    name: "Front_News",
    mounted() {
      this.GetNews();
    },
    data(){
        return{
            news_loading :false,
            news:[],

        }
    },
    methods :{
        GetNews(){
            this.news_loading=true;
            axios.get('public/news').then(res => {
                this.news = res.data.result;
                this.news_loading=false;
            }).catch(error => {
                this.news_loading=false;
                return this.NotifyServerError();
            })
        }
    },
    components: {skeleton_news, news_item}
}
</script>

<template>

    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12 ">
            <div class="q-mt-md">
                <q-img class="search-img" src="/front/images/loudspeaker.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    آخرین اخبار حوزه کشاورزی
                </strong>
                <p class="text-justify q-mt-md">
                    کشاورز عزیز ، شما میتوانید ادوات و خدمات مورد نیاز خود را به سادگی جستجو و دریافت کنید .
                    <br>
                    کافیست اطلاعت مورد نیاز را به دقت وارد کرده و دکمه جستجو را بزنید و در وقت خود صرفه جویی کنید !
                </p>
            </div>
            <div class="q-mt-xl">
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
</style>
