import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './pages/Home';
import About from './pages/About';
import Blog from './pages/Blog';
import SinglePost from './pages/SinglePost';
import NotFound from './pages/NotFound';

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: { title: 'Home' }
        },
        {
            path: '/about',
            name: 'about',
            component: About,
            meta: { title: 'About' }
        },
        {
            path: '/blog',
            name: 'blog',
            component: Blog,
            meta: { title: 'Blog' }
        },
        {
            path: '/blog/:slug',
            name: 'single-post',
            component: SinglePost,
            meta: { title: 'Post' }
        },
        {
            path: '*',
            name: 'not-found',
            component: NotFound
        }
    ]
});

export default router;