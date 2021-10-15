<template>
    <div class="hey-text-area">
        <textarea  class="hey-text-area-field" :cols="cols" :rows="rows" :value="text"></textarea>
    </div>
</template>

<script>
export default {
    props: [
        'text',
        'rows',
        'cols'
    ],
    data() {
        return {

        }
    },
}
</script>


<style scoped>
    @import url('../../../../css/hey-text-area.css');
</style>