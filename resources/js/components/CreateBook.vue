<template>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Add Book</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
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

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
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
    name:"book-create",
    data(){
        return {
            book:{
                title:"",
                author:"",
                isbn:"",
                genre:"",
                published:null,
                publisher:"",
            }
        }
    },
    methods:{
        async create(){
            await this.axios.post('/api/books',this.book).then(response=>{
                console.log(response);
                alert("Book has been added");
                // this.$router.push({name:"books"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>
