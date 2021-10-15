<template>
    <div class="hey-country-field">
      
        <v-select class="hey-country-field-select"
            :change="change()" 
            :items="options" 
            v-model="optionDefault" 
            flat 
            solo>

            <template v-slot:selection="{ item }">
                <img class="hey-country-field-select-img" :src="item.image">
                <div class="hey-country-field-name"> 
                    {{  item.av  }} 
                </div>
            </template>

            <template v-slot:item="{ item }">
                <img class="hey-country-field-select-img" :src="item.image">
                <div> {{  item.name  }}  </div>
            </template>
           
        </v-select> 
        
        <div class="hey-country-field-divider" ></div>

        <input class="hey-country-field-input" 
            type="text" 
            placeholder="Seleccione su pais" 
            :value="optionDefault.name">

    </div>
</template>

<script>

export default {
    props: [
        'text',
        'option'
    ],
    data() {
        return {
            optionDefault: {
                active: false,
                image: '/img/ICONOS/PAÍS.svg',
                code: '',
                av: '',
                name: 'Seleccione su pais'
            },
            options: [
                {
                    active: false,
                    image: '/img/ICONOS/PAÍS.svg',
                    code: '',
                    av: '',
                    name: 'Seleccione su pais'
                },
                {
                    active: false,
                    image: '/img/ICONOS/PANAMÁ.svg',
                    code: '+507',
                    av: 'PA',
                    name: 'Panamá'
                },
                {
                    active: false,
                    image: '/img/ICONOS/USD.svg',
                    code: '+1',
                    av: 'US',
                    name: 'Estados unidos'
                },
            ],    
        }
    },
    mounted() 
    { 
    },
    watch: {
    },
    methods: {
        change()
        {
            console.log( { component_change: this.optionDefault } );
            this.$emit('change', this.optionDefault);
        }
    }
}
</script>


<style scoped>
    @import url('../../../../css/hey-country-field.css');
</style>