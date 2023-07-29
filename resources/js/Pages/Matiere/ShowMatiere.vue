<script setup>
// -- Lib Components -- //
import { Link } from "@inertiajs/vue3";

// -- Layouts -- //
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

// -- End Imports -- //

defineOptions({ layout: DashboardLayout });

const props = defineProps({
    matiere: Object,
});
</script>

<template>
    <div>
        <h1>Show Matiere</h1>
    </div>

    <div class="flex flex-row items-center justify-between">
        <h1>{{ matiere.name }}</h1>

        <div>
            <Link :href="route('matieres.edit', matiere.id)">Edit</Link>

            <Link :href="route('matieres.show', matiere.id)">Show</Link>
        </div>
    </div>
</template>
