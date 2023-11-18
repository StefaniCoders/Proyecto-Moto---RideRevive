<template>
  <div>   
    <VueApexCharts
    :key="apexKey"
      slot-scope=""
      type="bar"
      height="350"
      :options="chartOptions"
      :series="series"
    ></VueApexCharts>
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
export default {
  components: {
    VueApexCharts,
  },
  data() {
    return {

  apexKey:0,
    itemGrafico:[],
      series: [
        {
          name: "Categoria",
          data: [],
        },
      ],

      chartOptions: {

            annotations: {
              points: [{
                x: 'Bananas',
                seriesIndex: 0,
                label: {
                  borderColor: '#775DD0',
                  offsetY: 0,
                  style: {
                    color: '#fff',
                    background: '#775DD0',
                  },
                  text: 'Bananas are good',
                }
              }]
            },
            chart: {
              height: 350,
              type: 'bar',
            },
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '50%',
              }
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              width: 2
            },
            
            grid: {
              row: {
                colors: ['#fff', '#f2f2f2']
              }
            },
            xaxis: {
              labels: {
                rotate: -45
              },
              categories: [],
              tickPlacement: 'on'
            },
            yaxis: {
              title: {
                text: 'Cantidad',
              },
            },
            fill: {
              type: 'gradient',
              gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100]
              },
            }        
          
          
        },
    };
  },
  mounted() {
    this.grafico();
  },
   watch: {
    itemGrafico: {
      handler: function (array) {      
         array.forEach(element => {
              this.series[0].data.push(element.cantidad)
              this.chartOptions.xaxis.categories.push(element.descripcion.toString());
            });  
        this.apexKey++;
      
      },
      deep: true,
    },
  },
  methods: {
    grafico() {
      //clientes-records
      let me = this;
      let url = "/grafico";
      axios({
        method: "GET",
        url: url,
      })
        .then(function (response) {
          console.log(response);
          if (response.data.status == 200) {
            let result =response.data.result;
           me.itemGrafico=response.data.result;      
           // console.log(me.chartOptions.xaxis.categories);        
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style>
</style>