<template>
  <div>
    <v-app>
      <v-container>
        <v-row>
          <v-col cols="12" sm="8">
            <v-system-bar window color="primary">
              <h5 style="color: white">Servicio {{ descripcion }}</h5>
        
            </v-system-bar>

            <b-card header="Datos de cliente" header-tag="header">
              <form>
                <div class="row">
                  <div class="col-md-6">
                    <label for="inputPassword4">Cliente</label>
                    <v-select
                      v-model="cliente"
                      placeholder="Seleccione"
                      label="Nombres"
                      style="padding-left: 4px; width: 100%"
                      item-value="IdCliente"
                      v-on:input="changeCliente"
                      :options="clients"
                    />                   
                  </div>

                  <div class="col-md-6">
                    <label for="inputAddress">Moto</label>
                    <v-select
                      v-model="moto"
                      placeholder="Seleccione"
                      label="marca"
                      style="padding-left: 4px"
                      item-value="IdMoto"
                      :options="motos"
                      v-on:input="changeMoto"
                    />
                    <!-- <input
                      type="text"
                      class="form-control"                 
                      required
                      v-model="model.telefono"              
                      placeholder="telefono"
                    /> -->
                  </div>

                  <div class="col-md-6">
                    <label>Servicios</label>
                    <v-select
                      v-model="categoria"
                      placeholder="Seleccione"
                      label="descripcion"
                      style="padding-left: 4px; width: 100%"                    
                      item-value="IdCategoria"
                      v-on:input="changeServicio"
                      :options="servicios"
                    />
                  </div>
                  <div class="col-md-6">
                    <label for="modelo">observaciones </label>
                    <input
                      type="text"
                      class="form-control"
                      id="detalle_moto"
                      v-model="model.detalle_moto"
                    />
                  </div>                 
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <!-- @click="storeCita()" -->
                    <b-button variant="primary" 
                     @click="storeCita()"
                      >{{ textButton }}</b-button
                    >
                  </div>
                </div>
              </form>
            </b-card>

            <b-card header="Fecha " header-tag="header">
              <div class="row">
                <v-chip
                  class="ma-2"
                  color="primary"
                  v-model="horario"
                  v-for="item in horarios"
                  :key="item.IdHorario"
                  v-on:click="changeHorario(item)"
                >
                  {{ item.fec_atencion }}
                </v-chip>
              
              </div>

              <br />

            
              <br />
            </b-card>
          </v-col>
          <v-col cols="12" sm="4">
            <v-date-picker
              locale="es-es"
              v-model="fec"
              elevation="15"
                event-color="green lighten-1" 
                 :events="arrayEvents"
              @input="onInput()"
            ></v-date-picker>
            <br />
            <br />
        
          </v-col>
        </v-row>
      </v-container>
    </v-app>
  </div>
</template>

<script>
import vSelect from "vue-select";
const Swal = require("sweetalert2");
export default {
  components: {
    vSelect,
  },
  props: ['cita'],
  data() {
    return {
      date: "2018-03-02",
      textButton: "Registrar Cita",
      picker: null,
      settings: [],
      categorias: [],
      servicios: [],
      horarios: [],
      clients: [],
      cliente: {},
      motos: [],
      selectedItem: null,
      arrayEvents: null,
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
        IdCita: null,
        DNI: null,
        Nombres: null,
        Apellidos: null,
        correo: null,
        telefono: null,
        IdHorario: null,
        marca: null,
        modelo: null,
        IdCliente: null,
        IdCategoria: null,
        color: null,
        IdMoto: null,
        modelo_motor: null,
        potencia_motor: null,
        cilindrada_motor: null,
        detalle_moto: null,
        detalle_motor: "detealle",
        estado: "n",  
        IdUsuario: 1,
        fec_registro: "2022-10-05",
        cilindrada: 200,
        detalle: {},
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

    this.fec = this.curren_date;
    this.getMotos();
    this.getServicios();
    this.getClientes();

    if (this.cita) {
        //console.log("cita es : ",this.cita);
        this.textButton="Editar Cita";
        setTimeout(() => {
          this.initform();
          }, 1000);
     
    }
  },
  methods: {
    changeCliente() {
      if (this.cliente) {
        
        this.model.IdCliente=this.cliente.IdCliente;
      }
    },
    changeMoto() {
      if (this.moto) {
        this.model.IdMoto = this.moto.IdMoto;
        this.model.color = this.moto.color;
        this.model.marca = this.moto.marca;
        this.model.modelo = this.moto.modelo;
      } else {
        this.model.IdMoto = null;
        this.model.color = null;
        this.model.marca = null;
        this.model.modelo = null;
      }
    },

    storeCita() {
      let url = "/cita-store";
      let data = this.model;    
      if (!this.model.IdCliente) {
        alert("Ingresar el documento");
      } else if (!this.model.IdHorario) {
        alert("Seleccionar una fecha");
      }

      else if (!this.model.detalle_moto) {
        alert("agrege una observacion");
      }      
      else {

        axios
          .post(url, data, {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          })
          .then((response) => {
            console.log(response);
            const { message, status } = response.data;
            if (status == 200) {
              // alert(message);
               Swal.fire({ icon: 'success', text: message, timer: 3000,})
            } else if (status == 400) {
            //  alert(message);
              Swal.fire({ icon: 'warning', text: message, timer: 2000,})
            } else {
               Swal.fire({ icon: 'warning', text:"hubo Algun error", timer: 2000,})
             // alert("hubo Algun error");
            }
          })
          .catch((error) => {
            console.log(error);
          });
      }
   
    },
    changeServicio(e) {
    ///  console.log(this.categoria);
      let me = this;
      me.descripcion = me.categoria.descripcion;
      let url = "/horario-categoria/" + me.categoria.IdCategoria;
      me.model.IdCategoria=me.categoria.IdCategoria
      axios({
        method: "GET",
        url: url,
      })
        .then(function (response) {
          if (response.data.status == 200) {
           
            me.arrayEvents=[];
            me.horarios = response.data.result;
            me.horarios.forEach((item)=>{
              me.arrayEvents.push(item.fec_atencion);
            }); 
            //arrayEvents
          }else{
              me.arrayEvents=null;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    changeHorario(horario) {
      console.log(horario);
      this.empleado = horario.Nombres + " " + horario.Apellidos;
      this.model.IdHorario = horario.IdHorario;
      this.model.fec_registro = horario.fec_atencion;
    },

    onInput(e) {
      let me = this;
      let url = "/gethorario/" + me.fec;
      axios({
        method: "GET",
        url: url,
      })
        .then(function (response) {
          if (response.data.status == 200) {
            // console.log(response);
            me.categorias = response.data.result;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getServicios() {
      //clientes-records
      let me = this;
      let url = "/categorias-records";
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
    getClientes() {
      //clientes-records
      let me = this;
      let url = "/clientes-records";
      axios({
        method: "GET",
        url: url,
      })
        .then(function (response) {
          console.log("clientes",response);
          if (response.data.status == 200) {          
            me.clients = response.data.result;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getMotos() {
      let me = this;
      let url = "/motos-records";
      axios({
        method: "GET",
        url: url,
      })
        .then(function (response) {
          if (response.data.status == 200) {       
            me.motos = response.data.result;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    ChangeCAtgeroria(item) {
      this.categoria = item.descripcion;
      this.model.IdHorario = item.IdHorario;
    },

    initform(){
    
      this.cliente = this.clients.find(x=>x.IdCliente==this.cita.IdCliente);
      this.categoria = this.servicios.find(x=>x.IdCategoria==this.cita.IdCategoria);

      this.moto = this.motos.find(x=>x.IdMoto==this.cita.detalle.IdMoto);
      this.changeMoto();
      this.model.IdCliente=this.cita.IdCliente;
      this.model.IdCategoria=this.cita.IdCategoria;
      this.model.IdMoto=this.cita.IdMoto;
      this.model.IdCita=this.cita.IdCita;
      this.model.detalle=this.cita.detalle;
      this.changeServicio();

      console.log(this.model);
    }
  },
};
</script>

<style>
.v-application ol,
.v-application ul {
  padding-left: 2px;
}
</style>