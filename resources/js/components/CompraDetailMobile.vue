<template>
    <div id="compra-detail-mobile">

        <v-sheet
            id="compra-sheet-detail-mobile" 
            class="pl-5" 
            width="100%" 
            :elevation="10">

            <v-slide-y-reverse-transition>
                <div id="compra-detail-mobile-container" v-show="expand">
                    <div id="compra-title-mobile"> Mi compra  </div>


                    <div id="compra-mobile-item-container">
                        <div class="compra-mobile-item"> Precio individual </div>
                        <div class="compra-mobile-item text-right"> {{ precioAccion }} </div>
                    </div>

                    <div id="compra-mobile-item-quantity-container">
                        <div class="compra-mobile-item-quantity"> Cantidad </div>
                        <div class="compra-mobile-item-quantity text-right"> {{ cantidad }} </div>
                    </div>

                    <div id="compra-detail-mobile-legend"> Todos los precios estan en USD </div>

                    <v-divider></v-divider>

                </div>
            </v-slide-y-reverse-transition>

            <div id="detail-total-container">
                <div class="compra-detail-mobile-total-title"
                    v-ripple 
                    @click="expand= ! expand"> 
                    Total a pagar:
                    <v-icon :color="styles.colorPrimaryDark"> mdi-chevron-up </v-icon>
                </div>
            </div>


            
            <v-row id="row-detail-container-total">
                <v-col cols="6">
                    <div class="compra--detail-mobile-total"> {{ totalPagar }} </div>
                </v-col>
                <v-col cols="6" >
                    <v-btn class="compra-detail-mobile-button pt-5 pb-5" x-large
                        :disabled="disabled"
                        @click="continuarMobile()"
                        :elevation="0" 
                        :color="styles.colorAccent1"> 
                        Siguiente 
                        <img class="mt-0 ml-1" height="10" width="10" :src="iconContinuar">
                    </v-btn>
                </v-col>
            </v-row>

            <v-expand-transition>
                <div id="section-back" v-show="!disabled">
                    <v-divider></v-divider>
                    <div id="container-regresar">
                        <v-btn id="btn-regresar" @click="compraRegresar()" icon small :elevation="10"> 
                            <img id="img-atras" :src="iconAtras" alt=""> 
                        </v-btn>
                        <div id="text-regrsar"> Regresar </div>
                    </div>
                </div>
            </v-expand-transition>


        
        </v-sheet>

    </div>
</template>

<script>
import styles from '../styles'
import { mapGetters } from 'vuex';

export default {

    data() {
        return {
            styles: styles,
            iconContinuar: '/img/ICONOS/CONTINUAR-AZUL.svg',
            iconAtras: '/img/ICONOS/ATRAS.svg',
            expand: false,
            disabled: true,
        }
    },
    computed: {
        ...mapGetters([
            'precioAccionSelected',
            'comprarAccionesSelected',
            'totalPagar',
            'precioAccion',
            'cantidad',
        ]),
    },
    watch: {
        precioAccionSelected(val) { 
            console.log("precioAccionSelected: " + val);
            if (val) {
                this.disabled = false;
            } 
        },
        comprarAccionesSelected(val) {
            console.log("comprarAccionesSelected: " + val);
            if (val) {
                this.disabled = false;
            } 
        }
    },
    methods: {
        continuarMobile()
        {
            this.$emit('compra-siguiente-mobile');
        },
        compraRegresar()
        {
            this.$emit('compra-regresar')
        }
    }
}
</script>

<style scoped>
    @import url('../../css/compra-sheet-detail-mobile.css');
</style>