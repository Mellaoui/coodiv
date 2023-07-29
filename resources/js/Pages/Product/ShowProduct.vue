<script setup>
// -- Layouts -- //
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
// -- End Imports -- //

defineOptions({
    layout: DashboardLayout,
});

const props = defineProps({
    product: Object,
});
</script>

<template>
    <div>
        <h1>Show Product</h1>
    </div>

    <div>
        <h1>Product Reference: {{ props.product.reference }}</h1>
        <ul>
            <li>
                <!-- product: {{ product.reference }} -->
            </li>
        </ul>
    </div>
</template>
