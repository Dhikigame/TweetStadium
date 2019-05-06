<template>
    <div class="col-md-8 col-md-offset-2">
        <h3>みんなのコメント</h3>
            <ul>
                <li
                v-for="comment in Comments"
                :key="comment.id"
                >
                    {{ comment.body }} 
                    <span class="comment_date">({{ comment.created_at }})</span>
                </li>
            </ul>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                comments: [],
                id: this.$route.params.id
            }
        },
        computed: {
            Comments: function () {
                var self = this;
                var count = 0;
                //時系列で新しい順にコメント出力する
                self.comments.reverse();
                
                // スタジアムのIDと一致したコメントを出力
                // コメント総数100件まで
                return self.comments.filter(function (comment) {
                    if(comment.comment_id == self.id && count < 100){
                        count++;
                        return true
                    }
                })
            }
        },
        mounted() {
            var self = this;
            var url = '/ajax/comment';
            axios.get(url).then(function(response){
                self.comments = response.data;
            });
        }
    }
</script>