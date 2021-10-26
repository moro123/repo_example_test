<template>
    <div id="profile">
        
        <messages ref="messages" :progress="progress"></messages>

        <h1> Agregar Perfil </h1>

        <v-form
            ref="form">

                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="profile.name"
                            label="Nombre"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="profile.title"
                            label="Titulo"
                            :rules="rules"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-textarea
                    v-model="profile.description"
                    name="input-7-1"
                    label="Descripción"
                    :rules="rules"
                ></v-textarea>

                <v-row>
                    <v-col cols="12" md="12">
                        <v-img contain :src="profile.currentImage" width="320" height="240"> </v-img>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" md="12">
                        <v-file-input
                        @change="Preview_image"
                        v-model="profile.image"
                        accept="image/*"
                        label="Imagen"
                        :rules="fileRules"
                        ></v-file-input>
                    </v-col>

                </v-row>

                <v-btn  class="mr-4" @click="reset">
                    Cancelar
                </v-btn>

                <v-btn
                    @click="validate()"
                    color="primary"
                    class="mr-4">
                    Guardar
                </v-btn>
    
                <!-- <v-btn color="warning" @click="resetValidation">
                    Reset Validation
                </v-btn> -->

        </v-form>
        <br> <br>
        <social-media></social-media>

    </div>
</template>

<script>
import profileApi from '../../api/profile.js'
import Messages from '../../messages/Messages.vue'
import SocialMedia from './SocialMedia.vue'

export default {
  components: { Messages, SocialMedia },
    data() {
        return {
            sectionId: -1,
            progress: false,
            profile:{ 
                name: '',
                title: '',
                image: [],
                description: '',
            },
            rules: [
                v => !!v || 'Este campo es requerido',
            ],
            fileRules: [
                v => !!v || 'La imagen es requerida',
                v => (v && v.size > 0) || 'La imagen es requerida',
            ]
        }
    },
    mounted() {
        this.sectionId = this.$route.params.sectionId;
    },
    methods: {
        Preview_image() {
            console.log("Preview_image()");
            if ( this.profile.image !== null ) {
                if ( this.profile.image !== []   ) {
                    console.log( { PROFILE_IMAGE: this.profile.image } );
                    this.profile.currentImage = URL.createObjectURL(this.profile.image);
                }
            } else {
                if ( this.profile.oldimage !== [] ) {
                    this.profile.currentImage = this.profile.oldImage;
                }
            }

        },
        validate () {
            if( this.$refs.form.validate() ) {
                this.store();
            }
        },
        reset () {
            this.$refs.form.reset()
        },
        resetValidation () {
            this.$refs.form.resetValidation()
        },

        store()
        {
            this.progress = true;
            console.log( "PROFILE STORE" );

            this.profile.sectionId = this.sectionId;

            profileApi.store( this.profile )
            .then( (response) => {
                this.progress = false;
                console.log( { STORE_RESPONSE: response } );
                this.storeProcess(response);
            })
            .catch( (error) => {
                this.progress = false;
                console.log( { store_error: error } );
             
        		this.$refs.messages.showAlertError( error.title, error.message);
            });
        },

        storeProcess(response)
        {
            if ( response.data === 1 ) {
                this.$refs.messages.showAlertSuccess("Transacción exitosa", "elemento agregado");
                this.reset();
            }
        },

    },
}
</script>