<script>

    export default {
        props: ['product'],
        methods: {
            viewProduct: function(location) {
                window.location.href = location;
            }
        }
    }

</script>