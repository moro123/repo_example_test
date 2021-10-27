<template>
    <div id="profiles">
        
        <messages ref="messages" :progress="progress"></messages>

        <v-data-table
            :headers="headers"
            :items="data"
            sort-by="calories"
            class="elevation-1">

            <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title> Perfiles </v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>

                    <!--  -->

                    <v-btn color="primary" dark class="mb-2" @click="createItem()">
                        Agregar perfil
                    </v-btn>

                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">

                            

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

                                        <v-col cols="12" md="12">
                                            <v-textarea
                                                v-model="profile.description"
                                                name="input-7-1"
                                                label="Descripción"
                                                value=""
                                                :rules="rules"
                                            ></v-textarea>
                                        </v-col>

                                    
                                        <v-col cols="12" md="12">
                                            <v-img contain :src="profile.currentImage" width="120" height="140"> </v-img>
                                        </v-col>
                                    

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
                                </v-form>


                            </v-container>
                        </v-card-text>
            
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="reset">
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

                <v-btn fab small :to=" '/profile/' + item.id " :elevation="3" class="mr-2">
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
import profileApi from '../../api/profile.js'


export default {
    components: { Messages },
    data() {
        return {
            sectionId: -1,
            profile:{ 
                name: '',
                title: '',
                image: [],
                description: '',
            },
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
            fileRules: [
                v => !!v || 'La imagen es requerida',
                v => (v && v.size > 0) || 'La imagen es requerida',
            ]
        }
    },
    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'Nuevo perfil' : 'Editar perfil'
        },
    },

    watch: {
        dialog (val) {
            val || this.close()
        },
        dialogDelete (val) {
            val || this.closeDelete()
        },
    },

    created () {
    },

    mounted()
    {
        this.sectionId = this.$route.params.sectionId;
        this.initialize();

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
        initialize()
        {
            this.progress = true;
            let data = {
                sectionId : this.sectionId
            }
            
            profileApi.getProfiles( data )
            .then( (response) => {
                this.progress = false;
                console.log( { INITIALIZE_PROFILES_RESPONSE: response.data } );
                this.data = response.data;
            })
            .catch( (error) => {
                this.progress = false;
                console.log( error );
            });
        },

        createItem()
        {
            this.dialog = true;
        },

        validate () {
            if( this.$refs.form.validate() ) {
                this.dialog = false;
                this.store();
            }
        },
        reset () {
            this.$refs.form.reset();
            this.dialog = false;
        },

        editItem (item) {
            console.log( "EDIT_ITEM" );
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
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
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete () {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save () {
            if (this.editedIndex > -1) {
                Object.assign(this.desserts[this.editedIndex], this.editedItem)
            } else {
                this.desserts.push(this.editedItem)
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

        openPerfil()
        {
            this.$router.push({
                name: 'profile', 
                params: { sectionId: this.sectionId }
            });
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
                this.initialize();
            }
        },


        destroy()
        {
            console.log("destroy()");
            console.log( { editedItem: this.editedItem } );
     
            profileApi.destroy(this.editedItem.id)
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
    },
}
</script>