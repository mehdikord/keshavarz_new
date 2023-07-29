
<template>

    <div class="card">
        <div class="card-body">
            <div class="mt-2">
                <div class="main-title text-dark">تاریخچه همه سفارشات</div>
            </div>
            <div class="q-gutter-y-md mt-4">
            <q-tabs
                v-model="tab"
                dense
                indicator-color="red"
                active-color="red"

                align="justify"
            >
                <q-tab name="active" icon="fas fa-clock" label="سفارشات جاری">
                    <q-badge color="yellow-10" floating>2</q-badge>
                </q-tab>
                <q-tab name="done" icon="fas fa-check" label="پایان یافته">
                    <q-badge color="yellow-10" floating>8</q-badge>
                </q-tab>
                <q-tab name="returned" icon="fas fa-hand-point-left" label="مرجوع شده" >
                    <q-badge color="yellow-10" floating>2</q-badge>
                </q-tab>

            </q-tabs>
            </div>
            <div class="mt-3">


            </div>

        </div>
    </div>



</template>

<style scoped>
.main-title{
    font-size: 16px;
    font-weight: 500;
}

</style>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Front_Profile_Orders",
    components:{

    }
    data(){
        return{
            tab:'active'
        }

    }
})
</script>
