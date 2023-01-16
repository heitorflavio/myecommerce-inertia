import cartSession from './cartSession.js';
import axios from 'axios';

export default {
    Hash() {
        let hashCart = cartSession.cart();
        axios.post('/cart/check', { hash: hashCart }).then(Response => { 
            let idCart = sessionStorage.getItem('cart');
            if (idCart == null) {
                let id = window.btoa(Response.data.id);
                sessionStorage.setItem('cart', id);
            }
        }).catch(error => {
             console.log(error);
          });
    }
}