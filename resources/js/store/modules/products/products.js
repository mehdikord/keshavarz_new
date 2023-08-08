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
        ProductsImagesIndex(_,item){
            return new Promise((resolve,reject) => {
                axios.get('products/'+item+'/images').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProductsImagesStore(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.image){data.append('image',item.image,item.image.name)};
                axios.post('products/'+item.id+"/images",data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProductsImagesDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('products/'+item.id+"/images/"+item.image).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },


    }

}
