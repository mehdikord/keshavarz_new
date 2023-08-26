
import axios from "axios"

export default {

    state : {},
    mutations: {},
    actions:{
        SearchStart(){
            return new Promise((resolve,reject) => {
                axios.get('users/search/providers').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },

    }



}
