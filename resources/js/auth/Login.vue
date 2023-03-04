<template>
    <div>
      <h2>Login Form</h2>
      {{ form }}
      <form @submit.prevent="login">
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="form.email" required>
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="form.password" required>
        </div>
        <div>
          <button type="submit">Login</button>
        </div>
      </form>
      <div v-if="error" style="color: red;">{{ error }}</div>
    </div>
  </template>

  <script>
  import axios from 'axios'

  export default {
    data() {
      return {
        form: {
          email: '',
          password: '',
        },
        error: null,
      }
    },
    methods: {
      login() {
        axios.post('/api/login', this.form)
          .then(response => {
            localStorage.setItem('token', response.data.token)
            this.$router.push('/dashboard')
          })
          .catch(error => {
            this.error = error.response.data.message
          })
      },
    },
  }
  </script>
