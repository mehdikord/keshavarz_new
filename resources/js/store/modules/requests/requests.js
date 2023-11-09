import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        UserCustomerPending(){
            return new Promise((resolve,reject) => {
                axios.get('users/search/requests/pending').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

        UserCustomerWorking(){
            return new Promise((resolve,reject) => {
                axios.get('users/search/requests/working').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },


        UserProviderPending(){
            return new Promise((resolve,reject) => {
                axios.get('users/provider/requests/pending').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

        UserProviderWorking(){
            return new Promise((resolve,reject) => {
                axios.get('users/provider/requests/working').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserProviderSetDone(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/provider/requests/set-done/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserProviderRequestAccept(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/provider/requests/accept/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

        UserProviderRequestReject(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/provider/requests/reject/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

    }

}
