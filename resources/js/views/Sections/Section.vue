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
            ref="form"
            v-model="valid"
            lazy-validation>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="section.date"
                            label="Fecha"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="section.header"
                            :counter="10"
                            label="Encabezado"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="section.title"
                            label="Titulo"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="section.subtitle"
                            label="Subtitulo"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-textarea
                    v-model="section.description"
                    name="input-7-1"
                    label="Descripción"
                    value=""
                ></v-textarea>

                <v-row>
                    <v-col cols="12" md="12">
                        <v-text-field
                            v-model="section.legend"
                            label="Video leyenda"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-file-input
                        v-model="section.image"
                        accept="image/*"
                        label="Imagen"
                        ></v-file-input>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-file-input
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
                    :disabled="!valid"
                    color="primary"
                    class="mr-4"
                    @click="store()">
                    Guardar
                </v-btn>
    
                <!-- <v-btn color="warning" @click="resetValidation">
                    Reset Validation
                </v-btn> -->

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
            valid: true,
            progress: false,
            section: {
                name: '',
                header: '',
                title: '',
                subtitle: '',
                description: '',
                image: '',
                video: '',
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
        this.section = this.$route.params.item;
        
        if( this.section != null ) {
            this.initialize();
        }
    },

    methods: {
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

        store()
        {
            let data = {
                section: this.section,
            }
            sectionApi.store(data)
            .then( (response) => {
                this.storeProcess(response);
            })
            .catch( (error) => {
                console.log( { store_error: error } );
                this.error = JSON.parse( e.response.data.message);
        		this.$refs.messages.showAlertError( this.error.title, this.error.message);
            });
        },

        storeProcess(response)
        {
            if ( response.data === 1 ) {
                this.$refs.messages.showAlertSuccess("Transacción exitosa", "elemento agregado");
                this.initialize();
            }
        },
    },
}
</script>