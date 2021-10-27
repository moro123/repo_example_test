<template>
    <div id="profile">
        
        <messages ref="messages" :progress="progress"></messages>

        <h1> Editar Perfil </h1>

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
                        ></v-file-input>
                    </v-col>
                </v-row>

                <br><br>

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
          <br> <br>
          <br> <br>
       

    </div>
</template>

<script>
import profileApi from '../../api/profile.js'
import Messages from '../../messages/Messages.vue'
import SocialMedia from './SocialMedia.vue'
import $ from 'jquery'

export default {
  components: { Messages, SocialMedia },
    data() {
        return {
            host: '',
            profileId: -1,
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

        }
    },
    created()
    {
        this.host = $("#input-host").val() + "/";
        console.log( { HOST: this.host } );
    },
    mounted() {
        this.profileId = this.$route.params.profileId;
        this.initialize();
    },
    methods: {

        initialize()
        {
            this.progress = true;
            profileApi.show(this.profileId)
            .then( (response) => {
                this.progress = false;
                console.log( { PROFILE_INITIALIZE_response: response } );
                this.setData( response );
            })
            .catch( (error) => {
                this.progress = false;
                console.log( { PROFILE_INITIALIZE_ERROR: error } );
                this.$refs.messages.showAlertError("Error", error);
            });
        },

        setData(response)
        {
            let profile = response.data;
            this.profile.currentImage = this.host + profile.image;
            profile.image = [];
            
            Object.assign(this.profile, profile); 

            this.profile.image = [];
        },

        Preview_image() {
            console.log("Preview_image()");
            this.profile.currentImage = URL.createObjectURL(this.profile.image);
        },
        validate () {
            console.log( "validate()" );
            if( this.$refs.form.validate() ) {
                this.update();
            }
        },

        update()
        {
            console.log( "update()" );
            console.log( { PROFILE: this.profile } );

            this.progress = true;
            profileApi.update( this.profile )
            .then( (response) => {
                this.progress = false;
                console.log( { UPDATE_RESPONSE: response } );
                this.updateProcess();
            })
            .catch( (error) => {
                this.progress = false;
                console.log( { UPDATE_ERROR: error } );
            });
        },

        updateProcess()
        {
            this.initialize();
            this.$refs.messages.showAlertSuccess("Transacción exitosa", "elemento actualizado");
        },

        reset () {
            this.$refs.form.reset()
        },
        resetValidation () {
            this.$refs.form.resetValidation()
        },

    

    },
}
</script>