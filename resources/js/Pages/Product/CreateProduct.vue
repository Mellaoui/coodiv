<script setup>
// -- Lib Functions -- //
import { computed, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
// -- Layouts -- //
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
// -- Lib Components -- //
import { Head, Link } from "@inertiajs/vue3";
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from "@headlessui/vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import Editor from "@tinymce/tinymce-vue";
// -- Icons -- //
import { PhotoIcon, UserCircleIcon } from "@heroicons/vue/24/solid";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";
import { CheckCircleIcon } from "@heroicons/vue/20/solid";
// -- End Imports -- //

defineOptions({ layout: DashboardLayout });

const props = defineProps({
    categories: Array,
    matieres: Array,
});

const categoryQuery = ref("");
const selectedCategory = ref(props.categories[0] ?? null);

const filteredCategories = computed(() =>
    categoryQuery.value === ""
        ? props.categories
        : props.categories.filter((category) => {
              return category.name
                  .toLowerCase()
                  .includes(categoryQuery.value.toLowerCase());
          })
);

const materialQuery = ref("");
const selectedMaterial = ref(props.matieres[0] ?? null);

const filteredMaterials = computed(() =>
    materialQuery.value === ""
        ? props.matieres
        : props.matieres.filter((material) => {
              return material.name
                  .toLowerCase()
                  .includes(materialQuery.value.toLowerCase());
          })
);

const productForm = useForm({
    category_id: selectedCategory.value.id,
    matiere_id: selectedMaterial.value.id,

    reference: "",
    designation: "",
    buy_price: "",
    sell_price: "",
    weight: "",
    discount: null,
    quantity: "",
});

const materialForm = useForm({
    name: "",
});

const categoryForm = useForm({
    name: "",
});

const Category = ref(false);

const Material = ref(false);
</script>

<template>
    <div class="grid grid-cols-3 gap-4">
        <div class="flex flex-col col-span-2">
            <h2 class="text-base font-semibold leading-7 text-gray-900">
                Add Product
            </h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">
                This information will be displayed publicly so be careful what
                you share.
            </p>
        </div>
        <div class="flex flex-row justify-end">
            <button
                type="button"
                class="rounded-md bg-white border transition-all px-3.5 py-2.5 text-sm font-semibold text-gray-600 shadow-sm mr-9 hover:bg-gray-400"
            >
                Discard
            </button>

            <button
                type="button"
                class="inline-flex items-center rounded-md bg-white border transition-all px-3.5 py-2.5 text-sm font-semibold text-blue-600 shadow-sm mr-9 hover:bg-gray-400"
            >
                Save Draft
            </button>

            <form @submit.prevent="productForm.post(route('products.store'))">
                <button
                    type="submit"
                    class="inline-flex items-center gap-x-1.5 transition-all rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Publish Product
                    <CheckCircleIcon
                        class="-mr-0.5 h-5 w-5"
                        aria-hidden="true"
                    />
                </button>
            </form>
        </div>

        <div class="col-span-2 pb-12 border-b border-gray-900/10">
            <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-12 sm:grid-cols-6">
                <div class="col-span-full">
                    <label
                        for="product-reference"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Product Reference</label
                    >
                    <div class="mt-2">
                        <div
                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                        >
                            <input
                                type="text"
                                name="product-reference"
                                id="product-reference"
                                autocomplete="name"
                                class="block flex-1 border-0 bg-transparent px-3.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                v-model="productForm.reference"
                            />
                        </div>
                    </div>
                </div>

                <div class="col-span-full">
                    <label
                        for="product-designation"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Product Designation</label
                    >

                    <div class="mt-2">
                        <div
                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                        >
                            <input
                                type="text"
                                name="product-designation"
                                id="product-designation"
                                class="block flex-1 border-0 bg-transparent px-3.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                v-model="productForm.designation"
                            />
                        </div>
                    </div>
                </div>

                <!-- <div class="col-span-full">
                    <label
                        for="about"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Product Description</label
                    >
                    <div class="mt-2">
                        <Editor
                            id="about"
                            name="about"
                            rows="3"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        />
                    </div>
                    <p class="mt-3 text-sm leading-6 text-gray-600">
                        Write a few sentences about the product.
                    </p>
                </div> -->

                <div class="col-span-full">
                    <label
                        for="photo"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Photo</label
                    >

                    <div class="flex items-center mt-2 gap-x-3">
                        <UserCircleIcon
                            class="w-12 h-12 text-gray-300"
                            aria-hidden="true"
                        />

                        <button
                            type="button"
                            class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                        >
                            Change
                        </button>
                    </div>
                </div>

                <div class="col-span-full">
                    <label
                        for="cover-photo"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Cover photo</label
                    >

                    <div
                        class="flex justify-center px-6 py-10 mt-2 border border-dashed rounded-lg border-gray-900/25"
                    >
                        <div class="text-center">
                            <PhotoIcon
                                class="w-12 h-12 mx-auto text-gray-300"
                                aria-hidden="true"
                            />

                            <div
                                class="flex mt-4 text-sm leading-6 text-gray-600"
                            >
                                <label
                                    for="file-upload"
                                    class="relative font-semibold text-indigo-600 bg-white rounded-md cursor-pointer focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500"
                                >
                                    <span>Upload a file</span>

                                    <input
                                        id="file-upload"
                                        name="file-upload"
                                        type="file"
                                        class="sr-only"
                                    />
                                </label>

                                <p class="pl-1">or drag and drop</p>
                            </div>

                            <p class="text-xs leading-5 text-gray-600">
                                PNG, JPG, GIF up to 10MB
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div
                class="px-4 py-5 pb-12 bg-white border border-gray-200 rounded-lg h-2/3 sm:px-6 border-gray-900/10"
            >
                <h2 class="text-base font-semibold leading-7 text-gray-900">
                    Organize
                </h2>

                <div class="flex flex-col">
                    <div class="sm:col-span-3">
                        <div class="mt-2">
                            <Combobox as="div" v-model="selectedCategory">
                                <div class="flex flex-col sm:flex-row">
                                    <ComboboxLabel
                                        class="flex pt-3 text-sm font-medium leading-6 text-gray-900"
                                        >Category</ComboboxLabel
                                    >
                                    <button
                                        @click="Category = true"
                                        type="button"
                                        class="flex pt-3 pl-3 text-sm font-medium leading-6 text-blue-600"
                                    >
                                        Create a new category
                                    </button>
                                </div>

                                <div class="relative mt-2">
                                    <ComboboxInput
                                        class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        @change="
                                            categoryQuery = $event.target.value
                                        "
                                        :display-value="
                                            (category) => category?.name
                                        "
                                    />

                                    <ComboboxButton
                                        class="absolute inset-y-0 right-0 flex items-center px-2 rounded-r-md focus:outline-none"
                                    >
                                        <ChevronUpDownIcon
                                            class="w-5 h-5 text-gray-400"
                                            aria-hidden="true"
                                        />
                                    </ComboboxButton>

                                    <ComboboxOptions
                                        v-if="filteredCategories.length > 0"
                                        class="absolute z-10 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                    >
                                        <ComboboxOption
                                            v-for="category in filteredCategories"
                                            :key="category.id"
                                            :value="category"
                                            as="template"
                                            v-slot="{ active, selected }"
                                        >
                                            <li
                                                :class="[
                                                    'relative cursor-default select-none py-2 pl-8 pr-4',
                                                    active
                                                        ? 'bg-indigo-600 text-white'
                                                        : 'text-gray-900',
                                                ]"
                                            >
                                                <span
                                                    :class="[
                                                        'block truncate',
                                                        selected &&
                                                            'font-semibold',
                                                    ]"
                                                >
                                                    {{ category.name }}
                                                </span>

                                                <span
                                                    v-if="selected"
                                                    :class="[
                                                        'absolute inset-y-0 left-0 flex items-center pl-1.5',
                                                        active
                                                            ? 'text-white'
                                                            : 'text-indigo-600',
                                                    ]"
                                                >
                                                    <CheckIcon
                                                        class="w-5 h-5"
                                                        aria-hidden="true"
                                                    />
                                                </span>
                                            </li>
                                        </ComboboxOption>
                                    </ComboboxOptions>
                                </div>
                            </Combobox>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <div class="mt-2">
                            <Combobox as="div" v-model="selectedMaterial">
                                <div
                                    class="inline-flex items-center sm:flex-row"
                                >
                                    <ComboboxLabel
                                        class="flex pt-3 text-sm font-medium leading-6 text-gray-900"
                                        >Material</ComboboxLabel
                                    >

                                    <button
                                        type="button"
                                        @click="Material = true"
                                        class="flex pt-3 pl-3 text-sm font-medium leading-6 text-blue-600"
                                    >
                                        Create a new material
                                    </button>
                                </div>

                                <div class="relative mt-2">
                                    <ComboboxInput
                                        class="w-full rounded-md border-0 bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        @change="
                                            materialQuery = $event.target.value
                                        "
                                        :display-value="
                                            (material) => material?.name
                                        "
                                    />

                                    <ComboboxButton
                                        class="absolute inset-y-0 right-0 flex items-center px-2 rounded-r-md focus:outline-none"
                                    >
                                        <ChevronUpDownIcon
                                            class="w-5 h-5 text-gray-400"
                                            aria-hidden="true"
                                        />
                                    </ComboboxButton>

                                    <ComboboxOptions
                                        v-if="filteredMaterials.length > 0"
                                        class="absolute z-10 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                    >
                                        <ComboboxOption
                                            v-for="material in filteredMaterials"
                                            :key="material.id"
                                            :value="material"
                                            as="template"
                                            v-slot="{ active, selected }"
                                        >
                                            <li
                                                :class="[
                                                    'relative cursor-default select-none py-2 pl-8 pr-4',
                                                    active
                                                        ? 'bg-indigo-600 text-white'
                                                        : 'text-gray-900',
                                                ]"
                                            >
                                                <span
                                                    :class="[
                                                        'block truncate',
                                                        selected &&
                                                            'font-semibold',
                                                    ]"
                                                >
                                                    {{ material.name }}
                                                </span>

                                                <span
                                                    v-if="selected"
                                                    :class="[
                                                        'absolute inset-y-0 left-0 flex items-center pl-1.5',
                                                        active
                                                            ? 'text-white'
                                                            : 'text-indigo-600',
                                                    ]"
                                                >
                                                    <CheckIcon
                                                        class="w-5 h-5"
                                                        aria-hidden="true"
                                                    />
                                                </span>
                                            </li>
                                        </ComboboxOption>
                                    </ComboboxOptions>
                                </div>
                            </Combobox>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label
                            for="product-buy-price"
                            class="block pt-3 text-sm font-medium leading-6 text-gray-900"
                            >Buying Price</label
                        >

                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                            >
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>

                            <input
                                type="number"
                                name="product-buy-price"
                                id="product-buy-price"
                                class="block w-full rounded-md border-0 py-1.5 pl-7 pr-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                placeholder="0.00"
                                aria-describedby="price-currency"
                                v-model="productForm.buy_price"
                            />

                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none"
                            >
                                <span
                                    class="text-gray-500 sm:text-sm"
                                    id="price-currency"
                                    >/g</span
                                >
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label
                            for="product-sell-price"
                            class="block pt-3 text-sm font-medium leading-6 text-gray-900"
                            >Selling Price</label
                        >

                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                            >
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>

                            <input
                                type="number"
                                name="product-sell-price"
                                id="product-sell-price"
                                class="block w-full rounded-md border-0 py-1.5 pl-7 pr-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                placeholder="0.00"
                                aria-describedby="price-currency"
                                v-model="productForm.sell_price"
                            />

                            <div
                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none"
                            >
                                <span
                                    class="text-gray-500 sm:text-sm"
                                    id="price-currency"
                                    >/g</span
                                >
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-2 sm:col-start-1">
                        <label
                            for="product-weight"
                            class="block pt-3 text-sm font-medium leading-6 text-gray-900"
                            >Weight</label
                        >

                        <div class="mt-2">
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input
                                    type="number"
                                    name="product-weight"
                                    id="product-weight"
                                    class="block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    placeholder="00"
                                    v-model="productForm.weight"
                                />

                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6 text-gray-400"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label
                            for="product-discount"
                            class="block pt-3 text-sm font-medium leading-6 text-gray-900"
                            >Discount</label
                        >

                        <div class="mt-2">
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input
                                    type="number"
                                    name="product-discount"
                                    id="product-discount"
                                    class="block w-full rounded-md border-0 py-1.5 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    aria-describedby="price-currency"
                                    placeholder="0.00"
                                    v-model="productForm.discount"
                                />

                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6 text-gray-400"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label
                            for="product-quantity"
                            class="block pt-3 text-sm font-medium leading-6 text-gray-900"
                            >Quantity</label
                        >

                        <div class="mt-2">
                            <input
                                type="number"
                                name="product-quantity"
                                id="product-quantity"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                placeholder="0"
                                v-model="productForm.quantity"
                            />
                        </div>

                        {{ productForm.errors }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <TransitionRoot as="template" :show="Category">
        <Dialog as="div" class="relative z-50" @close="Category = false">
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
                                    categoryForm.post(route('categories.store'))
                                "
                            >
                                <div>
                                    <div class="mt-3 text-center sm:mt-5">
                                        <DialogTitle
                                            as="h3"
                                            class="text-base font-semibold leading-6 text-gray-900"
                                            >Create new category</DialogTitle
                                        >

                                        <div class="mt-2">
                                            <div class="relative">
                                                <label
                                                    for="name"
                                                    class="absolute inline-block px-1 text-xs font-medium text-gray-900 bg-white -top-2 left-2"
                                                    >Name</label
                                                >

                                                <input
                                                    v-model="categoryForm.name"
                                                    type="text"
                                                    name="name"
                                                    id="name"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                    placeholder="Jane Smith"
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
                                        @click="Category = false"
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

    <TransitionRoot as="template" :show="Material">
        <Dialog as="div" class="relative z-50" @close="Material = false">
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
                                    materialForm.post(route('materials.store'))
                                "
                            >
                                <div>
                                    <div class="mt-3 text-center sm:mt-5">
                                        <DialogTitle
                                            as="h3"
                                            class="text-base font-semibold leading-6 text-gray-900"
                                            >Create new Material</DialogTitle
                                        >

                                        <div class="mt-2">
                                            <div class="relative">
                                                <label
                                                    for="name"
                                                    class="absolute inline-block px-1 text-xs font-medium text-gray-900 bg-white -top-2 left-2"
                                                    >Name</label
                                                >

                                                <input
                                                    type="text"
                                                    name="name"
                                                    id="name"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                    placeholder="Jane Smith"
                                                    v-model="materialForm.name"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3"
                                >
                                    <button
                                        type="button"
                                        class="inline-flex justify-center w-full px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2"
                                        @click="open = false"
                                    >
                                        Save
                                    </button>
                                    <button
                                        type="button"
                                        class="inline-flex justify-center w-full px-3 py-2 mt-3 text-sm font-semibold text-gray-900 bg-white rounded-md shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0"
                                        @click="open = false"
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
