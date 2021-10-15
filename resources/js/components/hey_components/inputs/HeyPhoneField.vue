<template>
    <div class="hey-phone-field">
      
        <v-select class="hey-phone-field-select" :items="options" v-model="optionDefault" flat solo>
            <template v-slot:selection="{ item }">
                <img class="hey-phone-field-select-img" :src="item.image">
            </template>
            <template v-slot:item="{ item }">
                <img class="hey-phone-field-select-img" :src="item.image">
            </template>
           
        </v-select> 
        
        <div class="hey-phone-field-divider" ></div>
        <div class="hey-phone-field-code"> +507 </div>
        <input class="hey-phone-field-input" type="text" placeholder="0000 0000" :value="text">

    </div>
</template>

<script>

export default {
    props: [
        'text',
    ],
    data() {
        return {
            optionDefault: {
                active: false,
                image: '/img/ICONOS/PANAMÁ.svg',
                code: '+507',
                name: 'PA'
            },
            options: [
                {
                    active: false,
                    image: '/img/ICONOS/PANAMÁ.svg',
                    code: '+507',
                    name: 'PA'
                },
                {
                    active: false,
                    image: '/img/ICONOS/PANAMÁ.svg',
                    code: '+507',
                    name: 'PA'

                },
            ],    
        }
    },
    mounted() 
    {
       
    }
}
</script>


<style scoped>
    @import url('../../../../css/hey-phone-field.css');
</style>