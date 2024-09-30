<template>
    <nav class="flex p-4">
        <div v-if="isAuthenticated">
            <router-link to="/form" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                Agregar tarea
            </router-link>

            <router-link to="/" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                Listar tareas
            </router-link>

            <a href="#" @click.prevent="logout" class="text-xl text-white mx-3 p-2">
                Cerrar sesión
            </a>
        </div>
        <div v-else>
            <router-link to="/login" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                Iniciar sesión
            </router-link>

            <router-link to="/register" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                Registrarse
            </router-link>

        </div>
    </nav>
</template>

<script>
export default {
    computed: {
        isAuthenticated() {
            return !!localStorage.getItem('token');
        }
    },
    methods: {
        logout() {
            localStorage.removeItem('token');
            this.$router.push('/login');
        }
    }
}
</script>
