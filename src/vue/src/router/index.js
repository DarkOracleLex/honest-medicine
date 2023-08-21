import {createRouter, createWebHistory} from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ItemIndexView from '../views/ItemIndexView.vue'
import ItemStoreView from '../views/ItemStoreView.vue'
import ItemShowView from '../views/ItemShowView.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/item',
            name: 'item',
            // route level code-splitting
            // this generates a separate chunk (About.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: ItemIndexView
        },
        {
            path: '/item/store',
            name: 'store-item',
            // route level code-splitting
            // this generates a separate chunk (About.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: ItemStoreView
        },
        {
            path: '/item/:id',
            name: 'show-item',
            // route level code-splitting
            // this generates a separate chunk (About.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: ItemShowView
        }
    ]
})

export default router
