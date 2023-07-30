<script setup>
// -- Lib Components -- //
import { Link } from "@inertiajs/vue3";

// -- End Imports -- //

const props = defineProps({
    from: Number,
    to: Number,
    total: Number,
    prev: {
        type: String,
        default: null,
    },
    next: {
        type: String,
        default: null,
    },
});
</script>

<template>
    <nav
        class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6"
        aria-label="Pagination"
    >
        <div class="">
            <p class="text-sm text-gray-700">
                <span>Showing&nbsp;</span>

                <span class="font-medium">{{ props.from }}</span>

                <span>&nbsp;to&nbsp;</span>

                <span class="font-medium">{{ props.to }}</span>

                <span>&nbsp;of&nbsp;</span>

                <span class="font-medium">{{ props.total }}</span>

                <span>&nbsp;results</span>
            </p>
        </div>

        <div class="flex justify-between flex-1 sm:justify-end">
            <Link
                v-if="props.prev"
                :href="props.prev"
                class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 bg-white rounded-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0 disabled:opacity-50"
                >Previous
            </Link>

            <Link
                v-if="props.next"
                :href="props.next"
                class="relative inline-flex items-center px-3 py-2 ml-3 text-sm font-semibold text-gray-900 bg-white rounded-md ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0 disabled:opacity-50"
                >Next
            </Link>
        </div>
    </nav>
</template>
