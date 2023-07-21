import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        FaqsIndex(){
            return new Promise((resolve,reject) => {
                axios.get('faqs').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        FaqsStore(_,item){
            return new Promise((resolve,reject) => {
                axios.post('faqs',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        FaqsEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('faqs/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        FaqsDelete(_,item){
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
