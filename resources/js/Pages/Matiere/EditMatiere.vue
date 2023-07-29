<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    matiere: Object,
});

const form = useForm({
    name: props.matiere.name,
});
</script>

<template>
    <div>
        <h1>Edit Matiere</h1>
    </div>
    <div>
        <form @submit.prevent="form.patch(route('matieres.update'))">
            <div>
                <label for="name">Nom</label>
                <input id="name" name="name" type="text" v-model="form.name" />
                <div>{{ form.errors.name }}</div>
            </div>
            <div>
                <button type="submit">Create</button>
            </div>
        </form>
    </div>
</template>
