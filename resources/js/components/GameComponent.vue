<template>
    <div class="col-md-8 col-md-offset-2">
            <div
                v-for="game in Game"
                :key="game"
            >
                <div
                    v-for="std in stadium"
                    :key="std.stadium"
                >
                    <div v-if="std.stadium === game[0][1][0][2]">
                        {{ std.stadium }}
                    </div>
                </div>
            </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                game_news: [],
                stadium: {},
                id: this.$route.params.id
            }
        },
        computed: {
            Game: function () {
                var self = this;
                // console.log(self.stadium);
                return self.game_news.filter(function (game) {
                    stadium = self.stadium.filter(function (std) {
                    // if(self.stadium.stadium === game[0][1][0][2]){
                        // console.log(game[0][0][0][0]);
                        // self.game_news.foreach(function(game){
                        //     console.log(game);
                        // });
                        console.log(game[0][1][0][2]);
                        console.log(self.stadium);
                        return true
                    })
                })
            }
        },
        mounted() {
            var self = this;
            var url_game = '/ajax/game_news';
            axios.get(url_game).then(function(response){
                self.game_news = response.data;
            });
            var url_stadium = '/ajax/stadium';
            axios.get(url_stadium).then(function(response){                
                self.stadium = response.data;
            });
        }
    }
</script>