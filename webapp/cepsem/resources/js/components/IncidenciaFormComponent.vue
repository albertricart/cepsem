<template>
  <div class="incidencia-form mx-5 my-5">
    <h1 class="page-title">NOVA INCIDÈNCIA</h1>

    <h3 class="mt-5 mr-3" style="text-align: right">
      <b>ID {{ incidencia.id }}</b>
    </h3>

    <nav class="incidencia-form-nav table-header">
      <span class="active">ALERTANT</span>
      <span>LOCALITZACIÓ</span>
      <span>AFECTATS</span>
      <span>RECURSOS MÒBILS</span>
    </nav>

    <div class="incidencia-form-body">
      <section id="alertant">
        <div class="row">
          <div class="col-lg-7">
            <div class="row">
              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="tipusaccident">Tipus Incidència</label>
                  <b-form-select
                    name="tipusaccident"
                    id="tipusaccident"
                    class="select"
                    value-field="id"
                    text-field="tipus"
                    :options="tipusincidents"
                  ></b-form-select>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="input input--col mb-4">
                  <label for="nom">Cerca un alertant existent</label>
                  <div class="input-button">
                    <input
                      type="text"
                      name="telefon"
                      id="telefon"
                      placeholder="Introdueix el telèfon de l'alertant..."
                      autofocus
                    />
                    <button class="button button--blue" style="width: 100%">
                      CARREGAR DADES
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="incidencia-hora">
              <div class="input input--row mb-4">
                <label for="data">Data</label>
                <input
                  type="date"
                  name="data"
                  id="data"
                  value=""
                  v-model="incidencia.data"
                />
              </div>

              <div class="input input--row mb-4">
                <label for="hora">Hora</label>
                <input
                  type="time"
                  name="hora"
                  id="hora"
                  value=""
                  v-model="incidencia.hora"
                />
              </div>

              <div>
                <button
                  class="button button--pink ml-2"
                  @click="actualitzarDateTime"
                >
                  ACTUALITZAR
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="row m-md-5">
          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="nom">Nom</label>
              <input
                type="text"
                name="nom"
                id="nom"
                placeholder="Introdueix el nom de l'alertant..."
                v-model="incidencia.alertant.nom"
              />
            </div>
          </div>

          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="cognoms">Cognoms</label>
              <input
                type="text"
                name="cognoms"
                id="cognoms"
                v-model="incidencia.alertant.cognoms"
                placeholder="Introdueix els cognoms de l'usuari..."
              />
            </div>
          </div>

          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="telefon">Telèfon</label>
              <input
                type="number"
                min="600000000"
                max="999999999"
                name="telefon"
                id="telefon"
                v-model="incidencia.alertant.telefon"
                placeholder="Introdueix el telèfon de l'alertant..."
              />
            </div>
          </div>

          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="adreca">Adreça</label>
              <input
                type="text"
                name="adreca"
                id="adreca"
                v-model="incidencia.alertant.adreca"
                placeholder="Introdueix l'adreça de l'alertant..."
              />
            </div>
          </div>

          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="tipus">Tipus</label>
              <b-form-select
                name="tipus"
                id="tipus"
                v-model="incidencia.alertant.tipus_alertants_id"
                class="select"
                value-field="id"
                text-field="tipus"
                :options="tipusalertants"
              ></b-form-select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="provincia">Provincia</label>
              <b-form-select
                name="provincia"
                id="provincia"
                v-model="incidencia.alertant.municipi.comarca.provincia.id"
                class="select"
                value-field="id"
                text-field="nom"
                :options="provincies"
              ></b-form-select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="comarca">Comarca</label>
              <b-form-select
                name="comarca"
                id="comarca"
                class="select"
                value-field="id"
                text-field="nom"
                v-model="incidencia.alertant.municipi.comarca.id"
                :options="alertantComarques"
              ></b-form-select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="municipi">Municipi</label>
              <b-form-select
                name="municipi"
                id="municipi"
                v-model="incidencia.alertant.municipis_id"
                class="select"
                value-field="id"
                text-field="nom"
                :options="alertantMunicipis"
              ></b-form-select>
            </div>
          </div>

          <div class="col-lg-4" v-show="insert">
            <input
              type="checkbox"
              name="saveAlertant"
              id="saveAlertant"
              v-model="incidencia.saveAlertant"
            />
            <label for="saveAlertant">Emmagatzemar Alertant</label>
          </div>
        </div>

        <div class="incidencia-form-footer">
          <button
            class="button button-icon button--pink button--rounded"
            style="
              background-image: url('/cepsem/webapp/cepsem/public/assets/icons/next.svg');
            "
          >
            Següent
          </button>
        </div>
      </section>

      <section id="localitzacio">
        <div class="row">
          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="provincia">Provincia</label>
              <b-form-select
                name="provincia"
                id="provincia"
                class="select"
                v-model="incidencia.municipi.comarca.provincia.id"
                value-field="id"
                text-field="nom"
                :options="provincies"
              ></b-form-select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="comarca">Comarca</label>
              <b-form-select
                name="comarca"
                id="comarca"
                class="select"
                v-model="incidencia.municipi.comarca.id"
                value-field="id"
                text-field="nom"
                :options="incidenciaComarques"
              ></b-form-select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="input input--col mb-4">
              <label for="municipi">Municipi</label>
              <b-form-select
                name="municipi"
                id="municipi"
                class="select"
                v-model="incidencia.municipis_id"
                value-field="id"
                text-field="nom"
                :options="incidenciaMunicipis"
              ></b-form-select>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8">
              <div class="input input--col mb-4">
                <label for="adreca">Adreça</label>
                <input
                  type="text"
                  name="adreca"
                  id="adreca"
                  v-model="incidencia.alertant.adreca"
                  placeholder="Introdueix l'adreça de l'alertant..."
                />
              </div>
            </div>
            <div class="col-lg-4">
              <div class="input input--col mb-4">
                <label for="adreca">Adreça</label>
                <input
                  type="text"
                  name="adreca"
                  id="adreca"
                  v-model="incidencia.alertant.adreca"
                  placeholder="Introdueix l'adreça de l'alertant..."
                />
              </div>
            </div>
          </div>

          <div class="incidencia-form-footer">
            <button
              class="button button-icon button--pink button--rounded"
              style="
                background-image: url('/cepsem/webapp/cepsem/public/assets/icons/next.svg');
              "
            >
              Següent
            </button>
          </div>
        </div>

      </section>

      <section id="afectats">
        <afectatitem-component></afectatitem-component>
      </section>
      <section id="recursos">
          <recursitem-component></recursitem-component>
      </section>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    idincidencia: {
      type: Number,
      required: false,
    },
    insert: {
      type: Boolean,
      required: true,
    },
    tipusalertants: {
      type: Array,
      required: false,
    },
    tipusincidents: {
      type: Array,
      required: false,
    },
    provincies: {
      type: Array,
      required: false,
    },
  },
  data() {
    return {
      alertantComarques: [],
      alertantMunicipis: [],
      incidenciaComarques: [],
      incidenciaMunicipis: [],
      incidencia: {
        id: 0,
        num_incident: 0,
        data: 0,
        hora: 0,
        telefon_alertant: "",
        adreca: "",
        adreca_complement: "",
        descripcio: "",
        nom_metge: "",
        tipus_incidencies_id: 0,
        alertants_id: 0,
        municipis_id: 0,
        usuaris_id: 0,
        saveAlertant: false,
        alertant: {
          id: 0,
          telefon: "",
          nom: "",
          cognoms: "",
          adreca: "",
          municipis_id: 0,
          tipus_alertants_id: 0,
          tipus_alertant: {
            id: 0,
            tipus: "",
          },
          municipi: {
            id: 0,
            nom: "",
            comarques_id: 0,
            comarca: {
              id: 0,
              nom: "",
              provincies_id: 0,
              provincia: {
                id: 0,
                nom: "",
              },
            },
          },
        },
        municipi: {
          id: 0,
          nom: "",
          comarques_id: 0,
          comarca: {
            id: 0,
            nom: "",
            provincies_id: 0,
            provincia: {
              id: 0,
              nom: "",
            },
          },
        },
      },
    };
  },
  methods: {
    // emptyIncidencia() {
    //   empty = {
    //     id: 0,
    //     num_incident: 0,
    //     data: 0,
    //     hora: 0,
    //     telefon_alertant: "",
    //     adreca: "",
    //     adreca_complement: "",
    //     descripcio: "",
    //     nom_metge: "",
    //     tipus_incidencies_id: 0,
    //     alertants_id: 0,
    //     municipis_id: 0,
    //     usuaris_id: 0,
    //     municipi: {
    //       id: 0,
    //       nom: "",
    //       comarques_id: 0,
    //       comarca: {
    //         id: 0,
    //         nom: "",
    //         provincies_id: 0,
    //         provincia: {
    //           id: 0,
    //           nom: "",
    //         },
    //       },
    //     },
    //   };

    //   this.incidencia = empty;
    // },
    filtrarComarques(idProvincia) {
      let comarques = [];

      if (idProvincia == 0) {
        this.provincies.forEach((provincia) => {
          provincia.comarques.forEach((comarca) => {
            comarques.push(comarca);
          });
        });
      } else {
        this.provincies.forEach((provincia) => {
          if (provincia.id == idProvincia) {
            provincia.comarques.forEach((comarca) => {
              comarques.push(comarca);
            });
          }
        });
      }

      return comarques;
    },

    filtrarMunicipis(idComarca, comarques) {
      let municipis = [];

      if (idComarca == 0) {
        comarques.forEach((comarca) => {
          comarca.municipis.forEach((municipi) => {
            municipis.push(municipi);
          });
        });
      } else {
        comarques.forEach((comarca) => {
          if (idComarca == comarca.id) {
            comarca.municipis.forEach((municipi) => {
              municipis.push(municipi);
            });
          }
        });
      }

      return municipis;
    },

    actualitzarDateTime() {
      var date = new Date();

      var day = date.getDate(),
        month = date.getMonth() + 1,
        year = date.getFullYear(),
        hour = date.getHours(),
        min = date.getMinutes();

      month = (month < 10 ? "0" : "") + month;
      day = (day < 10 ? "0" : "") + day;
      hour = (hour < 10 ? "0" : "") + hour;
      min = (min < 10 ? "0" : "") + min;

      var today = year + "-" + month + "-" + day,
        displayTime = hour + ":" + min;

      document.getElementById("data").value = today;
      document.getElementById("hora").value = displayTime;
    },

    initComponent() {
      let me = this;

      if (this.insert) {
        axios
          .get("/incidencies")
          .then((response) => {
            let incidencies = response.data;
            let lastIncidencia = incidencies[incidencies.length - 1];
            me.incidencia.id = lastIncidencia.id + 1;
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        axios
          .get("/incidencies/" + me.idincidencia)
          .then((response) => {
            me.incidencia = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
  created() {
    this.initComponent();
    // this.actualitzarDateTime();
  },
  mounted() {
    console.log("Incidència component mounted.");
  },
  computed: {
    filtrarAlertantComarques() {
      this.alertantComarques = this.filtrarComarques(
        this.incidencia.alertant.municipi.comarca.provincia.id
      );
    },

    filtrarAlertantMunicipis() {
      this.alertantMunicipis = this.filtrarMunicipis(
        this.incidencia.alertant.municipi.comarca.id,
        this.alertantComarques
      );
    },

    filtrarIncidenciaComarques() {
      this.incidenciaComarques = this.filtrarComarques(
        this.incidencia.municipi.comarca.provincia.id
      );
    },

    filtrarIncidenciaMunicipis() {
      this.incidenciaMunicipis = this.filtrarMunicipis(
        this.incidencia.municipi.comarca.id,
        this.incidenciaComarques
      );
    },
  },
};
</script>
