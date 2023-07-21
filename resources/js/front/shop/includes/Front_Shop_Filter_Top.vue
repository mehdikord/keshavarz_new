
<template>
    <div>
        <strong class="font-16">مرتب سازی : </strong>
        <div class="row mt-1">
            <div class="col">
                <q-chip class="font-13 bg-grey-4 pointer" size="md">جدید‌‌ترین</q-chip>
            </div>
            <div class="col">
                <q-chip class="font-14 bg-green-6 text-white pointer" size="md">گران‌ترین</q-chip>
            </div>
            <div class="col">
                <q-chip class="font-13 bg-grey-4 pointer" size="md">ارزان‌ترین</q-chip>
            </div>
            <div class="col">
                <q-chip class="font-13 bg-grey-4 pointer" size="md">پرفروش‌ترین</q-chip>
            </div>
            <div class="col">
                <q-chip class="font-13 bg-grey-4 pointer" size="md">پرفروش‌ترین</q-chip>
            </div>
        </div>
        <hr class="w-100">
    </div>
</template>

<style scoped>

.pointer{
    cursor: pointer;
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Shop_Filter_Top"
})
</script>
