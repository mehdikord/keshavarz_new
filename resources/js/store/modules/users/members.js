import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        UserMembersIndex(){
            return new Promise((resolve,reject) => {
                axios.get('users/members').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserMembersStore(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/members',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserMembersEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/members/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserMembersDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('users/members/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserMembersDChangeStatus(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/members/activation/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserMembersShow(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/members/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )

        },
        UserMembersActiveCustomer(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/members/active/customer/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )

        },
        UserMembersActiveProvider(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/members/active/provider/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )

        },
        UserMembersInvoices(_,item){
            return new Promise((resolve,reject) => {
                axios.get('users/members/invoices/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )

        },
        UserMembersInvoicesCreate(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/members/invoices/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )

        },

    }

}
