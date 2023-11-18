<template>
  <div>
    <div class="card">
      <div class="card-body">
        <h2 class="card-title text-center">Reporte</h2>
        <br />

        <div class="col-md-12 p-3 form-inline">
          <v-select
            v-model="categoria"
            placeholder="Seleccione"
            label="descripcion"
            style="padding-left: 4px; width: 20%"
            item-value="IdCategoria"
            :options="servicios"
          />

          <button class="btn btn-primary ml-2" @click="Buscar()">
            <i class="fas fa-search mr-1"></i>Buscar
          </button>

          <br />
         
        </div>
        <div v-if="reportes.length>0" style="margin-left:1%">
             <b-button
      
            class="mr-1"
            variant="success"
            @click="exportExcel"
          >
            <b-icon icon="file-earmark-excel" aria-hidden="true"></b-icon>
            Excel
          </b-button>
          <b-button  variant="danger" class="mr-1" @click="exportPdf">
            <b-icon icon="file-pdf" aria-hidden="true"></b-icon> PDF
          </b-button>
        </div>
       

        <div class="col-md-12 p-20 m-2 border">
          <table id="example" class="display" style="width: 100%">
            <thead>
              <th>Fecha Atencion</th>
              <th>Cliente</th>
              <th>Empleado</th>
              <th>Estado</th>
            </thead>
            <tbody>
              <tr v-for="item in reportes" :key="item.IdCita">
                <td>{{ item.fec_atencion }}</td>
                <td>{{ item.Nombres }}</td>
                <td>{{ item.empleado }}</td>
                <td>{{ item.estado }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vSelect from "vue-select";
export default {
  components: {
    vSelect,
  },
  data() {
    return {
      date: "2018-03-02",
      status: "Empleado",
      picker: null,
      settings: [],
      categorias: [],
      servicios: [],
      horarios: [],
      reportes: [],
      empleados: [],
      cliente: {},
      motos: [],
      selectedItem: null,
      arrayEvents: null,
      show: false,
      fec: "",
      title: "Fechas Disponibles",
      items: [
        { text: "Real-Time", icon: "mdi-clock" },
        { text: "Audience", icon: "mdi-account" },
        { text: "Conversions", icon: "mdi-flag" },
      ],
      curren_date: moment(new Date()).local().format("YYYY-MM-DD"),
      curren_month: moment(new Date()).local().format("MM"),
      curren_year: moment(new Date()).local().format("YYYY"),
      model: {
        usuario: null,
        password: null,
        IdEmpleado: null,
        nivel: null,
      },
      categoria: null,
      moto: null,
      descripcion: null,
      horario: null,
      empleado: null,
    };
  },
  mounted() {
    moment.lang("es", {
      months:
        "Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre".split(
          "_"
        ),
      monthsShort:
        "Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.".split("_"),
      weekdays: "Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado".split(
        "_"
      ),
      weekdaysShort: "Dom._Lun._Mar._Mier._Jue._Vier._Sab.".split("_"),
      weekdaysMin: "Do_Lu_Ma_Mi_Ju_Vi_Sa".split("_"),
    });
    //this.fec = this.curren_date;
    this.getServicios();
  },
  methods: {
    exportExcel() {
          let me = this;
          let url = "/reporte-excel/"+me.categoria.IdCategoria;
          window.open(url, "_blank");
    },
    exportPdf() {
         let me = this;
          let url = "/reporte-pdf/"+me.categoria.IdCategoria;
          window.open(url, "_blank");
    },
    Buscar() {

      let me = this;
 
      if (me.categoria) {
        me.handleSubmit(me.categoria.IdCategoria);
      }
    },
    handleSubmit(IdCategoria) {
      let me = this;
      console.log(IdCategoria);
      let url = "./reporte-records/" + IdCategoria;
      axios({
        method: "GET",
        url: url,
      })
        .then(function (response) {
          // console.log(response);
          if (response.data.status == 200) {
            console.log(response);
            me.reportes = response.data.result;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getServicios() {
      //clientes-records
      let me = this;
      let url = "./categorias-records";
      axios({
        method: "GET",
        url: url,
      })
        .then(function (response) {
          if (response.data.status == 200) {
            me.servicios = response.data.result;
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
.modal-backdrop {
  background-color: #22292f;
  opacity: 0.5;
}
</style>