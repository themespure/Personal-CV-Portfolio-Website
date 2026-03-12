<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
import { ref, onMounted, onUnmounted, computed } from 'vue';

// Computed property for current domain URL
const currentDomain = computed(() => window.location.origin);

const props = withDefaults(
    defineProps<{
        project: Array<{
            uuid: string;
            name: string;
            type: string;
            github_url: string;
            live_url: string;
            thumbnail_url: string;
            features: string;
            technology_used: string;
            build_tags: string;
        }>;
        thumbnail_url : string;
        github_url: string;
        linkedin_url: string;
        instagram_url: string;
        facebook_url: string;
    }>(),
    {
        thumbnail_url: '#',
        github_url: '#',
        linkedin_url: '#',
        instagram_url: '#',
        facebook_url: '#',
    },
);

const featureList = computed(() => {
    return props.project.features
        ?.split(',')
        .map(item => item.trim())
        .filter(item => item !== '') || [];
});

const techusedList = computed(() => {
    return props.project.technology_used
        ?.split(',')
        .map(item => item.trim())
        .filter(item => item !== '') || [];
});

const buildTagsList = computed(() => {
    return props.project.build_tags
        ?.split(',')
        .map(item => item.trim())
        .filter(item => item !== '') || [];
});

const navigation = ref([
    { name: 'Home', href: '/' },
    { name: 'About', href: '/#about' },
    { name: 'Skills', href: '/#skills' },
    { name: 'Projects', href: '/#latest-works' },
    { name: 'Contact Me', href: '/#contact' },
]);


const isMobileMenuOpen = ref(false);
const isScrolled = ref(false);
const showBackToTop = ref(false);

// Computed properties for safe name splitting
const firstName = computed(() => props.profile?.name?.split(' ')[0] || 'Yousuf');
const lastName = computed(() => props.profile?.name?.split(' ')[1] || 'Shimul');



const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

const closeMobileMenu = () => {
    isMobileMenuOpen.value = false;
};

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
    showBackToTop.value = window.scrollY > 300;
};

const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});


</script>
<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="min-h-screen" style="background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);">

        <!-- main navigations -->
        <nav :class="['fixed top-0 w-full z-50 transition-all duration-300 border-b', isScrolled ? 'bg-black/80 backdrop-blur-md border-white/10 ' : 'bg-transparent border-transparent']">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
                <div class="flex items-center justify-between h-24">
                    <Link :href="navigation[0].href" class="flex items-center space-x-3 group cursor-pointer">
                        <div
                            class="w-10 h-10 bg-gray-900 border border-primary/50 rounded flex items-center justify-center shadow-glow transition-all duration-300 hover:scale-105 group-hover:border-secondary/50">
                            
                            <i class="fa-solid fa-code lucide lucide-code text-green-500 w-5 h-5 group-hover:text-green-400 transition-colors"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-extrabold tracking-wider text-white">
                                YOUSUF <span class="text-green-600"> SHIMUL</span>
                            </span>
                            <div class="flex items-center space-x-1"><span
                                class="h-[2px] w-3 bg-green-700 mr-2 rounded-full"></span><span
                                class="text-[0.6rem] font-mono text-gray-400 tracking-widest uppercase pr-5"> Laravel DEVELOPER</span>
                            </div>
                        </div>
                    </Link>
                    <div class="hidden md:flex items-center space-x-10">
                        <Link :href="navigation[0].href" class="text-sm font-medium text-gray-300 hover:text-white transition-colors tracking-widest uppercase relative group">
                            HOME
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
                        </Link>
                        <a :href="navigation[1].href" class="text-sm font-medium text-gray-300 hover:text-white transition-colors tracking-widest uppercase relative group">
                            ABOUT
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a :href="navigation[2].href" class="text-sm font-medium text-gray-300 hover:text-white transition-colors tracking-widest uppercase relative group">
                            SKILLS
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <Link :href="navigation[3].href" class="text-sm font-medium text-gray-300 hover:text-white transition-colors tracking-widest uppercase relative group">
                            PROJECTS
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
                        </Link>
                        <a :href="navigation[4].href" class="text-sm font-medium text-gray-300 hover:text-white transition-colors tracking-widest uppercase relative group">
                            CONTACT ME
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </div>
                    <div class="hidden md:block">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="currentDomain + '/dashboard'"
                            class="border border-green-400 rounded-full relative inline-flex items-center justify-center px-8 py-3 text-white font-bold tracking-widest uppercase overflow-hidden group transition-all duration-300 hover:scale-105"
                        >
                            <span class="relative z-10 flex items-center gap-2">
                            <span class="font-mono">&lt;Dashboard /&gt;</span>
                            </span>
                        </Link>

                        <Link
                            v-else
                            :href="navigation[4].href"
                            class="border border-green-400 rounded-full relative inline-flex items-center justify-center px-8 py-3 text-white font-bold tracking-widest uppercase overflow-hidden group transition-all duration-300 hover:scale-105"
                        >
                            <span class="relative z-10 flex items-center gap-2">
                            <span class="font-mono">&lt;Hire Me /&gt;</span>
                            </span>
                        </Link>
                    </div>
                    <div class="md:hidden">
                        <button @click="toggleMobileMenu" class="text-gray-300 hover:text-white focus:outline-none transition-colors">
                            <svg v-if="!isMobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-menu" aria-hidden="true">
                                <path d="M4 5h16"></path>
                                <path d="M4 12h16"></path>
                                <path d="M4 19h16"></path>
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-x" aria-hidden="true">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <Transition
                enter-active-class="transition duration-300 ease-out"
                enter-from-class="opacity-0 scale-95"
                enter-to-class="opacity-100 scale-100"
                leave-active-class="transition duration-200 ease-in"
                leave-from-class="opacity-100 scale-100"
                leave-to-class="opacity-0 scale-95"
            >
                <div v-show="isMobileMenuOpen" class="md:hidden fixed inset-0 z-40 bg-black/95 backdrop-blur-sm">
                    <button @click="closeMobileMenu" class="absolute top-6 right-6 text-gray-300 hover:text-white focus:outline-none transition-colors z-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-x w-8 h-8" aria-hidden="true">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                    <div class="flex flex-col items-center justify-center min-h-screen space-y-8 px-4">
                    <Link :href="navigation[0].href" @click="closeMobileMenu"
                        class="text-2xl font-bold text-gray-300 hover:text-white transition-colors tracking-widest uppercase relative group">
                        HOME
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
                    </Link>
                    <a :href="navigation[1].href" @click="closeMobileMenu"
                        class="text-2xl font-bold text-gray-300 hover:text-white transition-colors tracking-widest uppercase relative group">
                        ABOUT
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a :href="navigation[2].href" @click="closeMobileMenu"
                        class="text-2xl font-bold text-gray-300 hover:text-white transition-colors tracking-widest uppercase relative group">
                        SKILLS
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <Link :href="navigation[3].href" @click="closeMobileMenu"
                        class="text-2xl font-bold text-gray-300 hover:text-white transition-colors tracking-widest uppercase relative group">
                        PROJECTS
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
                    </Link>
                    <a :href="navigation[4].href" @click="closeMobileMenu"
                        class="text-2xl font-bold text-gray-300 hover:text-white transition-colors tracking-widest uppercase relative group">
                        CONTACT ME
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" @click="closeMobileMenu"
                        class="border border-1 border-green-400 rounded-full relative inline-flex items-center justify-center px-8 py-3 text-white font-bold tracking-widest uppercase rounded-lg overflow-hidden group transition-all duration-300 hover:scale-105">
                        <span class="relative z-10 flex items-center gap-2">
                            <span class="font-mono">&lt;Hire Me /&gt;</span>
                        </span>
                    </a>
                </div>
            </div>
            </Transition>
        </nav>

        <!-- Project Details -->
         <section class="bg-gray-900 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="pt-32 pb-16 px-4 sm:px-6 lg:px-8">
                    <div class="relative rounded-3xl overflow-hidden border border-white/10 aspect-video md:aspect-[21/9] mb-12 group">
                        <div class="absolute inset-0 bg-cover bg-top" :style="{ backgroundImage: `url(${'/'+thumbnail_url})` }"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full">
                            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                                <div>
                                    <span class="inline-block px-3 py-1 mb-4 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold tracking-widest uppercase">{{ project.type }}</span>
                                    <h1 class="text-4xl md:text-6xl font-black text-white mb-4 tracking-tight">{{ project.name }}</h1>
                                </div>
                                <div class="flex gap-4">
                                    <a :href="project.live_url" target="_blank" class="flex items-center gap-2 bg-green-500 hover:bg-green-400 text-black font-bold py-3 px-6 rounded-full transition-colors uppercase text-xs tracking-wider">Live Preview <i class="fa-solid fa-arrow-up-right-from-square"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-20">
                        <div class="lg:col-span-2 space-y-12">

                            <section>
                                <h1 class="text-2xl font-bold text-white mb-6 flex items-center gap-3"> <span class="w-8 h-1 bg-green-500 rounded-full"></span> Project Overview</h1>
                                <p class="text-gray-400 text-lg leading-relaxed">{{ project.overview }}</p>
                            </section>

                            <!-- App Feature -->
                            <section class="bg-white/5 border border-white/10 rounded-2xl p-8">
                                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3"> <i class="fa-solid fa-circle-info text-green-500"></i> App Features</h3>
                                <li class="flex gap-4 text-gray-400" v-for="(item, index) in featureList" :key="index">
                                    <span class="flex-none mt-1.5 w-1.5 h-1.5 rounded-full bg-green-400/50"></span>
                                    <span>{{ item }}</span>
                                </li>
                            </section>
                        </div>
                        <div class="lg:col-span-1">

                            <!-- Software Version -->
                            <div class="sticky top-32 p-6 rounded-2xl border border-white/10 bg-[#0F0F11]">
                                <div class="flex items-center gap-3 mb-6 pb-6 border-b border-white/10">
                                    <i class="fa-solid fa-list-check text-green-500"></i>
                                    <h3 class="text-lg font-bold text-white">Software Version</h3>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex items-center gap-3 group" v-for="(tech, index) in techusedList" :key="index">
                                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:border-green-500/50 transition-colors">
                                            <span class="text-xs font-mono text-green-400">{{ index+1 }}</span>
                                        </div>
                                        <span class="text-gray-300 text-sm font-medium">{{ tech }}</span>
                                    </div>
                                </div>

                                <!-- build tags -->

                                <div class="mt-8 pt-6 border-t border-white/10">
                                    <div class="text-xs font-bold text-white uppercase tracking-widest mb-3 gap-2 flex items-center">
                                        <i class="fa-solid fa-tag text-green-500"></i>
                                        <span>Tags</span>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-3 py-1 text-[11px] font-bold tracking-wider text-gray-400 bg-white/5 border border-white/5 rounded-full uppercase" v-for="(tag, index) in buildTagsList" :key="index">{{ tag }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>
</template>