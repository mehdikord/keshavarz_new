<script>
export default {
    name: "Front_Plans_Reserved_Item",
    props:['item']
}
</script>

<template>
<q-card>
    <q-card-section class="bg-teal-9">
        <div class="title text-white">
            {{item.title}}
        </div>
        <div class="q-mt-xs">
            <span class="access-title text-grey-4">مدت اشتراک : </span> <strong class=" text-yellow-6 access-info">{{item.access}}  ماه</strong>
        </div>
        <div class="q-mt-xs">
            <span class="access-title text-grey-4">تاریخ خرید : </span> <strong class=" text-yellow-6 date">{{this.$filters.date(item.created_at)}}</strong>
        </div>

    </q-card-section>
</q-card>
</template>

<style scoped>
.title{
    font-size: 15px;
    font-weight: 500;
}
.access-title{
    font-size: 13px;
    font-weight: 500;
}
.access-info{
    font-size: 16px;
    font-weight: 550;
}
.date{
    font-size: 13px;
    font-weight: 500;
}
</style>
