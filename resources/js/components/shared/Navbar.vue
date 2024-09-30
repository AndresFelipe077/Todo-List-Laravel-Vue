<template>
    <nav class="flex p-4">
        <div v-if="isAuthenticated">
            <router-link to="/form" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                Add task
            </router-link>

            <router-link to="/" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                Tasks lists
            </router-link>

            <a href="#" @click.prevent="logout" class="text-xl text-white mx-3 p-2">
                Logout
            </a>
        </div>
        <div v-else>
            <router-link to="/login" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                Login
            </router-link>

            <router-link to="/register" class="text-xl text-white mx-3 p-2" active-class="font-bold" exact>
                Register
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
