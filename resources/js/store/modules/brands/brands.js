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
        BrandsDeleteImage(_,item){
            return new Promise((resolve,reject) => {
                axios.post('brands/image/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        BrandsEditImage(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.image){data.append('image',item.image,item.image.name)};
                axios.post('brands/image/'+item.id,data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        BrandsSelect(){
            return new Promise((resolve,reject) => {
                axios.get('brands').then((result) => {
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
