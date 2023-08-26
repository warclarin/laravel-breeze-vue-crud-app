<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    post: Object
})

// delete post
const deleteForm = useForm({});
const confirmingDeletion = ref(false)
const confirmDeletion = () => confirmingDeletion.value = true
const deletePost = () => {
    deleteForm.delete(route('posts.destroy', { post: props.post.id }), {
        onSuccess: () => closeModal()
    })
}
const closeModal = () => confirmingDeletion.value = false

// edit post
const form = useForm({
    title: props.post.title,
    body: props.post.body
})

const updatePost = () => {
    form.put(route('posts.update', { post: props.post.id }))
}

</script>

<template>
    <Head title="Update Post"></Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Post</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <form class="space-y-6" @submit.prevent="updatePost">
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
                                Update
                            </PrimaryButton>
                            <DangerButton class="ml-4" type="button" @click="confirmDeletion">
                                Delete
                            </DangerButton>
                        </div>
                    </form>
                </div>
            </div>
            
            <Modal :show="confirmingDeletion">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Are you sure you want to delete this post?
                    </h2>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                        <DangerButton class="ml-3" @click="deletePost">
                            Delete
                        </DangerButton>
                    </div>
                </div>
            </Modal>

        </div>
    </AuthenticatedLayout>
</template>
