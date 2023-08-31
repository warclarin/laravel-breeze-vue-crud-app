<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head } from '@inertiajs/vue3';
import gsap from 'gsap'
import { reactive } from 'vue';
import { onMounted } from 'vue';

const props = defineProps({
    posts: Number,
    comments: Number,
    users: Number
})

const animateNumbers = reactive({
    posts: { number: props.posts },
    comments: { number: props.comments },
    users: { number: props.users }
})

onMounted(() => {
    gsap.from(animateNumbers.posts, { duration: 1, number: 0 })
    gsap.from(animateNumbers.comments, { duration: 1, number: 0 })
    gsap.from(animateNumbers.users, { duration: 1, number: 0 })
})

</script>

<template>
    <Head title="Dashboard" />

    <DefaultLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <h1 class="text-2xl font-bold">Posts</h1>
                        <h1 class="text-4xl font-extrabold">{{ animateNumbers.posts.number.toFixed(0) }}</h1>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <h1 class="text-2xl font-bold">Comments</h1>
                        <h1 class="text-4xl font-bold">{{ animateNumbers.comments.number.toFixed(0) }}</h1>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <h1 class="text-2xl font-bold">Users</h1>
                        <h1 class="text-4xl font-bold">{{ animateNumbers.users.number.toFixed(0) }}</h1>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <h1 class="text-2xl font-bold"></h1>
                        <h1 class="text-4xl font-bold"></h1>
                    </div>
                </div>
            </div>


        </div>
    </DefaultLayout>
</template>
