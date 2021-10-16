import { takeWhile } from "lodash";
import AppStorage from "./AppStorage";
import Token from "./Token";


class User {


    responseAfterLogin(res) {
        // console.log('con from User >>', res.data);
        const access_token = res.data.access_token;
        const username = res.data.name;

        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, username);
        }
    }

    hasToken() {
        const storeToken = localStorage.getItem('token');
        // console.log(storeToken);
        if (storeToken) {
            return Token.isValid(storeToken) ? true : false;
        }
        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    userName() {
        if (this.loggedIn()) {
            return localStorage.getItem('user');
        }
    }

    userId() {
        if (this.loggedIn()) {
            const payload = Token.payload(localStorage.getItem('token'));
            return payload.sub;
        }
        return false;
    }

}

export default User = new User();