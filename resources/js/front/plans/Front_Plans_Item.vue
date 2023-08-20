<script>
export default {
    name: "Front_Plans_Item",
    props:['item']
}
</script>

<template>
    <q-card class="bg-indigo-5 text-white">
        <q-card-section class="q-pa-sm">
            <div class="row">
                <div class="col-2">
                    <q-icon name="fas fa-medal fa-3x"></q-icon>
                </div>
                <div class="col-10 q-pt-md">
                    <span class="title">{{item.name}}</span>
                    <div class="">
                        <strong class="access">{{item.access}}</strong>
                        <span class="access-text">ماه دسترسی نامحدود</span>
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
    font-size: 25px;
    font-weight: 700;
}
.access-text{
    padding-left: 4px;
    font-weight: 500;
}
</style>
