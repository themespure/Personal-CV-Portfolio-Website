<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    SidebarGroup,
    SidebarGroupContent,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { toUrl } from '@/lib/utils';
import { type NavItem } from '@/types';

type Props = {
    items: NavItem[];
    class?: string;
};

defineProps<Props>();
</script>

<template>
    <SidebarGroup
        :class="`group-data-[collapsible=icon]:p-0 ${$props.class || ''}`"
    >
        <SidebarGroupContent>
            <SidebarMenu>
                <SidebarMenuItem v-for="item in items" :key="item.title">
                    <SidebarMenuButton
                        class="text-neutral-600 hover:text-neutral-800 dark:text-neutral-300 dark:hover:text-neutral-100 hover:bg-neutral-100 dark:hover:bg-neutral-700 data-[state=open]:bg-neutral-100 dark:data-[state=open]:bg-neutral-700 data-[state=open]:text-neutral-800 dark:data-[state=open]:text-neutral-100"
                        as-child
                    >
                        <Link
                            :href="toUrl(item.href)"
                            target="_self"
                            rel="noopener noreferrer"
                        >
                            <component :is="item.icon" />
                            <span><b>{{ item.title }}</b> </span>
                            <span v-if="item.count" class="ml-auto bg-red-500 text-white rounded-full px-2 py-1 text-xs">
                                {{ item.count }}
                            </span>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarGroupContent>
    </SidebarGroup>
</template>
