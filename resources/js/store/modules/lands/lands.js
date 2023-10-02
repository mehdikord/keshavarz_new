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
                let data = new  FormData();
                if (item.title){data.append('title',item.title)}
                if (item.area){data.append('area',item.area)}
                if (item.location){data.append('location',item.location)}
                if (item.image){data.append('image',item.image,item.image.name)}

                axios.post('users/lands',data).then((result) => {
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
                axios.delete('users/lands/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

    }

}
