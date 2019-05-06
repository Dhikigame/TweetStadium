<template>
    <div class="col-md-8 col-md-offset-2">
        <span>試合経過</span>
            <span
                v-for="std in Stadium"
                :key="std.id"
            >
                {{ std.stadium }}
            </span>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                stadium: [],
                id: this.$route.params.id
            }
        },
        computed: {
            Stadium: function () {
                var self = this;

                var today = new Date();
                var year = today.getFullYear();
                var month = today.getMonth() + 1;
                var date = today.getDate();

                // const puppeteer = require('puppeteer')

                return self.stadium.filter(function (std) {

                    if(month <= 9 && date <= 9){
                        console.log(year + '0' + month + '0' + date);
                    }
                    else if(month <= 9 && date > 9){
                        console.log(year + '0' + month + '' + date);
                    }
                    else if(month > 9 && date <= 9){
                        console.log(year + '' + month + '0' + date);
                    }
                    else{
                        console.log(year + '' + month + '' + date);
                    }

                    async function getLatestDate(page, url){
                    await page.goto(url) // ページへ移動
                    // 任意のJavaScriptを実行
                    return await page.evaluate(() => document.querySelector('.newsList').children[0].firstChild.textContent.trim())
                    }

                    !(async() => {
                    try {
                        const browser = await puppeteer.launch()
                        const page = await browser.newPage()

                        const latestDate = await getLatestDate(page, 'http://www.uec.ac.jp/')
                        console.log(`最新の新着情報の日付は${latestDate}です。`)

                        browser.close()
                    } catch(e) {
                        console.error(e)
                    }
                    })()

                    return true;
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