<script>
export default {
    name: "Front_Plans_Item",
    props:['item']
}
</script>

<template>
    <q-card class="bg-teal-9 text-white shadow-8 cursor-pointer">
        <q-card-section class="q-pa-sm">
            <div class="row">
                <div class="col-2">
                    <q-icon name="fas fa-medal fa-3x"></q-icon>
                </div>
                <div class="col-10 q-pt-md">
                    <span class="title">{{item.title}}</span>
                    <div class="">
                        <strong class="access">{{item.access}}</strong>
                        <span class="access-text">ماه دسترسی نامحدود</span>
                    </div>
                    <div class="q-mt-sm">
                        <span class="price-title">قیمت : </span>
                        <template v-if="item.is_free">
                            <span class="float-right price text-yellow-7 fa-beat">رایگان</span>
                        </template>
                        <template v-else>
                            <template v-if="item.sale">
                                <span class="price-unit float-right">تومان</span>
                                <span class="float-right price text-yellow-7">{{this.$filters.numbers(item.sale)}}</span>
                                <span class="float-right price-sale">{{this.$filters.numbers(item.price)}}</span>
                            </template>
                            <template v-else>
                                <span class="price-unit float-right">تومان</span>
                                <span class="float-right price text-yellow-7">{{this.$filters.numbers(item.price)}}</span>

                            </template>
                        </template>


                    </div>

                </div>
            </div>
        </q-card-section>
    </q-card>
</template>

<style scoped>
.title{
    font-size: 15px;
    font-weight: 450;
}
.access{
    font-size: 20px;
    font-weight: 700;
}
.access-text{
    padding-left: 4px;
    font-weight: 500;
}
.price-title{
    font-size: 14px;
    color: rgba(243, 239, 239, 0.99);
}
.price{
    font-size: 18px;
    font-weight: 700;
}
.price-unit {
    margin-left: 5px;
    font-size: 13px;
}
.price-sale{
    margin-right: 5px;
    font-size: 17px;
    padding-top: 1px;
    font-weight: 700;
    text-decoration: line-through;
    text-decoration-color: black;
}
</style>
