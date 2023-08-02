import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        BrandsIndex(){
            return new Promise((resolve,reject) => {
                axios.get('brands').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        BrandsStore(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.name){data.append('name',item.name)};
                if (item.image){data.append('image',item.image,item.image.name)};
                if (item.description){data.append('description',item.description)};
                axios.post('brands',data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        BrandsEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('brands/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        BrandsDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('brands/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

    }

}
