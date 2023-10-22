
import axios from "axios"

export default {

    state : {},
    mutations: {},
    actions:{
        SearchIndex(){
            return new Promise((resolve,reject) => {
                axios.get('searches').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        SearchDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('searches/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        SearchStart(_,items){
            return new Promise((resolve,reject) => {
                axios.post('users/search/providers',items).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        SearchProviderProfile(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/search/providers/profile/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        SearchProviderGallery(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/search/providers/gallery/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        SearchProviderRequestSend(_,items){
            return new Promise((resolve,reject) => {
                axios.post('users/search/providers/request',items).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SearchProviderRequestUsers(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/search/providers/request/users/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },



    }



}
