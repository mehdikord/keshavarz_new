<script>
import {mapActions} from "vuex";

export default {
    name: "Front_Profile_Provider_Gallery",
    mounted() {
        if (this.AuthUserCheck()){
            this.GetUserGallery();
        }
    },
    data(){
        return{
            user_gallery:[],
            user_gallery_loading:true,
            gallery_add:null,
            errors:[],
            gallery_loading:false,
            AddGalleryDialog:false,
        }
    },
    methods:{
        ...mapActions([
            "ProfilesUserGallery",
            "ProfilesUserGalleryStore",
            "ProfilesUserGalleryDelete",

        ]),
        GetUserGallery(){
            this.ProfilesUserGallery().then(res => {
                this.user_gallery = res.data.result;
                this.user_gallery_loading=false;
            }).catch(error =>{
                this.user_gallery_loading=false;
                this.NotifyServerError();
            })
        },

        AddGallery(){
            if (!this.gallery_add){
                return this.NotifyError('تصویر را انتخاب کنید')
            }
            this.gallery_loading=true;
            let item ={image:this.gallery_add}
            this.ProfilesUserGalleryStore(item).then(res => {
                this.user_gallery.push(res.data.result);
                this.gallery_loading=false;
                this.AddGalleryDialog=false;
                this.NotifySuccess("تصویر جدید باموفقیت به گالری شما اضافه شد")
            }).catch(error => {
                this.gallery_loading=false;
                if (error.response.status === 409) {
                    this.NotifyError(error.response.data.error);
                }else if (error.response.status === 422) {
                    this.NotifyError("اطلاعات وارد شده ناقص است")
                }else {
                    return this.NotifyServerError();
                }

            })
        },
        RemoveGallery(item){
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا مطمئن هستید آیتم مورد نظر از گالری شما حذف شود ؟',

                ok: {
                    glossy: true,
                    color:'positive',
                },
                cancel: {
                    glossy: true,
                    color: 'red'
                },
                persistent: true
            }).onOk(() => {
                this.ProfilesUserGalleryDelete(item).then(res => {
                    this.GetUserGallery();
                    return this.NotifyDelete();
                }).catch(error => {
                    return  this.NotifyServerError();
                })

            }).onCancel(() => {
                // console.log('>>>> Cancel')
            }).onDismiss(() => {
                // console.log('I am triggered on both OK and Cancel')
            })
        },
    },
}
</script>

<template>
    <div class="row justify-center">
        <div class="col-lg-9 col-sm-12 col-xs-12">
            <div>
                <q-img class="search-img" src="/front/images/gallery.png"></q-img>
                <strong class="text-green-7 title q-ml-sm">
                    گالری تصاویر خدمت دهنده
                </strong>
                <p class="text-justify q-mt-sm subtitle text-grey-8">
                    شما میتوانید تصاویر مربوط به ادوات کشاورزی خود را در این قسمت وارد کنید ، و کشاورز گالری تصاویر و ادوات شما را مشاهده کند
                </p>
            </div>
            <div class="text-right">
                <q-btn :to="{name : 'profile_provider'}" color="red" size="sm" class="font-12" icon-right="fas fa-arrow-left q-ml-xs" glossy >بازگشت</q-btn>
            </div>
            <global_info_loading class="q-mt-xl" v-if="user_gallery_loading"></global_info_loading>

            <q-card v-else class="q-mt-md">
                <q-card-section>
                    <div class="info-subtitle text-red">
                        تصاویر ادوات شما :
                    </div>
                    <div class="q-mt-lg q-mb-md text-center">
                        <q-btn @click="AddGalleryDialog=true" class="add-btn" glossy color="teal-7" icon="fas fa-image q-mr-sm">
                            افزودن تصویر جدید
                        </q-btn>
                        <q-dialog position="top"  v-model="AddGalleryDialog" >

                            <q-card class="add-card">
                                <q-card-section class="bg-indigo text-white">
                                    <div class="add-title">
                                        افزودن تصویر جدید به گالری خود
                                    </div>
                                </q-card-section>
                                <q-card-section>

                                    <div class="form-box">
                                        <q-file class="q-mb-md" color="green-7" outlined bottom-slots v-model="gallery_add" label="انتخاب تصویر" counter>
                                            <template v-slot:prepend>
                                                <q-icon name="fas fa-image" @click.stop.prevent />
                                            </template>
                                            <template v-slot:append>
                                                <q-icon name="fas fa-times" @click.stop.prevent="gallery_add = null" class="cursor-pointer" />
                                            </template>
                                        </q-file>
                                    </div>
                                    <div class="q-mt-lg q-mb-sm text-right">
                                        <q-btn @click="AddGallery" :loading="gallery_loading" color="green-7" glossy>ثبت و ارسال تصویر</q-btn>
                                    </div>

                                </q-card-section>

                            </q-card>

                        </q-dialog>
                    </div>
                    <div class="q-mt-lg">
                        <global_info_loading v-if="user_gallery_loading"></global_info_loading>
                        <template v-else>
                            <div v-if="!user_gallery.length" class="text-center">
                                            <span class="q-mt-md text-red-5 ">
                                                شما هنوز هیچ تصویری در گالری خود اضافه نکرده اید
                                            </span>
                            </div>
                            <div v-else>
                                <div class="row">
                                    <div v-for="gallery in user_gallery" class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6 q-mt-xs">
                                        <q-card>
                                            <q-card-section class="text-center" >
                                                <q-img class="gallery-image" :src="gallery.file"/>
                                            </q-card-section>
                                            <q-card-actions>
                                                <q-icon @click="RemoveGallery(gallery.id)" name="fas fa-trash" color="red"  class="cursor-pointer"></q-icon>
                                            </q-card-actions>
                                        </q-card>
                                    </div>
                                </div>
                            </div>
                        </template>

                    </div>
                </q-card-section>
            </q-card>
        </div>

    </div>
</template>
<style scoped>
.title{
    font-size: 17px;
}
.subtitle{
    font-size: 15px;
}
.search-img{
    width: 80px;
}
.info-subtitle{
    font-size: 14px;
    font-weight: 500;
}
.add-card{
    max-width: 1024px;
    width: 900px;
}
.add-btn{
    font-size: 14px;
}
.add-card{
    max-width: 1024px;
    width: 900px;
}
.add-title{
    font-size: 15px;
    font-weight: 550;
}
.form-box{
    margin-bottom: 25px;
}
.gallery-image{
    width: 200px;
    height: 200px;
}

@media only screen and (max-width: 600px) {
    .title {
        font-size: 14px;
    }

    .subtitle {
        font-size: 13px;
    }

    .search-img {
        width: 70px;
    }
    .info-subtitle{
        font-size: 13px;
        font-weight: 500;
    }
    .add-btn{
        font-size: 12px;
    }
    .add-title{
        font-size: 13px;
        font-weight: 550;
    }
    .form-box{
        margin-bottom: 15px;
    }
    .gallery-image{
        width: 120px;
        height: 120px;

    }
}

</style>
