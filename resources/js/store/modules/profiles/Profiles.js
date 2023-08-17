
import axios from "axios"

export default {

    state : {},
    mutations: {},
    actions:{
        ProfilesUserMe(){
            return new Promise((resolve,reject) => {
                axios.get('users/profile').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },


    }



}
