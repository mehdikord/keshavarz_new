<script>
export default {
    name: "Front_Skeleton_News"
}
</script>

<template>

    <q-card flat>
        <q-card-section class="q-pa-xs">
            <div class="row">
                <div class="col-lg-2 q-pa-sm">
                    <q-skeleton class="image" square />
                </div>
                <div class="col-lg-10">
                    <div class="q-pa-sm">
                        <q-skeleton type="rect" />
                        <p class="q-mt-sm">
                            <q-skeleton v-for="i in 6" type="text" />
                        </p>
                    </div>
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
