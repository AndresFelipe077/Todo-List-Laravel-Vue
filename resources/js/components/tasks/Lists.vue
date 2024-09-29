<template>
    <div class="container mx-auto">
        <div class="row justify-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center text-lg font-bold">Lista de Tareas</div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Vencimiento</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="task in tasks" :key="task.id">
                                <td class="px-6 py-4 whitespace-nowrap dark:bg-slate-800">{{ task.title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap dark:bg-slate-800">{{ task.description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap dark:bg-slate-800">{{ task.due_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap dark:bg-slate-800">
                                    <button @click="editTask(task.id)" class="text-blue-500 hover:text-blue-700">Editar</button>
                                    <button @click="deleteTask(task.id)" class="text-red-500 hover:text-red-700 ml-4">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            tasks: []
        };
    },
    created() {
        this.fetchTasks();
    },
    methods: {
        fetchTasks() {
            axios.get('api/tasks')
                .then(response => {
                    this.tasks = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        editTask(id) {
            // Lógica para editar la tarea
            console.log(`Editar tarea con ID: ${id}`);
            this.$router.push('/edit/' + id);
        },
        deleteTask(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta tarea?')) {
                axios.delete(`api/tasks/${id}`)
                    .then(response => {
                        this.fetchTasks(); // Refrescar la lista después de eliminar
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
}
</script>

<style scoped>
.container {
    max-width: 800px;
}
</style>
