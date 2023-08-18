
import axios from "axios"

export default {

    state : {},
    mutations: {},
    actions:{
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
