<script>

    export default {
        props: {
            product : {},
            total : Number,
            limit : Number,
            wishlisted: {
                type: Boolean,
                default: false,
            },
        },
        data: function () {
            return {
                count: this.total,
                wishlist: this.wishlisted,
            }
        },
        methods: {
            redirectToLink: function(location) {
                window.location.href = location;
            },
            addThisItemToBasket: function() {
                if (this.count + 1 > this.limit){
                    this.$toastr.error('You cannot purchase more than ' + this.limit + ' ' + this.product.description, 'Limit Reached!', {progressBar: true, preventDuplicates:true, positionClass:"toast-bottom-right"});
                } else {
                    Vue.axios.get("/basket/store/"+this.product.produceCode).then((response) => {
                        this.count++;
                        this.$emit('store:basket', this.product.produceCode);
                        this.$toastr.success('1x ' + this.product.description, 'Item added to Basket', {timeOut: 500, positionClass:"toast-bottom-right"});
                    }).catch(function (error) {
                        this.$toastr.error('Something went wrong, try again later', 'Opps!', {progressBar: true,  positionClass:"toast-bottom-right"});
                    });
                }
            },
            updateQuantity: function() {

                if (this.count > this.limit) {
                    this.count = this.limit;
                }

                Vue.axios.post('/basket/update', {
                    code: this.product.produceCode,
                    count: this.count
                }).then((response) => {
                    location.reload();
                }).catch((error) => {
                    this.$toastr.error('Something went wrong, try again later', 'Opps!', {progressBar: true,  positionClass:"toast-bottom-right"});
                });
            },
            requestRemoval: function(link) {
                Vue.axios.post(link, {
                    code: this.product.produceCode
                }).then((response) => {
                    location.reload();
                }).catch((error) => {
                    this.$toastr.error('Something went wrong, try again later', 'Opps!', {progressBar: true,  positionClass:"toast-bottom-right"});
                });
            },
            toggleWishlist: function()
            {
                if (this.wishlist === false) {
                    Vue.axios.post('/wishlist/store', {
                        productCode: this.product.produceCode,
                    }).then((response) => {
                        this.$toastr.success(this.product.description, 'Item saved to wishlist', {timeOut: 500, positionClass:"toast-bottom-right"});
                        this.wishlist = true;
                    }).catch((error) => {
                        this.$toastr.error('Something went wrong, try again later', 'Opps!', {progressBar: true,  positionClass:"toast-bottom-right"});
                    })
                }
                else
                {
                    Vue.axios.post('/wishlist/destroy', {
                        productCode: this.product.produceCode,
                    }).then((response) => {
                        this.$toastr.success(this.product.description, 'Item removed from wishlist', {timeOut: 500, positionClass:"toast-bottom-right"});
                        this.wishlist = false;
                    }).catch((error) => {
                        this.$toastr.error('Something went wrong, try again later', 'Opps!', {progressBar: true,  positionClass:"toast-bottom-right"});
                    })
                }
            }
        }
    }

</script>