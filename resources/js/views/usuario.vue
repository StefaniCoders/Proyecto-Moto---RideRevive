<template>
  <div>
    <div class="card">
      <div class="card-body">
        <h2 class="card-title text-center">Lista de Usuarios</h2>
        <br />

        <div class="col-md-12 p-3 form-inline">
          <input type="text" class="form-control"   v-model="name"/>
          <button class="btn btn-primary ml-2" @click="getUsuarios()">
            <i class="fas fa-search mr-1"></i>Buscar
          </button>

          <b-button class="btn btn-primary ml-2" @click="show = true"
            >Nuevo Usuario</b-button
          >
        </div>

        <div class="col-md-12 p-20 m-2 border">
          
          <table id="example" class="display" style="width: 100%">
            <thead>
              <th>CODIGO</th>
              <th>Usuario</th>
              <th>Nivel</th>
              <th>estado</th>
              <th>acciones</th>
            </thead>
            <tbody>
              <tr v-for="item in usuarios" :key="item.IdEmpleado">
                <td>{{ item.IdEmpleado }}</td>
                <td>{{ item.nom_usuario }}</td>
                <td>{{ item.nivel }}</td>
                <td>{{ item.estado=='A'?'Activo':'Inactivo' }}</td>
              <td>
                <button class="btn btn-danger"  @click="eliminar(item.IdUsuario)">Eliminar</button>
              </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <b-modal ref="modal" title="Nuevo Usuario" v-model="show" hide-footer>
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group label="Empleado">
          <v-select
            v-model="empleado"
            placeholder="Seleccione"
            label="Nombres"
            style="padding-left: 4px; width: 100%"
            item-value="IdEmpleado"
            v-on:input="changeEmpleado"
            :options="empleados"
          />
        </b-form-group>
        <b-form-group label="Usuario">
          <b-form-input
            v-model="model.usuario"
            type="text"
            placeholder="usuario"
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group label="Contraseña">
          <b-form-input
            v-model="model.password"
            type="password"
            placeholder="contraseña"
             autocomplete="new-password" 
            required
          ></b-form-input>
        </b-form-group>
          <b-form-checkbox
            id="checkbox-1"
            v-model="status"
            name="checkbox-1"
            value="Empleado"
            unchecked-value="Administrador"
            >
           
            </b-form-checkbox>
         
        <div>Nivel: <strong>{{ status }}</strong></div>
        <b-button type="submit" variant="primary">Guardar</b-button>
      </form>
    </b-modal>
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
      status: 'Empleado',
      picker: null,
      settings: [],
      name: '',
      categorias: [],
      servicios: [],
      horarios: [],
      usuarios: [],
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
    this.fec = this.curren_date;
    this.getUsuarios();
  },
  methods: {
    changeEmpleado() {

        if (this.empleado) {
                this.model.IdEmpleado=this.empleado.IdEmpleado
        }else
        {
            this.model.IdEmpleado=null
        }
      
    },
    handleSubmit() {
        let me =this;
        me.model.nivel=me.status;
        if (me.model.IdEmpleado && me.model.usuario  && me.model.password) {
                let data = me.model
                console.log(data);
                let url="/usuario-store"
                   axios.post(url, data, {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    })
                    .then((response) => {
                     
                        const { result, status } = response.data;
                        if (status == 200) {
                          alert("Registrado");
                          me.show=false;
                          me.getUsuarios();
                        } else if (status == 400) {
                          alert("El usuario ya existe");
                        } else {
                               console.log(response);
                          alert("hubo Algun error");
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
        }else{
            alert("Complete los campos");
        }
    },
    getUsuarios() {
      //clientes-records
      let me = this;
      let params =`name=${me.name}`;
      let url = "./usuarios-records?"+params;
     // let url = "./usuarios-records";
      axios({
        method: "GET",
        url: url,
      })
        .then(function (response) {
          if (response.data.status == 200) {
            console.log(response);
            me.usuarios = response.data.result;
            me.empleados = response.data.empleados;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },


    eliminar(id){
        let me = this;
        let url = "./usuarios-delete/"+id;
        axios({
          method: "GET",
          url: url,
        })
          .then(function (response) {           
            if (response.data.status == 200) {
              me.getUsuarios();              
              alert(response.data.message);
            }else{
              alert(response.data.message);
            }
          })
          .catch((error) => {
            console.log(error);
          });
      }
  },
};
</script>

<style>
.modal-backdrop {
  background-color: #22292f;
  opacity: 0.5;
}
</style>