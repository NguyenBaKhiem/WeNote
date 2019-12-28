import Layout from './Layout';

import NotFound from '../views/NotFound';
// auth
import Login from '../views/auth/Login';
import SignUp from '../views/auth/SignUp';
import ForgotPassword from '../views/auth/ForgotPassword';
// page
import Messenger from '../views/Messenger';
import Menu from '../views/TabList';
import Notifications from '../views/Notifications';
import Profile from '../views/Profile';
import Home from '../views/Home';

export default {
  mode: 'history',
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login,
      props: (route) => ({
        confirmationCode: route.query.code,
        deviceCode: route.query.device,
      }),
      meta: {
        guest: true,
      },
    },
    {
      path: '/register',
      name: 'Sign Up',
      component: SignUp,
      meta: {
        guest: true,
      },
    },
    {
      path: '/forgot-password',
      name: 'ForgotPassword',
      component: ForgotPassword,
      meta: {
        guest: true,
      },
    },
    {
      path: '/',
      name: 'Layout',
      component: Layout,
      children: [
        {
          path: '/',
          name: 'Home',
          component: Home,
        },
        {
          path: '/messenger',
          name: 'Messenger',
          component: Messenger,
          meta: {
            auth: true,
          }
        },
        {
          path: '/menu',
          name: 'Menu',
          component: Menu,
          meta: {
            auth: true,
          }
        },
        {
          path: '/notifications',
          name: 'Notifications',
          component: Notifications,
          meta: {
            auth: true,
          }
        },
        {
          path: '/profile',
          name: 'Profile',
          component: Profile,
          meta: {
            auth: true,
          }
        },
        { path: '*', name: '404', component: NotFound }
      ]
    },
  ]
}
