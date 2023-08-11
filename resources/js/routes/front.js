import { createRouter, createWebHistory } from "vue-router";
import Front_Template from "../front/template/Front_Template.vue";
import Front_index from "../front/index/Front_index.vue";
import Front_Search from "@/front/search/Front_Search.vue";

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
