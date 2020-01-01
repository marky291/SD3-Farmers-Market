<script>

    export default {
        props: ['basket'],
        data: function () {
            return {
                basketCount: this.basket.length,
            }
        },
        methods: {
            addToBasket: function (code) {
                this.basketCount++;
                this.basket.push(code);
            }
        }
    }

</script>