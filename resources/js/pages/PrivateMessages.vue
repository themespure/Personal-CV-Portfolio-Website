<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { dashboard } from '@/routes';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Inbox',
        href: '/private-messages',
    },
];


const props = withDefaults(defineProps<{
    messages: {
        data: {
            id: number;
            subject: string;
            body: string;
            sender_name: string;
            is_read: boolean;
        }[];
    };
}>(), {
    messages: () => ({
        data: [],
    }),
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Private Messages" />

        <div class="m-10">
            <h2 class="text-xl font-semibold tracking-tight">Messages List</h2>
            <ul class="mt-4 space-y-4">
                <li
                    v-for="message in messages.data"
                    :key="message.id"
                    class="p-4 border rounded-lg hover:bg-gray-200 transition-colors cursor-pointer dark:hover:bg-gray-300"
                    :class="message.is_read ? 'bg-green-50' : 'bg-red-200'"
                >
                    <Link class="flex justify-between items-start" :href="`/private-messages/${message.uuid}`">

                        <div>
                            <h3 class="text-lg font-medium capitalize dark:text-gray-800">
                                {{ message.subject }}
                                <small class="text-[10px] text-green-500">
                                    ({{ message.created_at_human }})
                                </small>
                            </h3>

                            <p class="text-sm text-gray-600">
                                {{ message.body }}
                            </p>

                            <p class="text-xs text-gray-500">
                                From: {{ message.name }} - {{ message.email }}
                            </p>
                        </div>

                        <div class="flex items-center text-gray-400">
                            <i class="fa fa-arrow-right"></i>
                        </div>

                    </Link>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>