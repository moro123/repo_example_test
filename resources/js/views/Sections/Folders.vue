<template>
    <div id="folders">
    
        <messages ref="messages" :progress="progress"></messages>

        <v-data-table
            :headers="headers"
            :items="data"
            sort-by="calories"
            class="elevation-1">

            <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title> Carpetas </v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                            Agregar carpeta
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
                                    <v-col cols="12" sm="6" md="4">
                                        <v-text-field
                                            v-model="editedItem.name"
                                            label="Nombre"
                                            :rules="rules"
                                        ></v-text-field>
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
                            <v-btn color="blue darken-1" text @click="save">
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

                <v-btn fab small color="primary" :to=" '/folder/' + item.id " :elevation="3" class="mr-2" >
                    <v-icon>
                        mdi-arrow-right
                    </v-icon>
                </v-btn>

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
import folderApi from '../../api/folder.js'
import folder from '../../api/folder.js'

export default {
    components: {
        Messages
    },
    data() {
        return {
            sectionId: -1,
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
        }
    },
    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'Nueva carpeta' : 'Editar carpeta'
        },
    },

    watch: {
        dialog (val) {
            
            if ( !val ) {
                this.close()  
            }

            if ( val && this.editedIndex === -1 ) {
                try {
                    this.reset();
                } catch (error) {
                    
                }
                
            }

                 
        },
        dialogDelete (val) {
            val || this.closeDelete()
        },

        editedItem (val) {
          
        }
    },

    created () {
    },

    mounted()
    {
        this.sectionId = this.$route.params.sectionId;
        this.initialize();
    },

    methods: {
        initialize () {
            
            this.progress = true;
            let data = {
                sectionId : this.sectionId
            }
            
            folderApi.getFolders( data )
            .then( (response) => {
                this.progress = false;
                this.data = response.data;
            })
            .catch( (error) => {
                this.progress = false;
            });

        },

        editItem (item) {
            this.editedIndex = this.data.indexOf(item)
            Object.assign( this.editedItem , item)
            this.dialog = true
        },

        deleteItem (item) {
            this.editedIndex = this.data.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm () {
            this.closeDelete()
        },

        close () {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
            
            
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

            this.destroy();
        },

        save () {
           if ( this.$refs.form.validate() ) {
                let item = Object.assign( {}, this.editedItem ) 
                if (this.editedIndex > -1) {
                    this.update(item);
                } else {
                    this.store(item)
                }
                this.dialog = false;
           }
        },

        validate () {
           
            if( this.$refs.form.validate() ) {
                this.dialog = false;
                this.store();
            }
        },

        store(item)
        {
            this.progress = true;

            let data = {
                sectionId: this.sectionId,
                name: item.name
            }
            folderApi.store( data )
            .then( (response) => {
                this.progress = false;
               
                this.storeProcess(response);
            })
            .catch( (error) => {
                this.progress = false;
               
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

        openFolder(item)
        {
            this.$router.push({
                name: 'folder', 
                params: { item: item }
            });
        },

        destroy()
        {
            this.progress = true;
            folderApi.destroy(this.editedItem.id)
            .then( (response) => {
                this.progress = false;
                console.log( { DESTROY_RESPONSE: response.data } );
                this.destroyProcess(response);
            })
            .catch( (error) => {
                this.progress = false;
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

        update(item)
        {

            this.progress = true;
            folderApi.updateFolder( item )
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