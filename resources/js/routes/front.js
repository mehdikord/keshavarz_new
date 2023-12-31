import { createRouter, createWebHistory } from "vue-router";
import Front_Template from "../front/template/Front_Template.vue";
import Front_index from "../front/index/Front_index.vue";
import Front_Search from "@/front/search/Front_Search.vue";
import Front_News from "@/front/news/Front_News.vue";
import Front_Provider_Profile from "@/front/provider/Front_Provider_Profile.vue";
import Front_Profile from "../front/profile/Front_Profile.vue";
import Front_Plans_Store from "../front/plans/Front_Plans_Store.vue";
import Front_Profile_Provider from "@/front/profile/Front_Profile_Provider.vue";
import Front_Plans_Result from "../front/plans/result/Front_Plans_Result.vue";
import Front_Page_About from "../front/pages/Front_Page_About.vue";
import Front_Page_Contact from "../front/pages/Front_Page_Contact.vue";
import Front_Page_Services from "../front/pages/Front_Page_Services.vue";
import Front_Page_Faq from "../front/pages/Front_Page_Faq.vue";
import Front_Implement_Request from "../front/implement/Front_Implement_Request.vue";
import Front_Lands from "../front/lands/Front_Lands.vue";
import Front_Profile_Provider_Range from "../front/profile/provider/Front_Profile_Provider_Range.vue";
import Front_Profile_Provider_Implements from "../front/profile/provider/Front_Profile_Provider_Implements.vue";
import Front_Profile_Provider_Days from "../front/profile/provider/Front_Profile_Provider_Days.vue";
import Front_Profile_Provider_Gallery from "../front/profile/provider/Front_Profile_Provider_Gallery.vue";

const routes = [
    {
        path : "/",
        name : "index",
        component : Front_index,
        meta : {title : 'صفحه اصلی'}
    },
    {
        path : "/search",
        name : "search",
        component : Front_Search,
        meta : {title : 'جستجو خدمات'}
    },
    {
        path : "/provider/:id",
        name : "provider_profile",
        component : Front_Provider_Profile,
        meta : {title : 'پروفایل خدمات دهنده'}
    },
    {
        path : "/news",
        name : "news",
        component : Front_News,
        meta : {title : 'اخبار کشاورزی'}
    },
    {
        path : "/plans",
        name : "plans",
        component : Front_Plans_Store,
        meta : {title : 'خرید اشتراک'}
    },

    {
        path : "/pages/about",
        name : "pages_about",
        component :Front_Page_About,
        meta : {title : 'درباره کشاورز '}
    },
    {
        path : "/pages/contact",
        name : "pages_contact",
        component :Front_Page_Contact,
        meta : {title : 'تماس با ما '}
    },
    {
        path : "/pages/services",
        name : "pages_services",
        component :Front_Page_Services,
        meta : {title : 'خدمات کشاورز '}
    },
    {
        path : "/pages/faqs",
        name : "pages_faqs",
        component :Front_Page_Faq,
        meta : {title : 'سوالات متداول '}
    },
    {
        path : "/implements/request",
        name : "implements_request",
        component :Front_Implement_Request,
        meta : {title : 'درخواست ثبت ادوات '}
    },
    {
        path : "/plans/pay/result",
        name : "payment_result",
        component :Front_Plans_Result,
        meta : {title : 'نتیجه پرداخت '}
    },

    {
        path : "/profile",
        name : "profile",
        component : Front_Profile,
        meta : {title : 'حساب کاربری'}
    },
    {
        path : "/lands",
        name : "lands",
        component : Front_Lands,
        meta : {title : 'زمین های من'}
    },
    {
        path : "/profile/provider",
        name : "profile_provider",
        component : Front_Profile_Provider,
        meta : {title : 'ارائه خدمات'}
    },
    {
        path : "/profile/provider/range",
        name : "profile_provider_range",
        component : Front_Profile_Provider_Range,
        meta : {title : 'تنظیمات موقعیت جغرافیایی و محدوده فعالیت'}
    },
    {
        path : "/profile/provider/implements",
        name : "profile_provider_implements",
        component : Front_Profile_Provider_Implements,
        meta : {title : 'تنظیمات اداوت قابل ارائه'}
    },
    {
        path : "/profile/provider/days",
        name : "profile_provider_days",
        component : Front_Profile_Provider_Days,
        meta : {title : 'تنظیمات روز های تعطلیل'}
    },
    {
        path : "/profile/provider/gallery",
        name : "profile_provider_gallery",
        component : Front_Profile_Provider_Gallery,
        meta : {title : 'تنظیمات گالری تصاویر'}
    },


]

const router = createRouter({
    history: createWebHistory(),
    routes : routes

})

router.beforeEach((to, from, next) => {
    // trying to access a restricted page + not logged in
    // redirect to login page
    setTimeout(() => {
        window.scrollTo(0, 0);
    }, 1);
    next();

});

export default router
