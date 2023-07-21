import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        UserManagersIndex(){
            return new Promise((resolve,reject) => {
                axios.get('users/managers').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserManagersStore(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/managers',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserManagersEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/managers/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        UserManagersDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('users/managers/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

    }

}
