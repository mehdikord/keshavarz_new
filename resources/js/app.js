import {createApp} from "vue";
import router from "./routes/manage";
import show from "./manage/template/show.vue";
import { Quasar , Notify,Dialog} from 'quasar';
import quasarIconSet from 'quasar/icon-set/mdi-v7';
import quasarLang from 'quasar/lang/fa-IR'

// Import icon libraries
import '@quasar/extras/roboto-font/roboto-font.css';
import '@quasar/extras/fontawesome-v6/fontawesome-v6.css';
import { useQuasar } from 'quasar'
// ..required because of selected iconSet:
import '@quasar/extras/mdi-v7/mdi-v7.css';
// Import Quasar css
import 'quasar/dist/quasar.css';
import './bootstrap';
import Store from "./store";
import Helper from "./helpers/Helper";
import Error_Validation from "./manage/errors/Error_Validation.vue";
import {mapGetters} from "vuex";
import Manage_Global_Loading from "./manage/template/global/Manage_Global_Loading.vue";
import Manage_Global_Show_Image from "./manage/template/global/Manage_Global_Show_Image.vue";


const App=createApp(show);

// ++++++++++ Global Components ++++++++++

App.component('Error_Validation',Error_Validation)
App.component('Global_Loading',Manage_Global_Loading)
App.component('Global_Show_Image',Manage_Global_Show_Image)

// ++++++++++++++++++++

// ++++++++++ App Uses ++++++++++

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
App.use(router)
App.use(Store)
window.Helper = Helper

// ++++++++++++++++++++

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
