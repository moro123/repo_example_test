<template>
    <div id="agregar-post">
        
        <h1> Agregar post </h1>

        <messages ref="messages" :progress="progress"></messages>

        <v-form ref="form">
            <v-row>
                <v-col cols="12" md="6">
                    <v-text-field
                        prepend-icon="mdi-text"
                        v-model="post.title"
                        label="Titulo"
                        :rules="rules"
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                    <v-text-field
                        prepend-icon="mdi-text"
                        v-model="post.subtitle"
                        label="Subtitulo"
                        :rules="rules"
                    ></v-text-field>
                </v-col>
            </v-row>

            <v-radio-group v-model="post.published" mandatory>
                <v-radio
                label="Publicar"
                value="1"
                :rules="rules"
                
                ></v-radio>

                <v-radio
                label="No publicar"
                value="0"
                :rules="rules"
                ></v-radio>
            </v-radio-group>
            <br>

            <Vueditor id="editor" style="height: 500px"></Vueditor>

            <v-btn
                color="primary"
                class="mr-4"
                @click="store()">
                Guardar
            </v-btn>

        </v-form>

    </div>
</template>

<script>

import Messages from '../../messages/Messages.vue'
import postApi from "../../api/post";

export default {
    components: { Messages },
    data() {
        return {
            progress: false,
            post: {
                title: '',
                subtitle: '',
                published: '',
            },
            rules: [
                v => !!v || 'Este campo es requerido',
            ],
        }
    },

    mounted() {

        //this.editor = document.getElementById('editor');
        console.log( this.$Vueeditor );
    },

    methods: {

        store() {
            console.log("store()");
            console.log( { editor_content: editor.getContent() } );

            editor.upload = function (obj, callback) {
                let formData = new FormData();
                let xhr = new XMLHttpRequest();
                formData.append('fieldName', obj.files[0]);
                xhr.open('POST', '/api/post');
                xhr.send(formData);
                xhr.onload = function () {
                    console.log("onload");
                    callback(xhr.responseText);
                };
                xhr.onerror = function (err) {
                    console.log(err);
                }
            }

        }

    }

}

</script>