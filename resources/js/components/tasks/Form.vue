<template>
    <div class="container mx-auto">
        <div class="row justify-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center text-lg font-bold">Crear Tarea</div>

                    <form @submit.prevent="saveTask">
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" v-model="title" id="title"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                placeholder="Título de la tarea" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea v-model="description" id="description"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                placeholder="Descripción de la tarea" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="due_date" class="block text-sm font-medium text-gray-700">Fecha de
                                Vencimiento</label>
                            <input type="date" v-model="due_date" id="due_date"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                            <input type="file" @change="onFileChange" id="image"
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2" accept="image/*"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Etiquetas</label>
                            <div class="flex">
                                <input type="text" v-model="newTag"
                                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Agregar etiqueta" @keyup.enter="addTag">
                                <button type="button" @click="addTag"
                                    class="ml-2 bg-blue-500 text-white rounded-md p-2">Agregar</button>
                            </div>
                            <div class="mt-2">
                                <span v-for="(tag, index) in tags" :key="index"
                                    class="inline-block bg-gray-200 text-gray-800 rounded-full px-3 py-1 text-sm font-semibold mr-2">
                                    {{ tag }}
                                    <button type="button" @click="removeTag(index)" class="ml-1 text-red-500">x</button>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="bg-green-500 text-white rounded-md p-2">Guardar Tarea</button>
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
            title: '',
            description: '',
            due_date: '',
            image: null,
            newTag: '',
            tags: []
        };
    },
    methods: {
        onFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.image = file;
            }
        },
        addTag() {
            if (this.newTag.trim() !== '') {
                this.tags.push(this.newTag.trim());
                this.newTag = '';
            }
        },
        removeTag(index) {
            this.tags.splice(index, 1);
        },
        saveTask() {
            const formData = new FormData();
            formData.append('title', this.title);
            formData.append('description', this.description);
            formData.append('due_date', this.due_date);
            if (this.image) {
                formData.append('file', this.image);
            }
            formData.append('tags', JSON.stringify(this.tags));

            axios.post('api/tasks', formData) // Cambiado aquí
                .then(response => {
                    console.log(response);
                }).catch(error => {
                    console.log(error.response);
                });
        }
    }
}
</script>

<style scoped>
.container {
    max-width: 800px;
}
</style>
