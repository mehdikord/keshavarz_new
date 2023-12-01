<script>
import {mapActions} from "vuex";

export default {
    name: "Front_Search_Profile",
    props:['user','check_customer','request_id','users'],
    created() {
        // console.log(this.users)
    },
    data(){
        return{
            request_loading:[],
            cancel_loading:false,
        }

    },

    methods:{
        ...mapActions([
            "SearchProviderRequestSend",
            "SearchProviderRequestUserCancel",
        ]),
        SendRequest(){
            this.request_loading[this.user.user.id] = true;
            let items = {
                "request_id" : this.request_id,
                "user_id" : this.user.user.id
            }
            this.SearchProviderRequestSend(items).then(res => {
                this.NotifySuccess('درخواست باموفقیت ارسال شد');
                this.$emit('GetReqUsers',res.data.result);
                this.request_loading[this.user.user.id] = false;

            }).catch(error => {
                this.request_loading[this.user.user.id] = false;
                if (error.response.status === 409) {
                    return this.NotifyError(error.response.data.error);
                }
                return this.NotifyServerError();

            })


        },
        CancelRequest(){
            this.cancel_loading=true;
            let items = {
                "request_id" : this.request_id,
                "user_id" : this.user.user.id
            }
            this.SearchProviderRequestUserCancel(items).then(res => {
                this.NotifySuccess(res.data.message);
                this.$emit('GetReqUsers',res.data.result);
                this.cancel_loading=false;
                this.request_loading[this.user.user.id] = false;

            }).catch(error => {
                this.cancel_loading=false;

                if (error.response.status === 409) {
                    return this.NotifyError(error.response.data.error);
                }
                return this.NotifyServerError();

            })


        },
        CheckUserExists(user){

            let find=null;
            if (this.users.length){
                this.users.forEach(item => {
                    if (item.user_id === user && item.request_id === this.request_id){
                        find = item
                    }
                })
            }
            return find;
        }


    }

}
</script>

<template>

    <q-card class="bg-grey-1 rounded">
        <q-card-section class="q-pa-xs">
            <div class="row items-center">
                <div class="col-lg-2 col-sm-3 col-xs-3 q-pa-sm mobile-padding text-center">
                    <q-img  src="/front/images/farmer.png" class="image" />
                </div>
                <div class="col-lg-10 col-sm-9 col-xs-9 info-padding">
                    <div class="info-box">
                        <span class="info-title text-green-7">نام : </span>
                        <span class="info-text text-dark">{{user.user.name}} </span>
                    </div>
                    <div class="info-box">
                        <span class="info-title text-green-7">شماره تماس : </span>
                        <span v-if="user.user.phone" class="info-text text-dark" dir="ltr">{{user.user.phone}}</span>
                        <span v-else class="info-error text-red" dir="ltr">
                            برای مشاهده باید درخواست بدهید
                            <q-icon name="fas fa-triangle-exclamation"></q-icon>
                        </span>
                    </div>
                    <div class="info-box">
                        <span class="info-title text-green-7">فاصله از شما : </span>
                        <span class="info-text text-dark">{{user.dis}} کیلومتر </span>
                    </div>
                    <div class="info-box">
                        <span class="info-title text-green-7">قیمت : </span>
                        <span class="info-text text-dark">
                            <strong class="text-red">{{this.$filters.numbers(user.price)}}</strong>
                            <span class="currency">( {{ this.$filters.numtopersian(user.price) }} )</span>
                            /
                            <span>{{user.price_type}}</span>
                        </span>
                    </div>
                    <div class="btn-box">

                        <template v-if="CheckUserExists(user.user.id)">
                            <template v-if="CheckUserExists(user.user.id).status === 'pending'" >
                                <q-btn @click="CancelRequest" title="لغو درخواست" :loading="cancel_loading" color="red" icon="fas fa-times" dense class="float-right q-ml-sm"></q-btn>
                                <q-btn color="yellow-9" text-color="dark" disable class="float-right info-btn q-ml-sm" icon="fas fa-spinner fa-spin q-mr-xs">در انتظار تایید</q-btn>

                            </template>

                            <q-btn v-if="CheckUserExists(user.user.id).status === 'reject'" color="red" disable class="float-right info-btn q-ml-sm" icon="fas fa-times q-mr-xs">رد شده</q-btn>
                        </template>

                        <q-btn v-else @click="SendRequest" :loading="request_loading[user.user.id]" color="indigo" class="float-right info-btn q-ml-sm" icon="fas fa-check q-mr-xs" :disable="check_customer === 0" >درخواست</q-btn>

                        <q-btn :to="{name : 'provider_profile',params:{id:user.user.id}}" color="positive" class="float-right info-btn" icon="fas fa-user q-mr-xs">پروفایل</q-btn>
                    </div>
                </div>
            </div>
        </q-card-section>
    </q-card>
</template>

<style scoped>
.mobile-padding{

}
.info-padding{
    padding-bottom: 8px;
    padding-right: 10px;
}
.info-btn{
    font-size: 13px;
}
.image{
    width: 100px;
}
.currency{
    font-size: 13px;
    margin-left: 4px;
}
.btn-box{
    margin-top: 10px;
}
.info-box{
    margin-top: 11px;
}
.info-title{
    font-size: 13px;
    font-weight: 600;
}
.info-text{
    font-size: 14px;
    font-weight: 600;
    margin-left: 3px;
}
.info-error{
    font-size: 13px;
    font-weight: 500;
    margin-left: 3px;
}

@media only screen and (max-width: 600px) {
    .mobile-padding{
        padding: 0 0;
    }
    .info-padding{
        padding-bottom: 3px;
        padding-right: 3px;
    }
    .info-btn{
        font-size: 12px;
    }
    .image{
        width: 65px;
    }
    .currency{
        font-size: 12px;
        margin-left: 4px;
    }
    .btn-box{
        margin-top: 16px;
    }
    .info-box{
        margin-top: 11px;
    }
    .info-title{
        font-size: 12px;
        font-weight: 600;
    }
    .info-text{
        font-size: 13px;
        font-weight: 600;
        margin-left: 3px;
    }
    .info-error{
        font-size: 12px;
        font-weight: 500;
        margin-left: 3px;
    }
}

</style>
