<script>
import {mapActions} from "vuex";

export default {
    name: "Front_Profile_Provider_Item",
    props : ['request'],
    data(){
        return {
            done_loading:false,
        }
    },
    methods:{
        ...mapActions([
            "UserProviderSetDone"
        ]),
        SetDone(){


            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا مطمئن هستید این درخواست به حالت پایان یافته تغییر کند ؟',
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

                this.done_loading=true;
                this.UserProviderSetDone(this.request.id).then(res => {
                    this.done_loading=false;
                    this.NotifySuccess(res.data.message);
                    this.$emit("SetDoneEmit");

                }).catch(error => {
                    this.done_loading=false;
                    this.NotifyServerError();
                });
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
                <q-img class="rounded-borders land-img" v-if="request.implement.image" :src="request.implement.image" />
                <q-img class="rounded-borders land-img" v-else src="/front/images/implement.png" />
                <span class="implement-title q-ml-sm text-indigo">
                   {{request.implement.name}}
               </span>
            </div>
            <q-separator class="q-mt-sm q-mb-sm" />
            <div>
                <q-img class="rounded-borders land-img" src="/front/images/money.png" />
                <strong class=" q-ml-sm text-green-6">
                   {{this.$filters.numbers(request.price)}}
               </strong>
                <span class="implement-title">
                    ({{request.implement.price_type}})
                </span>
                <strong class="text-red q-ml-xs q-mr-xs">
                    /
                </strong>
                <span class="implement-title">
                    {{request.land.area}} متر
                </span>

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
                <q-img class="rounded-borders land-img" v-if="request.user.profile" :src="request.user.profile" />
                <q-img class="rounded-borders land-img" v-else src="/front/images/farmer.png" />
                <span class="text-grey-9 q-ml-sm implement-title">
                   {{request.user.name}}
               </span>
               <q-btn color="teal-8" glossy dense class="float-right font-13 q-mt-sm" icon="fas fa-mobile-retro q-mr-sm">
                   <a :href="'tel:'+request.user.phone" class="text-white">
                       {{request.user.phone}}
                   </a>
               </q-btn>
            </div>
            <q-separator class="q-mt-sm q-mb-sm" />
            <div class="text-center q-mt-md row">
                <div class="col-6 q-pr-xs">

                    <q-btn @click="SetDone" :loading="done_loading" class="for-btn" color="teal-6" icon-right="fas fa-check q-ml-xs" glossy dense style="width: 100%">اتمام کار</q-btn>

                </div>
                <div class="col-6 q-pl-xs">
                    <q-btn class="for-btn" color="red-8" icon-right="fas fa-times q-ml-xs" glossy dense style="width: 100%">لغو کار</q-btn>

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
.land-title{
    font-size: 13px;
    font-weight: 500;
}

@media only screen and (max-width: 600px) {
    .land-title{
        font-size: 12px;
        font-weight: 400;
    }
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
