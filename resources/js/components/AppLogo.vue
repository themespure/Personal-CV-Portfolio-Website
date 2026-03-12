<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { useInitials } from '@/composables/useInitials';
import type { User } from '@/types';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { computed } from 'vue';



</script>

<template>
    <div class="flex aspect-square size-8 items-center justify-center rounded-md bg-green-500 text-sidebar-primary-foreground">
        <AppLogoIcon class="size-5 fill-current text-white dark:text-black" />
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm">
        <span class="mb-0.5 truncate leading-tight font-semibold">Yousuf Shimul</span>
    </div>
</template>
