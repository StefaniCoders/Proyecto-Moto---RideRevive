<template>
    <div>
      <div class="card">
        <div class="card-body">
          <h2 class="card-title text-center">Lista de Empleados</h2>
          <br />  
          <div class="col-md-12 p-3 form-inline">
            <input type="text" class="form-control" v-model="name"/>
            <button class="btn btn-primary ml-2" @click="getUsuarios()">
              <i class="fas fa-search mr-1"></i>Buscar
            </button>  
            <b-button class="btn btn-primary ml-2" @click="openModal(null)"
              >Nuevo Empleado</b-button
            >
          </div>  
          <div class="col-md-12 p-20 m-2 border">
            <table id="example" class="display" style="width: 100%">
              <thead>                 
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>correo</th>
                    <th>telefono</th>
                    <th>acciones</th>
              </thead>
              <tbody>
                <tr v-for="item in usuarios" :key="item.IdEmpleado">
                  <td>{{ item.Nombres }}</td>
                  <td>{{ item.Apellidos }}</td>
                  <td>{{ item.DNI }}</td>
                  <td>{{ item.correo }}</td>
                  <td>{{ item.telefono }}</td>
                  <td>
                <button class="btn btn-warning"  @click="openModal(item.IdEmpleado)">Editar</button>
                <button class="btn btn-danger"  @click="eliminar(item.IdEmpleado)">Eliminar</button>
              </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <b-modal ref="modal" title="Nuevo Empleado" v-model="show" hide-footer>
        <form ref="form" @submit.stop.prevent="handleSubmit">        
          <b-form-group label="Nombres">
            <b-form-input
              v-model="model.Nombres"
              type="text"         
              required
            ></b-form-input>
          </b-form-group>
          <b-form-group label="Apellidos">
            <b-form-input
              v-model="model.Apellidos"        
              required
            ></b-form-input>
          </b-form-group>          
          <b-form-group label="DNI">
            <b-form-input
              v-model="model.DNI"        
              required
            ></b-form-input>
          </b-form-group>  
              <b-form-group label="correo">
            <b-form-input
              v-model="model.correo"        
              required
            ></b-form-input>
          </b-form-group>
          <b-form-group label="telefono">
            <b-form-input
              v-model="model.telefono"        
              required
            ></b-form-input>
          </b-form-group>      
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
        name: '',
        settings: [],
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
            IdEmpleado: null,
            Nombres: null,
            Apellidos: null,
            DNI: null,
            correo: null,
            telefono: null,
        },
        categoria: null,
        moto: null,
        descripcion: null,
        horario: null,
        empleado: null,
      };
    },
    mounted() {      
      this.getUsuarios();
    },
    methods: {   
      handleSubmit() {
          let me =this;      
          if (me.model.Nombres  && me.model.Apellidos && me.model.DNI) {
                  let data = me.model
                  console.log(data);
                  let url="/empleados-store"
                     axios.post(url, data, {
                          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                      })
                      .then((response) => {
                       
                          const { result, status,message } = response.data;
                          if (status == 200) {
                              me.show=false;
                              alert(message);
                            me.getUsuarios();
                          } 
                      })
                      .catch((error) => {
                          console.log(error);
                      });
          }else{
              alert("Complete los campos");
          }
      },
      openModal(id){
        console.log(id);
        if (id) {
           this.getCliente(id);
        }
        this.show=true;
      },    
      getUsuarios() {   
        let me = this;
        ///this.name
        let params =`name=${me.name}`;
        let url = "./empleados-records?"+params;
        console.log(url);
        axios({
          method: "GET",
          url: url,
        })
          .then(function (response) {
            if (response.data.status == 200) {
              console.log(response);
              me.usuarios = response.data.result;
           //   me.empleados = response.data.empleados;
            }
          })
          .catch((error) => {
            console.log(error);
          });
      },
      getCliente(id) {   
        let me = this;
        let url = "./empleados-edit/"+id;
        axios({
          method: "GET",
          url: url,
        })
          .then(function (response) {
            if (response.status == 200) {
              console.log(response);
              me.model=response.data.result;
             // me.usuarios = response.data.result;
           //   me.empleados = response.data.empleados;
            }
          })
          .catch((error) => {
            console.log(error);
          });
      },
      eliminar(id){
        let me = this;
        let url = "./empleados-delete/"+id;
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