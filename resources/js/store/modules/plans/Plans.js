
import axios from "axios"

export default {

    state : {},
    mutations: {},
    actions:{
        PlansStoreIndexCustomer(){
            return new Promise((resolve,reject) => {
                axios.get('public/plans/customer').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        PlansStoreIndexProvider(){
            return new Promise((resolve,reject) => {
                axios.get('public/plans/provider').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },


        UserPlanCustomerActive(){
            return new Promise((resolve,reject) => {
                axios.get('users/plans/customer/active').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        UserPlanProviderActive(){
            return new Promise((resolve,reject) => {
                axios.get('users/plans/provider/active').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        UserPlanCustomerReserved(){
            return new Promise((resolve,reject) => {
                axios.get('users/plans/customer/reserved').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        UserPlanProviderReserved(){
            return new Promise((resolve,reject) => {
                axios.get('users/plans/provider/reserved').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
    }



}
