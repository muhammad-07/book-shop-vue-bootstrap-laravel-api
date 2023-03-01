import Welcome from './components/Welcome.vue'
import BookList from './components/BookList.vue'
import CreateBook from './components/CreateBook.vue'
import UpdateBook from './components/UpdateBook.vue'

export const routes = [
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
        component: UpdateBook
    },
    {
        name: 'bookCreate',
        path: '/books/add',
        component: CreateBook
    }
];
