<template>
    <div id="folder">

        <messages ref="messages" :progress="progress"></messages>

        <v-data-table
            :headers="headers"
            :items="data"
            sort-by="calories"
            class="elevation-1">

            <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title> Social Media </v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                            Agregar red social
                        </v-btn>
                        </template>
                        <v-card>
                        <v-card-title>
                            <span class="text-h5">{{ formTitle }}</span>
                        </v-card-title>
            
                        <v-card-text>
                            <v-container>

                            <v-form ref="form">
                                <v-row>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="socialMedia.name"
                                            label="Nombre"
                                            :rules="rules"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="socialMedia.link"
                                            label="Link"
                                            :rules="rules"
                                        ></v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="12">
                                        <v-img contain :src="socialMedia.currentIcon" width="120" height="140"> </v-img>
                                    </v-col>

                                    <v-col cols="12"  md="12">
                                        <v-file-input
                                        @change="Preview_image"
                                        v-model="socialMedia.icon"
                                        accept="image/*"
                                        label="Icono"
                                        :rules="fileRules"
                                        ></v-file-input>
                                    </v-col>

                                </v-row>
                            </v-form>


                            </v-container>
                        </v-card-text>
            
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">
                                Cancelar
                            </v-btn>
                            <v-btn color="blue darken-1" text @click="validate">
                                Guardar
                            </v-btn>
                        </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                        <v-card-title class="text-h5">Estás seguro de que quieres eliminar este elemento?</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                        </v-card>
                    </v-dialog>
                    </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">

                <!-- <v-btn fab small color="primary" @click="openSection(item)" :elevation="3" class="mr-2" >
                    <v-icon>
                        mdi-arrow-right
                    </v-icon>
                </v-btn> -->

                <v-btn fab small @click="editItem(item)" :elevation="3" class="mr-2">
                    <v-icon small >
                        mdi-pencil
                    </v-icon>
                </v-btn>

                <v-btn fab small color="error" @click="deleteItem(item)" :elevation="3" >
                    <v-icon small >
                        mdi-delete
                    </v-icon>
                </v-btn>

            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="initialize">
                    Reset
                </v-btn>
            </template>
        </v-data-table>

    </div>
</template>

<script>
import Messages from '../../messages/Messages.vue'
import socialMediaApi from '../../api/social-media.js'
import $ from 'jquery'

export default {
    components: {
        Messages
    },
    data() {
        return {
            host: '',
            profileId: -1,
            progress: false,
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: 'Nombre',
                    align: 'start',
                    sortable: true,
                    value: 'name',
                },
                { text: 'Actiones', value: 'actions', sortable: false },
            ],
            socialMedia: {
                name: '',
                link: '',
                icon: [],
                currentIcon: '',
            },
            socialMediaDefault: {
                name: '',
                link: '',
                icon: [],
                currentIcon: '',
            },
            data: [],
            desserts: [],
            editedIndex: -1,
            editedItem: {
                name: '',
            },
            defaultItem: {
                name: '',
            },
            rules: [
                v => !!v || 'Este campo es requerido',
            ],
            // fileRules: [
            //     v => !!v || 'El icono es requerido',
            //     v => v.size > 0 || 'El icono es requerido',
            // ]
        }
    },
    computed: {
        fileRules(){
            if ( this.editedIndex === -1 ) {
                return [
                    v => !!v || 'El icono es requerido',
                    v => v.size > 0 || 'El icono es requerido',
                ]
            } else {
                return [
                    v => !!v || 'El icono es requerido'
                ]
            }
        },

        formTitle () {
            return this.editedIndex === -1 ? 'Nueva red social' : 'Editar red social'
        },
    },

    watch: {
        dialog(val)
        {
            if ( val && this.editedIndex === -1) {
                try {
                    this.reset()
                } catch (error) {
                    
                }
            }
            if ( !val ) {
                this.close();
            }
        }
    },

    created () {
        this.host = $("#input-host").val() + "/";
    },
    mounted()
    {
        
        this.profileId = this.$route.params.profileId;
        console.log("SOCIAL MEDIA");
        console.log( { PROFILE_ID: this.profileId } );

        this.initialize();
    },

    methods: {
        /*
          -> Response:    icon: "storage/PRirGEotS9gYqUVtq3rocmSLLjmBSDGaHE74VNCN.jpg"
          -> Open Dialog: icon: Array []
          -> Close Dialog:
        */
        Preview_image() {
            console.log("Preview_image()");
            
            if (  !Array.isArray(this.socialMedia.icon)   ) {
                console.log( { PROFILE_IMAGE: this.socialMedia.icon } );
                this.socialMedia.currentIcon = URL.createObjectURL(this.socialMedia.icon);
            }
            
            if ( !Array.isArray( this.socialMedia.oldIcon ) ) {
                this.socialMedia.currentIcon = this.socialMedia.oldIcon;
            }
            
        },
        initialize () {
            this.progress = true;
            let data = {
                profileId : this.profileId
            }
            
            socialMediaApi.getSocialMedia( data )
            .then( (response) => {
                this.progress = false;
                console.log( { INITIALIZE_SOCIAL_RESPONSE: response.data } );
                this.data = response.data;
            })
            .catch( (error) => {
                this.progress = false;
                console.log( error );
            });
        },

        editItem (item) {
            this.editedIndex = this.data.indexOf(item)
            this.socialMedia.id =  item.id;
            this.socialMedia.name =  item.name;
            this.socialMedia.link = item.link;
            this.socialMedia.currentIcon = this.host + item.icon

            console.log( { SOCIAL_MEDIA: this.socialMedia } );

            this.dialog = true;
        },

        deleteItem (item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm () {
            this.dialogDelete = false;
            this.destroy();
        },

        close () {
            this.editedIndex = -1;           
            this.dialog = false
        },
    

        reset () {
            this.$refs.form.reset()
        },

        closeDelete () {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        validate () {
            if( this.$refs.form.validate() ) {
                this.dialog = false;
                this.save();
            }
        },

        store()
        {
            this.progress = true;
            console.log( "SECTION STORE" );

            this.socialMedia.profileId = this.profileId;

            socialMediaApi.store( this.socialMedia )
            .then( (response) => {
                this.progress = false;
                console.log( { STORE_SOCIAL_RESPONSE: response.data } );
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
                this.initialize();
            }
        },

        save () {
            if (this.editedIndex > -1) {
                this.update();
            } else {
                this.store();
            }
            this.close()
        },

        openSection(item)
        {
            this.$router.push({
                name: 'section', 
                params: { item: item }
            });
        },

        destroy()
        {
            socialMediaApi.destroy(this.editedItem.id)
            .then( (response) => {
                console.log( { DESTROY_RESPONSE: response.data } );
                this.destroyProcess(response);
            })
            .catch( (error) => {
                console.log( { store_error: error } );
        		this.$refs.messages.showAlertError("Error", error);
            });
        },

        destroyProcess(response)
        {
            if ( response.data === 1 ) {
                this.$refs.messages.showAlertSuccess("Transacción exitosa", "elemento eliminado");
                this.initialize();
            }
        },

        update()
        {
            console.log( { UPDATE_PARAMS: this.socialMedia } );
            this.progress = true;
            socialMediaApi.update( this.socialMedia )
            .then( (response) => {
                this.progress = false;
                console.log( { UPDATE_RESPONSE: response } );
                this.updateProcess(response);
            })
            .catch( (error) => {
                this.progress = false;
                console.log( { store_error: error } );
        		this.$refs.messages.showAlertError( "Error", error.message);
            });
        },

        updateProcess(response)
        {
            this.initialize();
            this.$refs.messages.showAlertSuccess("Transacción exitosa", "elemento actualizado");
        },
    },
}
</script>