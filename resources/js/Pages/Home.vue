<script setup>
import Pagination from '@/Components/Pagination.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment'

defineProps({ posts: Object })

const sliceBody = (body) => body.slice(0, 200)

</script>

<template>
    <Head title="Home"></Head>

    <DefaultLayout>
        <template #header>
            <h2 class="font-semibold text-5xl text-gray-800 dark:text-gray-200 leading-tight">What's new?</h2>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-for="post in posts.data"
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-2 hover:scale-105 transition hover:font-bold">
                    <div class="post-title text-xl">
                        {{ post.title }}
                    </div>
                    
                    <div class="post-info">
                        <div class="text-gray-500 font-semibold text-sm">{{ moment(post.created_at).format('MMM D, Y h:mm A') }}</div>
                        <div class="text-sm">{{ post.author.name }}</div>
                    </div>
                    
                    <div class="post-body text-ellipsis overflow-hidden whitespace-nowrap">
                        {{ sliceBody(post.body) }}
                    </div>

                    <div>
                        <Link :href="post.slug" class="text-blue-500">Read more</Link>
                    </div>
                </div>

                <Pagination class="mt-6" :links="posts.links" />
            </div>


        </div>
    </DefaultLayout>
</template>
