<script>
import {mapActions} from "vuex";

export default {
    name: "Manage_Users_Members_Edit",
    props:['data'],
    data(){
        return{
            user:{
                id:this.data.id,
                name:this.data.name,
                province_id:this.data.province_id,
                city_id:this.data.city_id,
                national_code:this.data.national_code,
                phone:this.data.phone,
            },
            loading:false,
            EditDialog:false,
            errors:[],
            provinces:[],
            provinces_select:[],
            cities_select:[],
        }

    },
    methods:{
        ...mapActions([
            "UserMembersEdit",

        ]),
        GetProvinces(){
            axios.get('helpers/provinces').then(res =>{
                this.provinces = res.data.result;
                this.provinces.forEach(province => {
                    this.provinces_select.push({label : province.name , value : province.id})
                })
            })
        },
        EditItem(){
            this.loading=true;
            this.UserMembersEdit(this.user).then(res => {
                this.loading=false;
                this.EditDialog=false;
                this.$emit('UpdateEditedItem',this.user)
                return this.NotifyUpdate();
            }).catch(error => {
                this.loading=false;
                if (error.response.status === 422) {
                    return this.errors = error.response.data
                }
                return  this.NotifyServerError();

            })
        },

    },
    computed:{
        GetCities(){

            if (this.provinces.length && this.user.province_id){
                let cities;
                this.provinces.forEach(province =>{
                    if (province.id === this.user.province_id){
                        cities = province.cities;
                    }
                })
                this.cities_select=[];
                cities.forEach(city => {
                    this.cities_select.push({label : city.name , value : city.id})
                })
            }
        },


    }
}
</script>

<template>

    <q-btn @click="this.GetProvinces() ; EditDialog = true;errors=[]" glossy color="primary" size="sm" icon="mdi-pen" class="q-mx-xs">
        <q-tooltip class="bg-grey-9">ویرایش آیتم</q-tooltip>
    </q-btn>
    <q-dialog
        v-model="EditDialog"
        transition-show="scale"
        transition-hide="scale"
        position="top"
    >
        <q-card style="max-width: 700px;width: 700px">
            <q-card-section class="bg-primary text-white">
                <strong>ویرایش آیتم : {{user.name}}</strong>
            </q-card-section>
            <q-card-section >

                <q-input v-model="user.name"  lazy-rules type="text" outlined label="نام" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'name')">
                    <template v-slot:error>
                        <Error_Validation :errors="this.MixinValidation(errors,'email')"></Error_Validation>
                    </template>
                </q-input>
                <q-input v-model="user.phone" lazy-rules type="number" outlined label="موبایل" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'phone')">
                    <template v-slot:error>
                        <Error_Validation :errors="this.MixinValidation(errors,'phone')"></Error_Validation>
                    </template>
                </q-input>
                <q-input v-model="user.national_code" lazy-rules type="number" outlined label="کد ملی" color="primary" class="q-my-xs" :error="this.MixinValidationCheck(errors,'national_code')">
                    <template v-slot:error>
                        <Error_Validation :errors="this.MixinValidation(errors,'national_code')"></Error_Validation>
                    </template>
                </q-input>
                <q-select
                    outlined
                    v-model="user.province_id"
                    class="q-my-xs"
                    color="primary"
                    transition-show="flip-up"
                    transition-hide="flip-down"
                    use-input
                    label="انتخاب استان"
                    :options="provinces_select"
                    emit-value
                    map-options
                    behavior="menu"
                    @change="GetCities"
                    :error="this.MixinValidationCheck(errors,'province_id')"
                >
                    <template v-slot:error>
                        <Error_Validation :errors="this.MixinValidation(errors,'province_id')"></Error_Validation>
                    </template>
                </q-select>
                <q-select
                    outlined
                    class="q-my-xs"
                    v-model="user.city_id"
                    color="primary"
                    transition-show="flip-up"
                    transition-hide="flip-down"
                    use-input
                    label="انتخاب شهر"
                    :options="cities_select"
                    emit-value
                    map-options
                    behavior="menu"
                    :error="this.MixinValidationCheck(errors,'city_id')"
                >
                    <template v-slot:error>
                        <Error_Validation :errors="this.MixinValidation(errors,'city_id')"></Error_Validation>
                    </template>
                </q-select>

            </q-card-section>

            <q-card-actions align="right">
                <q-btn  label="بستن" color="red" v-close-popup />
                <q-btn @click="EditItem" :loading="loading" label="ویرایش آیتم" color="indigo"/>
            </q-card-actions>
        </q-card>
    </q-dialog>

</template>

<style scoped>

</style>
