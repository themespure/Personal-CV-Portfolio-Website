<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, Globe, Inbox } from 'lucide-vue-next';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import AppLogo from './AppLogo.vue';
import { dashboard } from '@/routes';
import axios from 'axios';
import { ref, onMounted, computed } from 'vue';


const newMessageCount = ref(0)

const fetchNewMessages = async () => {
    try {
        const response = await axios.get('/new-messages')
        newMessageCount.value = response.data.new_message_count
    } catch (error) {
        console.error('Error fetching messages:', error)
    }
}

onMounted(() => {
    fetchNewMessages()
})

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
];

const footerNavItems = computed<NavItem[]>(() => [
    {
        title: 'Visit Website',
        href: '/',
        icon: Globe,
        count: 0,
    },
    {
        title: `Inbox`,
        href: '/private-messages',
        icon: Inbox,
        count: newMessageCount.value,
    }
]);





</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
