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
                        <q-input v-model="add.title"  lazy-rules type="text" outlined label="عنوان اشتراک" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'title')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'title')"></Error_Validation>
                            </template>
                        </q-input>

                        <q-input v-model="add.subtitle"  lazy-rules type="text" outlined label="توضیح کوتاه (اختیاری)" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'subtitle')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'subtitle')"></Error_Validation>
                            </template>
                        </q-input>

                        <q-select
                            class="q-mb-lg"
                            outlined
                            transition-show="flip-up"
                            transition-hide="flip-down"
                            v-model="add.is_free"
                            label="اشتراک رایگان"
                            :options="free_options"
                            emit-value
                            map-options
                            behavior="menu"
                        >
                        </q-select>

                        <q-input v-show="add.is_free===0" v-model="add.price"  lazy-rules type="text" outlined label="قیمت اشتراک (تومان)" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'price')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'price')"></Error_Validation>
                            </template>
                        </q-input>

                        <q-input v-show="add.is_free===0" v-model="add.sale"  lazy-rules type="text" outlined label="قیمت با تخفیف" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'sale')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'sale')"></Error_Validation>
                            </template>
                        </q-input>

                        <q-input v-model="add.access"  lazy-rules type="text" outlined label="مدت اشتراک (ماه)" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'access')">
                            <template v-slot:error>
                                <Error_Validation :errors="this.MixinValidation(errors,'access')"></Error_Validation>
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

                    </q-card-section>

                    <q-card-actions align="right">
                        <q-btn  label="بستن" color="red" v-close-popup />
                        <q-btn @click="AddItem" :loading="loading_add" label="افزودن آیتم" color="green-9"/>
                    </q-card-actions>
                </q-card>
            </q-dialog>
            <strong class="font-16">لیست همه اشتراک های خدمات گیرنده</strong>
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
                <template v-slot:body-cell-price="props">
                    <q-td :props="props">
                        <strong v-if="props.row.price" class="text-green-7">{{this.$filters.numbers(props.row.price)}}</strong>
                        <span v-else>----</span>
                    </q-td>
                </template>

                <template v-slot:body-cell-sale="props">
                    <q-td :props="props">
                        <strong v-if="props.row.sale" class="text-red">{{this.$filters.numbers(props.row.sale)}}</strong>
                    </q-td>
                </template>
                <template v-slot:body-cell-access="props">
                    <q-td :props="props">
                        <q-chip color="indigo-7" text-color="white">{{props.row.access}}</q-chip>
                    </q-td>
                </template>
                <template v-slot:body-cell-is_free="props">
                    <q-td :props="props">
                        <Global_Status :status="props.row.is_free" />
                    </q-td>
                </template>
                <template v-slot:body-cell-invoices_count="props">
                    <q-td :props="props">
                        <q-chip color="dark" text-color="white">{{props.row.invoices_count}}</q-chip>
                    </q-td>
                </template>
                <template v-slot:body-cell-is_active="props">
                    <q-td :props="props">
                        <q-toggle
                            v-model="props.row.is_active"
                            :false-value="0"
                            :true-value="1"
                            icon="mdi-check"
                            color="green-7"
                            size="md"
                            @click="ChangeStatus(props.row.id)"
                        />
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

                                <q-input v-model="props.row.title"  lazy-rules type="text" outlined label="عنوان اشتراک" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'title')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'title')"></Error_Validation>
                                    </template>
                                </q-input>

                                <q-input v-model="props.row.subtitle"  lazy-rules type="text" outlined label="توضیح کوتاه (اختیاری)" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'subtitle')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'subtitle')"></Error_Validation>
                                    </template>
                                </q-input>

                                <q-select
                                    class="q-mb-lg"
                                    outlined
                                    transition-show="flip-up"
                                    transition-hide="flip-down"
                                    v-model="props.row.is_free"
                                    label="اشتراک رایگان"
                                    :options="free_options"
                                    emit-value
                                    map-options
                                    behavior="menu"
                                >
                                </q-select>

                                <q-input v-show="props.row.is_free===0" v-model="props.row.price"  lazy-rules type="text" outlined label="قیمت اشتراک (تومان)" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'price')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'price')"></Error_Validation>
                                    </template>
                                </q-input>

                                <q-input v-show="props.row.is_free===0" v-model="props.row.sale"  lazy-rules type="text" outlined label="قیمت با تخفیف" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'sale')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'sale')"></Error_Validation>
                                    </template>
                                </q-input>

                                <q-input v-model="props.row.access"  lazy-rules type="text" outlined label="مدت اشتراک (ماه)" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'access')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'access')"></Error_Validation>
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
    name: "Manage_Slider",
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
            dialog_add:false,
            dialog_edit:[],
            image_edit:[],
            dialog_edit_image:[],
            add:{
                title:null,
                subtitle:null,
                image:null,
                price:null,
                sale:null,
                access:1,
                is_free:0,
            },
            edit_image:[],
            free_options : [
                {
                    label:"بله",
                    value :1,
                },
                {
                    label:"خیر",
                    value :0,
                }
            ],
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
                    label: 'عنوان',
                    align: 'left',
                    field: row => row.title,
                    sortable: true
                },
                {
                    name:'price',
                    required: true,
                    label: 'قیمت',
                    align: 'left',
                    field: row => row.price,
                    sortable: true
                },
                {
                    name:'sale',
                    required: true,
                    label: 'قیمت با تخفیف',
                    align: 'left',
                    field: row => row.sale,
                    sortable: true
                },
                {
                    name:'access',
                    required: true,
                    label: 'مدت',
                    align: 'left',
                    field: row => row.access,
                    sortable: true
                },
                {
                    name:'is_free',
                    required: true,
                    label: 'رایگان',
                    align: 'left',
                    field: row => row.is_free,
                    sortable: true
                },
                {
                    name:'invoices_count',
                    required: true,
                    label: 'تعداد خرید',
                    align: 'left',
                    field: row => row.invoices_count,
                    sortable: true
                },

                {
                    name:'is_active',
                    required: true,
                    label: 'وضعیت',
                    align: 'left',
                    field: row => row.is_active,
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
            "PlansCustomerIndex",
            "PlansCustomerStore",
            "PlansCustomerDelete",
            "PlansCustomerDeleteImage",
            "PlansCustomerEdit",
            "PlansCustomerEditImage",
            "PlanCustomerChangeActive"

        ]),
        GetItems(){
            this.PlansCustomerIndex().then(res => {
                this.items = res.data.result;
                this.loading_get=false;
            }).catch(error => {
                this.NotifyServerError();
            });
        },
        AddItem(){
            this.loading_add=true;
            this.PlansCustomerStore(this.add).then(res => {
                this.items.unshift(res.data.result);
                this.loading_add=false;
                this.dialog_add=false;
                this.add=[];
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
            this.PlansCustomerEdit(item).then(res => {
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
            this.PlansCustomerEditImage({id:id,image:this.edit_image[id]}).then(res => {
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
                this.PlansCustomerDelete(id).then(res => {
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
            this.PlansCustomerDeleteImage(id).then( res => {
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
        ChangeStatus(id){
            this.PlanCustomerChangeActive(id).then(res => {
                return this.NotifySuccess('وضعیت اشتراک باموفقیت تغییر کرد');
            }).catch(error => {
                return this.NotifyServerError();

            })
        },


    }
}
</script>

<style scoped>

</style>
