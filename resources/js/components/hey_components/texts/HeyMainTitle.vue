<template>
    <div id="hey-main-title">
        {{ mainTitle }}
    </div>
</template>

<script>
export default {
    props: ['mainTitle'],
    data() {
        return {
            
        }
    },
}
</script>

<style scoped>

#hey-main-title {
  font-size: 30px;
  font-family: HeyFontBold;
  letter-spacing: -1px;
  color: #182151;
}

</style>