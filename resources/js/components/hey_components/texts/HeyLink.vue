<template>
    <a id="hey-link">
        {{ text }}
        <img id="hey-link-icon" :src="iconNext" alt="">
    </a>
</template>

<script>
export default {
    props: ['text', 'link'],
    data() {
        return {
            iconNext: '/img/ICONOS/SIGUIENTE-AZUL.svg'
        }
    },
}
</script>

<style scoped>
/* HeyLink.vue */
#hey-link {
  letter-spacing: -1px;
  font-size: 14px;
  color: #2A369B;
}

#hey-link-icon {
  width: 9px;
  height: 10px;
}
</style>