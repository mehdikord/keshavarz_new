<template>
    <q-card flat bordered>

        <q-card-section class="bg-blue-grey-14 text-white q-pb-lg">
            <q-btn @click="dialog_add=true" color="deep-orange-7" icon="mdi-plus" push class="float-right" label="افزودن آیتم"></q-btn>
            <q-dialog
                v-model="dialog_add"
                transition-show="scale"
                transition-hide="scale"
                position="top"
                full-width
            >
                <q-card>

                    <q-card-section class="bg-deep-orange-9 text-white">
                        <strong>افزودن محصول جدید</strong>
                    </q-card-section>
                    <q-card-section >
                        <div class="row">
                            <div class="col-md-12 q-px-md">
                                <q-input v-model="add.name"  lazy-rules type="text" outlined label="نام محصول" color="primary" :error="this.MixinValidationCheck(errors,'name')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'name')"></Error_Validation>
                                    </template>
                                </q-input>
                            </div>
                            <div class="col-md-6 q-px-md">
                                <q-select
                                    class="q-mb-md"
                                    outlined
                                    transition-show="flip-up"
                                    transition-hide="flip-down"
                                    v-model="add.category_id"
                                    use-input
                                    label="انتخاب دسته بندی محصول"
                                    :options="categories_option"
                                    emit-value
                                    map-options
                                    @filter="Filter_Select_Category"
                                    :loading="loading_select_category"
                                    behavior="menu"
                                    :error="this.MixinValidationCheck(errors,'category_id')"
                                >
                                    <template v-slot:no-option>
                                        <q-item>
                                            <q-item-section class="text-grey">
                                                No results
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                    <template v-slot:option="scope">
                                        <q-item v-bind="scope.itemProps">
                                            <q-item-section avatar>
                                                <Global_Show_Image :image="scope.opt.image"></Global_Show_Image>
                                            </q-item-section>
                                            <q-item-section>
                                                <q-item-label>{{ scope.opt.label }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'category_id')"></Error_Validation>
                                    </template>
                                </q-select>
                            </div>
                            <div class="col-md-6 q-px-md">
                                <q-select
                                    class="q-mb-md"
                                    outlined
                                    transition-show="flip-up"
                                    transition-hide="flip-down"
                                    v-model="add.brand_id"
                                    use-input
                                    label="انتخاب برند محصول"
                                    :options="brands_option"
                                    emit-value
                                    map-options
                                    @filter="Filter_Select_Brand"
                                    :loading="loading_select_brand"
                                    behavior="menu"
                                    :error="this.MixinValidationCheck(errors,'brand_id')"

                                >
                                    <template v-slot:no-option>
                                        <q-item>
                                            <q-item-section class="text-grey">
                                                No results
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                    <template v-slot:option="scope">
                                        <q-item v-bind="scope.itemProps">
                                            <q-item-section avatar>
                                                <Global_Show_Image :image="scope.opt.image"></Global_Show_Image>
                                            </q-item-section>
                                            <q-item-section>
                                                <q-item-label>{{ scope.opt.label }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'brand_id')"></Error_Validation>
                                    </template>
                                </q-select>
                            </div>
                            <div class="col-md-12 q-px-md">
                                <q-input v-model="add.short_description" rows="3"  lazy-rules type="textarea" outlined label="توضیحات کوتاه " color="primary" :error="this.MixinValidationCheck(errors,'short_description')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'short_description')"></Error_Validation>
                                    </template>
                                </q-input>
                            </div>
                            <div class="col-md-6 q-px-md">
                                <q-input v-model="add.price"  lazy-rules type="number" outlined label="قیمت (تومان)" color="primary" :error="this.MixinValidationCheck(errors,'price')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'price')"></Error_Validation>
                                    </template>
                                </q-input>
                            </div>
                            <div class="col-md-6 q-px-md">
                                <q-input v-model="add.sale"  lazy-rules type="text" outlined label="قیمت با تخفیف (تومان)" color="primary" :error="this.MixinValidationCheck(errors,'sale')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'sale')"></Error_Validation>
                                    </template>
                                </q-input>
                            </div>
                            <div class="col-md-12 q-px-md q-mb-lg">
                                <q-editor
                                    v-model="add.long_description"
                                    toolbar-outline
                                    toolbar-bg="blue-grey-9"
                                    toolbar-text-color="white"
                                    height="350px"
                                    :toolbar="[
                                                [
                                                  {
                                                    label: $q.lang.editor.align,
                                                    icon: $q.iconSet.editor.align,
                                                    fixedLabel: true,
                                                    options: ['left', 'center', 'right', 'justify']
                                                  }
                                                ],
                                                ['bold', 'italic', 'strike', 'underline', 'subscript', 'superscript'],
                                                ['token', 'hr', 'link', 'custom_btn'],
                                                ['print', 'fullscreen'],
                                                [
                                                  {
                                                    label: $q.lang.editor.formatting,
                                                    icon: $q.iconSet.editor.formatting,
                                                    list: 'no-icons',
                                                    options: [
                                                      'p',
                                                      'h1',
                                                      'h2',
                                                      'h3',
                                                      'h4',
                                                      'h5',
                                                      'h6',
                                                      'code'
                                                    ]
                                                  },
                                                  {
                                                    label: $q.lang.editor.fontSize,
                                                    icon: $q.iconSet.editor.fontSize,
                                                    fixedLabel: true,
                                                    fixedIcon: true,
                                                    list: 'no-icons',
                                                    options: [
                                                      'size-1',
                                                      'size-2',
                                                      'size-3',
                                                      'size-4',
                                                      'size-5',
                                                      'size-6',
                                                      'size-7'
                                                    ]
                                                  },
                                                  {
                                                    label: $q.lang.editor.defaultFont,
                                                    icon: $q.iconSet.editor.font,
                                                    fixedIcon: true,
                                                    list: 'no-icons',
                                                    options: [
                                                      'default_font',
                                                    ]
                                                  },
                                                  'removeFormat'
                                                ],
                                                ['quote', 'unordered', 'ordered', 'outdent', 'indent'],

                                                ['undo', 'redo'],
                                                ['viewsource']
                                              ]"
                                    :fonts="{
                                        vazir: 'Vazirmatn',
                                      }"

                                />
                            </div>
                            <div class="col-md-6 q-px-md">
                                <q-input v-model="add.quantity"  lazy-rules type="number" outlined label="موجودی در انبار" color="primary" :error="this.MixinValidationCheck(errors,'quantity')">
                                    <template v-slot:error>
                                        <Error_Validation :errors="this.MixinValidation(errors,'quantity')"></Error_Validation>
                                    </template>
                                </q-input>
                            </div>
                            <div class="col-md-6 q-px-md">
                                <q-select
                                    class="q-mb-md"
                                    outlined
                                    transition-show="flip-up"
                                    transition-hide="flip-down"
                                    v-model="add.commenting"
                                    label="قابلیت ثبت دیدگاه"
                                    :options="comment_options"
                                    emit-value
                                    map-options
                                    behavior="menu"
                                >
                                </q-select>
                            </div>
                        </div>

                    </q-card-section>
                    <q-card-actions align="right">
                        <q-btn  label="بستن" color="red" v-close-popup />
                        <q-btn @click="AddItem" :loading="loading_add" label="افزودن محصول جدید" color="green-9"/>
                    </q-card-actions>
                </q-card>
            </q-dialog>
            <strong class="font-16">لیست همه محصولات در فروشگاه</strong>
        </q-card-section>

        <q-card-section>

            <q-table
                :rows="items"
                row-key="id"
                :columns="item_columns"
                color="indigo"
                table-header-class="text-indigo"
                :loading="loading_get"
                separator="cell"
                :pagination="{rowsPerPage:30}"

            >
                <template v-slot:loading>
                    <Global_Loading></Global_Loading>
                </template>
                <template v-slot:body-cell-image="props">
                    <q-td :props="props">
                        image
                    </q-td>
                </template>
                <template v-slot:body-cell-category="props">
                    <q-td :props="props">
                        <span v-if="props.row.category" class="text-red">{{props.row.category.name}}</span>
                    </q-td>
                </template>
                <template v-slot:body-cell-brand="props">
                    <q-td :props="props">
                        <span v-if="props.row.brand" class="text-purple-8">{{props.row.brand.name}}</span>
                    </q-td>
                </template>
                <template v-slot:body-cell-price="props">
                    <q-td :props="props">
                        <strong class="text-green-7">{{this.$filters.numbers(props.row.price)}}</strong>
                    </q-td>
                </template>
                <template v-slot:body-cell-sale="props">
                    <q-td :props="props">
                        <strong v-if="props.row.sale" class="text-red">{{this.$filters.numbers(props.row.sale)}}</strong>
                    </q-td>
                </template>
                <template v-slot:body-cell-quantity="props">
                    <q-td :props="props">
                        <q-chip :color="this.$filters.quantity_color(props.row.quantity)" size="sm" class="font-12" text-color="white"><strong>{{props.row.quantity}}</strong></q-chip>
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
                        full-width
                        position="top"
                    >
                        <q-card style="max-width: 700px;width: 700px">
                            <q-card-section class="bg-primary text-white">
                                <strong>ویرایش آیتم : {{props.row.name}}</strong>
                            </q-card-section>
                            <q-card-section >
                                <div class="row">
                                    <div class="col-md-12 q-px-md">
                                        <q-input v-model="props.row.name"  lazy-rules type="text" outlined label="نام محصول" color="primary" :error="this.MixinValidationCheck(errors,'name')">
                                            <template v-slot:error>
                                                <Error_Validation :errors="this.MixinValidation(errors,'name')"></Error_Validation>
                                            </template>
                                        </q-input>
                                    </div>
                                    <div class="col-md-6 q-px-md">
                                        <q-select
                                            class="q-mb-md"
                                            outlined
                                            transition-show="flip-up"
                                            transition-hide="flip-down"
                                            v-model="props.row.category_id"
                                            use-input
                                            label="انتخاب دسته بندی محصول"
                                            :options="categories_option"
                                            emit-value
                                            map-options
                                            @filter="Filter_Select_Category"
                                            :loading="loading_select_category"
                                            behavior="menu"
                                            :error="this.MixinValidationCheck(errors,'category_id')"
                                        >
                                            <template v-slot:no-option>
                                                <q-item>
                                                    <q-item-section class="text-grey">
                                                        No results
                                                    </q-item-section>
                                                </q-item>
                                            </template>
                                            <template v-slot:option="scope">
                                                <q-item v-bind="scope.itemProps">
                                                    <q-item-section avatar>
                                                        <Global_Show_Image :image="scope.opt.image"></Global_Show_Image>
                                                    </q-item-section>
                                                    <q-item-section>
                                                        <q-item-label>{{ scope.opt.label }}</q-item-label>
                                                    </q-item-section>
                                                </q-item>
                                            </template>
                                            <template v-slot:error>
                                                <Error_Validation :errors="this.MixinValidation(errors,'category_id')"></Error_Validation>
                                            </template>
                                        </q-select>
                                    </div>
                                    <div class="col-md-6 q-px-md">
                                        <q-select
                                            class="q-mb-md"
                                            outlined
                                            transition-show="flip-up"
                                            transition-hide="flip-down"
                                            v-model="props.row.brand_id"
                                            use-input
                                            label="انتخاب برند محصول"
                                            :options="brands_option"
                                            emit-value
                                            map-options
                                            @filter="Filter_Select_Brand"
                                            :loading="loading_select_brand"
                                            behavior="menu"
                                            :error="this.MixinValidationCheck(errors,'brand_id')"

                                        >
                                            <template v-slot:no-option>
                                                <q-item>
                                                    <q-item-section class="text-grey">
                                                        No results
                                                    </q-item-section>
                                                </q-item>
                                            </template>
                                            <template v-slot:option="scope">
                                                <q-item v-bind="scope.itemProps">
                                                    <q-item-section avatar>
                                                        <Global_Show_Image :image="scope.opt.image"></Global_Show_Image>
                                                    </q-item-section>
                                                    <q-item-section>
                                                        <q-item-label>{{ scope.opt.label }}</q-item-label>
                                                    </q-item-section>
                                                </q-item>
                                            </template>
                                            <template v-slot:error>
                                                <Error_Validation :errors="this.MixinValidation(errors,'brand_id')"></Error_Validation>
                                            </template>
                                        </q-select>
                                    </div>
                                    <div class="col-md-12 q-px-md">
                                        <q-input v-model="props.row.description" rows="3"  lazy-rules type="textarea" outlined label="توضیحات کوتاه " color="primary" :error="this.MixinValidationCheck(errors,'short_description')">
                                            <template v-slot:error>
                                                <Error_Validation :errors="this.MixinValidation(errors,'short_description')"></Error_Validation>
                                            </template>
                                        </q-input>
                                    </div>
                                    <div class="col-md-6 q-px-md">
                                        <q-input v-model="props.row.price"  lazy-rules type="number" outlined label="قیمت (تومان)" color="primary" :error="this.MixinValidationCheck(errors,'price')">
                                            <template v-slot:error>
                                                <Error_Validation :errors="this.MixinValidation(errors,'price')"></Error_Validation>
                                            </template>
                                        </q-input>
                                    </div>
                                    <div class="col-md-6 q-px-md">
                                        <q-input v-model="props.row.sale"  lazy-rules type="text" outlined label="قیمت با تخفیف (تومان)" color="primary" :error="this.MixinValidationCheck(errors,'sale')">
                                            <template v-slot:error>
                                                <Error_Validation :errors="this.MixinValidation(errors,'sale')"></Error_Validation>
                                            </template>
                                        </q-input>
                                    </div>
                                    <div class="col-md-12 q-px-md q-mb-lg">
                                        <q-editor
                                            v-model="props.row.long_description"
                                            toolbar-outline
                                            toolbar-bg="blue-grey-9"
                                            toolbar-text-color="white"
                                            height="350px"
                                            :toolbar="[
                                                [
                                                  {
                                                    label: $q.lang.editor.align,
                                                    icon: $q.iconSet.editor.align,
                                                    fixedLabel: true,
                                                    options: ['left', 'center', 'right', 'justify']
                                                  }
                                                ],
                                                ['bold', 'italic', 'strike', 'underline', 'subscript', 'superscript'],
                                                ['token', 'hr', 'link', 'custom_btn'],
                                                ['print', 'fullscreen'],
                                                [
                                                  {
                                                    label: $q.lang.editor.formatting,
                                                    icon: $q.iconSet.editor.formatting,
                                                    list: 'no-icons',
                                                    options: [
                                                      'p',
                                                      'h1',
                                                      'h2',
                                                      'h3',
                                                      'h4',
                                                      'h5',
                                                      'h6',
                                                      'code'
                                                    ]
                                                  },
                                                  {
                                                    label: $q.lang.editor.fontSize,
                                                    icon: $q.iconSet.editor.fontSize,
                                                    fixedLabel: true,
                                                    fixedIcon: true,
                                                    list: 'no-icons',
                                                    options: [
                                                      'size-1',
                                                      'size-2',
                                                      'size-3',
                                                      'size-4',
                                                      'size-5',
                                                      'size-6',
                                                      'size-7'
                                                    ]
                                                  },
                                                  {
                                                    label: $q.lang.editor.defaultFont,
                                                    icon: $q.iconSet.editor.font,
                                                    fixedIcon: true,
                                                    list: 'no-icons',
                                                    options: [
                                                      'default_font',
                                                    ]
                                                  },
                                                  'removeFormat'
                                                ],
                                                ['quote', 'unordered', 'ordered', 'outdent', 'indent'],

                                                ['undo', 'redo'],
                                                ['viewsource']
                                              ]"
                                            :fonts="{
                                        vazir: 'Vazirmatn',
                                      }"

                                        />
                                    </div>
                                    <div class="col-md-12 q-px-md">
                                        <q-select
                                            class="q-mb-md"
                                            outlined
                                            transition-show="flip-up"
                                            transition-hide="flip-down"
                                            v-model="props.row.commenting"
                                            label="قابلیت ثبت دیدگاه"
                                            :options="comment_options"
                                            emit-value
                                            map-options
                                            behavior="menu"
                                        >
                                        </q-select>
                                    </div>
                                </div>

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
                        full-width
                    >
                        <q-card>
                            <q-card-section class="bg-deep-orange text-white">
                                <strong>ویرایش تصاویر : {{props.row.name}}</strong>
                            </q-card-section>
                            <q-card-section>

                                <strong>لیست تصاویر محصول :</strong>
                                <q-btn  color="indigo" glossy class="float-right" icon-right="mdi-plus" @click="images_show = !images_show"> افزودن تصویر جدید</q-btn>
                                <div v-show="images_show" class="row q-mt-lg justify-center">
                                    <div class="col-md-5">
                                        <q-file class="q-mb-sm" outlined bottom-slots v-model="images_new" label="انتخاب تصویر" counter>
                                            <template v-slot:prepend>
                                                <q-icon name="mdi-image" @click.stop.prevent />
                                            </template>
                                            <template v-slot:append>
                                                <q-icon name="mdi-close" @click.stop.prevent="images_new = null" class="cursor-pointer" />
                                            </template>
                                            <template v-slot:error>
                                                <Error_Validation :errors="this.MixinValidation(errors,'image')"></Error_Validation>
                                            </template>
                                        </q-file>
                                        <q-btn color="green" icon-right="mdi-check" @click="AddImage(props.row.id)" :loading="images_loading"> افزودن تصویر</q-btn>
                                    </div>
                                </div>

                            </q-card-section>
                            <hr />
                            <q-card-section>
                                <div class="row justify-center q-gutter-lg">
                                    <div v-if="!props.row.images.length" class="col-md-7">
                                        <q-banner class="bg-yellow-9 text-dark text-center" rounded>
                                            هیچ تصویری برای این محصول ثبت نشده است ، برای ثبت تصویر جدید از دکمه افزودن تصویر جدید استفاده کنید.
                                        </q-banner>
                                    </div>
                                    <template v-else>
                                        <div v-for="image in props.row.images" class="col-md-2 text-center">
                                            <q-img class="shadow" :src="image.image">
                                                <div class="absolute-bottom-right images-captions">
                                                    <q-icon name="mdi-delete" color="red-13" size="sm"></q-icon>
                                                </div>
                                            </q-img>
                                        </div>
                                    </template>



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
    name: "Manage_Products",
    created() {
        this.GetItems();

    },
    mounted() {
        this.Categories_Select();
        this.Brand_Select();
    },
    data(){
        return{
            items:[],
            loading_get:true,
            loading_add:false,
            loading_image:false,
            loading_select_category:false,
            loading_select_brand:false,
            errors:[],
            dialog_add:false,
            dialog_edit:[],
            dialog_edit_image:[],
            categories_option:[],
            brands_option:[],
            add:{
                name:null,
                category_id:null,
                brand_id:null,
                short_description:null,
                long_description:null,
                price:null,
                sale:null,
                quantity:10,
                commenting:1,
            },
            edit_image:[],
            item_columns:[
                {
                    name:'image',
                    required: true,
                    label: 'تصویر',
                    align: 'left',
                    field: row => row.images,
                    sortable: false
                },
                {
                    name:'name',
                    required: true,
                    label: 'نام محصول',
                    align: 'left',
                    field: row => row.name,
                    sortable: true
                },
                {
                    name:'category',
                    required: true,
                    label: 'دسته بندی',
                    align: 'left',
                    field: row => row.category,
                    sortable: true
                },
                {
                    name:'brand',
                    required: true,
                    label: 'برند',
                    align: 'left',
                    field: row => row.brand,
                    sortable: true
                },
                {
                    name:'price',
                    required: true,
                    label: 'قیمت',
                    align: 'left',
                    field: row => row.brand,
                    sortable: true
                },
                {
                    name:'sale',
                    required: true,
                    label: 'باتخفیف',
                    align: 'left',
                    field: row => row.sale,
                    sortable: true
                },
                {
                    name:'quantity',
                    required: true,
                    label: 'موجودی انبار',
                    align: 'left',
                    field: row => row.quantity,
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
            ],
            comment_options : [
                {
                    label:"بله",
                    value :1,
                },
                {
                    label:"خیر",
                    value :0,
                }
            ],
            images_new:null,
            images_show:false,
            images_loading:false,

        }
    },
    methods:{
        ...mapActions([
            "ProductsIndex",
            "ProductsStore",
            "ProductsDelete",
            "ProductsEdit",
            "ProductsImagesIndex",
            "ProductsImagesStore",
            "ProductsChangeActive",
            "CategoriesSelectWithParent",
            "BrandsSelect"

        ]),

        GetItems(){
            this.ProductsIndex().then(res => {
                this.items = res.data.result;
                this.loading_get=false;
            }).catch(error => {
                this.NotifyServerError();
            });
        },
        AddItem(){
            this.loading_add=true;
            this.ProductsStore(this.add).then(res => {
                this.items.unshift(res.data.result);
                this.loading_add=false;
                this.dialog_add=false;
                this.add={};
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
            this.ProductsEdit(item).then(res => {
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
                this.ProductsDelete(id).then(res => {
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
        ChangeStatus(id){
           this.ProductsChangeActive(id).then(res => {
               return this.NotifySuccess('وضعیت محصول باموفقیت تغییر کرد');
           }).catch(error => {
               return this.NotifyServerError();

           })
        },
        AddImage(item){
            if (!this.images_new){
                return this.NotifyError('برای افزودن عکس جدید ابتدا فایل مورد نطر را انتخاب کنید');
            }
            this.images_loading=true;
            this.ProductsImagesStore({id : item,image : this.images_new}).then(res => {
                this.images_loading=false;
                this.items = this.items.filter(item_get =>{
                    if (item_get.id === item){
                        item_get.images=res.data.result
                    }
                    return item_get;
                })
                this.images_new=null;
                this.images_show=false;
                return this.NotifySuccess('تصویر جدید باموفقیت اضافه شد');
            }).catch(error => {
                this.images_loading=false;
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                return  this.NotifyServerError();
            })

        },


        Categories_Select(){
            this.loading_select_category = true;
            this.CategoriesSelectWithParent().then(res => {
                this.categories_option = res;
                this.loading_select_category=false;
            }).catch(e => {
                return  this.NotifyServerError();

            })
        },
        Filter_Select_Category (val, update, abort) {
            update(() => {
                if (val){
                    this.categories_option =  this.categories_option.filter(item => {
                        return item.label !== null && item.label.match(val)
                    })
                }else {
                    this.Categories_Select();
                }
            })
        },
        Brand_Select(){
            this.loading_select_brand = true;
            this.BrandsSelect().then(res => {
                this.brands_option = res;
                this.loading_select_brand=false;
            }).catch(e => {
                return  this.NotifyServerError();

            })
        },
        Filter_Select_Brand (val, update, abort) {
            update(() => {
                if (val){
                    this.brands_option =  this.brands_option.filter(item => {
                        return item.label !== null && item.label.match(val)
                    })
                }else {
                    this.Brand_Select();
                }
            })
        }
    },
}
</script>

<style scoped>
.images-captions{
    padding: 4px 4px;
    cursor: pointer;
    background: rgba(19, 18, 18, 0.88);
}
</style>
