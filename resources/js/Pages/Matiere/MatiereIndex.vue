<script setup>
// -- Lib Functions -- //
import { router } from "@inertiajs/vue3";

// -- Lib Components -- //
import { Link } from "@inertiajs/vue3";

// -- Layouts -- //
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

// -- End Imports -- //

defineOptions({ layout: DashboardLayout });

const props = defineProps({
    matieres: Object,
});

function deleteMaterial(id) {
    if (confirm("Are you sure you want to delete this Material?")) {
        router.delete(route("matieres.destroy", id));
    }
}
</script>

<template>
    <div class="px-4 sm:px-6 lg:px-8 lg:py-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Materials
                </h1>

                <p class="mt-2 text-sm text-gray-700">
                    A list of all the Materials.
                </p>
            </div>

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <Link
                    :href="route('matieres.create')"
                    class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >Add New Material</Link
                >
            </div>
        </div>

        <div class="flow-root mt-8">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                >
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th
                                    scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                                >
                                    Name
                                </th>

                                <th
                                    scope="col"
                                    class="relative py-3.5 pl-3 pr-4 sm:pr-0"
                                >
                                    <span class="sr-only">Edit</span>
                                    <span class="sr-only">Show</span>
                                    <span class="sr-only">Delete</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="matiere in props.matieres.data"
                                :key="matiere.id"
                            >
                                <td
                                    class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0"
                                >
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div
                                                class="font-medium text-gray-900"
                                            >
                                                {{ matiere.name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td
                                    class="relative py-5 pl-3 pr-4 space-x-2 text-sm font-medium text-right whitespace-nowrap sm:pr-0"
                                >
                                    <Link
                                        :href="
                                            route('matieres.edit', matiere.id)
                                        "
                                        class="text-indigo-600 hover:text-indigo-900"
                                        >Edit</Link
                                    >

                                    <Link
                                        :href="
                                            route('matieres.show', matiere.id)
                                        "
                                        class="text-indigo-600 hover:text-indigo-900"
                                        >Show</Link
                                    >

                                    <button
                                        @click="deleteMaterial(matiere.id)"
                                        type="button"
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
