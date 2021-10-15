<template>
    <div class="hey-input-phone-code">
        <img class="hey-input-phone-code-img" :src="icon" alt="">
        <div class="hey-input-phone-code-container"> 
            <div class="hey-input-phone-code-code">
                {{ code }} 
            </div>
        </div>
        <input class="hey-input-phone-code-input" type="text" :placeholder="hint" :value="text">
    </div>
</template>

<script>
export default {
    props: [
        'hint',
        'text',
        'icon',
        'code'
    ],
    data() {
        return {

        }
    },
}
</script>


<style scoped>
    @import url('../../../../css/hey-phone-code-field.css');
</style>