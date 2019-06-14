<template>
    <div class="col-md-8 col-md-offset-2">
        <ul 
            v-for="std in Stadium"
            :key="std.id"
        >
            <p>緯度：{{ std.latitude }}</p>
            <p>経度：{{ std.longitude }}</p>
            <p>アドレス：{{ std.address }}</p>
        </ul>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                stadium: [] ,
                id: this.$route.params.id          
            }
        },
        computed: {
            Stadium: function () {
                var self = this;                
                
                return self.stadium.filter(function (std) {
                    if(std.id == self.id){
                        return true
                    }
                })
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