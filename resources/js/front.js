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

App.mount('#app')
