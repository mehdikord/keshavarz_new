
import axios from "axios"

export default {

    state : {},
    mutations: {},
    actions:{
        ProfilesUserMe(){
            return new Promise((resolve,reject) => {
                axios.get('users/profile').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        ProfilesUserUpdate(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/profile',item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfilesUserRangeUpdate(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/provider/range',item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfilesUserUpdateImage(_,item){
            return new Promise((resolve,reject) => {
                let data = new FormData();
                if (item){
                    data.append('image',item,item.name);
                }
                axios.post('users/profile/image',data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfileUserUpdateStorage(){
            axios.get('users/profile').then(res => {
                let item = res.data.result
                if (item){
                    let user = {
                        id:item.id,
                        name:item.name,
                        email:item.email,
                        profile:item.profile,
                        phone:item.phone,
                        is_active:item.is_active,
                    }
                    localStorage.setItem('user_auth_user',JSON.stringify(user))
                }

            })

        },
        ProfilesUserImplementStore(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/provider/implement',item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfilesUserImplement(){
            return new Promise((resolve,reject) => {
                axios.get('users/provider/implement').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfilesUserGallery(){
            return new Promise((resolve,reject) => {
                axios.get('users/gallery').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfilesUserDays(){
            return new Promise((resolve,reject) => {
                axios.get('users/provider/days').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfilesUserGalleryStore(_,item){
            return new Promise((resolve,reject) => {
                let data = new  FormData();
                if (item.image){data.append('image',item.image,item.image.name)};
                axios.post('users/gallery',data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfilesUserGalleryDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('users/gallery/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfilesUserImplementDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('users/provider/implement/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfilesUserImplementUpdate(_,item){
            return new Promise((resolve,reject) => {
                axios.post('users/provider/implement/edit/'+item.id,{price:item.price}).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        ProfilesUserImplementRequest(_,item){
            return new Promise((resolve,reject) => {
                let data = new  FormData();
                if (item.type){data.append('type',item.type)};
                if (item.name){data.append('name',item.name)};
                if (item.description){data.append('description',item.description)};
                if (item.image){data.append('image',item.image,item.image.name)};
                axios.post('users/provider/implement/requests',data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },


    }



}
