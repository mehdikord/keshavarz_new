import { createRouter, createWebHistory } from "vue-router";
import Manage_Dashboard from "../manage/pages/dashboard/Manage_Dashboard.vue";
import Manage_Auth from "../manage/pages/auth/Manage_Auth.vue";
import store from "../store"
import Manage_Users_Managers from "@/manage/pages/users/Manage_Users_Managers.vue";
import Manage_Users_Members from "../manage/pages/users/Manage_Users_Members.vue";
import Manage_Faqs from "@/manage/pages/faqs/Manage_Faqs.vue";
import Manage_Brands from "../manage/pages/brands/Manage_Brands.vue";
import Manage_Categories from "../manage/pages/categories/Manage_Categories.vue";
import Manage_Products from "../manage/pages/products/Manage_Products.vue";
import Manage_Implement_Categories from "@/manage/pages/implements/Manage_Implement_Categories.vue";
import Manage_Implements from "@/manage/pages/implements/Manage_Implements.vue";
import Manage_Implement_Forms from "../manage/pages/implements/Manage_Implement_Forms.vue";
import Manage_Slider from "../manage/pages/slider/Manage_Slider.vue";
import Manage_Contacts from "../manage/pages/contacts/Manage_Contacts.vue";
import Manage_News from "../manage/pages/news/Manage_News.vue";

const routes = [

    {
        path : "/management/login",
        name : "login",
        component : Manage_Auth,
        meta : { title : "ورود مدیران"}
    },
    {
        path : "/management/dashboard",
        name : "dashboard",
        component : Manage_Dashboard,
        meta : { title : "داشبورد مدیریت"}
    },
    {
        path : "/management/users/managers",
        name : "users_managers",
        component : Manage_Users_Managers,
        meta : { title : "مدیران سیستم"}
    },
    {
        path : "/management/implements/categories",
        name : "implements_categories",
        component : Manage_Implement_Categories,
        meta : { title : "دسته بندی های ادوات"}
    },
    {
        path : "/management/implements",
        name : "implements",
        component :Manage_Implements,
        meta : { title : "مدیریت ادوات"}
    },
    {
        path : "/management/implements/forms",
        name : "implements_forms",
        component : Manage_Implement_Forms,
        meta : { title : "فرم های ادوات"}
    },
    {
        path : "/management/brands",
        name : "brands",
        component : Manage_Brands,
        meta : { title : "برند ها"}
    },
    {
        path : "/management/categories",
        name : "categories",
        component : Manage_Categories ,
        meta : { title : "دسته بندی ها"}
    },

    {
        path : "/management/products",
        name : "products",
        component : Manage_Products ,
        meta : { title : "محصولات"}
    },
    {
        path : "/management/users/members",
        name : "users_members",
        component : Manage_Users_Members,
        meta : { title : "مشتریان فروشگاه"}
    },
    {
        path : "/management/news",
        name : "news",
        component : Manage_News,
        meta : { title : " خبر ها"}
    },
    {
        path : "/management/slider",
        name : "slider",
        component : Manage_Slider,
        meta : { title : " تنظیمات اسلایدر"}
    },
    {
        path : "/management/contacts",
        name : "contacts",
        component : Manage_Contacts,
        meta : { title : " پیام ها"}
    },
    {
        path : "/management/faqs",
        name : "faqs",
        component : Manage_Faqs,
        meta : { title : "سوالات متداول"}
    },

]


const router = createRouter({
    history: createWebHistory(),
    routes : routes

})

router.beforeEach((to, from, next) => {
    // trying to access a restricted page + not logged in
    // redirect to login page


    if (to.path !== '/management/login' && !store.getters.AuthManageCheck) {
        next('/management/login');
    }else if (to.path === '/management/login' && store.getters.AuthManageCheck){
        next('/management/dashboard');
    }
    else {
        next();
    }

});

export default router
