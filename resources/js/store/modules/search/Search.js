
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
                    reject(error);
                })
            } )
        },
        SearchDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('searches/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SearchStart(_,items){
            return new Promise((resolve,reject) => {
                axios.post('users/search/providers',items).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SearchProviderProfile(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/search/providers/profile/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SearchProviderGallery(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/search/providers/gallery/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SearchProviderRequestSend(_,items){
            return new Promise((resolve,reject) => {
                axios.post('users/search/requests',items).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SearchProviderRequestUsers(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/search/requests/users/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        SearchProviderRequestCancel(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('users/search/requests/cancel/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },



    }



}
