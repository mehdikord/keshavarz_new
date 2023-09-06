import "../../../bootstrap";

export default {

    state : {},
    mutations: {},
    actions:{
        SliderIndex(){
            return new Promise((resolve,reject) => {
                axios.get('slider').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SliderStore(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.title){data.append('title',item.title)};
                if (item.image){data.append('image',item.image,item.image.name)};
                if (item.link){data.append('link',item.link)};
                axios.post('slider',data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SliderEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('slider/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SliderDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('slider/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SliderDeleteImage(_,item){
            return new Promise((resolve,reject) => {
                axios.post('slider/image/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        SliderEditImage(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.image){data.append('image',item.image,item.image.name)};
                axios.post('slider/image/'+item.id,data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },


    }

}
