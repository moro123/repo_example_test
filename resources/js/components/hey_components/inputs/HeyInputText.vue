<template>
    <div class="hey-input-text">
        <img class="hey-input-text-img" :src="icon" alt="">
        <input class="hey-input-text-field" type="text" :placeholder="hint" :value="text">
    </div>
</template>

<script>
export default {
    props: [
        'hint',
        'text',
        'icon'
    ],
    data() {
        return {

        }
    },
}
</script>


<style scoped>
    @import url('../../../../css/hey-input-text.css');
</style>