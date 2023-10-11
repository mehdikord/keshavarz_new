<script>
import NeshanMap from "@neshan-maps-platform/vue3-openlayers";

export default {
    name: "Front_Profile_Provider_Range",
    components: {NeshanMap}
}
</script>

<template>

    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12">
            <div>
                <q-img class="search-img" src="/front/images/map.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    موقعیت مکانی و محدوده فعالیت
                </strong>
                <p class="text-justify q-mt-sm subtitle text-grey-8">
                    محدوده ای است که اگر کشاورزی در این محدوده ( درفاصله کمتر از 40 کیلیومتری شما) درخواست خدمات کند ، سیستم کشاورز شما را به عنوان ارائه دهنده خدمات انتخاب خواهد کرد
                </p>
            </div>
            <div class="text-right">
                <q-btn color="red" size="sm" class="font-12" icon-right="fas fa-arrow-left q-ml-xs" glossy >بازگشت</q-btn>
            </div>
            <q-separator class="q-mt-sm" />
        </div>
    </div>





</template>

<style scoped>
.title{
    font-size: 17px;
}
.subtitle{
    font-size: 15px;
}
.search-img{
    width: 80px;
}

@media only screen and (max-width: 600px) {
    .title {
        font-size: 14px;
    }
    .subtitle {
        font-size: 13px;
    }
    .search-img {
        width: 70px;
    }
}

</style>
