<template>
    <section class="">
        <div class="container">
            <div class="row">
                <!-- sidebar -->
                <div class="col-lg-3">
                    <!-- Toggle button -->
                    <button class="btn btn-outline-secondary mb-3 w-100 d-lg-none" type="button" data-mdb-toggle="collapse"
                        data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span>Show filter</span>
                    </button>
                    <!-- Collapsible wrapper -->

                    <form @submit.prevent="list">
                        <div class="collapse card d-lg-block mb-5" id="navbarSupportedContent">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <div class="col-12">
                                        <div class="input-group float-center">
                                            <div class="form-outline">
                                                <input v-model="search.title" type="search" id="search" class="form-control"
                                                    style="border: solid 1px #ddd ">
                                                <label class="form-label" for="search">Search Book Name</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary shadow-0">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>


                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                            Genre
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            <div class="">
                                                        <input v-model="search.genre" type="text"
                                                            class="form-control" placeholder="genre" />
                                                        <label class="form-label"></label>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                            Author
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            <div class="">
                                                        <input v-model="search.author" type="text"
                                                            class="form-control" placeholder="author" />
                                                        <label class="form-label"></label>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseThree"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            Date Published
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree">
                                        <div class="accordion-body">

                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        From
                                                    </p>
                                                    <div class="form-outline">
                                                        <input v-model="search.published_from" type="date"
                                                            class="form-control p-0" />
                                                        <label class="form-label"></label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        To
                                                    </p>
                                                    <div class="form-outline">
                                                        <input v-model="search.published_to" type="date"
                                                            class="form-control p-0" />
                                                        <label class="form-label"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-white w-100 border border-secondary">Apply
                                                Filters</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <!-- sidebar -->
                <!-- content -->
                <div class="col-lg-9">
                    <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
                        <strong v-if="books.hits && books.hits.length > 0" class="d-block py-2">{{ books.hits.length }}
                            Results(s) found </strong>
                        <div class="ms-auto">

                            <div v-if="$store.getters.getToken" class="btn-group shadow-0 border">
                                <router-link to="books" class="btn btn-light" title="List view"><i
                                        class="fa fa-bars fa-lg"></i></router-link>

                                <a :href="''" class="btn btn-light active" title="Grid view">
                                    <i class="fa fa-th fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </header>
                    <div v-if="books.hits && books.hits.length > 0" class="row">
                        <div v-for="(books, key) in books.hits" :key="key" class="col-lg-4 col-md-6 col-sm-6 d-flex">

                            <div class="card w-100 my-2 shadow-2-strong">
                                <img :src="'any.jfif'" class="card-img-top" />
                                <div class="card-body d-flex flex-column">

                                    <p class="card-text">
                                        <router-link :to='{ name: "book", params: { id: books._id } }'>{{
                                        books._source.title }} </router-link> <span class="badge badge-info badge-rounded">{{books._source.genre }}</span><br />
                                        <small class="text-muted"> Author: {{books._source.author }}</small><br/>
                                        <small class="text-muted"> Published: {{books._source.publishedAt }}</small>
                                        </p>
                                    <div class="card-footer d-flex justify-content-between align-items-end pt-3 px-0 pb-0 mt-auto">

                                        <router-link :to='{ name: "book", params: { id: books._id } }'
                                            :class="'btn btn-xs btn-primary'">Buy Now</router-link>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                    <i class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr />

                    <!-- Pagination -->
                    <nav v-if="books.pages > 0" aria-label="Page navigation example"
                        class="d-flex justify-content-center mt-3">
                        <ul class="pagination">
                            <li @click="list(books.current_page - 1)" class="page-item disabled" v-if="books.current_page > 1">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li @click="list(key+1)" v-for="(pages, key) in books.pages" :key="key" v-bind:class=" key+1 == books.current_page ? 'page-item active' : 'page-item'"><a class="page-link" :href="'#'">{{ key+1 }}</a></li>

                            <li @click="list(books.current_page + 1)" class="page-item" v-if="books.current_page < books.pages">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- Pagination -->
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
export default {
    name: "Welcome",

    setup() {
        return {
            search: {
                title: null,
                published_from: null,
                published_to: null,
                genre: null,
                author: null

            }
        }
    },
    data() {
        return {
            books: {
                type: Object,
                default: null
            },

        }
    },
    mounted() {
        this.list()
    },
    methods: {


        async list(page = 1) {
            // await axios.get(`/api/books?page=${page}${search}`).then(({ data }) => { USING POST FOR SAFE SEARCH
            await axios.post(`/api/books/list?page=${page}`, this.search).then(({ data }) => {
                console.log(data);
                this.books = data.hits;

                // PAGINATION
                this.books.pages = 0;
                this.books.current_page = page;
                this.books.total = data.hits.total.value;

                // if (data.hits.total.value > 10) {
                    this.books.pages = parseInt(this.books.total / 10); // page size
                // }

            }).catch(({ response }) => {
                console.log(response)
            })
        },




    }

}
</script>
