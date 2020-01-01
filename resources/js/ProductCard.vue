<script>

    export default {
        props: ['product', 'total', 'limit'],
        data: function () {
            return {
                count: this.total,
            }
        },
        methods: {
            redirectToLink: function(location) {
                window.location.href = location;
            },
            addThisItemToBasket: function() {
                if (this.count + 1 > this.limit){
                    this.$toastr.error('You cannot purchase more than ' + this.limit + ' ' + this.description, 'Limit Reached!', {progressBar: true, positionClass:"toast-bottom-right"});
                } else {
                    Vue.axios.get("/basket/store/"+this.product.produceCode).then((response) => {
                        this.count++;
                        this.$emit('store:basket', this.product.produceCode);
                        this.$toastr.success('1x ' + this.product.description, 'Item added to Basket', {progressBar: true, positionClass:"toast-bottom-right"});
                    }).catch(function (error) {
                        this.$toastr.error('Something went wrong, try again later', 'Opps!', {progressBar: true, positionClass:"toast-bottom-right"});
                    });
                }
            }
        }
    }

</script>