
import axios from "axios"

export default {

    state : {},
    mutations: {},
    actions:{

        PlansProviderIndex(){
            return new Promise((resolve,reject) => {
                axios.get('plans/providers').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansProviderStore(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.title){data.append('title',item.title)};
                if (item.image){data.append('image',item.image,item.image.name)};
                if (item.price){data.append('price',item.price)};
                if (item.sale){data.append('sale',item.sale)};
                if (item.subtitle){data.append('subtitle',item.subtitle)};
                if (item.access){data.append('access',item.access)};
                data.append('is_free',item.is_free);
                axios.post('plans/providers',data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansProviderEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('plans/providers/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansProviderDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('plans/providers/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansProviderDeleteImage(_,item){
            return new Promise((resolve,reject) => {
                axios.post('plans/providers/image/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansProviderEditImage(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.image){data.append('image',item.image,item.image.name)};
                axios.post('plans/providers/image/'+item.id,data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlanProviderChangeActive(_,item){
            return new Promise((resolve,reject) => {
                axios.get('plans/providers/activation/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },

        PlansCustomerIndex(){
            return new Promise((resolve,reject) => {
                axios.get('plans/customers').then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansCustomerStore(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.title){data.append('title',item.title)};
                if (item.image){data.append('image',item.image,item.image.name)};
                if (item.price){data.append('price',item.price)};
                if (item.sale){data.append('sale',item.sale)};
                if (item.subtitle){data.append('subtitle',item.subtitle)};
                if (item.access){data.append('access',item.access)};
                data.append('is_free',item.is_free);
                axios.post('plans/customers',data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansCustomerEdit(_,item){
            return new Promise((resolve,reject) => {
                axios.post('plans/customers/'+item.id,item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansCustomerDelete(_,item){
            return new Promise((resolve,reject) => {
                axios.delete('plans/customers/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansCustomerDeleteImage(_,item){
            return new Promise((resolve,reject) => {
                axios.post('plans/customers/image/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansCustomerEditImage(_,item){
            return new Promise((resolve,reject) => {
                var data = new  FormData();
                if (item.image){data.append('image',item.image,item.image.name)};
                axios.post('plans/customers/image/'+item.id,data,{headers: {'Content-Type': 'multipart/form-data'}}).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlanCustomerChangeActive(_,item){
            return new Promise((resolve,reject) => {
                axios.get('plans/customers/activation/'+item).then((result) => {
                    resolve(result);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansCustomerSelection(){
            return new Promise((resolve,reject) => {
                axios.get('plans/customers').then((result) => {
                    let data=[];
                    result.data.result.forEach(item => {
                        data.push({label:item.title,value:item.id});
                    })
                    resolve(data);
                }).catch(error => {
                    reject(error);
                })
            } )
        },
        PlansProviderSelection(){
            return new Promise((resolve,reject) => {
                axios.get('plans/providers').then((result) => {
                    let data=[];
                    result.data.result.forEach(item => {
                        data.push({label:item.title,value:item.id});
                    })
                    resolve(data);
                }).catch(error => {
                    reject(error);
                })
            } )
        },





        PlansStoreIndexCustomer(){
            return new Promise((resolve,reject) => {
                axios.get('public/plans/customer').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        PlansStoreIndexProvider(){
            return new Promise((resolve,reject) => {
                axios.get('public/plans/provider').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },


        UserPlanCustomerActive(){
            return new Promise((resolve,reject) => {
                axios.get('users/plans/customer/active').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        UserPlanProviderActive(){
            return new Promise((resolve,reject) => {
                axios.get('users/plans/provider/active').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        UserPlanCustomerReserved(){
            return new Promise((resolve,reject) => {
                axios.get('users/plans/customer/reserved').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        UserPlanProviderReserved(){
            return new Promise((resolve,reject) => {
                axios.get('users/plans/provider/reserved').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
    }



}
