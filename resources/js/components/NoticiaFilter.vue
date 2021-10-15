<template>
    <div id="noticia-filter">

        <v-btn @click="next()" icon> 
            <v-icon> mdi-chevron-left </v-icon> 
        </v-btn>

        <carousel
            id="carousel-noticia-filter"
            :pullDrag="false" 
            :touchDrag="false"
            :mouseDrag="false"
            :rewind="false"
            :margin="-70"
            :items="1" :nav="false" :dots="false">

            <template slot="prev"><span class="prev" ref="prev"></span></template>

            <template slot="next"><span class="next" ref="next"></span></template>

                <v-btn
                    v-bind:class="{ 'noticia-btn-filter-active': item.active }"
                    @click="noticiaBtnFilter(item)"
                    v-for="(item, i) in years" :key="i" 
                    class="noticia-btn-filter" 
                    :elevation="0"> 
                    {{ item.year }}
                </v-btn>
                
        </carousel>

        <v-btn @click="prev()" icon> 
            <v-icon> mdi-chevron-right </v-icon> 
        </v-btn>

    </div>
</template>

<script>
import carousel from 'vue-owl-carousel'

export default {
    components: {
        carousel
    },
    data() {
        return {
            years:[
                {
                    year: 2018,
                    active: false,
                },
                {
                    year: 2019,
                    active: false,
                },
                {
                    year: 2020,
                    active: false,
                },
                {
                    year: 2021,
                    active: true,
                }
            ],
        }
    },
    computed: {
        noticiaBtnFilterActive: function () {
            return {
                'noticia-btn-filter-active' : false,
            }
        },
    },
    methods: {
        next()
        {
            this.$refs.prev.click();
        },
        prev()
        {
            this.$refs.next.click();
        },
        noticiaBtnFilter(item)
        {
            this.years.forEach(element => {
                element.active = false;
            });
            item.active = true;
        }   
    }
}
</script>

<style scoped>
    @import url('../../css/noticia-filter.css');
</style>