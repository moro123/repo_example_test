<template>
    <div id="profile">
        
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation>

                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="email"
                        
                            label="Nombre"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="email"
                            label="Titulo"
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
                        <v-file-input
                        accept="image/*"
                        label="Imagen"
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
        <br> <br>
        <social-media></social-media>

    </div>
</template>

<script>
import SocialMedia from './SocialMedia.vue'
export default {
  components: { SocialMedia },
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

    },
}
</script>