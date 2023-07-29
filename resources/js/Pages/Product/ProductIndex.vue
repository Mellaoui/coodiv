<script setup>
// -- Lib Functions -- //
import { ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";

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
    orders: Object
});

// const currentProduct = ref(props.products.data[0]);

/*const form = useForm({
    tracking_number: props.orders.data[0].tracking_number,
    quantity: props.orders.data[0].quantity,
    status: props.orders.data[0].status,
});*/

const isOpen = ref(false);

function closeModal() {
    isOpen.value = false;
}

function openModal(product) {
    isOpen.value = true;

    // form.tracking_number = order.tracking_number;
    // form.quantity = order.quantity;
    // form.status = order.status;

    // selectedStatus.value = order.status;
}

// const orderStatuses = ["delivered", "shipped", "returned"];
// const selectedStatus = ref(orderStatuses[0]);

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
                                    class="relative py-5 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-0"
                                >
                                    <button
                                        @click="openModal(product)"
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        @click="deleteOrder(product.id)"
                                        class="ml-4 text-indigo-600 hover:text-indigo-900"
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

    <TransitionRoot as="template" :show="isOpen">
        <Dialog as="div" class="relative z-50" @close="closeModal">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div
                    class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0"
                >
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100"
                        leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <DialogPanel
                            class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
                        >
                            <form
                                @submit.prevent="
                                    form.patch(
                                        route(
                                            'products.update',
                                            currentProduct.id
                                        )
                                    )
                                "
                            >
                                <div>
                                    <div class="mt-3 text-center sm:mt-5">
                                        <DialogTitle
                                            as="h3"
                                            class="text-base font-semibold leading-6 text-gray-900"
                                            >Update Order</DialogTitle
                                        >

                                        <div class="mt-4">
                                            <div class="relative">
                                                <label
                                                    for="product-reference"
                                                    class="absolute inline-block px-1 text-xs font-medium text-gray-900 bg-white -top-2 left-2"
                                                    >Tracking Number</label
                                                >

                                                <input
                                                    v-model="
                                                        form.tracking_number
                                                    "
                                                    type="text"
                                                    name="product-reference"
                                                    id="product-reference"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                />
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <div class="relative">
                                                <label
                                                    for="product-designation"
                                                    class="absolute inline-block px-1 text-xs font-medium text-gray-900 bg-white -top-2 left-2"
                                                    >Quantity</label
                                                >

                                                <input
                                                    v-model="form.quantity"
                                                    type="number"
                                                    name="product-designation"
                                                    id="product-designation"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                />
                                            </div>
                                        </div>

                                        <Listbox v-model="selectedCategory">
                                            <div class="relative mt-1">
                                                <ListboxButton
                                                    class="relative w-full py-2 pl-3 pr-10 text-left bg-white rounded-lg shadow-md cursor-default focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                                                >
                                                    <span
                                                        class="block truncate"
                                                        >{{
                                                            selectedCategory
                                                                ? selectedCategory.name
                                                                : "Select a category"
                                                        }}</span
                                                    >
                                                    <span
                                                        class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                                                    >
                                                        <ChevronUpDownIcon
                                                            class="w-5 h-5 text-gray-400"
                                                            aria-hidden="true"
                                                        />
                                                    </span>
                                                </ListboxButton>

                                                <transition
                                                    leave-active-class="transition duration-100 ease-in"
                                                    leave-from-class="opacity-100"
                                                    leave-to-class="opacity-0"
                                                >
                                                    <ListboxOptions
                                                        class="absolute w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                    >
                                                        <ListboxOption
                                                            v-slot="{
                                                                active,
                                                                selected,
                                                            }"
                                                            v-for="status in orderStatuses"
                                                            :key="status"
                                                            :value="status"
                                                            as="template"
                                                        >
                                                            <li
                                                                :class="[
                                                                    active
                                                                        ? 'bg-amber-100 text-amber-900'
                                                                        : 'text-gray-900',
                                                                    'relative cursor-default select-none py-2 pl-10 pr-4',
                                                                ]"
                                                            >
                                                                <span
                                                                    :class="[
                                                                        selected
                                                                            ? 'font-medium'
                                                                            : 'font-normal',
                                                                        'block truncate',
                                                                    ]"
                                                                    >{{
                                                                        status
                                                                    }}</span
                                                                >
                                                                <span
                                                                    v-if="
                                                                        selected
                                                                    "
                                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                                                                >
                                                                    <CheckIcon
                                                                        class="w-5 h-5"
                                                                        aria-hidden="true"
                                                                    />
                                                                </span>
                                                            </li>
                                                        </ListboxOption>
                                                    </ListboxOptions>
                                                </transition>
                                            </div>
                                        </Listbox>
                                    </div>
                                </div>

                                <div
                                    class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3"
                                >
                                    <button
                                        @click="closeModal"
                                        type="submit"
                                        class="inline-flex justify-center w-full px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2"
                                    >
                                        Save
                                    </button>

                                    <button
                                        type="button"
                                        class="inline-flex justify-center w-full px-3 py-2 mt-3 text-sm font-semibold text-gray-900 bg-white rounded-md shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0"
                                        @click="closeModal"
                                        ref="cancelButtonRef"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>