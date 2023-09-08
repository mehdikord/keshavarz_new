import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
       FormsIndex(){
            return new Promise((resolve,reject) => {
                axios.get('implements/forms').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
       FormsStore(_,item){
            return new Promise((resolve,reject) => {
                axios.post('implements/forms',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
       FormsEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('implements/forms/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
       FormsDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('implements/forms/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

    }

}
