import {createApp} from "vue";
import VuePersianDatetimePicker from 'vue3-persian-datetime-picker';


import Store from "./store";
import './bootstrap-front';
import Front from "./routes/front";
import Front_Template from "./front/template/Front_Template.vue";
import { Quasar , Notify,Dialog} from 'quasar';
import quasarIconSet from 'quasar/icon-set/fontawesome-v6';
import quasarLang from 'quasar/lang/fa-IR';
import 'quasar/dist/quasar.css';
import '@quasar/extras/fontawesome-v6/fontawesome-v6.css'
import {mapActions, mapGetters} from "vuex";
import Front_Global_Images_Categories from "./front/globals/Front_Global_Images_Categories.vue";
import Front_Global_Images_Implements from "./front/globals/Front_Global_Images_Implements.vue";
import Front_Global_Search_Loading from "./front/globals/Front_Global_Search_Loading.vue";
import Error_Validation from "./manage/errors/Error_Validation.vue";
import Helper from "./helpers/Helper";
import Front_Global_Info_Loading from "./front/globals/Front_Global_Info_Loading.vue";
import axios from "axios";
import moment from 'moment-jalaali';
import Front_Global_Images_Lands from "./front/globals/Front_Global_Images_Lands.vue";
import Num2persian from 'num2persian';
// import Front_Global_Map from "./front/globals/Front_Global_Map.vue";




const App=createApp(Front_Template);
App.use(Quasar, {
    plugins: {
        Notify,
        Dialog

    }, // import Quasar plugins and add here
    iconSet: quasarIconSet,
    lang: quasarLang,

    config: {

        brand: {

            // primary: '#e46262',
            // ... or all other brand colors
        },
        notify: {}, // default set of options for Notify Quasar plugin


    }
})

App.use(Store)
App.use(Front)


window.Helper = Helper

// ++++++++++ Global Components ++++++++++
App.component("global_image_categories",Front_Global_Images_Categories)
App.component("global_image_implements",Front_Global_Images_Implements)
App.component("global_image_lands",Front_Global_Images_Lands)
App.component("global_search_loading",Front_Global_Search_Loading)
App.component("global_info_loading",Front_Global_Info_Loading)
App.component('Error_Validation',Error_Validation)
// App.component('global_map',Front_Global_Map)
App.component("PersianDatePicker",VuePersianDatetimePicker)




// ++++++++++ Global Functions (Mixin) ++++++++++

App.mixin({
    beforeCreate() {
        this.$store.commit('AuthUserSync');

    },
    created() {
        axios.defaults.headers.common['Authorization'] ="Bearer "+this.UserToken





    },
    //Methods
    methods:{
        ...mapActions([
            "Auth_User_Logout"
        ]),
        NotifyMessage(message=null,type=null,icon=null,color=null){
            if (icon || color){
                this.$q.notify({
                    type: type,
                    message: message,
                    icon : icon,
                    color : color,
                    progress : true,
                    position: "top"
                });
            }else {
                this.$q.notify({
                    type: type,
                    iconSize:'md',
                    message: message,
                    progress : true,
                    position: "top"
                });
            }
        },

        NotifyCreate(){
            this.NotifyMessage('آیتم باموفقیت ایجاد شد','positive')
        },
        NotifyUpdate(){
            this.NotifyMessage('آیتم باموفقیت ویرایش شد','positive')
        },
        NotifyDelete(){
            this.NotifyMessage('آیتم باموفقیت حذف شد','positive')
        },
        NotifyServerError(){
            this.NotifyError('خطای سرور !');
        },
        NotifySuccess(message){
            this.NotifyMessage(message,'positive')
        },
        NotifyWarning(message){
            this.NotifyMessage(message,'warning')
        },
        NotifyError(message){
            this.NotifyMessage(message,'negative')
        },
        NotifyInfo(message){
            this.NotifyMessage(message,'','mdi-bell','indigo')
        },
        MixinValidation(errors,field){
            return Helper.HelperValidationErrors(errors,field);
        },
        MixinValidationCheck(errors,field){
            return Helper.HelperValidationCheck(errors,field);

        },
        MixinLeftDate(start,end){
          let a = moment(start);
          let b = moment(end);
          let now = moment();
          let total = b.diff(a,'days');
          let left = b.diff(now,'days');
          return {total:total,left:left};
        },

        AuthUserCheck(){
            return this.UserCheck;
        }
    },
    computed : {
        ...mapGetters({
            AuthToken : "AutManageToken",
            UserToken : "AutUserToken",
            UserCheck : "AuthUserCheck"
        })
    }


})

// ++++++++++++++++++++

// ++++++++++ Global Filters ++++++++++

App.config.globalProperties.$filters = {

    numtopersian(number){
        if (number){
            return Num2persian(number) + ' تومان';

        }
    },
    date(value,format) {
        return moment(value).format(format='jYYYY/jM/jD')
    },
    numbers(number){
        return new Intl.NumberFormat().format(number);
    },
    quantity_color(quantity){
        if (quantity >= 5){
            return "green";
        }else if (quantity < 5 && quantity >=3){
            return "yellow-9";
        }else {
            return "red";
        }
    },
    short_text(text,len = 20){
        var extra='';
        if (text.length > len){
            extra = "..."
        }
        return text.substring(0,len) + extra;
    },
    persianDigitsToEnglish(persianNumber) {
    const persianDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
    const englishDigits = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
    if (!persianNumber){
        return persianNumber;
    }
    const persianNumberStr = persianNumber.toString();
    let englishNumberStr = "";

    for (let i = 0; i < persianNumberStr.length; i++) {
        const digit = persianNumberStr[i];
        const digitIndex = persianDigits.indexOf(digit);

        if (digitIndex !== -1) {
            englishNumberStr += englishDigits[digitIndex];
        } else {
            englishNumberStr += digit;
        }
    }

    return englishNumberStr;
}
}




// ++++++++++++++++++++
App.mount('#app')
