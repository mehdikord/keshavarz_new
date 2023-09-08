<template>
    <q-card flat bordered>

        <q-card-section class="bg-blue-grey-14 text-white q-pb-lg">
            <q-btn @click="dialog_add=true" color="deep-orange-7" icon="mdi-plus" push class="float-right" label="افزودن آیتم"></q-btn>
            <q-dialog
                v-model="dialog_add"
                transition-show="scale"
                transition-hide="scale"
                position="top"
            >
                <q-card style="max-width: 700px;width: 700px">
                    <q-card-section class="bg-deep-orange-9 text-white">
                        <strong>افزودن آیتم جدید</strong>
                    </q-card-section>
                    <q-card-section >
                        <q-input v-model="add.title"  lazy-rules type="text" outlined label="عنوان خبر" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'title')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'title')"></Error_Validation>
                            </template>
                        </q-input>

                        <q-input v-model="add.link"  lazy-rules type="text" outlined label="لینک منبع" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'link')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'link')"></Error_Validation>
                            </template>
                        </q-input>
                        <q-file class="q-mb-md" outlined bottom-slots v-model="add.image" label="انتخاب تصویر" counter>
                            <template v-slot:prepend>
                                <q-icon name="mdi-image" @click.stop.prevent />
                            </template>
                            <template v-slot:append>
                                <q-icon name="mdi-close" @click.stop.prevent="add.image = null" class="cursor-pointer" />
                            </template>
                        </q-file>
                        <q-input v-model="add.description"  lazy-rules type="textarea" outlined label="توضیحات کوتاه" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'description')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'description')"></Error_Validation>
                            </template>
                        </q-input>


                    </q-card-section>

                    <q-card-actions align="right">
                        <q-btn  label="بستن" color="red" v-close-popup />
                        <q-btn @click="AddItem" :loading="loading_add" label="افزودن آیتم" color="green-9"/>
                    </q-card-actions>
                </q-card>
            </q-dialog>
            <strong class="font-16">لیست همه خبر ها</strong>
        </q-card-section>

        <q-card-section>

            <q-table
                :rows="items"
                row-key="id"
                :columns="item_columns"
                color="indigo"
                table-header-class="text-indigo"
                :loading="loading_get"
                :pagination="{rowsPerPage:30}"

            >
                <template v-slot:loading>
                    <Global_Loading></Global_Loading>
                </template>
                <template v-slot:body-cell-image="props">
                    <q-td :props="props">
                        <Global_Show_Image :image="props.row.image"></Global_Show_Image>
                    </q-td>
                </template>
                <template v-slot:body-cell-description="props">
                    <q-td :props="props">
                        <q-btn color="deep-purple" @click="dialog_description[props.row.id] = true">مشاهده</q-btn>
                        <q-dialog
                            v-model="dialog_description[props.row.id]"
                            transition-show="scale"
                            transition-hide="scale"
                            position="top"
                        >
                            <q-card style="max-width: 700px;width: 700px">
                                <q-card-section class="bg-deep-purple text-white">
                                    <strong>توضیحات : {{props.row.title}}</strong>
                                </q-card-section>
                                <q-card-section >
                                    <p class="text-justify">
                                        {{props.row.description}}
                                    </p>
                                </q-card-section>

                                <q-card-actions align="right">
                                    <q-btn  label="بستن" color="red" v-close-popup />
                                </q-card-actions>
                            </q-card>
                        </q-dialog>

                    </q-td>
                </template>

                <template v-slot:body-cell-tools="props">
                    <q-td :props="props">
                        <q-btn @click="dialog_edit[props.row.id] = true;errors=[]" glossy color="primary" size="sm" icon="mdi-pen" class="q-mx-xs">
                            <q-tooltip class="bg-grey-9">ویرایش آیتم</q-tooltip>
                        </q-btn>
                        <q-btn @click="dialog_edit_image[props.row.id] = true;errors=[]" glossy color="deep-orange" size="sm" icon="mdi-image-edit" class="q-mx-xs">
                            <q-tooltip class="bg-grey-9">ویرایش تصویر آیتم</q-tooltip>
                        </q-btn>
                        <q-btn @click="DeleteItem(props.row.id)" glossy color="red-9" size="sm" icon="mdi-delete" class="q-mx-xs">
                            <q-tooltip class="bg-grey-9">حذف آیتم</q-tooltip>
                        </q-btn>
                    </q-td>
                    <q-dialog
                        v-model="dialog_edit[props.row.id]"
                        transition-show="scale"
                        transition-hide="scale"
                        position="top"
                    >
                        <q-card style="max-width: 700px;width: 700px">
                            <q-card-section class="bg-primary text-white">
                                <strong>ویرایش آیتم : {{props.row.name}}</strong>
                            </q-card-section>
                            <q-card-section >

                                <q-input v-model="props.row.title"  lazy-rules type="text" outlined label="عنوان خبر" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'title')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'title')"></Error_Validation>
                                    </template>
                                </q-input>
                                <q-input v-model="props.row.link"  lazy-rules type="text" outlined label="لینک منبع" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'link')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'link')"></Error_Validation>
                                    </template>
                                </q-input>
                                <q-input v-model="props.row.description"  lazy-rules type="textarea" outlined label="توضیحات کوتاه" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'description')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'description')"></Error_Validation>
                                    </template>
                                </q-input>

                            </q-card-section>

                            <q-card-actions align="right">
                                <q-btn  label="بستن" color="red" v-close-popup />
                                <q-btn @click="EditItem(props.row)" :loading="loading_add" label="ویرایش آیتم" color="indigo"/>
                            </q-card-actions>
                        </q-card>

                    </q-dialog>
                    <q-dialog
                        v-model="dialog_edit_image[props.row.id]"
                        transition-show="scale"
                        transition-hide="scale"
                        position="top"
                    >
                        <q-card style="max-width: 700px;width: 700px">
                            <q-card-section class="bg-deep-orange text-white">
                                <strong>ویرایش تصویر : {{props.row.name}}</strong>
                            </q-card-section>
                            <q-card-section>
                                <div>
                                    برای ویرایش تصویر ، فایل جدید را انتخاب کنید و دکمه ویرایش تصویر را کلیک کنید و برای حذف تصویر دکمه حذف تصویر را کلیک کنید
                                </div>
                                <div class="q-mt-lg">
                                    <q-file class="q-mb-md" outlined bottom-slots v-model="edit_image[props.row.id]" label="انتخاب تصویر" counter>
                                        <template v-slot:prepend>
                                            <q-icon name="mdi-image" @click.stop.prevent />
                                        </template>
                                        <template v-slot:append>
                                            <q-icon name="mdi-close" @click.stop.prevent="edit_image[props.row.id] = null" class="cursor-pointer" />
                                        </template>
                                        <template v-slot:error>
                                            <Error_Validation :errors="this.MixinValidation(errors,'image')"></Error_Validation>
                                        </template>
                                    </q-file>
                                </div>
                                <div class="q-mt-sm q-gutter-sm">
                                    <q-btn glossy icon="mdi-pen" color="indigo" @click="EditImage(props.row.id)">ویرایش تصویر</q-btn>
                                    <q-btn  glossy icon="mdi-delete-forever" @click="DeleteItemImage(props.row.id)" color="red" :disable="!props.row.image">حذف تصویر</q-btn>
                                </div>

                            </q-card-section>
                            <q-card-actions align="right">
                                <q-btn  label="بستن" color="dark" v-close-popup />
                            </q-card-actions>
                        </q-card>

                    </q-dialog>

                </template>


            </q-table>

        </q-card-section>


    </q-card>

</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Manage_News",
    created() {
        this.GetItems();

    },
    data(){
        return{
            items:[],
            loading_get:true,
            loading_add:false,
            loading_image:false,
            errors:[],
            dialog_description:[],
            dialog_add:false,
            dialog_edit:[],
            image_edit:[],
            dialog_edit_image:[],
            add:{
                title:null,
                image:null,
                link:null,
                description:null,
            },
            add_empty:{
                title:null,
                image:null,
                link:null,
                description:null,
            },
            edit_image:[],
            item_columns:[
                {
                    name:'id',
                    required: true,
                    label: 'ID',
                    align: 'left',
                    field: row => row.id,
                    sortable: true
                },
                {
                    name:'image',
                    required: true,
                    label: 'تصویر',
                    align: 'left',
                    field: row => row.image,
                    sortable: false
                },
                {
                    name:'name',
                    required: true,
                    label: 'عنوان خبر',
                    align: 'left',
                    field: row => row.title,
                    sortable: true
                },
                {
                    name:'link',
                    required: true,
                    label: 'لینک منبع',
                    align: 'left',
                    field: row => row.link,
                    sortable: true
                },
                {
                    name:'description',
                    required: true,
                    label: 'توضیحات',
                    align: 'left',
                    field: row => row.description,
                    sortable: true
                },
                {
                    name:'tools',
                    required: true,
                    label: 'تنظیمات',
                    align: 'left',

                },
            ]
        }
    },
    methods:{
        ...mapActions([
            "NewsIndex",
            "NewsStore",
            "NewsDelete",
            "NewsDeleteImage",
            "NewsEdit",
            "NewsEditImage"

        ]),
        GetItems(){
            this.NewsIndex().then(res => {
                this.items = res.data.result;
                this.loading_get=false;
            }).catch(error => {
                this.NotifyServerError();
            });
        },
        AddItem(){
            this.loading_add=true;
            this.NewsStore(this.add).then(res => {
                this.items.unshift(res.data.result);
                this.loading_add=false;
                this.dialog_add=false;
                this.add=this.add_empty;
                return this.NotifyCreate();
            }).catch(error => {
                this.loading_add=false;
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                return  this.NotifyServerError();
            })
        },
        EditItem(item){
            this.loading_add=true;
            this.NewsEdit(item).then(res => {
                this.loading_add=false;
                this.items = this.items.filter(item_get =>{
                    if (item_get.id === item.id){
                        item_get=res.data.result
                    }
                    return item_get;
                })
                this.dialog_edit[item.id]=false;
                return this.NotifyUpdate();
            }).catch(error => {
                this.loading_add=false;
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                return  this.NotifyServerError();
            })
        },
        EditImage(id){
            this.loading_image=true;
            this.NewsEditImage({id:id,image:this.edit_image[id]}).then(res => {
                this.items = this.items.filter(item_get =>{
                    if (item_get.id === id){
                        item_get.image=res.data.result.image
                    }
                    return item_get;
                })
                this.loading_image=false;
                this.dialog_edit_image[id]=false;
                this.edit_image[id]=null;
                return this.NotifyUpdate();
            }).catch(error => {
                this.loading_image=false;
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                return  this.NotifyServerError();
            })
        },
        DeleteItem (id) {
            this.$q.dialog({
                title: 'هشدار !',
                message: 'آیا مطمئن هستید آیتم مورد نظر حذف شود ؟',

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
                this.NewsDelete(id).then(res => {
                    this.items = this.items.filter(item =>{
                        return item.id !== id;
                    })
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
        DeleteItemImage (id) {
            this.NewsDeleteImage(id).then( res => {
                this.items = this.items.filter(item_get =>{
                    if (item_get.id === id){
                        item_get.image=null
                    }
                    return item_get;
                })
                this.dialog_edit_image[id]=false;
                return this.NotifyDelete();
            }).catch(error => {

                return  this.NotifyServerError();

            })
        },

    }
}
</script>

<style scoped>

</style>
