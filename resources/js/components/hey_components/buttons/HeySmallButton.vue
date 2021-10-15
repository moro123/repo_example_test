<template>
    <div class="hey-small-button" >
        <v-btn class="h-small-btn" :elevation="0">
            <img class="h-small-btn-img" :src="prevIcon">
            <div class="h-small-btn-text">
                {{ text }}
            </div> 
        </v-btn>
    </div>
</template>
<script>
export default {
    props:['text'],
    data() {
        return {
            prevIcon: '/img/ICONOS/ATRAS.svg'
        }
    },
}
</script>

<style scoped>
/* HeySmallButton.vue */
.h-small-btn {
  background-color: #182151 !important;
  height: 30px !important;
  border-radius: 10px !important;
}

.h-small-btn-img {
   height: 15px;
  margin-right: 10px;
}

.h-small-btn-text {
  color: white;
  text-transform: none;
  font-family: HeyFontBold;
  letter-spacing: 0px;
  font-size: 16px;
}
</style>