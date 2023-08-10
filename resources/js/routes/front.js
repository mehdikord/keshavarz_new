import { createRouter, createWebHistory } from "vue-router";
import Front_Template from "../front/template/Front_Template.vue";

const routes = [
    {
        path : "/",
        name : "index",
        component : Front_Template,
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
