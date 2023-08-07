import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        ProductsIndex(){
            return new Promise((resolve,reject) => {
                axios.get('products').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProductsStore(_,item){
            return new Promise((resolve,reject) => {
                axios.post('products',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProductsEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('products/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProductsDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('products/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProductsChangeActive(_,item){
            return new Promise((resolve,reject) => {
                axios.get('products/activation/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

    }

}
