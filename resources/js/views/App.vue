<template>
    <v-app id="inspire">
            <v-navigation-drawer id="drawer" v-model="drawer" app height="100vh">

                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title class="title">
                                Investor
                            </v-list-item-title>
                            <v-list-item-subtitle>
                                panel de administración
                            </v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                    
                    <v-list dense nav >
                        <div v-for="(item, i) in routes" :key="i">
                            <div v-if="item.subLinks">
                                <v-list-group prepend-icon="" no-action :value="false">
                                    
                                    <template v-slot:activator>
                                        <v-list-item-icon>
                                            <v-icon>{{ item.icon }}</v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                                    </template>

                                    <v-list-item v-for="(subLink, i) in item.subLinks" :key="i" :to="subLink.link" link>
                                        <v-list-item-title>{{ subLink.title }}</v-list-item-title>
                                        <v-list-item-icon>
                                            <v-icon>{{ subLink.icon }}</v-icon>
                                        </v-list-item-icon>
                                    </v-list-item>
                            
                                </v-list-group>
                            </div>
                            <div v-else>

                                <div v-if="item.link === '/logout' ">
                                    <v-list-item @click="logout()" :to="item.link" link>
                                        <v-list-item-icon>
                                            <v-icon>{{ item.icon }}</v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                                    </v-list-item>
                                </div>
                                <div v-else>
                                    <v-list-item :to="item.link" link>
                                        <v-list-item-icon>
                                            <v-icon>{{ item.icon }}</v-icon>
                                        </v-list-item-icon>
                                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                                    </v-list-item>
                                </div>    


                            </div>
                        
                        </div>
                    </v-list>
                    
                </v-navigation-drawer>

                <v-app-bar app color="primary" dark>
                    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                    <v-toolbar-title> Investor </v-toolbar-title>
                </v-app-bar>

                <v-main>
                    <v-container>
                        <v-row >
                            <v-col>
                                <transition name="fade">
                                    <router-view></router-view>
                                </transition>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-main>
    </v-app>
</template>

<script>

import authApi from '../api/auth'
import $ from 'jquery'

export default {
    data()  { 
        return {
            access: null,
            drawer:true,
            routes: [
                {
                    icon     : 'mdi-view-dashboard',
                    title     : 'Principal',
                    link: '',
                    subLinks : [
                        {
                            title : 'Carousel',
                            link    : '/sections/1/-1',
                        },
                        {
                            title : 'Sostenibilidad',
                            link    : '/sections/3/-1',
                        },
                        {
                        title : 'Herramientas',
                            link    : '/sections/4/-1',
                        },
                    ]
                },
                {
                    icon     : 'mdi-view-dashboard',
                    title     : 'Noticias y Eventos',
                    link: '',
                    subLinks : [
                        {
                            title : 'Noticias',
                            link    : '/noticias',
                        },
                        {
                            title : 'Eventos',
                            link    : '/eventos',
                        },
                    ]
                },
                {
                    icon     : 'mdi-view-dashboard',
                    title     : 'Acciones Heytics',
                    link: '',
                    subLinks : [
                        {
                            title : 'Portada',
                            link    : '/acciones/portada',
                        },
                        {
                            title : 'Eventos',
                            link    : '/',
                        },
                    ]
                },
                {
                    icon: 'mdi-logout-variant',
                    title: 'Salir',
                    link: '/logout'
                },  
            ],
            right: false,
            permanent: true,
            miniVariant: false,
            expandOnHover: false,
        }
    },
    created() {
    },
    mounted(){ 
    },
    watch: {
    },
    methods: {
        logout()
        {
            authApi.logout()
            .then( (response) => {
                location.reload(); 
            })
            .catch( (error) => {
                console.log( error );
            });
        }
    }
}
</script>



<style>

</style>