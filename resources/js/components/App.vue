<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#"> The BookStore {{ $store.state.token }}</router-link>
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">

                        <router-link exact-active-class="active" to="/" class="nav-item nav-link">Home</router-link>
                        <router-link exact-active-class="active" to="/books" class="nav-item nav-link">Books</router-link>
                        <router-link v-if="api_token" exact-active-class="active" to="/books/add"
                            class="nav-item nav-link">Add Book</router-link>

                        <router-link exact-active-class="active" to="/login" class="nav-item nav-link">Login</router-link>
                        <router-link exact-active-class="active" to="/Register"
                            class="nav-item nav-link">Register</router-link>

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
// import { Store } from 'vuex';

import { mapState, mapMutations, mapActions, mapGetters } from 'vuex';
import state from '../auth/state';
export default {
    props: {
        api_token: {
            default: null,
            type: String
        }
    },


    //   computed: {
    //     ...mapState(['count', 'isLoggedIn', 'user', 'token']),
    //   },
    //   methods: {
    //     ...mapMutations(['increment', 'decrement', 'login', 'logout']),
    //     ...mapActions(['increment', 'decrement', 'login', 'logout', 'setToken']),
    //     ...mapGetters(['getToken'])
    //   },
    mounted() {
        state.dispatch('setToken', this.api_token);
    },
}



</script>
