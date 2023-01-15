import cartSession from './cartSession.js';
import axios from 'axios';

export default {
    Hash() {
        let hashCart = cartSession.cart();
        axios.post('/cart/check', { hash: hashCart }).then(Response => { console.log(Response) }).catch(error => { });
    }
}