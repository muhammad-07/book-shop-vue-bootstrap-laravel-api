<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#"> The BookStore</router-link>
                <div class="collapse navbar-collapse justify-content-end">
                    <div class="navbar-nav">

                        <router-link exact-active-class="active" to="/" class="nav-item nav-link">Home</router-link>
                        <router-link v-if="$store.getters.getToken" exact-active-class="active" to="/books" class="nav-item nav-link">Books
                            List</router-link>


                        <router-link v-if="$store.getters.getToken" exact-active-class="active" to="/books/add" class="nav-item nav-link">Add New
                            Book</router-link>
                        <a  v-if="$store.getters.getToken" href="#" @click="logout()" class="nav-item nav-link">Logout <i class="fa fa-upload"></i></a>

                        <a v-else :href="'/login'" :class="'me-1 border rounded py-1 px-3 nav-link d-flex align-items-center'">
                            <i class="fas fa-user-alt m-1 me-md-2"></i> Login
                        </a>

                        <!-- <router-link exact-active-class="active" to="/login" class="nav-item nav-link">Login</router-link>
                        <router-link exact-active-class="active" to="/Register"
                            class="nav-item nav-link">Register</router-link> -->

                    </div>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>

import state from '../auth/state';
// import router from '../routes';
export default {
    props: {
        api_token: {
            default: null,
            type: String
        }
    },



    methods: {
        logout() {
            state.dispatch('setToken', null);
            window.location.href = "/logout";
            // router.push('/');
        }

    },
    mounted() {
        state.dispatch('setToken', this.api_token);
    },
}



</script>
