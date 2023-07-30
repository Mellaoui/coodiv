<script setup>
// -- Lib Functions -- //
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

// -- Lib Components -- //
import { Link } from "@inertiajs/vue3";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import {
    Listbox,
    ListboxOptions,
    ListboxOption,
    ListboxButton,
} from "@headlessui/vue";

// -- Components -- //
import Pagination from "@/Components/Pagination.vue";

// -- Icons -- //
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";

// -- Layouts -- //
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

// -- End Imports -- //

defineOptions({ layout: DashboardLayout });

const props = defineProps({
    products: Object,
    categories: Object,
    material: Object,
    orders: Object,
});

function deleteProduct(id) {
    if (confirm("Are you sure you want to delete this Product?")) {
        router.delete(route("products.destroy", id));
    }
}
</script>

<template>
    <div class="px-4 sm:px-6 lg:px-8 lg:py-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Products
                </h1>

                <p class="mt-2 text-sm text-gray-700">List of Products.</p>
            </div>

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a
                    :href="route('products.export')"
                    class="block px-3 py-2 text-sm font-semibold text-center text-white bg-green-600 rounded-md shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                    >Export Products</a
                >
            </div>

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <Link
                    :href="route('products.create')"
                    class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >Add Product</Link
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
                                    Product
                                </th>

                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Category
                                </th>

                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Sell Price
                                </th>

                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Buy Price
                                </th>

                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                >
                                    Designation
                                </th>

                                <th
                                    scope="col"
                                    class="relative py-3.5 pl-3 pr-4 sm:pr-0"
                                >
                                    <span>Actions</span>
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="product in props.products.data"
                                :key="product.id"
                            >
                                <td
                                    class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0"
                                >
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-11 w-11">
                                            <img
                                                class="rounded-md h-11 w-11"
                                                :src="
                                                    product.media[0]
                                                        .original_url
                                                "
                                                :alt="product.reference"
                                            />
                                        </div>

                                        <div class="ml-4">
                                            <div
                                                class="font-medium text-gray-900"
                                            >
                                                {{ product.reference }}
                                            </div>

                                            <div class="mt-1 text-gray-500">
                                                {{ product.quantity }}
                                                pieces
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td
                                    class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap"
                                >
                                    <div class="text-gray-900">
                                        {{ product.category.name }}
                                    </div>
                                </td>

                                <td
                                    class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap"
                                >
                                    {{ product.sell_price }}
                                </td>

                                <td
                                    class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap"
                                >
                                    {{ product.sell_price }}
                                </td>

                                <td
                                    class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap"
                                >
                                    {{ product.designation }}
                                </td>

                                <td
                                    class="relative py-5 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap"
                                >
                                    <Link
                                        :href="
                                            route('products.edit', product.id)
                                        "
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Edit
                                    </Link>

                                    <button
                                        @click="deleteProduct(product.id)"
                                        class="ml-4 text-indigo-600 hover:text-indigo-900"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <Pagination
                        :from="props.products.from"
                        :to="props.products.to"
                        :total="props.products.total"
                        :prev="props.products.prev_page_url"
                        :next="props.products.next_page_url"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
