<script>
export default {
    name: "Manage_Lands_Item",
    props:['land'],

}
</script>

<template>

    <q-card>
        <q-card-section dir="rtl">
            <span>
                <Global_Show_Image :image="land.image"></Global_Show_Image>
                <strong class="q-ml-sm">{{land.title}}</strong>
            </span>
            <strong class="q-ml-sm qmr-sm text-grey-5">
                /
            </strong>

            <strong class="text-indigo">
                {{this.$filters.numbers(land.area)}}
            </strong>
            <span class="q-ml-xs">متر</span>


        </q-card-section>
    </q-card>
</template>

<style scoped>

</style>
