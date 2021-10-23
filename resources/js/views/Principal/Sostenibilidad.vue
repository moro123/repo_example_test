d<template>
    <div id="carousel">
        
        <sections v-if="mainSection != null" :mainSection="mainSection"></sections>

    </div>
</template>

<script>
import Sections from '../Sections/Sections.vue'
import mainSectionApi from '../../api/main-section.js'

export default {
    components: {
        Sections
    },
    data() {
        return {
            mainSection: null,
        }
    },
    computed: {
 
    },

    watch: {
    },

    created () {
        
    },

    mounted()
    {
        mainSectionApi.getMainSection( { name: 'sostenibilidad' } )
        .then( (response) =>  {
            console.log( { carousel_response: response.data } );
            this.mainSection = response.data;
        })
        .catch( (error) => {
            console.log( { error: error } );
        });
    },

    methods: {
    },

}
</script>