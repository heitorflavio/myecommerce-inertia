export default {
    cart() {
        let session = localStorage.getItem('_cart');
        if (session !== null) {
            return session;
        } else {
            let newcart = new Date().getTime();
            newcart = window.btoa(newcart);
            localStorage.setItem('_cart', newcart);
            return newcart;

        }
    }
}
