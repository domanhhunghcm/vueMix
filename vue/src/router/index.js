import { createRouter,createWebHistory } from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import login from "../views/Login.vue";
import register from "../views/Register.vue";
import DefaultLayout from '../components/DefaultLayout.vue';
import Survey from '../views/Survey.vue';
import store from '../store';
import authLayout from '../components/authLayout.vue';
const routes=[
    {
        path:"/",
        redirect:"/dashboard",
        component:DefaultLayout,
        meta:{ requiresAuth:true },
        children:[
            {path:"/dashboard",name:"dashboard",component:Dashboard},
            {path:"/Survey",name:"Survey",component:Survey},
        ]
    },
    {
        path:"/login",
        redirect:"/login",
        component:authLayout,
        meta:{ isGuest:true },
        children:[
            {path:"/login",name:"login",component:login},
            {path:"/register",name:"register",component:register},
        ]
    }
];

const router=createRouter({
    history:createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({name:"login"});
   　　
    }else{
        next();
    }
})

export default router;