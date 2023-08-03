
<template>

        <q-img
            v-if="image"
            :src="image"
            loading="lazy"
            spinner-color="green-8"
            class="image rounded"
            @click="show = true"
        />
        <q-img
            v-else
            src="/assets/images/icons/no-photo.png"
            loading="lazy"
            spinner-color="green-8"
            class="image rounded"
        />
    <q-dialog
    v-model="show"

    >
    <q-card class="show-image">
        <q-card-section >
            <q-img
                :src="image"
                loading="lazy"
                spinner-color="green-8"
                class="show-img"
            />
        </q-card-section>

        <q-card-actions align="right" class="bg-white ">
            <q-btn color="red" label="بستن" size="md" v-close-popup />
        </q-card-actions>
    </q-card>
    </q-dialog>



</template>

<style scoped>
.image{
    width: 55px!important;
    height: 55px!important;
    border-radius: 7px;
    cursor: zoom-in;
}
.show-image{
    width: 800px;
}
.show-img{
    width: 100% !important;
}
</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Manage_Global_Show_Image",

    data(){
      return {
          show : false,
      }
    },
    props :['image']
})
</script>
