import ApiService from '../ApiService';

class PostApi extends ApiService {
    constructor() {
        super('user/posts');
    }

    async list() {
        return await this.request({
            method: 'GET',
        });
    }

    async create({ title, content, image = null }) {
        return await this.request({
           body: {
               title,
               content,
               image,
           },
        });
    }
}

export default PostApi;