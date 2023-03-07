<template>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Update Book</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" v-model="book.title">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input type="text" class="form-control" v-model="book.isbn">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Author</label>
                                    <input type="text" class="form-control" v-model="book.author">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Genre</label>
                                    <input type="text" class="form-control" v-model="book.genre">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Publisher</label>
                                    <input type="text" class="form-control" v-model="book.publisher">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Published Date</label>
                                    <input type="date" class="form-control" v-model="book.published">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" v-model="book.description">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"book-update",
    data(){
        return {
            book:{
                title:"",
                description:"",
                title:"",
                author:"",
                isbn:"",
                genre:"",
                published:null,
                publisher:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showBook()
    },
    methods:{
        async showBook(){
            await this.axios.get(`/api/books/${this.$route.params.id}`).then(response=>{
                console.log(response);
                this.book = response.data;
                this.book.published = response.data.publishedAt;
                this.book._method = "patch"

            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post(`/api/books/${this.$route.params.id}`,this.book).then(response=>{
                this.$router.push({name:"books"});
                // console.log(response);
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>
