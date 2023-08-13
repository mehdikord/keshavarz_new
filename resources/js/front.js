import {createApp} from "vue";
import Store from "./store";
import './bootstrap-front';
import Front from "./routes/front";
import Front_Template from "./front/template/Front_Template.vue";
import { Quasar , Notify,Dialog} from 'quasar';
import quasarIconSet from 'quasar/icon-set/fontawesome-v6';
import quasarLang from 'quasar/lang/fa-IR';
import 'quasar/dist/quasar.css';
import '@quasar/extras/fontawesome-v6/fontawesome-v6.css'
import  '@neshan-maps-platform/vue3-openlayers/dist/style.css'
import {mapGetters} from "vuex";
import Front_Global_Images_Categories from "./front/globals/Front_Global_Images_Categories.vue";
import Front_Global_Images_Implements from "./front/globals/Front_Global_Images_Implements.vue";
import Front_Global_Search_Loading from "./front/globals/Front_Global_Search_Loading.vue";



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

// ++++++++++ Global Components ++++++++++
App.component("global_image_categories",Front_Global_Images_Categories)
App.component("global_image_implements",Front_Global_Images_Implements)
App.component("global_search_loading",Front_Global_Search_Loading)




// ++++++++++ Global Functions (Mixin) ++++++++++

App.mixin({
    beforeCreate() {
        this.$store.commit('AuthManageSync');
    },
    created() {
        axios.defaults.headers.common['Authorization'] ="Bearer "+this.AuthToken

    },
    //Methods
    methods:{
        NotifyMessage(message=null,type=null,icon=null,color=null){
            if (icon || color){
                this.$q.notify({
                    type: type,
                    message: message,
                    icon : icon,
                    color : color,
                    progress : true,
                    position: "bottom"

                });
            }else {
                this.$q.notify({
                    type: type,
                    iconSize:'md',
                    message: message,
                    progress : true,
                    position: "bottom"
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
    },
    computed : {
        ...mapGetters({
            AuthToken : "AutManageToken",
        })
    }


})

// ++++++++++++++++++++

// ++++++++++ Global Filters ++++++++++

App.config.globalProperties.$filters = {
    // date(value,format) {
    //     return moment(value).format(format='jYYYY/jM/jD')
    // },
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
    }
}

// ++++++++++++++++++++


App.mount('#app')
