import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        ImplementsIndex(){
            return new Promise((resolve,reject) => {
                axios.get('public/implements/implements').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ImplementsStore(_,item){
            return new Promise((resolve,reject) => {
                axios.post('faqs',item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ImplementsEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('faqs/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ImplementsDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('faqs/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

        ImplementsCategoriesIndex(){
            return new Promise((resolve,reject) => {
                axios.get('public/implements/categories').then((result) => {

                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ImplementsCategoriesSelectIndex(){
            return new Promise((resolve,reject) => {
                axios.get('public/implements/categories').then((result) => {

                    let data = [];
                    result.data.result.forEach(item => {
                        data.push({label : item.name , image:item.image , value : item.id})
                    })
                    resolve(data);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ImplementsSelectIndex(_,item){
            return new Promise((resolve,reject) => {
                if (!item){
                    item='';
                }
                axios.get('public/implements/implements?category='+item).then((result) => {
                    let data = [];
                    result.data.result.forEach(item => {
                        data.push({label : item.name , image:item.image , value : item.id})
                    })
                    resolve(data);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

    }

}
