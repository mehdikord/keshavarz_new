import { createRouter, createWebHistory } from "vue-router";
import Front_Template from "../front/template/Front_Template.vue";
import Front_index from "../front/index/Front_index.vue";
import Front_Search from "@/front/search/Front_Search.vue";
import Front_News from "@/front/news/Front_News.vue";
import Front_Provider_Profile from "@/front/provider/Front_Provider_Profile.vue";
import Front_Profile from "../front/profile/Front_Profile.vue";

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
        path : "/provider/:code",
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




]

const router = createRouter({
    history: createWebHistory(),
    routes : routes

})

router.beforeEach((to, from, next) => {
    // trying to access a restricted page + not logged in
    // redirect to login page

    next();

});

export default router
