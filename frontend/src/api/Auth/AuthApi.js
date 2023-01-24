import ApiService from '../ApiService';

class AuthApi extends ApiService {
    constructor() {
        super('auth');
    }

    async register(email, password) {
        return await this.request({
            path: 'register',
            body: {
                email,
                password
            },
        })
    }

    async login(email, password) {
        return await this.request({
            path: 'login',
            body: {
                email,
                password
            },
        });
    }
}

export default AuthApi;