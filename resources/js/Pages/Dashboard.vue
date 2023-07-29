<script setup>
// -- Layouts -- //
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

// -- Lib Components -- //
import { Head, Link } from "@inertiajs/vue3";

// -- Icons -- //
import { ArrowDownIcon, ArrowUpIcon } from "@heroicons/vue/20/solid";
import {
    CursorArrowRaysIcon,
    EnvelopeOpenIcon,
    UsersIcon,
} from "@heroicons/vue/24/outline";
import { computed } from "vue";

// -- End Emports -- //

defineOptions({ layout: DashboardLayout });

const props = defineProps({
    products: Object,
});

const stats = [
    {
        id: 1,
        name: "Total Subscribers",
        stat: "71,897",
        icon: UsersIcon,
        change: "122",
        changeType: "increase",
    },
    {
        id: 2,
        name: "Avg. Open Rate",
        stat: "58.16%",
        icon: EnvelopeOpenIcon,
        change: "5.4%",
        changeType: "increase",
    },
    {
        id: 3,
        name: "Avg. Click Rate",
        stat: "24.57%",
        icon: CursorArrowRaysIcon,
        change: "3.2%",
        changeType: "decrease",
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <div>
        <h3 class="text-base font-semibold leading-6 text-gray-900">
            Last 30 days
        </h3>

        <dl class="grid grid-cols-1 gap-5 mt-5 sm:grid-cols-2 lg:grid-cols-3">
            <div
                v-for="item in stats"
                :key="item.id"
                class="relative px-4 pt-5 pb-12 overflow-hidden bg-white rounded-lg shadow sm:px-6 sm:pt-6"
            >
                <dt>
                    <div class="absolute p-3 bg-indigo-500 rounded-md">
                        <component
                            :is="item.icon"
                            class="w-6 h-6 text-white"
                            aria-hidden="true"
                        />
                    </div>
                    <p class="ml-16 text-sm font-medium text-gray-500 truncate">
                        {{ item.name }}
                    </p>
                </dt>
                <dd class="flex items-baseline pb-6 ml-16 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">
                        {{ item.stat }}
                    </p>
                    <p
                        :class="[
                            item.changeType === 'increase'
                                ? 'text-green-600'
                                : 'text-red-600',
                            'ml-2 flex items-baseline text-sm font-semibold',
                        ]"
                    >
                        <ArrowUpIcon
                            v-if="item.changeType === 'increase'"
                            class="self-center flex-shrink-0 w-5 h-5 text-green-500"
                            aria-hidden="true"
                        />
                        <ArrowDownIcon
                            v-else
                            class="self-center flex-shrink-0 w-5 h-5 text-red-500"
                            aria-hidden="true"
                        />
                        <span class="sr-only">
                            {{
                                item.changeType === "increase"
                                    ? "Increased"
                                    : "Decreased"
                            }}
                            by
                        </span>
                        {{ item.change }}
                    </p>
                    <div
                        class="absolute inset-x-0 bottom-0 px-4 py-4 bg-gray-50 sm:px-6"
                    >
                        <div class="text-sm">
                            <a
                                href="#"
                                class="font-medium text-indigo-600 hover:text-indigo-500"
                                >View all<span class="sr-only">
                                    {{ item.name }} stats</span
                                ></a
                            >
                        </div>
                    </div>
                </dd>
            </div>
        </dl>

        <div class="px-4 sm:px-6 lg:px-8 lg:py-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">
                        Products
                    </h1>

                    <p class="mt-2 text-sm text-gray-700">
                        A list of all the Products.
                    </p>
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
                                        Reference
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
                                        Buy price
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Sell price
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Material
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Weight
                                    </th>

                                    <th
                                        scope="col"
                                        class="relative py-3.5 pl-3 pr-4 sm:pr-0"
                                    >
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
                                            <div
                                                class="flex-shrink-0 h-11 w-11"
                                            >
                                                <img
                                                    class="rounded-md h-11 w-11"
                                                    :src="
                                                        product.media[0]
                                                            .original_url
                                                    "
                                                    alt=""
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
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 rounded-md bg-gray-50 ring-1 ring-inset ring-green-600/20"
                                            >${{ product.buy_price }}</span
                                        >
                                    </td>

                                    <td
                                        class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap"
                                    >
                                        ${{ product.sell_price }}
                                    </td>

                                    <td
                                        class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap"
                                    >
                                        {{ product.matiere.name }}
                                    </td>

                                    <td
                                        class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap"
                                    >
                                        {{ product.weight }} g
                                    </td>

                                    <td
                                        class="relative py-5 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-0"
                                    >
                                        <Link
                                            :href="
                                                route(
                                                    'products.edit',
                                                    product.id
                                                )
                                            "
                                            class="text-indigo-600 hover:text-indigo-900"
                                            >Edit<span class="sr-only"
                                                >, {{ product.reference }}</span
                                            ></Link
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav
                            class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6"
                            aria-label="Pagination"
                        >
                            <div class="hidden sm:block">
                                <p class="text-sm text-gray-700">
                                    <span>Showing&nbsp;</span>

                                    <span class="font-medium">{{
                                        props.products.from
                                    }}</span>

                                    <span>&nbsp;to&nbsp;</span>

                                    <span class="font-medium">{{
                                        props.products.to
                                    }}</span>

                                    <span>&nbsp;of&nbsp;</span>

                                    <span class="font-medium">{{
                                        props.products.total
                                    }}</span>

                                    <span>&nbsp;results</span>
                                </p>
                            </div>

                            <div
                                class="flex justify-between flex-1 sm:justify-end"
                            >
                                <Link
                                    :href="props.products.prev_page_url"
                                    class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 bg-white rounded-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0 disabled:opacity-50"
                                    >Previous
                                </Link>

                                <Link
                                    :href="props.products.next_page_url"
                                    class="relative inline-flex items-center px-3 py-2 ml-3 text-sm font-semibold text-gray-900 bg-white rounded-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0 disabled:opacity-50"
                                    >Next
                                </Link>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
