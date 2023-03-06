<template>
    <div class="row">
        <div v-if="$store.getters.getToken" class="col-12 mb-2 text-end">
            <router-link :to='{ name: "bookCreate" }' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Book List View</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="books.data && books.data.length > 0">
                                <tr v-for="(books, key) in books.data" :key="key">
                                    <td>{{ books.id }}</td>
                                    <td>{{ books.title }}</td>
                                    <td>{{ books.description }}</td>
                                    <td>

                                        <div class="btn-group" role="group">
                                            <router-link :to='{ name: "bookEdit", params: { id: books.id } }'
                                                class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></router-link>
                                            <button type="button" @click="deleteBook(books.id)"
                                                class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Books Found for you, Please login as admin to add some books.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Bootstrap5Pagination align="center" :data="books" @pagination-change-page="list" />

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import store from '../auth/state.js';
export default {
    name: "BookList",
    components: {
        // axios
        Bootstrap5Pagination
    },
    data() {
        return {
            books: {
                type: Object,
                default: null
            }
        }
    },
    mounted() {
        if(store.getters.getToken)
            this.list()
    },
    methods: {
        async list(page = 1) {
            await axios.get(`/api/books?page=${page}`).then(({ data }) => {
                this.books = data;

            }).catch(({ response }) => {
                console.log(response)
            })
        },

        deleteBook(id) {
            if (confirm("Are you sure to delete this book?")) {
                this.axios
                    .delete(`/api/books/${id}`)
                    .then(response => {
                        alert("Deleted successfully");
                        // HERE SAVING API REQUEST TO LIST DATA AGAIN BY JUST SPLICE DELETED RECORD
                        // this.list()
                        let i = this.books.data.map(data => data.id).indexOf(id);
                        this.books.data.splice(i, 1);
                    });
            }
        }
    }

}
</script>

<style scoped>
.pagination {
    margin-bottom: 0;
}
</style>
