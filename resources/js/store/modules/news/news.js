import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        NewsIndex(){
            return new Promise((resolve,reject) => {
                axios.get('news').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        NewsStore(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.title){data.append('title',item.title)};
                if (item.image){data.append('image',item.image,item.image.name)};
                if (item.link){data.append('link',item.link)};
                if (item.description){data.append('description',item.description)};
                axios.post('news',data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        NewsEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('news/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        NewsDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('news/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        NewsDeleteImage(_,item){
            return new Promise((resolve,reject) => {
                axios.post('news/image/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        NewsEditImage(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.image){data.append('image',item.image,item.image.name)};
                axios.post('news/image/'+item.id,data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },


    }

}
