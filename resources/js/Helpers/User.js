import Token from './Token';
import AppStorage from './AppStorage';

class User {

    responseAfterLogin(response) {
        const access_token = response.data.access_token;
        const username = response.data.name;
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, username);
        }
    }

    hasToken() {
        const storeToken = localStorage.getItem('token');
        if (storeToken ) {
            return Token.isValid(storeToken) ? true : false;
        }
        false;
    }

    loggedIn() {
        return this.hasToken();
    }

    logout() {
        AppStorage.clear();
    }

    name() {
        if (this.loggedIn()) {
            return AppStorage.getUser();
        }
    }

    id() {
        if (this.loggedIn()) {
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }

        return false;
    }

}

export default User = new User();