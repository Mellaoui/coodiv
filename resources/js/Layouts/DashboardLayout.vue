<script setup>
// -- Lib Functions -- //
import { ref, computed } from "vue";
import { router, usePage } from "@inertiajs/vue3";

// -- Lib Components -- //
import { Link } from "@inertiajs/vue3";
import {
    Dialog,
    DialogPanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";

// -- Icons -- //
import {
    Bars3Icon,
    BellIcon,
    CalendarIcon,
    ChartPieIcon,
    Cog6ToothIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    TagIcon,
    XMarkIcon,
    BeakerIcon,
    TruckIcon,
    CubeIcon,
} from "@heroicons/vue/24/outline";
import { ChevronDownIcon, MagnifyingGlassIcon } from "@heroicons/vue/20/solid";
// -- End Imports -- //

const authUser = computed(() => usePage().props.auth.user);

const navigation = [
    {
        name: "Dashboard",
        href: route("dashboard"),
        icon: HomeIcon,
        current: route().current("dashboard"),
    },
    {
        name: "Products",
        href: route("products.index"),
        icon: CubeIcon,
        current: route().current("products.index"),
    },
    {
        name: "Categories",
        href: route("categories.index"),
        icon: TagIcon,
        current: route().current("categories.index"),
    },
    {
        name: "Materials",
        href: route("matieres.index"),
        icon: BeakerIcon,
        current: route().current("matieres.index"),
    },
    {
        name: "Orders",
        href: route("orders.index"),
        icon: TruckIcon,
        current: route().current("orders.index"),
    },
];

const sidebarOpen = ref(false);

function logout() {
    router.visit(route("logout"), { method: "post" });
}
</script>
<template>
    <!--
      This example requires updating your template:

      ```
      <html class="h-full bg-white">
      <body class="h-full">
      ```
    -->
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog
                as="div"
                class="relative z-50 lg:hidden"
                @close="sidebarOpen = false"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-gray-900/80" />
                </TransitionChild>

                <div class="fixed inset-0 flex">
                    <TransitionChild
                        as="template"
                        enter="transition ease-in-out duration-300 transform"
                        enter-from="-translate-x-full"
                        enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform"
                        leave-from="translate-x-0"
                        leave-to="-translate-x-full"
                    >
                        <DialogPanel
                            class="relative flex flex-1 w-full max-w-xs mr-16"
                        >
                            <TransitionChild
                                as="template"
                                enter="ease-in-out duration-300"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="ease-in-out duration-300"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <div
                                    class="absolute top-0 flex justify-center w-16 pt-5 left-full"
                                >
                                    <button
                                        type="button"
                                        class="-m-2.5 p-2.5"
                                        @click="sidebarOpen = false"
                                    >
                                        <span class="sr-only"
                                            >Close sidebar</span
                                        >
                                        <XMarkIcon
                                            class="w-6 h-6 text-white"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>
                            </TransitionChild>
                            <!-- Sidebar component, swap this element with another sidebar if you like -->
                            <div
                                class="flex flex-col px-6 pb-4 overflow-y-auto bg-white grow gap-y-5"
                            >
                                <Link
                                    :href="route('welcome')"
                                    class="flex items-center h-16 shrink-0"
                                >
                                </Link>
                                <nav class="flex flex-col flex-1">
                                    <ul
                                        role="list"
                                        class="flex flex-col flex-1 gap-y-7"
                                    >
                                        <li>
                                            <ul
                                                role="list"
                                                class="-mx-2 space-y-1"
                                            >
                                                <li
                                                    v-for="item in navigation"
                                                    :key="item.name"
                                                >
                                                    <Link
                                                        :href="item.href"
                                                        :class="[
                                                            item.current
                                                                ? 'bg-gray-50 text-indigo-600'
                                                                : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50',
                                                            'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                        ]"
                                                    >
                                                        <component
                                                            :is="item.icon"
                                                            :class="[
                                                                item.current
                                                                    ? 'text-indigo-600'
                                                                    : 'text-gray-400 group-hover:text-indigo-600',
                                                                'h-6 w-6 shrink-0',
                                                            ]"
                                                            aria-hidden="true"
                                                        />
                                                        {{ item.name }}
                                                    </Link>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="mt-auto">
                                            <a
                                                href="#"
                                                class="flex p-2 -mx-2 text-sm font-semibold leading-6 text-gray-700 rounded-md group gap-x-3 hover:bg-gray-50 hover:text-indigo-600"
                                            >
                                                <Cog6ToothIcon
                                                    class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600"
                                                    aria-hidden="true"
                                                />
                                                Settings
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div
            class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
        >
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div
                class="flex flex-col px-6 pb-4 overflow-y-auto bg-white border-r border-gray-200 grow gap-y-5"
            >
                <Link
                    :href="route('welcome')"
                    class="flex items-center h-16 shrink-0 w-fit"
                >
                </Link>
                <nav class="flex flex-col flex-1">
                    <ul role="list" class="flex flex-col flex-1 gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li v-for="item in navigation" :key="item.name">
                                    <a
                                        :href="item.href"
                                        :class="[
                                            item.current
                                                ? 'bg-gray-50 text-indigo-600'
                                                : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50',
                                            'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                        ]"
                                    >
                                        <component
                                            :is="item.icon"
                                            :class="[
                                                item.current
                                                    ? 'text-indigo-600'
                                                    : 'text-gray-400 group-hover:text-indigo-600',
                                                'h-6 w-6 shrink-0',
                                            ]"
                                            aria-hidden="true"
                                        />
                                        {{ item.name }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="mt-auto">
                            <a
                                href="#"
                                class="flex p-2 -mx-2 text-sm font-semibold leading-6 text-gray-700 rounded-md group gap-x-3 hover:bg-gray-50 hover:text-indigo-600"
                            >
                                <Cog6ToothIcon
                                    class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600"
                                    aria-hidden="true"
                                />
                                Settings
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            <div
                class="sticky top-0 z-40 flex items-center h-16 px-4 bg-white border-b border-gray-200 shadow-sm shrink-0 gap-x-4 sm:gap-x-6 sm:px-6 lg:px-8"
            >
                <button
                    type="button"
                    class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
                    @click="sidebarOpen = true"
                >
                    <span class="sr-only">Open sidebar</span>
                    <Bars3Icon class="w-6 h-6" aria-hidden="true" />
                </button>

                <!-- Separator -->
                <div
                    class="w-px h-6 bg-gray-200 lg:hidden"
                    aria-hidden="true"
                />

                <div class="flex self-stretch flex-1 gap-x-4 lg:gap-x-6">
                    <form class="relative flex flex-1" action="#" method="GET">
                        <label for="search-field" class="sr-only">Search</label>
                        <MagnifyingGlassIcon
                            class="absolute inset-y-0 left-0 w-5 h-full text-gray-400 pointer-events-none"
                            aria-hidden="true"
                        />
                        <input
                            id="search-field"
                            class="block w-full h-full py-0 pl-8 pr-0 text-gray-900 border-0 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
                            placeholder="Search..."
                            type="search"
                            name="search"
                        />
                    </form>
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <button
                            type="button"
                            class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500"
                        >
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="w-6 h-6" aria-hidden="true" />
                        </button>

                        <!-- Separator -->
                        <div
                            class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200"
                            aria-hidden="true"
                        />

                        <!-- Profile dropdown -->
                        <Menu as="div" class="relative">
                            <MenuButton class="-m-1.5 flex items-center p-1.5">
                                <span class="sr-only">Open user menu</span>

                                <img
                                    class="object-cover w-8 h-8 rounded-full bg-gray-50"
                                    :src="authUser.media"
                                    :alt="authUser.data.name"
                                />

                                <span class="hidden lg:flex lg:items-center">
                                    <span
                                        class="ml-4 text-sm font-semibold leading-6 text-gray-900"
                                        aria-hidden="true"
                                        >{{ authUser.data.name }}</span
                                    >

                                    <ChevronDownIcon
                                        class="w-5 h-5 ml-2 text-gray-400"
                                        aria-hidden="true"
                                    />
                                </span>
                            </MenuButton>

                            <transition
                                enter-active-class="transition duration-100 ease-out"
                                enter-from-class="transform scale-95 opacity-0"
                                enter-to-class="transform scale-100 opacity-100"
                                leave-active-class="transition duration-75 ease-in"
                                leave-from-class="transform scale-100 opacity-100"
                                leave-to-class="transform scale-95 opacity-0"
                            >
                                <MenuItems
                                    class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                                >
                                    <MenuItem v-slot="{ active }">
                                        <Link
                                            as="button"
                                            :href="route('profile.edit')"
                                            :class="[
                                                active ? 'bg-gray-100' : '',
                                                'block w-full px-4 py-2 text-sm leading-5 text-left text-gray-700',
                                            ]"
                                        >
                                            Profile
                                        </Link>
                                    </MenuItem>

                                    <MenuItem v-slot="{ active }">
                                        <button
                                            @click="logout()"
                                            type="button"
                                            :class="[
                                                active ? 'bg-gray-100' : '',
                                                'block w-full px-4 py-2 text-sm leading-5 text-left text-gray-700',
                                            ]"
                                        >
                                            Logout
                                        </button>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
