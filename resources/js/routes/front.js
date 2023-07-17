import { createRouter, createWebHistory } from "vue-router";
import Front_Index from "../front/index/Front_Index.vue";
import test from "../front/test.vue";

const routes = [
    {
        path : "/",
        name : "index",
        component : Front_Index,
    },
    {
        path : "/test",
        name : "test",
        component : test,
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
