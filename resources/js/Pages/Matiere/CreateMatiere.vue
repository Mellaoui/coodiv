<script setup>
// -- Lib Functions -- //
import { useForm } from "@inertiajs/vue3";

// -- Layouts -- //
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

// -- End Imports -- //

defineOptions({
    layout: DashboardLayout,
});

const form = useForm({
    name: "",
});
</script>

<template>
    <div>
        <h1>Create Matiere</h1>
    </div>

    <div>
        <div
            class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
        >
            <form @submit.prevent="form.post(route('matieres.store'))">
                <div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3
                            as="h3"
                            class="text-base font-semibold leading-6 text-gray-900"
                        >
                            Create New Material
                        </h3>

                        <div class="mt-2">
                            <div class="relative">
                                <label
                                    for="name"
                                    class="absolute inline-block px-1 text-xs font-medium text-gray-900 bg-white -top-2 left-2"
                                    >Name</label
                                >

                                <input
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3"
                >
                    <button
                        type="submit"
                        class="inline-flex justify-center w-full px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2"
                    >
                        Save
                    </button>

                    <button
                        type="button"
                        class="inline-flex justify-center w-full px-3 py-2 mt-3 text-sm font-semibold text-gray-900 bg-white rounded-md shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
