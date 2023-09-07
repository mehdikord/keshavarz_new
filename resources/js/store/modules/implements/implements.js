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
        ImplementsShow(_,item){
            return new Promise((resolve,reject) => {
                axios.get('public/implements/implements/'+item).then((result) => {
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

        ManageImplementsIndex(){
            return new Promise((resolve,reject) => {
                axios.get('implements').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ManageImplementsStore(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.name){data.append('name',item.name)};
                if (item.price_type){data.append('price_type',item.price_type)};
                if (item.implement_category_id){data.append('implement_category_id',item.implement_category_id)};
                if (item.image){data.append('image',item.image,item.image.name)};
                if (item.description){data.append('description',item.description)};
                axios.post('implements',data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ManageImplementsEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('implements/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ManageImplementsDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('implements/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ManageImplementsDeleteImage(_,item){
            return new Promise((resolve,reject) => {
                axios.post('implements/image/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ManageImplementsEditImage(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.image){data.append('image',item.image,item.image.name)};
                axios.post('implements/image/'+item.id,data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

        ManageImplementsRequestsIndex(){
            return new Promise((resolve,reject) => {
                axios.get('implements/requests').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ManageImplementsRequestsDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('implements/requests/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },


        ManageImplementsForms(_,item){
            return new Promise((resolve,reject) => {

                axios.post('implements/form/'+item.id,{forms:item.forms}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ManageImplementsCategoriesSelectIndex(){
            return new Promise((resolve,reject) => {
                axios.get('implements/categories').then((result) => {

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
