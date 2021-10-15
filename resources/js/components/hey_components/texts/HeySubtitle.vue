<template>
    <div id="hey-subtitle">
        {{ subtitle }}
    </div>
</template>

<script>
export default {
    props: ['subtitle'],
    data() {
        return {

        }
    },
}
</script>

<style scoped>
/* HeySubtitle.vue */
#hey-subtitle {
  font-family: HeyFontBold;
  letter-spacing: -1px;
  font-size: 18px;
}
</style>

