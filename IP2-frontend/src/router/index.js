import { createRouter, createWebHistory } from "vue-router";
import AboutUs from "@/views/User/ordering.vue/AboutUs.vue";
import Contact from "@/views/User/ordering.vue/Contact.vue";
import Home from "@/views/User/ordering.vue/Home.vue";
import Menu from "@/views/User/ordering.vue/Menu.vue";
import Food from "@/views/User/categories/Food.vue";
import Dessert from "@/views/User/categories/Dessert.vue";
import Drink from "@/views/User/categories/Drink.vue";
import Sign_In from "@/views/User/authentication/Sign_in.vue";
import Manage_Acc from "@/views/User/authentication/Manage_acc.vue";
import My_Review from "@/views/User/authentication/My_review.vue";
import My_Order from "@/views/User/authentication/My_order.vue";
import FoodDessert_detail from "@/views/User/categories/Food&Dessert_detail.vue";
import Drink_detail from "@/views/User/categories/Drink_detail.vue";
import ForgetPassword from "@/views/User/authentication/Forget_password.vue";
import CreateAccount from "@/views/User/authentication/Create_account.vue";
import ReviewsPage from "@/views/Admin/authentication/Review_Page.vue";
import Admin_layout from "@/components/Admin_Component/admin_layout.vue";
import DashboardPage from "@/views/Admin/authentication/DashboardPage.vue";
import Chat_Page from "@/views/Admin/authentication/Chat_Page.vue";
import Stocks from "@/views/Admin/authentication/Stocks.vue";
import Delivery from "@/views/Admin/authentication/Delivery.vue";
import Wishlist from "@/views/User/authentication/Wishlist.vue";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "",
      name: "Home",
      component: Home,
    },
    {
      path: "/menu",
      name: "MenuPage",
      component: Menu,
    },
    {
      path: "/menu/food",
      name: "food",
      component: Food,
    },
    {
      path: "/menu/drink",
      name: "drink",
      component: Drink,
    },
    {
      path: "/menu/dessert",
      name: "dessert",
      component: Dessert,
    },
    {
      path: "/wishlist",
      name: "wishlist", 
      component: Wishlist,
    },
    {
      path: "/contact",
      name: "contact",
      component: Contact,
    },
    { path: "/sign-in", component: Sign_In },
    { path: "/register", component: CreateAccount },
    { path: "/forgot-password", component: ForgetPassword },

    {
      path: "/aboutUs",
      name: "aboutUs",
      component: AboutUs,
    },
    {
      path: "/sign-in",
      name: "sign-in",
      component: Sign_In,
    },
    {
      path: "/manage_Account",
      name: "manage_Account",
      component: Manage_Acc,
    },
    {
      path: "/my_review",
      name: "my_review",
      component: My_Review,
    },
    {
      path: "/my-order",
      name: "my-order",
      component: My_Order,
    },
    {
      path: "/menu/food/detail/:id",
      name: "detail",
      component: FoodDessert_detail,
    },
    {
      path: "/menu/drink/detail/:id",
      name: "drink-detail",
      component: Drink_detail,
    },
    {
      path: '/reviews',
      name: 'Reviews',
      component: ReviewsPage
    },
    // --- Admin Routes (using Admin_Layout as the parent) ---
    {
      path: '/admin', // The base path for all admin-related pages
      component: Admin_layout,
      children: [
        {
          path: 'dashboard', // Will resolve to /admin/dashboard
          name: 'DashboardPage',
          component: DashboardPage
        },
        // {
        //   path: 'orders', // Will resolve to /admin/orders
        //   name: 'Orders',
        //   component: OrdersPage
        // },
        {
          path: 'stocks', // Will resolve to /admin/stocks
          name: 'Stocks',
          component: Stocks
        },
        {
          path: 'delivery', // Will resolve to /admin/delivery
          name: 'Delivery',
          component: Delivery
        },
        {
          path: 'chat', // Will resolve to /admin/users
          name: 'ChatPage',
          component: Chat_Page
        },
        {
          path: 'reviews', // Will resolve to /admin/reviews
          name: 'Reviews',
          component: ReviewsPage // Your specific Review Page
        },
        // {
        //   path: 'chats', // Will resolve to /admin/chats
        //   name: 'Chats',
        //   component: ChatPage
        // },
        // {
        //   path: 'manage-account', // Will resolve to /admin/manage-account
        //   name: 'ManageAccount',
        //   component: ManageAccountPage
        // },

      ]

    },
    {
      // Default child route for /admin: redirect to dashboard
      path: '/admin', // Matches /admin exactly
      redirect: '/admin/dashboard'
    }
  ],
});

export default router;
