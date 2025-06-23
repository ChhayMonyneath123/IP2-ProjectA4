import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import axios from 'axios'
import My_order from '@/components/My_order.vue'

const routes = [
    // ==========================================
    // PUBLIC PAGES (No Authentication Required)
    // ==========================================
    {
        path: '/',
        name: 'Home',
        component: () => import('@/views/User/ordering.vue/Home.vue'),
        meta: { requiresAuth: false }
    },
    {
        path: '/menu',
        name: 'MenuPage',
        component: () => import('@/views/User/ordering.vue/Menu.vue'),
        meta: { requiresAuth: false }
    },
    {
        path: '/contact',
        name: 'contact',
        component: () => import('@/views/User/ordering.vue/Contact.vue'),
        meta: { requiresAuth: false }
    },
    {
        path: '/aboutUs',
        name: 'aboutUs',
        component: () => import('@/views/User/ordering.vue/AboutUs.vue'),
        meta: { requiresAuth: false }
    },

    // ==========================================
    // PRODUCT DETAIL PAGES
    // ==========================================
    {
        path: '/menu/detail/:id',
        name: 'detail',
        component: () => import('@/views/User/categories/Food&Dessert_detail.vue'),
        meta: { requiresAuth: false }
    },
    {
        path: '/menu/drink/detail/:id',
        name: 'drink-detail',
        component: () => import('@/views/User/categories/Drink_detail.vue'),
        meta: { requiresAuth: false }
    },

    // ==========================================
    // AUTHENTICATION PAGES (Guest Only)
    // ==========================================
    {
        path: '/login',
        name: 'login',
        component: () => import('@/views/User/authentication/Log_in.vue'),
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/views/User/authentication/Create_account.vue'),
        meta: { guestOnly: true }
    },
    {
        path: '/forgot-password',
        name: 'forgot-password',
        component: () => import('@/views/User/authentication/Forget_password.vue'),
        meta: { guestOnly: true }
    },

    // ==========================================
    // USER ACCOUNT PAGES (Authentication Required)
    // ==========================================
    {
        path: '/manage_Account',
        name: 'manage_Account',
        component: () => import('@/views/User/authentication/Manage_acc.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/my_review',
        name: 'my_review',
        component: () => import('@/views/User/authentication/My_review.vue'),
        meta: { requiresAuth: true }
    },

    // ==========================================
    // SHOPPING & ORDERS (Authentication Required)
    // ==========================================
    {
        path: '/wishlist',
        name: 'Wishlist',
        component: () => import('@/components/Wishlist.vue'),
        meta: { requiresAuth: true }
    },
    // Cart - Commented Out
    // {
    //     path: '/cart',
    //     name: 'Cart',
    //     component: () => import('@/components/My_order.vue')
    //     // meta: { requiresAuth: true }
    // },
    {
        path: '/my-order',
        name: 'My_order',
        component: () => import('@/components/My_order.vue')
    },
    {
        path: "/payment",
        name: "Payment",
        component: () => import('@/views/User/authentication/Payment.vue'),
    },

    // ==========================================
    // ADMIN SECTION
    // ==========================================
    {
        path: '/admin',
        component: () => import('@/components/Admin_Component/admin_layout.vue'),
        children: [
            {
                path: '',
                redirect: '/admin/dashboard'
            },
            // Admin Dashboard
            {
                path: 'dashboard',
                name: 'DashboardPage',
                component: () => import('@/views/Admin/authentication/DashboardPage.vue')
            },
            // Admin Management Pages
            {
                path: 'orders',
                name: 'OrdersPage',
                component: () => import('@/views/Admin/authentication/Order.vue')
            },
            {
                path: 'stocks',
                name: 'Stocks',
                component: () => import('@/views/Admin/authentication/Stocks.vue')
            },
            {
                path: 'delivery',
                name: 'Delivery',
                component: () => import('@/views/Admin/authentication/DeliveryPage.vue')
            },
            {
                path: 'reviews',
                name: 'AdminReviews',
                component: () => import('@/views/Admin/authentication/Review_Page.vue')
            },
            // Admin Communication
            {
                path: 'chat',
                name: 'ChatPage',
                component: () => import('@/views/Admin/authentication/Chat_Page.vue')
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})

// ==========================================
// ROUTE GUARDS (Currently Commented Out)
// ==========================================
// router.beforeEach(async (to) => {
//     axios.defaults.baseURL = 'http://localhost:8000/api';
//     axios.defaults.withCredentials = true; // if needed for cookies
    
//     const authStore = useAuthStore()
//     await authStore.init() // Make sure to await the init if it's async

//     // Check if route requires authentication and user is not authenticated
//     if (to.meta.requiresAuth && !authStore.isAuthenticated) {
//         return { name: 'login', query: { redirect: to.fullPath } }
//     }

//     // Check if route requires admin and user is not admin
//     if (to.meta.requiresAdmin && (!authStore.isAuthenticated || authStore.user.role !== 'admin')) {
//         return { name: 'Home' }
//     }

//     // Check if route is guest only and user is authenticated
//     if (to.meta.guestOnly && authStore.isAuthenticated) {
//         return { 
//             path: authStore.user.role === 'admin' ? '/admin/dashboard' : '/' 
//         }
//     }
// })

export default router