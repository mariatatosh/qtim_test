import Home from '@/views/Home/Home.vue';

import PostCreate from '@/views/Post/PostCreate.vue';
import PostList from '@/views/Post/PostList.vue';

import Register from '@/views/Auth/Register.vue';
import Login from '@/views/Auth/Login.vue';

export default [
    {
        path: '/',
        component: Home,
        name: 'home',
    },
    {
        path: '/posts',
        component: PostList,
        name: 'posts.list',
    },
    {
        path: '/posts/create',
        component: PostCreate,
        name: 'posts.create',
    },
    {
        path: '/auth/register',
        component: Register,
        name: 'auth.register',
    },
    {
        path: '/auth/login',
        component: Login,
        name: 'auth.login',
    }
];