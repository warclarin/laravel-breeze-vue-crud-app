<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Textarea from '@/Components/Textarea.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, router } from '@inertiajs/vue3';
import moment from 'moment'
import { ref } from 'vue';

const props = defineProps({ post: Object })

const editMode = ref(null)

const editCommentForm = useForm({
    message: ''
})

const enableEditMode = (comment) => {
    editMode.value = comment.id
    editCommentForm.message = comment.message
}
const disableEditMode = () => {
    editMode.value = null
    editCommentForm.message = ''
}
const updateComment = () => {
    editCommentForm.patch(route('comments.update', { comment: editMode.value }), {
        preserveScroll: true,
        onSuccess: () => {
            editCommentForm.reset()
            editMode.value = null
        }
    })
}

const commentForm = useForm({
    'message': '',
    'post_id': props.post.id
})

const addComment = () => {
    commentForm.post(route('comments.store'), {
        preserveScroll: true,
        onSuccess: () => commentForm.reset()
    })
}

const deleteComment = (comment) => {
    const response = window.confirm('Are you sure you want to delete this comment?')

    if (response) {
        router.delete(route('comments.destroy', { comment: comment.id }), {
            preserveScroll: true
        })
    }
}

const nl2br = text => text.replace(/\n/g, '<br>')
</script>

<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-5">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h1 class="text-lg font-bold">Comments</h1>

            <div v-for="comment in post.comments" :key="comment.id" :id="`comment-${comment.id}`"
                class="flex justify-between">
                <div class="mr-5 mt-2"><i class="fas fa-user fa-2x"></i></div>
                <div class="flex-grow bg-white shadow sm:rounded-lg mb-2">
                    <div class="py-2 px-4 bg-gray-100 rounded-sm">
                        <span class="font-bold mr-2"> {{ comment.user.name }} </span>
                        <span class="text-sm">{{ moment(comment.created_at).format('MMM D, Y h:mm A') }}</span>
                    </div>

                    <div v-if="editMode != comment.id" v-html="nl2br(comment.message)" class="p-4"></div>
                    <form v-else class="p-4" @submit.prevent="updateComment">
                        <Textarea id="editCommentBox" type="text" class="mt-1 block w-full"
                            v-model="editCommentForm.message" rows="4" required />

                        <InputError class="mt-2" :message="editCommentForm.errors.message" />

                        <div class="flex items-center justify-end my-4">
                            <SecondaryButton class="ml-4" @click="disableEditMode">
                                Cancel
                            </SecondaryButton>
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': editCommentForm.processing }"
                                :disabled="editCommentForm.processing">
                                Update
                            </PrimaryButton>
                        </div>
                    </form>

                    <div v-if="$page.props.auth.user && editMode != comment.id && comment.user.id == $page.props.auth.user.id" class="flex p-2 text-sm">
                        <div class="p-2 cursor-pointer text-blue-500" @click="enableEditMode(comment)">Edit</div>
                        <div class="p-2 cursor-pointer text-red-500" @click="deleteComment(comment)">Delete</div>
                    </div>
                </div>
            </div>

            <form class="space-y-6 pl-12" @submit.prevent="addComment">
                <Textarea id="commentBox" type="text" class="mt-1 block w-full" v-model="commentForm.message" rows="4"
                    required />

                <InputError class="mt-2" :message="commentForm.errors.message" />

                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': commentForm.processing }"
                        :disabled="commentForm.processing">
                        Comment
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
