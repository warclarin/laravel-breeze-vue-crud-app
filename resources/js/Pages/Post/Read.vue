<script setup>
import CommentSection from '@/Components/CommentSection.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head } from '@inertiajs/vue3';
import moment from 'moment'

defineProps({ post: Object })
</script>

<template>
    <Head :title="post.title"></Head>

    <DefaultLayout>
        <template #header>
            <h2 class="font-semibold text-5xl text-gray-800 dark:text-gray-200 leading-tight">{{ post.title }}</h2>
            <div class="text-gray-500 font-semibold">{{ moment(post.created_at).format('MMM D, Y h:mm A') }}</div>
            <div class="font-bold">{{ post.author.name }}</div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <p v-html="post.body"></p>
                </div>
            </div>

            <CommentSection :post="post"/>
        </div>
    </DefaultLayout>
</template>
