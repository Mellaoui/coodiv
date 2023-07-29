<script setup>
// -- Lib Components -- //
import { Link } from "@inertiajs/vue3";

// -- Layouts -- //
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

// -- End Imports -- //

defineOptions({ layout: DashboardLayout });

const props = defineProps({
    categories: Array,
});
</script>

<template>
    <div>
        <h1>Matiere Index</h1>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>

                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="category in props.categories" :key="category.id">
                    <td>{{ category.name }}</td>

                    <td>
                        <Link :href="route('categories.edit', category.id)"
                            >Edit</Link
                        >

                        <Link :href="route('categories.show', category.id)"
                            >Show</Link
                        >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
