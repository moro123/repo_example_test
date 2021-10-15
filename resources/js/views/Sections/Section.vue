<template>
    <div id="section">

        <v-row>
            <v-col cols="12" class="text-right">
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
                            v-model="email"
                            label="Fecha"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="name"
                            :counter="10"
                        
                            label="Encabezado"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="email"
                        
                            label="Titulo"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="email"
                            label="Subtitulo"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-textarea
                    name="input-7-1"
                    label="Descripción"
                    value=""
                ></v-textarea>

                <v-row>
                    <v-col cols="12" md="12">
                        <v-text-field
                            v-model="email"
                        
                            label="Video leyenda"
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-file-input
                        accept="image/*"
                        label="Imagen"
                        ></v-file-input>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-file-input
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
                    @click="validate">
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



export default {
    components: {
        Folders,
        Profiles
    },
    data() {
        return {
            valid: true,
            name: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => (v && v.length <= 10) || 'Name must be less than 10 characters',
            ],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
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

    methods: {
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
        }
    },
}
</script>