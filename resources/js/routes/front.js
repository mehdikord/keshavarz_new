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
        path : "/profile",
        name : "profile",
        component : Front_Profile,
        meta : {title : 'حساب کاربری'}
    },
    {
        path : "/profile/provider",
        name : "profile_provider",
        component : Front_Profile_Provider,
        meta : {title : 'ارائه خدمات'}
    },
    {
        path : "/plans",
        name : "plans",
        component : Front_Plans_Store,
        meta : {title : 'خرید اشتراک'}
    },
    {
        path : "/plans/pay/result",
        name : "plans_pay_result",
        component :Front_Plans_Result,
        meta : {title : 'خرید اشتراک'}
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
