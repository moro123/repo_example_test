<template>
    <div id="hey-title">
        {{ title }}
    </div>
</template>

<script>
export default {
    props: ['title'],
    data() {
        return {

        }
    },
}
</script>

<style scoped>
/* HeyTitle.vue */
#hey-title {
  font-size: 30px;
  font-family: HeyFontBold;
  letter-spacing: -1px;
}
</style>

