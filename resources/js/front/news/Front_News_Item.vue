<script>
export default {
    name: "Front_News_Item",
    props:['item'],

}
</script>


<template>
    <q-card flat>
        <q-card-section class="q-pa-xs">
            <div class="row">
                <div class="col-lg-2 col-sm-2 col-xs-2 q-pa-sm mobile-padding">
                    <q-img v-if="item.image" :src="item.image" class="image"/>
                    <q-img v-else src="/front/images/news.jpg" class="image" />
                </div>
                <div class="col-lg-10 col-sm-10 col-xs-10">
                    <div class="q-pa-sm">
                        <span class="title">{{item.title}}</span>
                        <p class="q-mt-sm text-justify description">
                            {{item.description}}
                        </p>
                        <div class="q-mt-md">
                            <a :href="item.link" target="_blank" class="float-right">
                                 <q-icon name="fas fa-newspaper" class="text-green-7"/>
                                <span class="link-text text-green-7 q-ml-sm">مشاهده منبع خبر</span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </q-card-section>
    </q-card>
</template>

<style scoped>
.image{
    height: 120px;
    width: 100%;
}
.title{
    font-size: 16px;
    font-weight: 550;
}

@media only screen and (max-width: 600px) {
    .image{
        height: 70px;
        width: 100%;
    }
    .title{
        font-size: 13px;
        font-weight: 450;
    }
    .mobile-padding{
        padding: 0 0 !important;
    }
    .description{
        font-size: 12px;
    }

    .link-text{
        font-size: 13px;
    }


}

</style>
