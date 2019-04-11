<template>
    <div class="col-md-8 col-md-offset-2">
        <div v-for="std in stadium">
            <div v-if="std.id === id">
                <p>緯度：{{ std.latitude }}</p>
                <p>経度：{{ std.longitude }}</p>
                <p>アドレス：{{ std.address }}</p>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                stadium: {} ,
                id: this.$route.params.id          
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