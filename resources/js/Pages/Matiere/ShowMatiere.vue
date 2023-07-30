<script setup>
// -- Lib Functions -- //
import { usePage } from "@inertiajs/vue3";

// -- Lib Components -- //
import { Link } from "@inertiajs/vue3";

// -- Components -- //
import FlashAlert from "@/Components/FlashAlert.vue";

// -- Layouts -- //
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

// -- End Imports -- //

defineOptions({ layout: DashboardLayout });

const flashSuccess = usePage().props.flash.success;

const props = defineProps({
    matiere: Object,
});
</script>

<template>
    <div>
        <h1>Show Material</h1>
    </div>

    <div class="flex flex-row items-center justify-between">
        <h1>{{ matiere.name }}</h1>

        <FlashAlert v-if="flashSuccess" :message="flashSuccess" />

        <div class="flex flex-row gap-4">
            <Link :href="route('matieres.edit', matiere.id)">Edit</Link>

            <Link :href="route('matieres.index')">Index</Link>
        </div>
    </div>
</template>
