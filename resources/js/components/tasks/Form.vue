<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header py-16 text-center text-sm text-black dark:text-white/70">Create task</div>

                    <form method="POST" v-on:submit.prevent="saveTask()">
                        <div class="d-block flex px-2 py-4">
                            <input type="text" placeholder="new task" v-model="newTask"
                            class="text-xl p-2 mr-2 w-10/12 border-b-2 border-green-500">
                        </div>

                        <button type="submit" class="bg-green-500 w-2/12 text-white">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newTask: ''
        };
    },
    methods: {
        saveTask() {
            console.log('Task saved:', this.newTask);
            // Aquí puedes agregar la lógica para guardar la tarea
        }
    },
    mounted() {
        console.log('Component mounted.');
    }
}
</script>
