<script>
import {mapActions} from "vuex";

export default {
    name: "Front_Profile_Provider_Item",
    props : ['request'],
    data(){
        return {
            accept_loading:false,
            cancel_loading:false,
            cancel_message:null,
        }
    },
    methods:{
        ...mapActions([
            "UserProviderRequestAccept",
            "UserProviderRequestReject"
        ]),
        AcceptRequest(){
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا به پذیرفتن این درخواست اطمینان دارید ؟',
                ok: {
                    push: true,
                    color:'green-9',
                },
                cancel: {
                    push: true,
                    color: 'negative'
                },
                persistent: true
            }).onOk(() => {

                this.accept_loading=true;
                this.UserProviderRequestAccept(this.request.id).then(res => {
                    this.$emit('AcceptRequest');
                    this.accept_loading=false;
                }).catch(error => {
                    this.accept_loading=false;
                    if (error.response.status === 409) {
                        this.NotifyError(error.response.data.error);
                    }
                })

            }).onCancel(() => {
                // console.log('>>>> Cancel')
            }).onDismiss(() => {
                // console.log('I am triggered on both OK and Cancel')
            })


        },
        RejectRequest(){
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا اطمینان دارید این درخواست رد شود ؟',
                ok: {
                    push: true,
                    color:'green-9',
                },
                cancel: {
                    push: true,
                    color: 'negative'
                },
                persistent: true
            }).onOk(() => {

                this.accept_loading=true;
                this.UserProviderRequestReject(this.request.id).then(res => {
                    this.$emit('AcceptRequest');
                    this.accept_loading=false;
                }).catch(error => {
                    this.accept_loading=false;
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
    <q-card>
        <q-card-section class="q-pb-xs">
            <div>
                <q-img class="rounded-borders land-img" v-if="request.user_implement.implement.image" :src="request.user_implement.implement.image" />
                <q-img class="rounded-borders land-img" v-else src="/front/images/implement.png" />
                <span class="implement-title q-ml-sm text-indigo">
                   {{request.user_implement.implement.name}}
               </span>
            </div>
            <q-separator class="q-mt-sm q-mb-sm" />
            <div>
                <q-img class="rounded-borders land-img" src="/front/images/distance.png" />
                <span class="q-ml-sm q-mr-sm">
                    <span class="text-grey-10  implement-title">فاصله : </span>
                    <strong class="text-red font-15">{{request.distance}}</strong>
                    <span class="text-grey-8 q-ml-xs">کیلومتر</span>
                </span>
                <strong>/</strong>
                <span class="q-ml-sm">
                    <span class="text-grey-10  implement-title">مبلغ : </span>
                    <strong class="text-green-8 font-15">{{this.$filters.numbers(request.price)}}</strong>
                    <span class="text-grey-8 q-ml-xs implement-title">تومان</span>
                </span>
            </div>
            <q-separator class="q-mt-sm q-mb-sm" />
            <div>
                <q-img class="rounded-borders land-img" v-if="request.request.user.profile" :src="request.request.user.profile" />
                <q-img class="rounded-borders land-img" v-else src="/front/images/farmer.png" />
                <span class="text-grey-9 q-ml-sm implement-title">
                   {{request.request.user.name}}
               </span>
               <q-btn color="teal-8" glossy dense class="float-right font-13 q-mt-sm" icon="fas fa-mobile-retro q-mr-sm">
                   <a :href="'tel:'+request.request.user.phone" class="text-white">
                       {{request.request.user.phone}}
                   </a>
               </q-btn>
            </div>
            <q-separator class="q-mt-sm q-mb-sm" />
            <div class="text-center q-mt-md row">
                <div class="col-6 q-pr-xs">
                    <q-btn class="for-btn" @click="AcceptRequest" :loading="accept_loading" color="green-7" icon-right="fas fa-check q-ml-xs" glossy dense style="width: 100%">پذیرفتن درخواست</q-btn>

                </div>
                <div class="col-6 q-pl-xs">
                    <q-btn class="for-btn" color="red-6" icon-right="fas fa-times q-ml-xs" glossy dense style="width: 100%">رد درخواست</q-btn>

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
.implement-title{
    font-size: 14px;
    font-weight: 500;
}
.for-btn{
    font-size: 13px;
}

@media only screen and (max-width: 600px) {

    .land-img{
        width: 35px;
        height: 35px;
    }
    .implement-title{
        font-size: 14px;
        font-weight: 400;
    }
    .for-btn{
        font-size: 12px;
    }


}
</style>
