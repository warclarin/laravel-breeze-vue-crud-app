<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    body: ''
})

const createPost = () => {
    form.post(route('posts.store'), {
        onSuccess: () => form.reset()
    })
}

</script>

<template>
    <Head title="Create Post"></Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Post</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <form class="space-y-6" @submit.prevent="createPost">
                        <div>
                            <InputLabel for="title" value="Title" />

                            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" autofocus />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div>
                            <InputLabel for="body" value="Body" />

                            <Textarea id="body" type="text" class="mt-1 block w-full" v-model="form.body" rows="8" />

                            <InputError class="mt-2" :message="form.errors.body" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Create
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>