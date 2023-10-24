import {createStore} from "vuex";
import managers from "./modules/users/managers";
import members from "./modules/users/members";
import faqs from "./modules/faqs/faqs";
import brands from "./modules/brands/brands";
import categories from "./modules/categories/categories";
import products from "./modules/products/products";
import implement from "./modules/implements/implements";
import profiles from "./modules/profiles/Profiles";
import plans from "./modules/plans/Plans";
import search from "./modules/search/Search";
import forms from "./modules/forms/forms";
import slider from "./modules/slider/slider";
import news from "./modules/news/news";
import invoices from "./modules/invoices/Invoices";
import lands from "./modules/lands/lands";
import requests from "./modules/requests/requests";
const store = createStore({
    state(){
        return {
            Auth_Manage : [],
            Auth_User : [],

        }
    },

    modules:{
        managers,
        members,
        faqs,
        brands,
        categories,
        products,
        implement,
        profiles,
        plans,
        search,
        forms,
        slider,
        news,
        invoices,
        lands,
        requests

    },

    mutations : {
        AuthManageLogin(state,item){
            state.Auth_Manage = item
            localStorage.setItem('manage_auth_token',item.access_token)
            localStorage.setItem('manage_auth_user',JSON.stringify(item.user))
        },
        AuthLogout(state){
            state.Auth_Manage = {}
            localStorage.removeItem('manage_auth_token')
            localStorage.removeItem('manage_auth_user')
        },
        AuthManageSync(state){
            if (localStorage.getItem('manage_auth_token') && localStorage.getItem('manage_auth_user')){
                var item;
                item = {
                    token : localStorage.getItem('manage_auth_token'),
                    user : JSON.parse(localStorage.getItem('manage_auth_user')),
                }
                state.Auth_Manage = item
            }
        },

        AuthUserSync(state){
            if (localStorage.getItem('user_auth_token') && localStorage.getItem('user_auth_user')){
                var item;
                item = {
                    token : localStorage.getItem('user_auth_token'),
                    user : JSON.parse(localStorage.getItem('user_auth_user')),
                }
                state.Auth_User = item
            }
        },
        AuthUserLogin(state,item){
            state.Auth_User = item
            localStorage.setItem('user_auth_token',item.token)
            localStorage.setItem('user_auth_user',JSON.stringify(item.user))
        },
        AuthUserLogout(state,item){
            state.Auth_User = {}
            localStorage.removeItem('user_auth_token')
            localStorage.removeItem('user_auth_user')
        }



    },
    getters : {
        AuthManageCheck : state => {
            return !!state.Auth_Manage.token;
        },
        AuthManageUser : state => {
            return state.Auth_Manage.user;
        },
        AutManageToken : state => {
            return state.Auth_Manage.token;
        },
        AuthUserCheck : state => {
            return !!state.Auth_User.token;
        },
        AuthUserUser : state => {
            return state.Auth_User.user;
        },
        AutUserToken : state => {
            return state.Auth_User.token;
        },

    },
    actions : {
        Auth_Manage_Login(state,item){
            state.commit('AuthManageLogin',item)
        },
        Auth_Manage_Logout(state){
            state.commit('AuthLogout')
        },
        Auth_User_Login(state,item){
            state.commit('AuthUserLogin',item)
        },
        Auth_User_Logout(state){
            state.commit('AuthUserLogout')
        },

    }
});

export default store
