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

        UserProviderRequestAccept(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/provider/requests/accept/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

    }

}
