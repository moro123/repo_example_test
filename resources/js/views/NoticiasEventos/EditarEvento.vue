<template>
    <div id="agregar-evento">

        <h3> Editar Evento </h3>

        <messages ref="messages" :progress="progress"></messages>

        <v-form    
            ref="form">
                <v-row>
                    <v-col cols="12" md="6">
                        <v-menu
                            ref="menu"
                            v-model="menu"
                            :close-on-content-click="false"
                            :return-value.sync="event.date"
                            transition="scale-transition"
                            offset-y
                            min-width="auto">

                            <template v-slot:activator="{ on, attrs }">

                                <v-text-field
                                    :rules="rules"
                                    class="picker-date"
                                    v-model="event.date"
                                    prepend-inner-icon="mdi-calendar"
                                    append-icon="mdi-chevron-down"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on">
                                    
                                </v-text-field>
                                    
                            </template>

                            <v-date-picker
                                v-model="event.date"
                                no-title
                                scrollable
                                locale="es-ES">

                                <v-spacer></v-spacer>
                                <v-btn tex color="primary" @click="menu = false"> Cancelar </v-btn>
                                <v-btn text color="primary" @click="$refs.menu.save(event.date)"> OK </v-btn>
                            </v-date-picker>

                        </v-menu>


    
                    </v-col>
                    
                    <v-col cols="12" md="6">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.source"
                            label="Fuente"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                    
                </v-row>

               

                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.title"
                            label="Titulo"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.subtitle"
                            label="Subtitulo"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-textarea
                    prepend-icon="mdi-text"
                    v-model="event.content"
                    name="input-7-1"
                    label="Contenido"
                    value=""
                    :rules="rules"
                ></v-textarea>


                <v-row>
                    <v-col cols="12" md="6">
                        <v-img contain :src="event.currentImage" width="320" height="240"></v-img>
                    </v-col>
                    <v-col cols="12" md="6">
                        
                    </v-col>
                </v-row>
                

                <v-row>
                    <v-col cols="12" md="6">
                    </v-col>
                    <v-col cols="12" md="6">
                        <a :href="event.currentFile"> Documento actual </a>
                    </v-col>

                    <v-col cols="12" md="6">
                        <v-file-input
                        @change="Preview_image"
                        v-model="event.image"
                        accept="image/*"
                        label="Imagen"
                    
                        ></v-file-input>
                    </v-col>
                    <v-col cols="12" md="6">

                        

                        <v-file-input
                        v-model="event.file"
                        accept=".pdf"
                        label="Documento"
                        
                        ></v-file-input>
                    </v-col>
                </v-row>
                <br>

                <span> Contacto 1 </span>
                <v-row>
                    <v-col cols="12" md="3">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.contact1.title"
                            label="Titulo"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.contact1.name"
                            label="Nombre"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.contact1.phone"
                            label="Móvil"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.contact1.email"
                            label="Correo electrónico"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <span> Contacto 2 </span>
                <v-row>
                    <v-col cols="12" md="3">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.contact2.title"
                            label="Titulo"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.contact2.name"
                            label="Nombre"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.contact2.phone"
                            label="Móvil"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field
                            prepend-icon="mdi-text"
                            v-model="event.contact2.email"
                            label="Correo electrónico"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-radio-group v-model="event.published" mandatory>
                    <v-radio
                    label="Publicar"
                    value="1"
                    :rules="rules"
                    
                    ></v-radio>

                    <v-radio
                    label="No publicar"
                    value="0"
                    :rules="rules"
                    ></v-radio>
                </v-radio-group>
                <br>

                <v-btn  class="mr-4" @click="reset">
                    Cancelar
                </v-btn>

                <v-btn
                    color="primary"
                    class="mr-4"
                    @click="update()">
                    Guardar
                </v-btn>

                <br><br><br><br>

        </v-form>
    </div>
</template>

<script>

import Messages from '../../messages/Messages.vue'
import eventApi from "../../api/event";
import $ from 'jquery';

export default {
    components: { Messages },
    data() {
        return {    
            host: '',
            eventId: -1,
            progress: false,
            radioGroup: 1,
            menu: false,
            event: {
                date: '',
                title: '',
                subtitle: '',
                content: '',
                image: [],
                currentImage: '',
                currentFile:'',
                file: [],
                published: '',
                source: '',
                contact1: {
                    title: '',
                    name: '',
                    phone: '',
                    mail: '',
                },
                contact2: {
                    title: '',
                    name: '',
                    phone: '',
                    mail: '',
                }
            },
            rules: [
                v => !!v || 'Este campo es requerido',
            ],
            fileRules: [
                v => !!v || 'El documento es requerido',
                v => v.size > 0 || 'El documento es requerido',
            ]
        }
    },

    computed: {

        // fileRules(){
        //     if ( this.editedIndex === -1 ) {
        //         return [
        //             v => !!v || 'El documento es requerido',
        //             v => v.size > 0 || 'El documento es requerido',
        //         ]
        //     } else {
        //         return [
        //             v => !!v || 'El documento es requerido'
        //         ]
        //     }
        // },

    },

    mounted(){

        this.host = $("#input-host").val() + "/";
        this.eventId = this.$route.params.eventId;
        this.initialize();

    },

    methods: {

        Preview_image() {
            console.log("Preview_image()");
            if ( this.event.image !== null ) {
                if ( this.event.image !== []   ) {
                    this.event.currentImage = URL.createObjectURL(this.event.image);
                }
            } else {
                if ( this.event.oldimage !== [] ) {
                    this.event.currentImage = this.event.oldImage;
                }
            }

        },

        reset() {
            this.$resf.form.reset();
        },

        initialize() {
            this.progress = true;
            eventApi.show( this.eventId )
            .then( (response) => {
                this.progress = false;
                this.setData( response.data );
            })
            .catch( (error) => {
                this.progress = false;
                console.log( { initialize_response_error: error } );
            });

        },

        setData( data ) {
            this.event.currentImage = this.host + data.image;
            this.event.currentFile = this.host + data.file;

            this.event.oldImage = this.host + data.image;
            this.event.oldFile = this.host + data.file;

            this.event.title = data.title;
            this.event.subtitle = data.subtitle;
            this.event.date = data.date;
            this.event.content = data.content;
            this.event.source = data.source;
            this.event.published = data.published;

            Object.assign( this.event.contact1, data.contacts[0] );
            Object.assign( this.event.contact2, data.contacts[1] );
        },

        update() {

            if ( this.$refs.form.validate() ) {

                window.scrollTo(0,0);
                this.progress = true;

                eventApi.update( this.event, this.eventId  )
                .then( (response) => {
                    this.progress = false;
                    console.log( { update_response: response.data } );
                    this.updateProcess( response );
                })
                .catch( (error) => {
                    this.progress = false;
                    console.log( { update_response_error: error } );
                });

            }

        },

        updateProcess(response)
        {
            if ( response.data === 1 ) {
                this.$refs.messages.showAlertSuccess("Transacción exitosa", "elemento actualizado");
                this.initialize();
            }
        },

    }

}

</script>