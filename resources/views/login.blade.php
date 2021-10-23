<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <v-app>
            <v-main>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="6">
                            <v-expand-transition>
                                <div v-if="progress">
                                    <v-progress-linear  indeterminate   color="primary"></v-progress-linear>
                                </div>
                            </v-expand-transition>
                            <v-card class="pa-5">
                                <v-card-title class="headline mb-1">
                                    Investor Administrador
                                </v-card-title>
                                <v-form 
                                    ref="form" 
                                    v-model="valid" 
                                    lazy-validation 
                                    method="post" 
                                    action="/login">

                                    <input type="hidden" name="_token" :value="csrf">

                                    <v-text-field
                                        :error-messages="emailErrorMessages" 
                                        v-model="email" 
                                        :rules="emailRules" 
                                        label="E-mail" 
                                        required
                                        name="email" 
                                    >
                                    </v-text-field>
                                    <v-text-field
                                        :error-messages="passwordErrorMessages"
                                        :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                                        @click:append="show2 = !show2" 
                                        :type="show2 ? 'text' : 'password'"
                                        v-model="password"  
                                        :rules="passwordRules" 
                                        label="Contraseña" 
                                        name="password"
                                        required
                                    >
                                    </v-text-field>
  
                                    <div class="text-right">
                                        <v-btn :disabled="!buttonLogin" color="primary" class="mr-4" @click="login">
                                            Iniciar Sessión
                                        </v-btn>
                                    </div>
                                    
                                </v-form>
                                
                            </v-card>
                           
                        </v-col>
                    </v-row>
                </v-container>
            </v-main>
        </v-app>
    </div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
<script>
    new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data: {
            emailErrorMessages: [],
            passwordErrorMessages: [],
            csrf: '',
            buttonLogin: true,
            progress: false,
            show2: false,
            valid: true,
            email: '',
            emailRules: [
                v => !!v || 'El e-mail es requerido',
                v => /.+@.+\..+/.test(v) || 'el e-mail no es válido',
            ],
            password: '',
            passwordRules: [
                v => !!v || 'La contraseña es requerida',
                // v => (v && v.length <= 10) || 'Name must be less than 10 characters',
            ],
        },
        watch: {
            email () {
                this.validate();
            },
            password () {
                this.validate();
            },
        },
        created() {
            this.csrf = document.getElementById('csrf').getAttribute('content');
        },
        methods: {
            validate () {
                let flag = this.$refs.form.validate();
                if ( flag ) {
                    this.buttonLogin = true;
                } else {
                    this.buttonLogin = false;
                }
                return flag;
            },
            reset () {
                this.$refs.form.reset()
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            },
            login() {
                this.$refs.form.$el.submit();
            },
            // loginClick()
            // {
            //     console.log( "loginClick()" );
            //     this.emailErrorMessages = [];
            //     this.passwordErrorMessages = [];
            //     if ( this.validate() )
            //     {
            //         let data = {
            //             email: this.email,
            //             password: this.password
            //         }
            //         this.login(data);
            //     }
            // },
            // login(data)
            // {
            //     console.log( "login()" );
            //     this.progress = true;
            //     axios.post('/login', data )
            //     .then( (response) => {
            //         this.progress = false;
            //         console.log( { loginResponse: response } );
            //     })
            //     .catch( (error) => {
            //         this.progress = false;
            //         console.log( { loginError: error.response.data } );
            //         if ( typeof error.response.data.errors !== 'undefined' ) {
            //         this.setLoginErrors( error.response.data.errors );
            //     }
            //     });
            // },

            // setLoginErrors(errors)
            // {
            //     if ( typeof errors.email !== 'undefined' ) {
            //         this.emailErrorMessages = errors.email;
            //     }
            //     if ( typeof errors.password !== 'undefined' ) {
            //         this.passwordErrorMessages = errors.password;
            //     }
            // }
        },
      })
  </script>
</body>
</html>