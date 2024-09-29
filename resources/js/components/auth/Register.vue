<template>
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 py-6">
            <h2 class="text-2xl font-bold text-center">Registrarse</h2>
            <form @submit.prevent="register">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" v-model="name" id="name" required
                        class="mt-1 p-2 w-full border rounded text-dark" />
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input type="email" v-model="email" id="email" required
                        class="mt-1 p-2 w-full border rounded text-dark" />
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" v-model="password" id="password" required
                        class="mt-1 p-2 w-full border rounded text-dark" />
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirmar
                        contraseña</label>
                    <input type="password" v-model="password_confirmation" id="confirm_password" required
                        class="mt-1 p-2 w-full border rounded text-dark" />
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Registrarse</button>
                </div>
            </form>
            <p class="mt-4 text-center">¿Ya tienes una cuenta? <router-link to="/login" class="text-blue-500">Inicia
                    sesión aquí</router-link>.</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    },
    methods: {
        register() {
            if (this.password !== this.password_confirmation) {
                alert('Las contraseñas no coinciden. Por favor, inténtalo de nuevo.');
                return;
            }

            if (this.password.length < 8) {
                alert('La contraseña debe tener al menos 8 caracteres.');
                return;
            }

            let data = {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            }

            axios.post('api/register', data) // Cambiado aquí
                .then(response => {
                    this.$router.push('/');
                }).catch(error => {
                    console.log(error.response);
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
