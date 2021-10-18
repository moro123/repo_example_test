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
                        <v-toolbar-title> Secciones </v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                            Agregar seccion
                        </v-btn>
                        </template>
                        <v-card>
                        <v-card-title>
                            <span class="text-h5">{{ formTitle }}</span>
                        </v-card-title>
            
                        <v-card-text>
                            <v-container>
                            <v-row>

                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="editedItem.name"
                                        label="Nombre"
                                        :rules="nameRules"
                                    ></v-text-field>
                                </v-col>
                          
                            </v-row>
                            </v-container>
                        </v-card-text>
            
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">
                                Cancelar
                            </v-btn>
                            <v-btn :disabled="btnSaveDisabled" color="blue darken-1" text @click="save">
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

                <v-btn fab small color="primary" @click="openSection(item)" :elevation="3" class="mr-2" >
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

import sectionApi from '../../api/sections.js'

export default {
    props: ['mainSection', 'section'],
    components: {
        Messages
    },
    data() {
        return {
            error: null,
            progress: false,
            dialog: false,
            dialogDelete: false,
            btnSaveDisabled: true,
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
            editedIndex: -1,
            editedItem: {
                name: '',
            },
            defaultItem: {
                name: '',
            },
            nameRules: [
                v => !!v || 'Name is required',
            ],
        }
    },
    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'Nueva sección' : 'Editar seccion'
        },
    },

    watch: {
        'editedItem.name': {
            handler: function (after, before) {
                if ( after !== '' ) {
                    this.btnSaveDisabled = false;
                } else {
                     this.btnSaveDisabled = true;
                }
            },
            deep: true
        },
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
        console.log( "Section mounted()" );
        console.log( { mainSection: this.mainSection } );
        this.initialize();
    },

    methods: {
        initialize (mainSection, section) {
            
            console.log( "section initialize()" );
            console.log( { mainSection: this.mainSection } );
            console.log( { section: this.section } );
            let data = {
                mainSection: this.mainSection, 
                section: this.section
            }
            this.progress = true;
            sectionApi.getSections( data )
            .then( (response) => {
                console.log( { sections_response: response } );
                this.progress = false;
                this.data = response.data;
            })
            .catch( (error) => {
                console.log( { error: error } );
                this.progress = false;
            });
        },

        editItem (item) {
            this.editedIndex = this.data.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true;
        },

        deleteItem (item) {
            this.editedIndex = this.data.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm () {
            this.closeDelete()
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

        store()
        {
            let data = {
                mainSection: this.mainSection, 
                section: this.section,
                item: this.editedItem
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

        update()
        {

            console.log("update()");
            console.log( { editedItem: this.editedItem } );
            let data = {
                mainSection: this.mainSection, 
                section: this.section,
                item: this.editedItem
            }
            sectionApi.update(data, this.editedItem.id)
            .then( (response) => {
                this.updateProcess(response);
            })
            .catch( (error) => {
                console.log( { store_error: error } );
                this.error = JSON.parse( e.response.data.message);
        		this.$refs.messages.showAlertError(this.error.title, this.error.message);
            });
        },

        updateProcess(response)
        {
            if ( response.data === 1 ) {
                this.$refs.messages.showAlertSuccess("Transacción exitosa", "elemento actualizado");
                this.initialize();
            }
        },

        destroy()
        {
            console.log("destroy()");
            console.log( { editedItem: this.editedItem } );
            let data = {
                mainSection: this.mainSection, 
                section: this.section,
                item: this.editedItem
            }
            sectionApi.destroy(this.editedItem.id)
            .then( (response) => {
                this.destroyProcess(response);
            })
            .catch( (error) => {
                console.log( { store_error: error } );
                this.error = JSON.parse( e.response.data.message);
        		this.$refs.messages.showAlertError(this.error.title, this.error.message);
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