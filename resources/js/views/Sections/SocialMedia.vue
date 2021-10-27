<template>
    <div id="folder">

        <messages :progress="progress"></messages>

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
                            <v-row>

                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="socialMedia.name"
                                        label="Nombre"
                                        :rules="rules"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" sm="6" md="4">
                                    <v-text-field
                                        v-model="socialMedia.link"
                                        label="Link"
                                        :rules="rules"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="12">
                                    <v-img contain :src="socialMedia.currentImage" width="120" height="140"> </v-img>
                                </v-col>

                                <v-col cols="12" sm="6" md="4">
                                    <v-file-input
                                    v-model="socialMedia.icon"
                                    accept="image/*"
                                    label="Icono"
                                    :rules="fileRules"
                                    ></v-file-input>
                                </v-col>

                            </v-row>
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
import socialMediaApi from '../../api/social-media.js'

export default {
    components: {
        Messages
    },
    data() {
        return {
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
                icon: ''
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
            fileRules: [
                v => !!v || 'La imagen es requerida',
                v => (v && v.size > 0) || 'La imagen es requerida',
            ]
        }
    },
    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'Nueva red social' : 'Editar red social'
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
        this.profileId = this.$route.params.profileId;
        this.initialize();
    },

    methods: {
        initialize () {
            this.progress = true;
            let data = {
                sectionId : this.sectionId
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
            this.desserts.splice(this.editedIndex, 1)
            this.closeDelete()
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
        }
    },
}
</script>