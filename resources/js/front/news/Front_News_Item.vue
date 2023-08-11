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
                <div class="col-lg-2 q-pa-sm">
                    <q-img :src="item.image" class="image"/>
                </div>
                <div class="col-lg-10">
                    <div class="q-pa-sm">
                        <span class="title">{{item.title}}</span>
                        <p class="q-mt-sm text-justify">
                            {{item.description}}
                        </p>
                        <div class="q-mt-md">
                            <span class="float-right">
                                 <q-icon name="fas fa-newspaper" class="text-green-7"/>
                                <span class="link-text text-green-7 q-ml-sm">مشاهده منبع خبر</span>
                            </span>


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

</style>
