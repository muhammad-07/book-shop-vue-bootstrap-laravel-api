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
                    {{ search }}
                    <form @submit.prevent="list">
                        <div class="collapse card d-lg-block mb-5" id="navbarSupportedContent">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <div class="col-12">
                                        <div class="input-group float-center">
                                            <div class="form-outline">
                                                <input v-model="search.title" type="search" id="search" class="form-control"
                                                    style="border: solid 1px #ddd ">
                                                <label class="form-label" for="search">Search</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary shadow-0">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <h2 class="accordion-header" id="headingOne">

                                        <!-- <button
                                    class="accordion-button text-dark bg-light"
                                    type="button"
                                    data-mdb-toggle="collapse"
                                    data-mdb-target="#panelsStayOpen-collapseOne"
                                    aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne"
                                    >
                            Related items
                            </button> -->
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne">
                                        <div class="accordion-body">
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="text-dark">Electronics </a></li>
                                                <li><a href="#" class="text-dark">Home items </a></li>
                                                <li><a href="#" class="text-dark">Books, Magazines </a></li>
                                                <li><a href="#" class="text-dark">Men's clothing </a></li>
                                                <li><a href="#" class="text-dark">Interiors items </a></li>
                                                <li><a href="#" class="text-dark">Underwears </a></li>
                                                <li><a href="#" class="text-dark">Shoes for men </a></li>
                                                <li><a href="#" class="text-dark">Accessories </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                            Brands
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            <div>
                                                <!-- Checked checkbox -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckChecked1" checked />
                                                    <label class="form-check-label" for="flexCheckChecked1">Mercedes</label>
                                                    <span class="badge badge-secondary float-end">120</span>
                                                </div>
                                                <!-- Checked checkbox -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckChecked2" checked />
                                                    <label class="form-check-label" for="flexCheckChecked2">Toyota</label>
                                                    <span class="badge badge-secondary float-end">15</span>
                                                </div>
                                                <!-- Checked checkbox -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckChecked3" checked />
                                                    <label class="form-check-label"
                                                        for="flexCheckChecked3">Mitsubishi</label>
                                                    <span class="badge badge-secondary float-end">35</span>
                                                </div>
                                                <!-- Checked checkbox -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckChecked4" checked />
                                                    <label class="form-check-label" for="flexCheckChecked4">Nissan</label>
                                                    <span class="badge badge-secondary float-end">89</span>
                                                </div>
                                                <!-- Default checkbox -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault" />
                                                    <label class="form-check-label" for="flexCheckDefault">Honda</label>
                                                    <span class="badge badge-secondary float-end">30</span>
                                                </div>
                                                <!-- Default checkbox -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault" />
                                                    <label class="form-check-label" for="flexCheckDefault">Suzuki</label>
                                                    <span class="badge badge-secondary float-end">30</span>
                                                </div>
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
                                                        <input v-model="search.published_from" type="date" class="form-control" />
                                                        <label class="form-label" ></label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">
                                                        To
                                                    </p>
                                                    <div class="form-outline">
                                                        <input v-model="search.published_to" type="date" class="form-control" />
                                                        <label class="form-label"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-white w-100 border border-secondary">Apply Filters</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseFour"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                            Size
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree">
                                        <div class="accordion-body">
                                            <input type="checkbox" class="btn-check border justify-content-center"
                                                id="btn-check1" checked autocomplete="off" />
                                            <label class="btn btn-white mb-1 px-1" style="width: 60px;"
                                                for="btn-check1">XS</label>
                                            <input type="checkbox" class="btn-check border justify-content-center"
                                                id="btn-check2" checked autocomplete="off" />
                                            <label class="btn btn-white mb-1 px-1" style="width: 60px;"
                                                for="btn-check2">SM</label>
                                            <input type="checkbox" class="btn-check border justify-content-center"
                                                id="btn-check3" checked autocomplete="off" />
                                            <label class="btn btn-white mb-1 px-1" style="width: 60px;"
                                                for="btn-check3">LG</label>
                                            <input type="checkbox" class="btn-check border justify-content-center"
                                                id="btn-check4" checked autocomplete="off" />
                                            <label class="btn btn-white mb-1 px-1" style="width: 60px;"
                                                for="btn-check4">XXL</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button text-dark bg-light" type="button"
                                            data-mdb-toggle="collapse" data-mdb-target="#panelsStayOpen-collapseFive"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                            Ratings
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree">
                                        <div class="accordion-body">
                                            <!-- Default checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" checked />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <i class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                </label>
                                            </div>
                                            <!-- Default checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" checked />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <i class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-secondary"></i>
                                                </label>
                                            </div>
                                            <!-- Default checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" checked />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <i class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-secondary"></i>
                                                    <i class="fas fa-star text-secondary"></i>
                                                </label>
                                            </div>
                                            <!-- Default checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" checked />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <i class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-warning"></i><i
                                                        class="fas fa-star text-secondary"></i><i
                                                        class="fas fa-star text-secondary"></i>
                                                    <i class="fas fa-star text-secondary"></i>
                                                </label>
                                            </div>
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
                        <strong v-if="books.data && books.data.length > 0" class="d-block py-2">{{books.data.length}} Results(s) found </strong>
                        <div class="ms-auto">
                            <select class="form-select d-inline-block w-auto border pt-1">
                                <option value="0">Best match</option>
                                <option value="1">Recommended</option>
                                <option value="2">High rated</option>
                                <option value="3">Randomly</option>
                            </select>
                            <div v-if="$store.getters.getToken" class="btn-group shadow-0 border">
                                <router-link to="books" class="btn btn-light" title="List view"><i
                                        class="fa fa-bars fa-lg"></i></router-link>
                                <!-- <a :href="'books'" class="btn btn-light" title="List view">
                <i class="fa fa-bars fa-lg"></i>
              </a> -->
                                <a :href="''" class="btn btn-light active" title="Grid view">
                                    <i class="fa fa-th fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </header>
                    <!-- "id": 15, "title": "I BEG your.", "author": "Alfonso Price", "isbn": "9797439600246", "publishedAt": "2020-01-05", "publisher": "Quo Et", "genre": "Voluptatem", "image": "http://placeimg.com/480/640/any", "description": "While the Duchess began in a court of justice before, but she was now about two feet high, and she tried to fancy what the next witness!' said the March Hare took the least notice of them with the.", "created_at": null, "updated_at": null -->
                    <div v-if="books.data && books.data.length > 0" class="row">
                        <div v-for="(books, key) in books.data" :key="key" class="col-lg-4 col-md-6 col-sm-6 d-flex">

                            <div class="card w-100 my-2 shadow-2-strong">
                                <img :src="'any.jfif'" class="card-img-top" />
                                <div class="card-body d-flex flex-column">
                                    <!-- <div class="d-flex flex-row">
                  <h5 class="mb-1 me-1">$34,50</h5>
                  <span class="text-muted">{{books.author}}</span>
                </div> -->
                                    <p class="card-text"><router-link :to='{ name: "book", params: { id: books.id } }'
                                            >{{ books.title }} </router-link><br /><small
                                            class="text-muted"> Author: {{ books.author }}</small> <span
                                            class="badge badge-info badge-rounded">{{ books.genre }}</span></p>
                                    <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">

                                        <router-link :to='{ name: "book", params: { id: books.id } }'
                                            :class="'btn btn-xs btn-primary'">Buy Now</router-link>
                                        <!-- <router-link :to='{ name: "bookEdit", params: { id: books.id } }'
                                                class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></router-link> -->
                                        <!-- <a href="#!" class="btn btn-light border icon-hover px-2 pt-2"><i class="fas fa-home fa-lg text-secondary px-1"></i>{{ books.genre }}</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr />

                    <!-- Pagination -->
                    <Bootstrap5Pagination align="center" :data="books" @pagination-change-page="list" />
                    <!-- Pagination -->
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
export default {
    name: "Welcome",
    components: {
        // axios
        Bootstrap5Pagination
    },
    setup() {
        return {
search: {
                title: null,
                published_from: null,
                published_to: null
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
            // await axios.get(`/api/books?page=${page}${search}`).then(({ data }) => { USING POST FOR MORE SECURE SEARCH
            await axios.post(`/api/books?page=${page}`, this.search).then(({ data }) => {
                console.log(data);
                this.books = data;

            }).catch(({ response }) => {
                console.log(response)
            })
        },




    }

}
</script>
