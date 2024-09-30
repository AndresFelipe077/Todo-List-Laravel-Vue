<template>
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 py-6">
            <h2 class="text-2xl font-bold text-center">Iniciar Sesión</h2>
            <form @submit.prevent="login">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input type="email" v-model="email" id="email" required
                        class="mt-1 p-2 w-full border rounded text-dark" />
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" v-model="password" id="password" required autocomplete="password"
                        class="mt-1 p-2 w-full border rounded text-dark" />
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Iniciar Sesión</button>
                </div>
            </form>
            <p class="mt-4 text-center">¿No tienes una cuenta? <router-link to="/register"
                    class="text-blue-500">Regístrate aquí</router-link>.</p>
        </div>
    </div>
</template>

<script>
import { createStore } from 'vuex';

export default {
    data() {
        return {
            email: '',
            password: ''
        };
    },
    computed: {
        isAuthenticated() {
            return !!localStorage.getItem('token');
        }
    },
    methods: {
        login() {
            if (!this.email || !this.password) {
                alert('Por favor completa todos los campos necesarios');
                return;
            }

            let data = {
                email: this.email,
                password: this.password,
            }

            axios.post('api/login', data) // Cambiado aquí
                .then(response => {
                    localStorage.setItem('token', response.data.access_token);
                    localStorage.setItem('user', response.data.user);
                    this.$router.push('/');
                    setTimeout(() => {
                        window.location.reload();
                    }, 50);
                }).catch(error => {
                    alert(error.response.data.message);
                });
        }
    }
};
</script>

<style scoped>
.container {
    max-width: 400px;
}

.text-dark {
    color: black !important;
}
</style>
