<template>
    <div class="col-md-8 col-md-offset-2">
        <li v-for="std in stadium">
            <span>{{ std.address }}</span>
        </li>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                stadium: {}
            }
        },
        mounted() {
            var self = this;
            var url = '/ajax/stadium';
            axios.get(url).then(function(response){
                self.stadium = response.data;
            });
        }
    }
</script>