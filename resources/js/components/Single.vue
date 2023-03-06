<template>
    <section class="">
        <div class="container">
            <div class="row justify-content-center">

                <!-- content -->
                <div class="col-lg-8">
                    <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
                        <strong v-if="book.title" class="d-block py-2">{{ book.title }} </strong>

                    </header>
                    <div v-if="book.title" class="row">
                        <div class="col-lg-12 d-flex">

                            <div class="card w-100 my-2 shadow-2-strong">
                                <div class="d-flex">
                                    <div class="col-lg-6">
                                        <img :src="'any.jfif'" class="card-img-top" />
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-body d-flex flex-column">

                                            <p class="card-text">{{ book.title }} <br /><small class="text-muted"> Author:
                                                    {{ book.author }}</small> <span
                                                    class="badge badge-info badge-rounded">{{
                                                        book.genre }}</span><br />
                                                <small class="text-muted"> Published: {{ book.publishedAt }}</small>
                                            </p>
                                            {{ book.description }}

                                            <div class="card-footer d-flex justify-content-between align-items-end pt-3 px-0 pb-0 mt-auto">
                                                <a href="#" class="btn btn-primary shadow-0 me-1">Buy Now</a>
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
                        </div>

                    </div>
                    <div v-else class="row text-center">Opps! looks like this book is not available now</div>

                    <hr />


                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "book",
    data() {
        return {
            book: {
                title: null,
                description: "",

            }
        }
    },
    mounted() {
        this.showBook()
    },
    methods: {
        async showBook() {
            await this.axios.get(`/api/books/${this.$route.params.id}`).then(response => {
                // const { title, description } = response.data
                // this.book.title = title
                // this.book.description = description
                this.book = response.data;

            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
