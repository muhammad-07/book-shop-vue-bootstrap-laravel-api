import {createWebHashHistory, createRouter } from 'vue-router';
import Welcome from './components/Welcome.vue'
import BookList from './components/BookList.vue'
import CreateBook from './components/CreateBook.vue'
import UpdateBook from './components/UpdateBook.vue'
import BookSingle from './components/Single.vue';
import store from './auth/state.js'
// import Login from './auth/Login.vue';
// import Register from './auth/Register.vue';

// let home_route = {
//     name: 'home',
//     path: '/',
//     component: (!store.getters.getToken ? Welcome : BookList)
// };

const routes = [
    {
        name: 'home',
        path: '/',
        component: store.getters.getHome
        // component: store.getters.getToken != null ? BookList : Welcome
    },
    // home_route,
    {
        name: 'books',
        path: '/books',
        component: BookList
    },
    {
        name: 'book',
        path: '/books/:id',
        component: BookSingle
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
    //     path: '/github',
    //     beforeEnter() {location.href = 'http://github.com'},

    // }
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
    alert(router.currentRoute.value.name);
    if(to.meta.requireAuth && !store.getters.getToken) {
        router.push('/');
    }


});
export default router;
