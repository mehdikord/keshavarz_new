import { createRouter, createWebHistory } from "vue-router";
import Front_Index from "../front/index/Front_Index.vue";
import test from "../front/test.vue";
import Front_Shop_Index from "../front/shop/Front_Shop_Index.vue";

const routes = [
    {
        path : "/",
        name : "index",
        component : Front_Index,
    },
    {
        path : "/shop",
        name : "shop",
        component : Front_Shop_Index,
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
