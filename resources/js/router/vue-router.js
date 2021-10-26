import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '../views/Home'

import Section from '../views/Sections/Section'
import Sections from '../views/Sections/Sections'

import Carousel from '../views/Principal/Carousel'
import Sostenibilidad from '../views/Principal/Sostenibilidad'
import Herramientas from '../views/Principal/Herramientas'

import Folder from '../views/Sections/Folder'
import Profile from '../views/Sections/Profile'


Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
	routes: [
		{
			path: '/sections/:mainSectionId/:sectionId',
			name: 'sections',
			component: Sections
		},
        {
			path: '/section/:sectionId',
			name: 'section',
			component: Section
		},
        {
			path: '/principal/carousel',
			name: 'carousel',
			component: Carousel
		},
		{
			path: '/principal/sostenibilidad',
			name: 'sostenibilidad',
			component: Sostenibilidad
		},
        {
			path: '/principal/herramientas',
			name: 'herramientas',
			component: Herramientas
		},
		{
			path: '/folder',
			name: 'folder',
			component: Folder
		},
		{
			path: '/profile/:sectionId',
			name: 'profile',
			component: Profile
		},
    ],
    
});



export default router