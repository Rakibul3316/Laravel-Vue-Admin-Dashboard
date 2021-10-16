

class AppStorage {

    storeToken(token) {
        localStorage.setItem('token', token);
    }

    storeUser(user) {
        localStorage.setItem('user', user);
    }

    store(token, user) {
        // console.log('con form AppStorage', token, user)
        this.storeToken(token);
        this.storeUser(user);
    }

    clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
    }

    getToken() {
        localStorage.getItem('token');
    }

    getUser() {
        localStorage.getItem('user');
    }
}

export default AppStorage = new AppStorage();
