<script>
export default {
    name: "Front_Skeleton_News"
}
</script>

<template>

    <q-card >
        <q-card-section class="q-pa-sm">
           <div class="row">
               <div class="col-2">
                   <q-skeleton type="circle" />
               </div>
               <div class="col-10">
                   <q-skeleton class="q-mt-md" />
                   <q-skeleton v-for="i in 3" type="text" class="q-mt-sm" />
               </div>
           </div>

        </q-card-section>
    </q-card>

</template>

<style scoped>
.image{
    height: 160px;
    width: 100%;
}

</style>
