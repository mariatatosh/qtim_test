import axios from 'axios';

class ApiService {
    constructor(service) {
        this.service = service;
    }

    #makeUrl(path) {
        return `http://localhost:8081/api/${this.service}/${path ? path + '/' : ''}`;
    }

    #assertMethod(method) {
        if (!['GET', 'POST', 'DELETE', 'PUT'].includes(method)) {
            throw new Error('Unexpected HTTP method');
        }
    }

    async request({ path=  '', method = 'POST', body = {}, params = {} }) {
        this.#assertMethod(method)

        const { data } = await axios.request({
            url: this.#makeUrl(path),
            method,
            data: body,
            params,
        });

        return data;
    }
}

export default ApiService;