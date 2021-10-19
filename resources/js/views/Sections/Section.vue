<template>
    <div id="section">

        <messages ref="messages" :progress="progress"></messages>

        <v-row>
            <v-col cols="12" md="6">
                <h3> Sección: {{ section.name }} </h3>
            </v-col>
            <v-col cols="12" md="6" class="text-right">
                <v-btn
                    :disabled="!valid"
                    color="primary"
                    class="mr-4"
                    @click="openSections()">
                    Secciones
                </v-btn>
            </v-col>
        </v-row>


        <v-form
            ref="form">

                <v-row>
                    <v-col cols="12" md="6">

                        <v-menu
                            ref="menu"
                            v-model="menu"
                            :close-on-content-click="false"
                            :return-value.sync="section.date"
                            transition="scale-transition"
                            offset-y
                            min-width="auto">

                            <template v-slot:activator="{ on, attrs }">

                                <v-text-field
                                    class="picker-date"
                                    v-model="section.date"
                                    prepend-inner-icon="mdi-calendar"
                                    append-icon="mdi-chevron-down"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on">
                                </v-text-field>
                                    
                            </template>

                            <v-date-picker
                                v-model="section.date"
                                no-title
                                scrollable
                                locale="es-ES">

                                <v-spacer></v-spacer>
                                <v-btn tex color="primary" @click="menu = false"> Cancelar </v-btn>
                                <v-btn text color="primary" @click="$refs.menu.save(section.date)"> OK </v-btn>
                            </v-date-picker>

                        </v-menu>


    
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="section.header"
                            :counter="10"
                            label="Encabezado"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="section.title"
                            label="Titulo"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="section.subtitle"
                            label="Subtitulo"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-textarea
                    prepend-icon="mdi-text"
                    v-model="section.description"
                    name="input-7-1"
                    label="Descripción"
                    value=""
                ></v-textarea>

                <v-row>
                    <v-col cols="12" md="12">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="section.legend"
                            label="Video leyenda"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-img contain :src="section.currentImage" width="320" height="240"> </v-img>
                    </v-col>
                    <v-col cols="12" md="6">
                        <video width="320" height="240" controls>
                            <source :src="section.currentVideo" type="video/mp4">
                        </video> 
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-file-input
                        @change="Preview_image"
                        v-model="section.image"
                        accept="image/*"
                        label="Imagen"
                        
                        ></v-file-input>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-file-input
                        @change="Preview_video"
                        v-model="section.video"
                        accept="video/*"
                        label="Video"
                        
                        ></v-file-input>
                    </v-col>
                </v-row>

                <v-btn  class="mr-4" @click="reset">
                    Cancelar
                </v-btn>

                <v-btn
                    color="primary"
                    class="mr-4"
                    @click="update()">
                    Guardar
                </v-btn>

        </v-form>

        <br><br>

        <profiles></profiles>
        <br><br>
        <folders></folders>

     
    </div>
</template>

<script>
import Folders from './Folders.vue'
import Profiles from './Profiles.vue'

import Messages from '../../messages/Messages.vue'
import sectionApi from '../../api/sections.js'

export default {
    components: {
        Folders,
        Profiles,
        Messages
    },
    data() {
        return {
            host: 'http://investor.admin.sandbox/',
            menu: false,
            valid: true,
            progress: false,
            section: {
                name: '',
                header: '',
                title: '',
                subtitle: '',
                description: '',
                image: [],
                video: [],
                date: '',
                legend: '',
                link: ''
            },
            valid: true,
            select: null,
            items: [
                'Item 1',
                'Item 2',
                'Item 3',
                'Item 4',
            ],
            checkbox: false,
        }
    },
    computed: {
    },

    mounted()
    {
        console.log( { section: this.$route.params } );

        let section = this.$route.params.item;

        if ( section.image === '' || section.image === '[]' ) {
            section.image = [];
        }

        if ( section.image !== '' ){
            section.currentImage = this.host + section.image;
            section.image = [];
        }

        if ( section.video === '' || section.video === '[]' ) {
            section.video = [];
        }

        if ( section.video !== '' ) {
            section.currentVideo =  this.host + section.video;
            section.video = [];
        }

        console.log( { SECTION: section } );

        this.section = section;
        
        if( this.section != null ) {
            this.initialize();
        }
    },

    watch: {
        'section.image': {
            handler: function (after, before) {
            },
            deep: true
        },
        'section.video': {
            handler: function (after, before) {
                console.log( { video: after } );
            },
            deep: true
        },
    },

    methods: {
        Preview_image() {
            if ( this.section.image !== []) {
                this.section.currentImage = URL.createObjectURL(this.section.image);
            }
        },
        Preview_video() {
            if ( this.section.video !== []) {
                this.section.currentVideo = URL.createObjectURL(this.section.video);
            }
        },
        initialize()
        {
            
            this.progress = true;
            sectionApi.show( this.section.id )
            .then( (response) => {
                this.progress = false;
                console.log( { response: response.data } );
            })
            .catch( (error) => {
                this.progress = false;
                console.log( error );
            });
        },

 
        validate () {

            this.$refs.form.validate()
        },
        reset () {
            this.$refs.form.reset()
        },
        resetValidation () {
            this.$refs.form.resetValidation()
        },
        openSections()
        {
            this.$router.push({
                name: 'sections', 
                params: {  }
            });
        },

        update()
        {
            window.scrollTo(0,0);
            let data = this.section;

            delete data.currentImage;
            delete data.currentVideo;
            
            sectionApi.updateSection( data )
            .then( (response) => {
                console.log( { response_store: response } );
                this.updateProcess(response);
            })
            .catch( (error) => {
                console.log( { store_error: error } );
        		this.$refs.messages.showAlertError( "Error", error.message);
            });
        },

        updateProcess(response)
        {
            this.$refs.messages.showAlertSuccess("Transacción exitosa", "elemento actualizado");
        },
    },
}
</script>