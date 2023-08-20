
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

    }



}
