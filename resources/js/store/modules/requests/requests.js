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

    }

}
