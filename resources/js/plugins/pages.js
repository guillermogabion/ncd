import Main from '../pages/Main.vue'
import Login from '../pages/Login.vue'
import Dashboard from '../pages/Admin/Dashboard.vue'
// employee 
import Employee from '../pages/Admin/Employee/index.vue'
import AddEmployee from '../pages/Admin/Employee/includes/add.vue'
import About from '../pages/Admin/About.vue'
import Chat from '../layouts/includes/chat/index.vue'
import Settings from '../pages/settings'

// event 
import Enrollee from '../pages/Admin/Enrollee/index.vue'

// settings 
import NavSetting from '../pages/settings/navsetting.vue'
import Items from '../pages/settings/includes/item.vue'
import Delivery from '../pages/settings/includes/delivery.vue'
import Category from '../pages/settings/includes/category.vue'

import Attendance from '../pages/Attendance.vue'

import StudentsSubj from '../pages/Admin/StudentSubj'


import Patient from '../pages/Patient'
import Medicine from '../pages/Medicine'
import Disease from '../pages/Disease'

// student  

import Students from '../pages/Admin/Student'


export default [{
    path: '/',
    component: Main,
    meta: { authOnly: true },
    children: [
        // {
        //     path: '/',
        //     component: Dashboard,
        //     meta: { authOnly: true },
        // },
        // {
        //     path: '/dashboard',
        //     name: 'dashboard',
        //     component: Dashboard,
        //     meta: { authOnly: true },
        // },
        // items 

        // {
        //     path: '/allitems',
        //     component: AllItems,
        //     meta: { authOnly: true },
        //     children: [
        //         {
        //             path: '/allitems',
        //             name: 'items',
        //             meta: { authOnly: true },
        //             component : AllItems
        //         },
        //     ]
        // },
        // employee 
        {
            path: '/',
            name: 'patient',
            component: Patient,
            meta: { authOnly: true },
            children : [
               
            ]
        },
        {
            path: '/patient',
            name: 'patient',
            component: Patient,
            meta: { authOnly: true },
            children : [
               
            ]
        },
        {
            path: '/medicine',
            name: 'medicine',
            component: Medicine,
            meta: { authOnly: true },
            children : [
               
            ]
        },
        {
            path: '/disease',
            name: 'disease',
            component: Disease,
            meta: { authOnly: true },
        },

        {
            path: '/enrollee',
            name: 'enrollee',
            component: Enrollee,
            meta: { authOnly: true },
        },

        {
            path: '/about',
            name: 'about',
            component: About,
            meta: { authOnly: true },
        },

        {
            path: '/chat',
            name: 'chat',
            component: Chat,
            meta: { authOnly: true }
        },
        {
            path: '/setting',
            component: Settings,
            meta: { authOnly: true },
            children: [
                {
                    path: '/setting',
                    name: 'items',
                    meta: { authOnly: true },
                    component : Items
                },
                {
                    path: '/setting/item',
                    name: 'items',
                    meta: { authOnly: true },
                    component : Items
                },
                {
                    path: '/setting/delivery',
                    name: 'delivery',
                    component: Delivery,
                    meta: { authOnly: true }
                },
                {
                    path: '/setting/category',
                    name: 'category',
                    component: Category,
                    meta: { authOnly: true }
                },

            ]
        },
       


    ]
},
{
    path: '/login',
    name: 'login',
    component: Login,
    meta: { authOnly: false },
},
{
    path: '/attendance',
    name: 'attendance',
    component: Attendance,
    meta: {authOnly: true}
}
]

