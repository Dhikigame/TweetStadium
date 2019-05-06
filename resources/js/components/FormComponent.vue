<template>
    <div class="container">
        <div class="row">
            <span>現在{{ TextCount }}文字</span>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                typedText: ''
            }
        },
        computed: {
            TextCount: function() {
                return this.typedText.length;
            }
        },

    }
</script>