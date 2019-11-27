<script>
    //Importing Line class from the vue-chartjs wrapper
    import { Line } from 'vue-chartjs'

    //Exporting this so it can be used in other components
    export default {
        extends: Line,
        props: ['product'],
        data () {
            return {
                datacollection: {
                    //Data to be represented on x-axis
                    labels: [],
                    datasets: [
                        {
                            label: 'Ordering History',
                            backgroundColor: '#f87979',
                            pointBackgroundColor: 'white',
                            borderWidth: 3,
                            lineTension: 0.5,
                            fill: false,
                            borderColor: '#f87979',
                            pointBorderColor: '#e42312',
                            data: []
                        }
                    ]
                },
                //Chart.js options that controls the appearance of the chart
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                        xAxes: [ {
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    legend: {
                        display: true
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            }
        },
        async mounted () {
            Vue.axios.get("/order/timeline/"+this.product).then((response) => {
                for(let key in response.data) {
                    this.datacollection.labels.push(key);
                    this.datacollection.datasets[0].data.push(response.data[key]);
                }
                this.renderChart(this.datacollection, this.options)
            });
        }
    }
</script>