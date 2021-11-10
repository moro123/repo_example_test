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

import Eventos from '../views/NoticiasEventos/Eventos'
import AgregarEvento from '../views/NoticiasEventos/AgregarEvento'
import EditarEvento from '../views/NoticiasEventos/EditarEvento'


import Noticias from '../views/NoticiasEventos/Noticias'
import AgregarNoticia from '../views/NoticiasEventos/AgregarNoticia'
import EditarNoticia from '../views/NoticiasEventos/EditarNoticia'

import Posts from '../views/Blog/Posts.vue';
import AgregarPost from '../views/Blog/AgregarPost.vue';


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
			path: '/folder/:folderId',
			name: 'folder',
			component: Folder
		},
		{
			path: '/profile/:profileId',
			name: 'profile',
			component: Profile
		},
		{
			path: '/eventos',
			name: 'eventos',
			component: Eventos
		},
		{
			path: '/agregar-evento',
			name: 'agregarEvento',
			component: AgregarEvento
		},
		{
			path: '/editar-evento/:eventId',
			name: 'editarEvento',
			component: EditarEvento
		},
				{
			path: '/agregar-noticia',
			name: 'agregarNoticia',
			component: AgregarNoticia
		},
		{
			path: '/editar-noticia/:noticeId',
			name: 'editarNoticia',
			component: EditarNoticia
		},
		{
			path: '/noticias',
			name: 'noticias',
			component: Noticias
		},
		{
			path: '/posts',
			name: 'posts',
			component: Posts
		},
		{
			path: '/agregar-post',
			name: 'agregarPost',
			component: AgregarPost
		},
    ],
    
});



export default router