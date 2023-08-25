<script setup>
import Pagination from '@/Components/Pagination.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3'
import moment from 'moment'

defineProps({ posts: Object })
</script>

<template>
    <Head title="Posts"></Head>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-end">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Posts</h2>
                <Link :href="route('posts.create')" class="ml-auto font-bold"><i class="fas fa-plus"></i> Create</Link>
            </div>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <table class="table-auto w-full text-left text-sm font-light">
                        <thead class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
                            <tr>
                                <th scope="col" class="px-6 py-4">ID</th>
                                <th scope="col" class="px-6 py-4">Title</th>
                                <th scope="col" class="px-6 py-4">Published</th>
                                <th scope="col" class="px-6 py-4">Link</th>
                                <th scope="col" class="px-6 py-4">Author</th>
                                <th scope="col" class="px-6 py-4">Created</th>
                                <th scope="col" class="px-6 py-4">Updated</th>
                                <th scope="col" class="px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="post in posts.data" :key="post.id"
                                class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-700">
                                <td class="px-6 py-4 font-medium">{{ post.id }}</td>
                                <td class="px-6 py-4">{{ post.title }}</td>
                                <td class="px-6 py-4">{{ post.is_published ? 'Yes' : 'No' }}</td>
                                <td class="px-6 py-4">
                                    <Link v-if="post.is_published" :href="post.slug" class="text-blue-500">Go</Link>
                                </td>
                                <td class="px-6 py-4">{{ post.author.name }}</td>
                                <td class="px-6 py-4">{{ moment(post.created_at).format('MMM D, Y HH:mm:ss') }}
                                </td>
                                <td class="px-6 py-4">{{ moment(post.updated_at).format('MMM D, Y HH:mm:ss') }}
                                </td>
                                <td class="px-6 py-4">
                                    <Link :href="`/posts/${post.id}/edit`"><i class="fas fa-edit text-blue-500 mr-2"></i>
                                    </Link>
                                    <Link href=""><i class="fas fa-trash text-red-500"></i></Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <Pagination class="mt-6 float-right" :links="posts.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
