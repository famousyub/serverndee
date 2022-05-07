
import Login from './components/Login.vue';
import Signup from './components/Signup.vue';
import Me from './components/Me.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: Login
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'signup',
        path: '/signup',
        component: Signup
    },
    {
        name: 'me',
        path: '/me',
        component: Me
    }
];