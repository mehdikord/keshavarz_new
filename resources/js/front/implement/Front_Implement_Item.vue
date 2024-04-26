<script>
export default {
    name: "Front_Implement_Item",
    props:['item']
}
</script>

<template >
    <div class="q-pa-sm">
        <q-card class="shadow-5 row">
            <div class="col-md-3 col-sm-3 col-xs-3 q-py-sm q-pa-sm">
                <q-img class="" :src="item.image">

                </q-img>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="q-mt-md">
                    <strong class="implement-name q-ml-md">{{item.name}}</strong>
                </div>

            </div>
        </q-card>

    </div>
</template>

<style scoped>

.img-size{
    height: 95px;
}
.implement-name{
    font-size: 16px;
}
@media only screen and (max-width: 600px) {

    .img-size{
        height: 75px;
    }
    .implement-name{
        font-size: 13px;
    }
}
</style>
