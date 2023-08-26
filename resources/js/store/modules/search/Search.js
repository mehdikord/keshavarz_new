
import axios from "axios"

export default {

    state : {},
    mutations: {},
    actions:{
        SearchStart(_,items){
            return new Promise((resolve,reject) => {
                axios.post('users/search/providers',items).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },

    }



}
