<template>
    
    <div id="resumen-compra-mobile">
        <v-sheet
            id="sheet-resume" 
            class="pl-5" 
            width="100%" 
            :elevation="15">

            <v-slide-y-transition>
                <div id="cresume-contianer" v-show="expand">
                    <div id="title"> Resumen de la compra </div>

                    <div id="item-container">
                        <div class="item">  Precio individual </div>
                        <div class="item text-right"> {{ precioAccion }} </div>
                    </div>

                    <div id="item-quantity-container">
                        <div class="item-quantity"> Cantidad </div>
                        <div class="item-quantity text-right"> {{ cantidad }} </div>
                    </div>

                    <div id="subtotal-container">
                        <div class="subtotal"> Subtotal </div>
                        <div class="subtotal text-right"> {{ totalPagar }} </div>
                    </div>

                    <div class="legend"> Todos los precios estan en USD </div>

                    <v-divider></v-divider>

                </div>
            </v-slide-y-transition>


            <div id="detail-total-container">
                <div class="compra-detail-mobile-total-title"
                    v-ripple 
                    @click="expand = !expand"> 
                    Monto a pagar:
                    <v-icon :color="styles.colorPrimaryDark"> mdi-chevron-up </v-icon>
                </div>
            </div>
            
            <div id="monto-pagar-container">
              
                <div id="monto-pagar-quantity-container">
                    <div id="monto-pagar-quantity"> {{ totalPagar }} </div>
                </div>
                
                <div id="btn-completar-mobile-container">
                    <v-btn id="btn-completar-mobile" class="pt-5 pb-5" x-large
                        @click="completarMobile()"
                        :elevation="0" 
                        :color="styles.colorAccent1"> 
                        Completar compra 
                    </v-btn>
                </div>
  
            </div>

            <v-divider></v-divider>

            <div id="container-regresar">
                <v-btn id="btn-regresar" @click="regresar()" icon small :elevation="10"> 
                    <img id="img-atras" :src="iconAtras" alt=""> 
                </v-btn>
                <div id="text-regrsar"> Regresar </div>
            </div>

<!-- 
            <div id="legal" class="text-center">
                Compra segura. Para su comodidad, Heytics almacenará su  información 
                de pago encriptada para futuros pedidos.  
                Administre su información de pago en los detalles de su cuenta
            </div> -->
            
        </v-sheet>
    </div>


   
</template>

<script>

import styles from '../styles'
import { mapGetters } from 'vuex';

export default {
    data() {
        return {
            iconAtras: '/img/ICONOS/ATRAS.svg',
            styles: styles,
            expand: false,
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
    methods: {
        regresar()
        {
            this.$emit('regresar');
        }
    }
}
</script>

<style scoped>
    @import url('../../css/resumen-compra-mobile.css');
</style>