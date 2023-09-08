
import axios from "axios"

export default {

    state : {},
    mutations: {},
    actions:{
        InvoicesIndex(){
            return new Promise((resolve,reject) => {
                axios.get('invoices').then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },
        InvoicesChangePay(_,item){
            return new Promise((resolve,reject) => {
                axios.get('invoices/change/pay/'+item).then((result ) => {
                    resolve(result);
                }).catch(error => {
                    reject();
                })
            } )
        },


    }



}
