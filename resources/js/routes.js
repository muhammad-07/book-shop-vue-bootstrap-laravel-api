import {createWebHashHistory, createRouter } from 'vue-router';
import Welcome from './components/Welcome.vue'
import BookList from './components/BookList.vue'
import CreateBook from './components/CreateBook.vue'
import UpdateBook from './components/UpdateBook.vue'
import store from './auth/state.js'
// import Login from './auth/Login.vue';
// import Register from './auth/Register.vue';


const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'books',
        path: '/books',
        component: BookList
    },
    {
        name: 'bookEdit',
        path: '/books/:id/edit',
        component: UpdateBook,
        meta:{
            requireAuth: true
        }
    },
    {
        name: 'bookCreate',
        path: '/books/add',
        component: CreateBook,
        meta:{
            requireAuth: true
        }
    },
    // {
    //     name: 'register',
    //     path: '/register',
    //     component: Register
    // },
    // {
    //     name: 'login',
    //     path: '/login',
    //     component: Login
    // }
];
const router = createRouter({
    history: createWebHashHistory(),
    routes,
});
router.beforeEach((to, from) => {
    if(to.meta.requireAuth && !store.getters.getToken) {
        router.push('/');
    }

});
export default router;
