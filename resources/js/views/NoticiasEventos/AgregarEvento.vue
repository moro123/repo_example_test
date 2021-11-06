<template>
    <div id="agregar-evento">

        <h3> Agregar Evento </h3>

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
                        <v-img contain :src="event.currentImage" width="320" height="240"> </v-img>
                    </v-col>
                    <v-col cols="12" md="6">
                       
                    </v-col>
                </v-row>
                

                <v-row>
                    <v-col cols="12" md="6">
                        <v-file-input
                        @change="Preview_image"
                        v-model="event.image"
                        accept="image/*"
                        label="Imagen"
                        :rules="fileRules"
                        ></v-file-input>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-file-input
                        v-model="event.file"
                        accept=".pdf"
                        label="Documento"
                        :rules="fileRules"
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
                    @click="store()">
                    Guardar
                </v-btn>

                <br><br><br><br>

        </v-form>
    </div>
</template>

<script>

import Messages from '../../messages/Messages.vue'
import eventApi from "../../api/event";

export default {
    components: { Messages },
    data() {
        return {
            progress: false,
            radioGroup: 1,
            menu: false,
            event: {
                date: '',
                title: '',
                subtitle: '',
                content: '',
                image: [],
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

        },

        store() {

            if ( this.$refs.form.validate() ) {

                window.scrollTo(0,0);
                this.progress = true;

                eventApi.store( this.event )
                .then( (response) => {
                    this.progress = false;
                    console.log( { store_response: response.data } );
                    this.storeProcess( response );
                })
                .catch( (error) => {
                    this.progress = false;
                    console.log( { store_response_error: error } );
                });

            }

        },

        storeProcess(response)
        {
            if ( response.data === 1 ) {
                this.$refs.messages.showAlertSuccess("Transacción exitosa", "elemento agregado");
            }
        },

    }

}

</script>