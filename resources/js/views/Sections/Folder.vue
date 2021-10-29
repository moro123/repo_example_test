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
                        <v-toolbar-title> Documentos </v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                            Agregar documento
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
                                    <v-col cols="12" md="12">
                                        <v-text-field
                                            v-model="editedItem.name"
                                            label="Nombre"
                                            :rules="rules"
                                        ></v-text-field>
                                    </v-col>

                                    <v-row>
                                        <v-col cols="12" md="12">
                                            <v-file-input
                                            v-model="editedItem.link"
                                            accept=".pdf"
                                            label="Documento"
                                            :rules="fileRules"
                                            ></v-file-input>
                                        </v-col>
                                    </v-row>
                            
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

                <v-btn fab small color="primary" @click="openDocument(item)" :elevation="3" class="mr-2" >
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
import documentApi from '../../api/document.js'
import $ from 'jquery'

export default {
    components: {
        Messages
    },
    data() {
        return {
            host: '',
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
                link:[]
            },
            defaultItem: {
                name: '',
                link:[]
            },
            rules: [
                v => !!v || 'Este campo es requerido',
            ],
        }
    },
    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'Nuevo documento' : 'Editar documento'
        },

        fileRules(){
            if ( this.editedIndex === -1 ) {
                return [
                    v => !!v || 'El documento es requerido',
                    v => v.size > 0 || 'El documento es requerido',
                ]
            } else {
                return [
                    v => !!v || 'El documento es requerido'
                ]
            }
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
       this.host = $("#input-host").val() + "/";
    },

    mounted() {
        this.folderId = this.$route.params.folderId;
        this.initialize();
    },

    watch: {
        editedItem(val) {
            console.log( { editedItem: val } );
        }
    },

    methods: {
        initialize () {
            
            this.progress = true;
            let data = {
                folderId : this.folderId
            }
            
            documentApi.getDocuments( data )
            .then( (response) => {
                console.log( { DOCUMENTS_RESPOMNSE: response } );
                this.progress = false;
                this.data = response.data;
            })
            .catch( (error) => {
                console.log( error );
                this.progress = false;
            });

        },

        store()
        {
            this.progress = true;
            this.editedItem.folderId = this.folderId;

            documentApi.store( this.editedItem )
            .then( (response) => {
                console.log( { DOCUMENT_STORE_RESPONSE: response } );
                this.progress = false;
                this.storeProcess(response);
            })
            .catch( (error) => {
                console.log( error );
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

        update()
        {
            console.log( "update()" );
            console.log( { FOLDER: this.editedItem } );

            this.progress = true;
            documentApi.update( this.editedItem )
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

        destroy()
        {
            this.progress = true;
            documentApi.destroy(this.editedItem.id)
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

        editItem (item) {
            this.editedIndex = this.data.indexOf(item)
            this.editedItem.id = item.id;
            this.editedItem.name = item.name;
            this.dialog = true
        },

        deleteItem (item) {
            this.editedIndex = this.data.indexOf(item)
            this.editedItem.id = item.id;
            this.dialogDelete = true
        },

        deleteItemConfirm () {
            this.destroy();
            this.closeDelete()
        },


        closeDelete () {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save () {
            if ( this.$refs.form.validate() ) {
                if (this.editedIndex > -1) {
                    this.update();
                } else {
                    this.store();
                }
                this.close();
            }

        },

        close () {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },


        openSection(item)
        {
            this.$router.push({
                name: 'section', 
                params: { item: item }
            });
        },

        openDocument(item)
        {
            window.open( this.host + item.link , '_blank').focus();
        }

    },
}
</script>