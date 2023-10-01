import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        LandsUserIndex(){
            return new Promise((resolve,reject) => {
                axios.get('users/lands').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        LandsUserStore(_,item){
            return new Promise((resolve,reject) => {
                axios.post('faqs',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        LandsUserEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('faqs/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        LandsUserDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('faqs/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

    }

}
