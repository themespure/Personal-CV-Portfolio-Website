<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { dashboard } from '@/routes';
import { computed } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Inbox',
        href: '/private-messages',
    },
];

const props = withDefaults(defineProps<{
    message: {
        id: number;
        uuid: string;
        subject: string;
        message: string;
        name: string;
        email: string;
        sent_message: Array<{
            reply: string;
            replied_at: string;
        }>;
        is_read: boolean;
    };
}>(), {
    message: () => ({
        id: 0,
        uuid: '',
        subject: '',
        message: '',
        name: '',
        email: '',
        sent_message: [],
        is_read: false,
    }),
});


const form = useForm({
    reply: '',
});

// Submit function
const submit = () => {
    form.post(`/private-messages/${props.message.uuid}/reply`, {
        preserveState: true,  // keeps the URL the same
        replace: true,        // replace history entry (optional)
        onSuccess: () => {
            form.reset()
            modalMessage.value = 'Submitted Successfully!'
            showModal.value = true

            setTimeout(() => {
                showModal.value = false
                modalMessage.value = ''
                window.location.href = '/'
            }, 3000)
        },
        onError: () => {
            showModal.value = false
        }
    })
}


const reversedReplies = computed(() => {
    return (props.message.sent_message || []).slice().reverse()
})


const formatDate = (dateString) => {
    const date = new Date(dateString)

    const day = date.getDate()
    const month = date.toLocaleString('default', { month: 'long' })
    const year = date.getFullYear()

    const time = date.toLocaleString('default', {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    })

    const getOrdinal = (n) => {
        const s = ["th", "st", "nd", "rd"]
        const v = n % 100
        return s[(v - 20) % 10] || s[v] || s[0]
    }

    return `${day}${getOrdinal(day)} ${month}, ${year} - ${time}`
}

</script>


<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Private Message" />
        <div class="m-10">
            <Link href="/private-messages" class="text-blue-500 hover:underline mb-20">
                &larr; Back to Messages
            </Link>
            <p class="text-sm text-gray-500 mt-4">
                From: {{ message.name }} - {{ message.email }}
            </p>
            <h2 class="text-xl font-semibold tracking-tight mt-10 capitalize ">{{ message.subject }}</h2>
            <p class="text-gray-600 mt-2 border border-1 border-gray-100 p-2 dark:text-white">{{ message.message }}</p>
            <div>

                <form class="mt-6" @submit.prevent="submit">

                    <div class="flex items-center mt-2 space-x-4">
                        <span class="block mt-2 text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer border border-gray-300 dark:border-gray-600 px-3 py-1 rounded-full hover:bg-blue-100" @click="form.reply += `${message.name},`">Name</span>
                        <span class="block mt-2 text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer border border-gray-300 dark:border-gray-600 px-3 py-1 rounded-full hover:bg-blue-100" @click="form.reply += `${message.email},`">Email</span>
                    </div>

                    <textarea
                        v-model="form.reply"
                        class="w-full mt-4 p-2 border border-gray-300 rounded-md bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        cols="10" rows="5"
                        placeholder="Enter reply message"
                    ></textarea>

                    <div v-if="form.errors.reply" class="text-red-500 text-sm mt-1">
                        {{ form.errors.reply }}
                    </div>

                    <button
                        type="submit"
                        
                        class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors cursor-pointer"
                    >
                        <span v-if="!form.processing">Send Reply Message</span>
                        <span v-else>Sending...</span>
                    </button>

                </form>

            </div>

            <!-- Replies Section -->
            <div class="mt-6">
                <h3 class="text-lg font-medium">Replies</h3>
                <ul class="mt-2 space-y-2">
                    <li v-for="(reply, index) in reversedReplies" :key="index" class="p-2 border border-gray-300 rounded-md">
                        <p class="text-gray-600 dark:text-white">{{ reply.reply }}</p>
                        <p class="text-xs text-gray-500 mt-1 dark:text-gray-400">{{ formatDate(reply.replied_at) }}</p>
                    </li>
                </ul>
            </div>
        </div>  
    </AppLayout>
</template>