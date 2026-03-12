<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
import { ref, onMounted, onUnmounted, computed } from 'vue';


const showModal = ref(false)
const modalMessage = ref('')

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});


// Submit function
const submit = () => {
    form.post('/contact', {
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

// Computed property for current domain URL
const currentDomain = computed(() => window.location.origin);


const props = withDefaults(
    defineProps<{
        canRegister: boolean;
        projects: Array<{
            uuid: string;
            name: string;
            type: string;
            github_url: string;
            live_url: string;
            thumbnail_url: string;
        }>;
        profile: {
            name: string;
            role: string;
            description: string;
            resume_url: string;
            photo_url: string;
        };
        clients: Array<{
            name: string;
            photos: string;
            company: string;
            testimonial: string;
        }>;
        github_url: string;
        linkedin_url: string;
        instagram_url: string;
        facebook_url: string;
    }>(),
    {
        canRegister: true,
        projects: () => [],
        profile: () => ({
            name: 'Yousuf Shimul',
            role: 'Laravel [Backend] Developer',
            description: 'Specializing in building scalable and high-performance web applications. I have strong expertise in task scheduling, queue job processing, Fixing bugs and seamless third-party API integrations. I focus on writing clean, efficient, and maintainable backend systems that ensure reliability and automation.',
            resume_url: '#',
            photo_url: '/uploads/shimul.jpeg',
        }),
        clients: () => [],
        github_url: '#',
        linkedin_url: '#',
        instagram_url: '#',
        facebook_url: '#',
    },
);

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
    
    <Head title="Yousuf Shimul - Laravel Backend Developer">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div class="min-h-screen" style="background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);">


        <Link href="/" ref="homeLink" class="hidden"></Link>

        <!-- main navigations -->
        <nav :class="['fixed top-0 w-full z-50 transition-all duration-300 border-b', isScrolled ? 'bg-black/80 backdrop-blur-md border-white/10 ' : 'bg-transparent border-transparent']">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
                <div class="flex items-center justify-between h-24">
                    <Link :href="navigation[0].href"class="flex items-center space-x-3 group cursor-pointer">
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


        <!-- hero section -->

        <section
            class="relative z-10 pt-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto flex items-center min-h-[calc(100vh-8rem)] pb-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center w-full">
                <div class="space-y-5 order-2 lg:order-1" style="opacity: 1; transform: none;">
                    <p class="font-mono text-green-400 text-lg tracking-wide animate-pulse-slow mt-10">I'm</p>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight">
                        <span class="text-gray-400 mr-3">{{ firstName }}</span>
                        <span class="text-gray-300"></span>
                        <span class="block mt-2 text-green-600 text-gradient relative inline-block">{{ lastName }}</span>
                    </h1>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-200 italic">{{ profile?.role }}</h2>
                    <div class="flex space-x-4 pl-1">
                        <div class="w-5 bg-green-600 h-auto rounded-full shadow-glow"></div>
                        <p class="text-gray-400 text-base sm:text-lg leading-relaxed max-w-xl">
                            {{ profile?.description }}
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4"><a
                        :href="profile?.resume_url || '#'" download="resume"
                        class="inline-flex items-center justify-center px-8 py-3 bg-green-600 text-white font-bold rounded-full hover:bg-green-600 transition-all duration-300 transform hover:-translate-y-1 text-sm tracking-widest uppercase group">
                        Download CV <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-download ml-2 w-4 h-4 group-hover:translate-y-1 transition-transform"
                            aria-hidden="true">
                            <path d="M12 15V3"></path>
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <path d="m7 10 5 5 5-5"></path>
                        </svg></a><a href="#latest-works"
                        class="inline-flex items-center justify-center px-8 py-3 bg-transparent border border-white/20 text-white font-bold rounded-full hover:bg-white/10 hover:border-white/40 transition-all duration-300 transform hover:-translate-y-1 text-sm tracking-widest uppercase group">
                        View My Projects <i class="fa-solid fa-arrow-right pl-4 group-hover:translate-x-1 transition-transform"></i> </a></div>
                    <div class="flex items-center gap-4 pt-4"><a :href="github_url" target="_blank"
                        rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-gray-400 transition-all duration-300 hover:text-white hover:bg-white/10 hover:border-white/50"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-github" aria-hidden="true">
                            <path
                                d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4">
                            </path>
                            <path d="M9 18c-4.51 2-5-2-7-2"></path>
                        </svg></a><a :href="linkedin_url" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-gray-400 transition-all duration-300 hover:text-blue-500 hover:bg-blue-500/10 hover:border-blue-500/50"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-linkedin" aria-hidden="true">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                            <rect width="4" height="12" x="2" y="9"></rect>
                            <circle cx="4" cy="4" r="2"></circle>
                        </svg></a><a :href="instagram_url" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-gray-400 transition-all duration-300 hover:text-pink-500 hover:bg-pink-500/10 hover:border-pink-500/50"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-instagram" aria-hidden="true">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                        </svg></a><a :href="facebook_url" target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-gray-400 transition-all duration-300 hover:text-blue-600 hover:bg-blue-600/10 hover:border-blue-600/50"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-facebook" aria-hidden="true">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg></a></div>
                </div>
                <div class="relative order-1 lg:order-2 flex justify-center items-center h-[500px]"
                    style="opacity: 1; transform: none;">
                    <div class="relative w-[350px] h-[350px] sm:w-[450px] sm:h-[450px]">
                        <div
                            class="absolute inset-0 rounded-full glow-circle border-[7px] border-l-green-500 border-t-green-600 border-r-accent-pink border-b-green-500 opacity-80"
                            style="translate: none; rotate: none; scale: none; transform: translate3d(0px, 0px, 0px) rotate(112.932deg);">
                        </div>
                        <div class="absolute inset-2 rounded-full overflow-hidden z-20 bg-gray-900"><img :alt="profile?.name || 'Profile'"
                            class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700 opacity-90 hover:opacity-100"
                            :src="profile?.photo_url || '/uploads/shimul.jpeg'"></div>
                        <div class="absolute -top-4 -left-4 z-30" style="transform: translateY(-3.68578px);">
                            <div
                                title="Laravel"
                                class="w-14 h-14 bg-gray-900 border border-gray-700 rounded-xl flex items-center justify-center shadow-lg hover:border-red-500 transition-colors group">
                                <img :src="`${currentDomain}/uploads/Laravel.png`" alt="Laravel"
                                    class="w-7 h-7 group-hover:scale-110 transition-transform">
                            </div>
                        </div>
                        <div class="absolute bottom-8 -left-4 z-30" style="transform: translateY(-19.3202px);">
                            <div
                                title="Vue.js"
                                class="w-14 h-14 bg-gray-900 border border-gray-700 rounded-xl flex items-center justify-center shadow-lg hover:border-green-600 transition-colors group">
                                <img :src="`${currentDomain}/uploads/Vue.js.png`" alt="Vue.js"
                                    class="w-7 h-7 group-hover:scale-110 transition-transform">
                            </div>
                        </div>
                        <div class="absolute bottom-4 right-0 z-30" style="transform: translateY(-11.235px);">
                            <div
                                title="Tailwind CSS"
                                class="w-14 h-14 bg-gray-900 border border-gray-700 rounded-xl flex items-center justify-center shadow-lg hover:border-yellow-400 transition-colors group">
                                <img :src="`${currentDomain}/uploads/Tailwind-CSS.png`" alt="Tailwind CSS"
                                    class="w-7 h-7 group-hover:scale-110 transition-transform">
                            </div>
                        </div>
                        <div class="absolute top-8 -right-4 z-30" style="transform: translateY(-18.3249px);">
                            <div
                                title="Livewire"
                                class="w-14 h-14 bg-gray-900 border border-gray-700 rounded-xl flex items-center justify-center shadow-lg hover:border-green-500 transition-colors group">
                                <img :src="`${currentDomain}/uploads/Livewire.png`" alt="Livewire"
                                    class="w-7 h-7 group-hover:scale-110 transition-transform">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- about me section -->

        <section id="about" class="relative py-24">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="relative group rounded-3xl bg-[#0A0A0A] border border-white/5 p-8 md:p-12 overflow-hidden shadow-glow"
                    style="opacity: 1; transform: none;">
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2">
                    </div>
                    <div class="relative z-10">
                        <div class="flex flex-col items-center mb-8">
                            <h2 class="text-3xl md:text-4xl font-bold text-white mb-2 relative inline-block">About Me
                                <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-primary rounded-full"></span>
                            </h2>
                        </div>
                        <div class="text-center space-y-6 mb-10">
                            <p class="text-gray-300 text-lg leading-relaxed">Hello! I'm <span
                                class="text-secondary font-semibold">{{ firstName }}</span>, a passionate <span
                                class="text-green-500 font-semibold">{{ profile?.role }}</span> who loves building scalable and high-performance web applications. My journey into backend development started with curiosity about how servers, databases, and APIs communicate behind the scenes—today, that curiosity drives me to design reliable and efficient systems that power real-world applications.</p>
                            <p class="text-gray-300 text-lg leading-relaxed">I specialize in Task Scheduling, Queue Job Processing, and Third-Party API Integrations, ensuring applications run smoothly, handle background processes efficiently, and communicate seamlessly with external services. My focus is on writing clean, maintainable, and optimized backend code that supports fast, secure, and scalable platforms.</p>
                            <p class="text-gray-400 text-base leading-relaxed">When I'm not coding, you can find me exploring new technologies and refining my system architecture skills. Continuous learning keeps me ahead in the ever-evolving tech landscape, and I’m always committed to improving performance, automation, and backend reliability.</p>
                        </div>
                        <div class="flex flex-wrap justify-center gap-3"><span
                            class="px-4 py-2 text-sm font-medium text-white bg-white/5 border border-white/10 rounded-full hover:border-violet-500/50 hover:bg-violet-500/10 transition-colors cursor-default shadow-[0_0_10px_rgba(139,92,246,0.2)]">#
                            Laravel</span><span
                            class="px-4 py-2 text-sm font-medium text-white bg-white/5 border border-white/10 rounded-full hover:border-amber-400/50 hover:bg-amber-400/10 transition-colors cursor-default shadow-[0_0_10px_rgba(251,191,36,0.2)]">#
                            MYSQL</span><span
                            class="px-4 py-2 text-sm font-medium text-white bg-white/5 border border-white/10 rounded-full hover:border-sky-400/50 hover:bg-sky-400/10 transition-colors cursor-default shadow-[0_0_10px_rgba(56,189,248,0.2)]">#
                            VUE.JS</span><span
                            class="px-4 py-2 text-sm font-medium text-white bg-white/5 border border-white/10 rounded-full hover:border-emerald-500/50 hover:bg-emerald-500/10 transition-colors cursor-default shadow-[0_0_10px_rgba(16,185,129,0.2)]">#
                            Tailwind CSS</span><span
                            class="px-4 py-2 text-sm font-medium text-white bg-white/5 border border-white/10 rounded-full hover:border-teal-400/50 hover:bg-teal-400/10 transition-colors cursor-default shadow-[0_0_10px_rgba(45,212,191,0.2)]">#
                            Livewire</span><span
                            class="px-4 py-2 text-sm font-medium text-white bg-white/5 border border-white/10 rounded-full hover:border-rose-500/50 hover:bg-rose-500/10 transition-colors cursor-default shadow-[0_0_10px_rgba(244,63,94,0.2)]">#
                            Alpine JS</span></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- skills -->

        <section id="skills" class="relative py-20 overflow-hidden">
            <div class="absolute top-1/2 left-0 w-64 h-64 bg-primary/10 rounded-full blur-[100px] -z-10 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-secondary/10 rounded-full blur-[100px] -z-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col items-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-2 relative inline-block">My <span class="bg-gradient-to-r from-green-400 to-blue-500 bg-clip-text text-transparent uppercase">Skills</span>
                        <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-primary rounded-full"></span>
                    </h2>
                    <p class="text-gray-400 mt-6 max-w-2xl text-center">Technologies and tools I utilize to build scalable and reliable backend systems.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        class="bg-[#0A0A0A] border border-white/5 rounded-2xl p-6 hover:border-primary/50 transition-all duration-300 hover:shadow-glow">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2 border-b border-white/10 pb-4"><i
                            class="fas fa-code text-secondary"></i>Frontend Development</h3>
                        <div class="space-y-6">
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fab fa-html5 text-orange-500"></i> HTML5</span><span
                                    class="text-sm font-medium text-gray-400">90%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-orange-400 to-orange-600 h-2.5 rounded-full relative"
                                        style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fab fa-css3-alt text-blue-500"></i> CSS</span><span
                                    class="text-sm font-medium text-gray-400">90%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-blue-400 to-blue-600 h-2.5 rounded-full relative"
                                        style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fab fa-js text-yellow-400"></i> JavaScript</span><span
                                    class="text-sm font-medium text-gray-400">80%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-yellow-300 to-yellow-500 h-2.5 rounded-full relative"
                                        style="width: 80%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fa-brands fa-tailwind-css text-blue-400"></i> Tailwind CSS</span><span
                                    class="text-sm font-medium text-gray-400">75%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-cyan-300 to-cyan-500 h-2.5 rounded-full relative"
                                        style="width: 75%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fa-brands fa-vuejs text-teal-400"></i> VUE JS</span><span
                                    class="text-sm font-medium text-gray-400">90%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-teal-300 to-teal-500 h-2.5 rounded-full relative"
                                        style="width: 90%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-[#0A0A0A] border border-white/5 rounded-2xl p-6 hover:border-primary/50 transition-all duration-300 hover:shadow-glow">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2 border-b border-white/10 pb-4"><i
                            class="fas fa-server text-green-500"></i>Backend Development</h3>
                        <div class="space-y-6">
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fa-brands fa-laravel text-red-600"></i> Laravel</span><span
                                    class="text-sm font-medium text-gray-400">90%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-green-500 to-green-700 h-2.5 rounded-full relative"
                                        style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fas fa-network-wired text-gray-400"></i> REST API Development</span><span
                                    class="text-sm font-medium text-gray-400">90%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-gray-300 to-gray-500 h-2.5 rounded-full relative"
                                        style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fas fa-database text-green-400"></i> MySQL</span><span
                                    class="text-sm font-medium text-gray-400">85%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-green-300 to-green-500 h-2.5 rounded-full relative"
                                        style="width: 85%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fas fa-exchange-alt text-purple-400"></i> Task Scheduling </span><span
                                    class="text-sm font-medium text-gray-400">90%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-purple-400 to-purple-600 h-2.5 rounded-full relative"
                                        style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fa-solid fa-briefcase text-orange-500"></i> Queue Jobs</span><span
                                    class="text-sm font-medium text-gray-400">85%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-orange-400 to-yellow-500 h-2.5 rounded-full relative"
                                        style="width: 85%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-[#0A0A0A] border border-white/5 rounded-2xl p-6 hover:border-primary/50 transition-all duration-300 hover:shadow-glow">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2 border-b border-white/10 pb-4"><i
                            class="fas fa-tools text-pink-500"></i>Tools & Others</h3>
                        <div class="space-y-6">
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fab fa-git-alt text-red-500"></i> Git & Version Control</span><span
                                    class="text-sm font-medium text-gray-400">80%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-red-400 to-red-600 h-2.5 rounded-full relative"
                                        style="width: 80%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fab fa-github text-white"></i> Server Management</span><span
                                    class="text-sm font-medium text-gray-400">90%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-gray-200 to-gray-500 h-2.5 rounded-full relative"
                                        style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fas fa-terminal text-blue-400"></i> VS Code</span><span
                                    class="text-sm font-medium text-gray-400">95%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-blue-400 to-indigo-500 h-2.5 rounded-full relative"
                                        style="width: 95%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fas fa-rocket text-orange-400"></i> Postman</span><span
                                    class="text-sm font-medium text-gray-400">90%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-orange-300 to-orange-500 h-2.5 rounded-full relative"
                                        style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="flex justify-between mb-1"><span
                                    class="text-sm font-medium text-gray-300 flex items-center gap-2"><i
                                        class="fa-solid fa-server text-purple-400"></i> Laragon</span><span
                                    class="text-sm font-medium text-gray-400">80%</span></div>
                                <div class="skill-progress-bar w-full bg-gray-700 h-2.5 rounded-full overflow-hidden">
                                    <div
                                        class="skill-progress-fill bg-gradient-to-r from-pink-400 to-purple-500 h-2.5 rounded-full relative"
                                        style="width: 80%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- educations -->

        <section id="education" class="relative py-24">
            <div class="absolute top-1/2 left-0 w-64 h-64 bg-primary/10 rounded-full blur-[100px] -z-10 -translate-y-1/2">
            </div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-secondary/10 rounded-full blur-[100px] -z-10"></div>
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col items-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-2 relative inline-block">
                        Educational <span class="bg-gradient-to-r from-green-400 to-blue-500 bg-clip-text text-transparent">Qualification</span>
                        <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-primary rounded-full"></span>
                    </h2>
                    <p class="text-gray-400 mt-6 max-w-2xl text-center">Formal education and certified technical training.</p>
                </div>
                <div class="space-y-6">
                    <div
                        class="group relative p-6 md:p-8 rounded-2xl bg-gradient-to-br from-[#0A0A0A] to-[#0F0F11] border border-white/10 hover:border-green-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10 hover:-translate-y-1">
                        <div class="relative z-10">
                            <div class="flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
                                <div class="flex items-start gap-5">
                                    <div
                                        class="w-14 h-14 bg-gradient-to-br from-green-500/20 to-emerald-500/10 rounded-xl border border-green-500/30 flex items-center justify-center shrink-0 group-hover:border-green-500/50 group-hover:from-green-500/30 group-hover:to-emerald-500/20 transition-all duration-300">
                                        <i class="fas fa-graduation-cap text-2xl text-green-500"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white group-hover:text-green-400 transition-colors">Diploma in Computer Science and Technology</h3>
                                        <p class="text-gray-400 font-medium mt-2">Pabna Polytechnic Institute</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center gap-3 px-5 py-2.5 bg-green-500/10 rounded-full border border-green-500/20 text-sm font-mono text-green-400 group-hover:bg-green-500/20 group-hover:border-green-500/40 transition-all duration-300 shrink-0">
                                    <i class="far fa-calendar-alt"></i><span>2011 - 2014</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="group relative p-6 md:p-8 rounded-2xl bg-gradient-to-br from-[#0A0A0A] to-[#0F0F11] border border-white/10 hover:border-green-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10 hover:-translate-y-1">
                        <div class="relative z-10">
                            <div class="flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
                                <div class="flex items-start gap-5">
                                    <div
                                        class="w-14 h-14 bg-gradient-to-br from-green-500/20 to-emerald-500/10 rounded-xl border border-green-500/30 flex items-center justify-center shrink-0 group-hover:border-green-500/50 group-hover:from-green-500/30 group-hover:to-emerald-500/20 transition-all duration-300">
                                        <i class="fas fa-university text-2xl text-green-500"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white group-hover:text-green-400 transition-colors">Full stack Laravel Career Path with PHP, Vue.js & AI</h3>
                                        <p class="text-gray-400 font-medium mt-2">Interactive Cares [Batch 3]</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center gap-3 px-5 py-2.5 bg-green-500/10 rounded-full border border-green-500/20 text-sm font-mono text-green-400 group-hover:bg-green-500/20 group-hover:border-green-500/40 transition-all duration-300 shrink-0">
                                    <i class="far fa-calendar-alt"></i><span>2025 [Jan - June]</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects -->

        <section id="latest-works" class="relative py-24 border-t border-gray-800/30 overflow-hidden">
            <div class="absolute top-40 -left-64 w-96 h-96 bg-primary/20 rounded-full blur-[120px] pointer-events-none">
            </div>
            <div
                class="absolute bottom-40 -right-64 w-96 h-96 bg-secondary/10 rounded-full blur-[120px] pointer-events-none">
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col items-center mb-16 text-center">
                    <div class="inline-block px-4 py-1 mb-4 rounded-full border border-cyan-500/30 bg-cyan-900/10 text-cyan-400 text-xs font-bold tracking-widest uppercase"> Showcase</div>
                    <h2 class="text-5xl md:text-6xl font-black text-white mb-2 tracking-tight">My 
                        <span class="bg-gradient-to-r from-green-400 to-blue-500 bg-clip-text text-transparent uppercase">Projects</span>
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    <div class="group relative rounded-3xl overflow-hidden bg-[#0F0F11] border border-white/5 hover:border-green-500/30 transition-all duration-500"
                        style="opacity: 1; transform: none;" v-for="(project, index) in projects" :key="project.uuid">
                        <div class="relative h-[420px] w-full overflow-hidden bg-[#1a1a1a]">
                            <div
                                class="w-full h-[120%] bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                :style="{ backgroundImage: `url(${project.thumbnail_url})` }">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/80 to-transparent opacity-90">
                            </div>
                            <div class="absolute bottom-0 left-0 w-full p-6 sm:p-8 flex flex-col h-full justify-end"><span
                                class="text-xs font-bold tracking-widest text-green-400 uppercase mb-2">{{ project.type }}</span>
                                <h3 class="text-3xl font-extrabold text-white mb-6">{{ project.name }}</h3>
                                <div class="flex flex-wrap gap-2 mb-8"><span
                                    class="px-3 py-1 text-[10px] font-bold tracking-wider text-gray-300 bg-white/5 border border-white/10 rounded-full uppercase">LARAVEL</span><span
                                    class="px-3 py-1 text-[10px] font-bold tracking-wider text-gray-300 bg-white/5 border border-white/10 rounded-full uppercase">LIVEWIRE</span><span
                                    class="px-3 py-1 text-[10px] font-bold tracking-wider text-gray-300 bg-white/5 border border-white/10 rounded-full uppercase">TAILWIND CSS</span>
                                </div>
                                <div class="flex items-center gap-3 w-full">
                                    <Link class="flex-1 flex items-center justify-center gap-2 bg-green-500 hover:bg-green-400 text-black font-bold py-3 px-6 rounded-full transition-colors uppercase text-xs tracking-wider"
                                        :href="`/projects/${project.uuid}`" data-discover="true">Case Study 
                                        <i class="fas fa-arrow-right -rotate-45 text-xs"></i>
                                    </Link>

                                    <a v-if="project.live_url" :href="project.live_url" target="_blank"
                                        rel="noopener noreferrer"
                                        class="flex items-center justify-center w-12 h-12 rounded-full border border-green-500/20 hover:bg-green-500/10 text-green-500 transition-colors">
                                        <i class="fa-solid fa-globe text-lg"></i>
                                    </a>
                                    <a v-else :href="project.github_url" target="_blank"
                                        rel="noopener noreferrer"
                                        class="flex items-center justify-center w-12 h-12 rounded-full border border-green-500/20 hover:bg-green-500/10 text-green-500 transition-colors">
                                        <i class="fab fa-github text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-6 left-6 w-10 h-10 rounded-full bg-green-500/50 backdrop-blur-sm border border-green-500/10 flex items-center justify-center text-xs font-mono text-gray-100">{{ String(index + 1).padStart(2, '0') }}</div>
                    </div>
                    
                    
                </div>
            </div>
        </section>

        <!-- testimonials -->

        <section id="testimonials" class="relative py-24 border-t border-gray-800/30 overflow-hidden">
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-primary/5 rounded-[100%] blur-[100px] -z-10 pointer-events-none">
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col items-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-2 relative inline-block text-center">Client Testimonials
                        <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-primary rounded-full"></span>
                    </h2>
                    <p class="text-gray-400 mt-6 max-w-2xl text-center">Testimonials from clients and collaborators I’ve had the privilege to work with.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- testimonials -->
                    <div
                        class="bg-[#0A0A0A] border border-white/5 rounded-2xl p-8 relative hover:border-primary/50 transition-all duration-300 group hover:-translate-y-1"
                        style="opacity: 1; transform: none;" v-for="(client, index) in clients" :key="index">
                        <div class="absolute -top-4 -right-4 text-6xl text-white/5 font-serif group-hover:text-primary/10 transition-colors"></div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-primary/20 bg-gray-800">
                                <img alt="{{ client.name }}" class="w-full h-full object-cover" :src="client.photos">
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-lg group-hover:text-green-400 transition-colors">{{ client.name }}</h4>
                                <p class="text-gray-500 text-xs uppercase tracking-wider font-medium">{{ client.company }}</p>
                            </div>
                        </div>
                        <p class="text-gray-300 italic leading-relaxed text-sm">"{{ client.testimonial }}"</p>
                        <div class="mt-6 flex text-yellow-500 text-xs">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>

                    
                </div>
            </div>
        </section>

        <!-- contacts -->

        <section id="contact" class="relative py-24 bg-background-dark overflow-hidden">
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[120px] -z-10 translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-purple-600/5 rounded-full blur-[120px] -z-10 -translate-x-1/2 translate-y-1/2">
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                    <div class="flex flex-col space-y-8" style="opacity: 1; transform: none;">
                        <div>
                            <div
                                class="inline-flex items-center space-x-2 px-3 py-1 bg-green-900/20 border border-green-500/30 rounded-full mb-6">
                                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div><span
                                    class="text-green-400 text-xs font-mono tracking-widest uppercase">Open to Opportunities</span>
                            </div>
                            <h2 class="text-6xl md:text-7xl font-black text-white leading-tight tracking-tight mb-2 text-uppercase">
                                READY TO <br><span class="bg-gradient-to-r from-green-400 to-blue-500 bg-clip-text text-transparent">COLLABORATE?</span></h2>
                            <div class="flex items-start space-x-4 mt-8 border-l-2 border-red-500/50 pl-6 py-2">
                                <p class="text-gray-400 text-lg leading-relaxed max-w-lg">Let’s transform your ideas into high-performance digital solutions—get in touch today.</p>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-4 pt-4">
                            <div
                                class="group relative w-full overflow-hidden rounded-2xl bg-[#0F1115] border border-white/5 hover:border-blue-500/30 transition-all duration-300">
                                <div class="px-6 py-5 flex items-center space-x-5">
                                    <div
                                        class="w-12 h-12 rounded-full bg-blue-500/10 flex items-center justify-center shrink-0 group-hover:bg-blue-500/20 transition-colors">
                                        <i class="fa-solid fa-at text-blue-500"></i> </div>
                                    <div class="flex flex-col"><span
                                        class="text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-1">Email</span><span
                                        class="text-xl md:text-2xl font-bold text-white tracking-tight group-hover:text-blue-400 transition-colors">{{ profile.email ?? '' }}</span>
                                    </div>
                                </div>
                                <div class="absolute inset-0 border border-blue-500/0 group-hover:border-blue-500/20 rounded-2xl transition-all duration-300 pointer-events-none"></div>
                            </div>
                            <div
                                class="group relative w-full overflow-hidden rounded-2xl bg-[#0F1115] border border-white/5 hover:border-green-500/30 transition-all duration-300">
                                <div class="px-6 py-5 flex items-center space-x-5">
                                    <div
                                        class="w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center shrink-0 group-hover:bg-green-500/20 transition-colors">
                                        <i class="fa-brands fa-whatsapp text-green-500"></i> </div>
                                    <div class="flex flex-col"><span
                                        class="text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-1">whatsApp</span><span
                                        class="text-xl md:text-2xl font-bold text-white tracking-tight group-hover:text-green-400 transition-colors">{{ profile.phone ?? '' }}</span>
                                    </div>
                                </div>
                                <div
                                    class="absolute inset-0 border border-green-500/0 group-hover:border-green-500/20 rounded-2xl transition-all duration-300 pointer-events-none">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-8" style="opacity: 1; transform: none;">
                        <div class="relative rounded-3xl p-[1px] bg-gradient-to-b from-white/10 to-transparent">
                            <div class="bg-black rounded-[23px] p-6 md:p-8 relative overflow-hidden">
                                <div class="flex items-center mb-8"><i class="fas fa-bolt text-yellow-400 text-xl mr-3"></i>
                                    <h3 class="text-2xl font-bold text-white">Send Message</h3>
                                </div>
                                <form class="space-y-5" @submit.prevent="submit">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div class="space-y-2">
                                            <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider flex items-center gap-2">
                                                <i class="fas fa-user text-green-500 text-sm"></i>
                                                Your Full Name
                                            </label>
                                            <input
                                                required
                                                placeholder="Your Full Name"
                                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:border-green-500/50 focus:ring-2 focus:ring-green-500/10 transition-all duration-300 text-sm hover:border-white/20"
                                                type="text"
                                                name="name"
                                                v-model="form.name"
                                            >
                                            <div v-if="form.errors.name" class="text-red-500 text-xs">
                                                {{ form.errors.name }}
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider flex items-center gap-2">
                                                <i class="fas fa-envelope text-blue-500 text-sm"></i>
                                                Contact Email
                                            </label>
                                            <input
                                                required
                                                placeholder="john@example.com"
                                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10 transition-all duration-300 text-sm hover:border-white/20"
                                                type="email"
                                                name="email"
                                                v-model="form.email"
                                            >
                                            <div v-if="form.errors.email" class="text-red-500 text-xs">
                                                {{ form.errors.email }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider flex items-center gap-2">
                                            <i class="fas fa-tag text-purple-500 text-sm"></i>
                                            Subject
                                        </label>
                                        <input
                                            required
                                            placeholder="Project Inquiry"
                                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/10 transition-all duration-300 text-sm hover:border-white/20"
                                            type="text"
                                            name="subject"
                                            v-model="form.subject"
                                        >
                                        <div v-if="form.errors.subject" class="text-red-500 text-xs">
                                            {{ form.errors.subject }}
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider flex items-center gap-2">
                                            <i class="fas fa-comment-dots text-pink-500 text-sm"></i>
                                            Your Message
                                        </label>
                                        <textarea
                                            required
                                            name="message"
                                            v-model="form.message"
                                            rows="5"
                                            placeholder="Tell me about your project..."
                                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3.5 text-white placeholder-gray-500 focus:outline-none focus:border-pink-500/50 focus:ring-2 focus:ring-pink-500/10 transition-all duration-300 text-sm resize-none hover:border-white/20"
                                        ></textarea>
                                        <div v-if="form.errors.message" class="text-red-500 text-xs">
                                            {{ form.errors.message }}
                                        </div>
                                    </div>
                                    <button
                                        type="submit"
                                        :disabled="form.processing"
                                        class="w-full py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold text-sm tracking-widest uppercase rounded-xl hover:from-green-400 hover:to-emerald-500 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg hover:shadow-green-500/25 flex items-center justify-center space-x-2 group disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:scale-100 cursor-pointer"
                                    >
                                        <span v-if="!form.processing">Send Message</span>
                                        <span v-else>Sending...</span>
                                        <i class="fas fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                                    </button>
                                </form>
                                <div class="absolute bottom-6 -right-6 w-12 h-12 border-b-2 border-r-2 border-red-500 rounded-br-2xl"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- footer -->

        <footer class="relative w-full border-t border-white/10 bg-[#050505] pt-12 pb-8 z-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col items-center text-center space-y-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-900 border border-green-500/50 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-code text-green-500 w-5 h-5"></i>
                        </div>
                        <span class="text-xl font-bold text-white">{{ profile?.name || 'Yousuf Shimul' }}</span>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <a :href="github_url" target="_blank" rel="noopener noreferrer"
                            class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a :href="linkedin_url" target="_blank" rel="noopener noreferrer"
                            class="text-gray-400 hover:text-blue-400 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a :href="instagram_url" target="_blank" rel="noopener noreferrer"
                            class="text-gray-400 hover:text-pink-400 transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a :href="facebook_url" target="_blank" rel="noopener noreferrer"
                            class="text-gray-400 hover:text-blue-600 transition-colors">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-8 text-sm">
                        <a :href="`mailto:${profile.email}`" class="text-gray-400 hover:text-green-400 transition-colors">
                            <i class="fas fa-envelope mr-2"></i> {{ profile.email}}
                        </a>
                        <a :href="`tel:${profile.phone}`" class="text-gray-400 hover:text-green-400 transition-colors">
                            <i class="fas fa-phone mr-2"></i>{{ profile.phone }}
                        </a>
                    </div>
                    
                    <div class="border-t border-white/10 w-full pt-6 bg-green-500/5 rounded-lg">
                        <p class="text-gray-500 text-sm">
                            ©  {{ new Date().getFullYear() }} {{ profile?.name || 'Yousuf Shimul' }}. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Back to Top Button -->
        <Transition
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-10"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-10"
        >
            <button
                v-if="showBackToTop"
                @click="scrollToTop"
                class="fixed bottom-8 right-8 z-50 w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-full shadow-lg hover:shadow-green-500/50 transition-all duration-300 hover:scale-110 flex items-center justify-center group cursor-pointer"
                aria-label="Back to top"
            >
                <i class="fas fa-arrow-up text-lg group-hover:-translate-y-0.5 transition-transform"></i>
            </button>
        </Transition>


        <div 
            v-if="showModal" 
            class="fixed inset-0 flex items-center justify-center z-50 bg-black/40"
        >
            <div class="bg-white rounded-xl p-6 w-80 text-center shadow-lg animate-fadeIn">
                <h3 class="text-lg font-bold text-green-600 mb-2">Success!</h3>
                <p class="text-gray-700">{{ modalMessage }}</p>
            </div>
        </div>

    </div>

</template>

<style>
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.95); }
  to   { opacity: 1; transform: scale(1); }
}

.animate-fadeIn {
  animation: fadeIn 0.3s ease-out forwards;
}
</style>