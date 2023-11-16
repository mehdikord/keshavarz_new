<script>
import {mapActions} from "vuex";

export default {
    name: "Front_Search_Requests_Working",
    props:['request'],
    data(){
        return {
            cancel_loading:false,
        }

    },
    methods:{
        ...mapActions([
            "SearchProviderRequestCancel"

        ]),
        CancelCustomerRequest(item){
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا مطمئن هستید این درخواست لغو گردد ؟',
                ok: {
                    push: true,
                    color:'green-9',
                    title:'بله'

                },
                cancel: {
                    push: true,
                    color: 'negative'
                },
                persistent: true
            }).onOk(() => {

                this.cancel_loading=true;
                this.SearchProviderRequestCancel(item).then(res => {
                    this.$emit('CancelRequest',item);
                    this.cancel_loading=false;
                }).catch(error => {
                    this.cancel_loading=false;
                    if (error.response.status === 409) {
                        this.NotifyError(error.response.data.error);
                    }
                })

            }).onCancel(() => {
                // console.log('>>>> Cancel')
            }).onDismiss(() => {
                // console.log('I am triggered on both OK and Cancel')
            })


        }
    }



}
</script>

<template>
    <q-card square>
        <q-card-section class="q-pb-xs">
            <div>
                <div>
                    <q-img class="rounded-borders land-img" v-if="request.land.image" :src="request.land.image" />
                    <q-img class="rounded-borders land-img" v-else src="/front/images/land-default.png" />
                    <span class="land-title q-ml-sm text-grey-8">
                       {{request.land.title}}
                   </span>
                </div>
                <q-separator class="q-mt-sm q-mb-sm" />

                <div>
                    <q-img class="rounded-borders land-img" v-if="request.implement.image" :src="request.implement.image" />
                    <q-img class="rounded-borders land-img" v-else src="/front/images/implement.png" />
                    <span class="land-title q-ml-sm text-grey-8">
                       {{request.implement.name}}
                   </span>
                </div>
                <q-separator class="q-mt-sm q-mb-sm" />
                <div>
                    <span>
                        <i class="fas fa-cog font-26 fa-spin" ></i>
                    </span>
                    <span class="land-title q-ml-sm text-grey-8">
                       وضعیت درخواست :
                   </span>
                    <strong class="q-ml-sm text-positive">
                        درحال کار
                    </strong>

                </div>
                <q-separator class="q-mt-sm q-mb-sm" />
                <div>
                    <q-img class="rounded-borders land-img" src="/front/images/calendar.png" />
                    <span class="land-title q-ml-sm">
                       <q-chip dense class="land-title" v-for="date in request.dates_decode">
                           {{date}}
                       </q-chip>
                   </span>
                </div>
                <q-separator class="q-mt-sm q-mb-sm" />
                <div>
                    <q-img class="rounded-borders land-img" v-if="request.provider.profile" :src="request.provider.profile" />
                    <q-img class="rounded-borders land-img" v-else src="/front/images/user.png" />
                    <span class="provider-title q-ml-sm">
                       {{request.provider.name}} - <span class="land-title text-teal">{{request.provider.phone}}</span>
                   </span>
                    <q-btn :href="'tel:'+request.provider.phone" icon="fas fa-phone q-mr-xs" dense glossy color="green-6" class="font-13 float-right q-mt-sm" style="padding-right: 10px;padding-left: 10px">تماس</q-btn>
                </div>
                <q-separator class="q-mt-sm q-mb-sm" />
                <div class="text-center">
                    <q-btn @click="CancelCustomerRequest(request.id)" :loading="cancel_loading" class="cancel-btn" color="red" icon="fas fa-times q-mr-xs">لغو این درخواست</q-btn>
                </div>

            </div>
        </q-card-section>
    </q-card>
</template>

<style scoped>
.land-img{
    width: 40px;
    height: 40px;
}
.land-title{
    font-size: 13px;
    font-weight: 500;
}
.provider-title{
    font-size: 14px;
    font-weight: 600;
}
.cancel-btn{
    width: 100%;
    font-size: 13px;
}

@media only screen and (max-width: 600px) {

    .land-img{
        width: 35px;
        height: 35px;
    }
    .land-title{
        font-size: 12px;
        font-weight: 400;
    }
    .provider-title{
        font-size: 13px;
        font-weight: 550;
    }
    .cancel-btn{
        width: 100%;
        font-size: 11px;
    }


}

</style>
