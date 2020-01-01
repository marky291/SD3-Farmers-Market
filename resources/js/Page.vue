<script>

    export default {
        props: ['basketCount'],
        data: function () {
            return {
                count: this.basketCount,
            }
        },
        methods: {
            incrementBasketCount: function (key) {
                this.count++;
            }
        }
    }

</script>