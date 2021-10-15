<template>
    <v-btn :color="color" class="hey-button" :elevation="0"> 
        <div class="hey-button-text" :style="{ color: colorText }">
            {{ text }}
        </div> 
    </v-btn>
</template>

<script>
export default {
    props:[
        'color',
        'text',
        'colorText'
    ],
    data() {
        return {

        }
    },
}
</script>

<style scoped>
@import url('../../../../css/hey-button.css');
</style>