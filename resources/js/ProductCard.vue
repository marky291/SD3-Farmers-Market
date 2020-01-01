<script>

    export default {
        props: ['product'],
        methods: {
            redirectToLink: function(location) {
                window.location.href = location;
            },
            addThisItemToBasket: function() {
                Vue.axios.get("/basket/store/"+this.product.produceCode).then((response) => {
                    this.$emit('store:basket', this.product.produceCode);
                    this.$toastr.success('1x ' + this.product.description, 'Item added to Basket', {progressBar: true, positionClass:"toast-bottom-right"});
                }).catch(function (error) {
                    this.$toastr.error('Something went wrong, try again later', 'Opps!', options);
                });
            },
        }
    }

</script>