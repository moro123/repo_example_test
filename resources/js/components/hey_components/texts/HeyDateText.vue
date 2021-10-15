<template>
    <div id="hey-date-text">
        {{ date }}
    </div>
</template>

<script>
export default {
    props: ['date'],
    data() {
        return {
            
        }
    },
}
</script>

<style scoped>
/* HeyDateText */
#hey-date-text {
  font-size: 11px;
  color: grey;
  letter-spacing: 0px;
}
</style>