<template>
  <div class="container-fluid">
    <div class="incidencia-form mx-5 my-5">
      <h1 class="page-title">
        <span v-if="insert">NOVA</span><span v-else>EDITAR</span> INCIDÈNCIA
      </h1>

      <h3 class="mt-5 mr-3" style="text-align: right">
        <b>ID {{ incidencia.id }}</b>
      </h3>

      <div v-if="loading" class="table-loading">
        <p>{{ loadingStatus }}</p>
        <div class="progress-line"></div>
      </div>

      <div v-else>
        <nav class="incidencia-form-nav table-header">
          <span class="nav-link active" @click="tabSelected(0)" data-nav="0"
            >ALERTANT</span
          >
          <span class="nav-link" @click="tabSelected(1)" data-nav="1"
            >LOCALITZACIÓ</span
          >
          <span class="nav-link" @click="tabSelected(2)" data-nav="2"
            >AFECTATS</span
          >
          <span class="nav-link" @click="tabSelected(3)" data-nav="3"
            >RECURSOS MÒBILS</span
          >
        </nav>

        <div class="incidencia-form-body">
          <section
            class="js-tab-content animate__animated animate__faster animate__fadeIn"
            id="alertant"
            data-tab="0"
          >
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
                        v-model="incidencia.tipus_incidencies_id"
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
                      v-model="incidencia.data"
                    />
                  </div>

                  <div class="input input--row mb-4">
                    <label for="hora">Hora</label>
                    <input
                      type="time"
                      name="hora"
                      id="hora"
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
              <div class="col-lg-12 mb-3">
                <h3 class="section-title">
                  <img
                    src="/cepsem/webapp/cepsem/public/assets/icons/alertant.svg"
                    alt=""
                    class="mr-3"
                  />DADES DE L'ALERTANT
                </h3>
              </div>

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
                  <label for="adrecaAlertant">Adreça</label>
                  <input
                    type="text"
                    name="adrecaAlertant"
                    id="adrecaAlertant"
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

              <!-- <div class="col-lg-6">
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
              </div> -->

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
          </section>

          <section
            class="js-tab-content animate__animated animate__faster"
            id="localitzacio"
            data-tab="1"
            style="display: none"
          >
            <div class="row">
              <!-- <div class="col-lg-6">
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
            </div> -->

              <div class="col-lg-5">
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
              <div class="col-lg-3">
                <div class="input input--col mb-4">
                  <label for="numero_adreca">Número</label>
                  <input
                    type="text"
                    name="numero_adreca"
                    id="numero_adreca"
                    placeholder="Introdueix el número de l'adreça de l'incident..."
                  />
                </div>
              </div>
              <div class="col-lg-8">
                <div class="input input--col mb-4">
                  <label for="complementadreca">Complement Adreça</label>
                  <textarea
                    name="complementadreca"
                    id="complementadreca"
                    cols="30"
                    rows="7"
                    v-model="incidencia.alertant.adreca_complement"
                    placeholder="Indica informació complementària sobre l’adreça del incident..."
                  ></textarea>
                </div>
              </div>
            </div>
          </section>

          <!--  -->
          <section
            class="js-tab-content animate__animated animate__faster"
            id="afectats"
            data-tab="2"
            style="display: none"
          >
            <div class="row">
              <afectatitem-component
                v-for="afectat in afectats"
                :key="afectat.id"
                :editafectat="afectat"
                :sexes="sexes"
              ></afectatitem-component>

              <div class="col-3 m-auto">
                <button
                  class="button button-icon button-inverted button-inverted--blue button--rounded addButton"
                  @click="addAfectat"
                >
                  Afegir Afectat
                </button>
              </div>
            </div>
          </section>

          <section
            class="js-tab-content animate__animated animate__faster"
            id="recursos"
            data-tab="3"
            style="display: none"
          >
            <recursitem-component
                v-for="incidencia_has_recurs in incidencia.incidencia_has_recursos"
                :key="incidencia_has_recurs.id"
                :editrecurs="incidencia_has_recurs"
                :tipusrecursos="tipusrecursos">
            </recursitem-component>
          </section>

          <div class="incidencia-form-footer">
            <button
              class="button button-icon button--pink button--rounded"
              style="
                background-image: url('/cepsem/webapp/cepsem/public/assets/icons/next.svg');
              "
              @click="fabClick"
            >
              <span v-if="currentTab == 3">Finalitzar</span>
              <span v-else>Següent</span>
            </button>
          </div>
        </div>
      </div>
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
    sexes: {
      type: Array,
      required: false,
    },
    tipusrecursos: {
        type: Array,
      required: false,
    }
  },
  data() {
    return {
      alertantComarques: [],
      alertantMunicipis: [],
      incidenciaComarques: [],
      incidenciaMunicipis: [],
      afectats: [],
      currentTab: 0,
      loading: true,
      loadingStatus: "Carregant les dades...",
      incidencia: {
        id: 0,
        num_incident: 0,
        data: "yyyy-MM-dd",
        hora: "HH:mm",
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
        afectats: [],
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
        incidencia_has_recursos: [],
        //  {
        //   afectat: {
        //     id: "",
        //     telefon: "",
        //     cip: "",
        //     nom: "",
        //     cognoms: "",
        //     edat: "",
        //     te_cip: "",
        //     sexes_id: "",
        //   },
        //   afectats_id: 1,
        //   desti: null,
        //   hora_activacio: null,
        //   hora_arribada_hospital: null,
        //   hora_assistencia: null,
        //   hora_finalitzacio: null,
        //   hora_mobilitzacio: null,
        //   hora_transferencia: null,
        //   hora_transport: null,
        //   incidencies_id: 2,
        //   prioritat: null,
        // },
      },
    };
  },
  created() {
    this.initComponent();
  },

  mounted() {
    console.log("Incidència component mounted.");
    this.actualitzarDateTime();
  },
  computed: {
    // filtrarAlertantComarques() {
    //   this.alertantComarques = this.filtrarComarques(
    //     this.incidencia.alertant.municipi.comarca.provincia.id
    //   );
    // },
    // filtrarAlertantMunicipis() {
    //   this.alertantMunicipis = this.filtrarMunicipis(
    //     this.incidencia.alertant.municipi.comarca.id,
    //     this.alertantComarques
    //   );
    // },
    // filtrarIncidenciaComarques() {
    //   this.incidenciaComarques = this.filtrarComarques(
    //     this.incidencia.municipi.comarca.provincia.id
    //   );
    // },
    // filtrarIncidenciaMunicipis() {
    //   this.incidenciaMunicipis = this.filtrarMunicipis(
    //     this.incidencia.municipi.comarca.id,
    //     this.incidenciaComarques
    //   );
    // },
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
    // filtrarComarques(idProvincia) {
    //   let comarques = [];

    //   if (idProvincia == 0) {
    //     this.provincies.forEach((provincia) => {
    //       provincia.comarques.forEach((comarca) => {
    //         comarques.push(comarca);
    //       });
    //     });
    //   } else {
    //     this.provincies.forEach((provincia) => {
    //       if (provincia.id == idProvincia) {
    //         provincia.comarques.forEach((comarca) => {
    //           comarques.push(comarca);
    //         });
    //       }
    //     });
    //   }

    //   return comarques;
    // },

    // filtrarMunicipis(idComarca, comarques) {
    //   let municipis = [];

    //   if (idComarca == 0) {
    //     comarques.forEach((comarca) => {
    //       comarca.municipis.forEach((municipi) => {
    //         municipis.push(municipi);
    //       });
    //     });
    //   } else {
    //     comarques.forEach((comarca) => {
    //       if (idComarca == comarca.id) {
    //         comarca.municipis.forEach((municipi) => {
    //           municipis.push(municipi);
    //         });
    //       }
    //     });
    //   }

    //   return municipis;
    // },

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

      this.incidencia.data = today;
      this.incidencia.hora = displayTime;

    },

    initComponent() {
      let me = this;

      if (this.insert) {
        axios
          .get("/incidencies")
          .then((response) => {
            let incidencies = response.data;
            var assignarId;
            if (incidencies.length == 0) {
              assignarId = 1;
            } else {
              assignarId = incidencies[incidencies.length - 1].id + 1;
            }
            me.incidencia.id = assignarId;
            this.loading = false;
            this.addAfectat();
          })
          .catch((error) => {
            console.log(error);
            this.loadingStatus = error;
          });
      } else {
        axios
          .get("/incidencies/" + me.idincidencia)
          .then((response) => {
            me.incidencia = response.data;
            this.loading = false;
          })
          .catch((error) => {
            console.log(error);
            this.loadingStatus = error;
          });
      }
    },

    tabSelected(id) {
      this.currentTab = id;
      let navlinks = document.querySelectorAll(".nav-link");
      let tabContents = document.querySelectorAll(".js-tab-content");

      navlinks.forEach((navlink) => {
        if (navlink.dataset.nav == id) {
          navlink.classList.add("active");
        } else {
          navlink.classList.remove("active");
        }
      });

      tabContents.forEach((tabContent) => {
        if (tabContent.dataset.tab == id) {
          tabContent.style.display = "block";
          tabContent.classList.add("animate__fadeIn");
        } else {
          tabContent.style.display = "none";
          tabContent.classList.remove("animate__fadeIn");
        }
      });

      if (id == 2) {
        this.getAfectats();
      }
    },

    fabClick() {
      //finalitzar
      if (this.currentTab == 3) {
      } else {
        this.tabSelected(this.currentTab + 1);
      }
    },

    addAfectat() {
      let afectat = {
        id: 0,
        telefon: "",
        cip: "",
        nom: "",
        cognoms: "",
        edat: 0,
        te_cip: 0,
        sexes_id: 0,
        saveAfectat: false,
      };

      afectat.id = Math.random();
      this.afectats.push(afectat);
      this.incidencia.incidencia_has_recursos.push(this.emptyIncidenciaHasRecurs());
      this.getAfectats();
    },
    emptyIncidenciaHasRecurs() {
        return {
            incidencies_id: 0,
            recursos_id: 0,
            hora_activacio: 0,
            hora_mobilitzacio: 0,
            hora_assistencia: 0,
            hora_transport: 0,
            hora_arribada_hospital: 0,
            hora_transferencia: 0,
            hora_finalitzacio: 0,
            prioritat: 0,
            desti: ""
        }
    },

    removeAfectat(id) {
      let i = 0;
      let found = false;
      while (!found && i < this.afectats.length) {
        if (this.afectats[i].id == id) {
          found = true;
          this.afectats.splice(i, 1);
        }
        i++;
      }
      this.getAfectats();
    },

    getAfectats() {
      if (!this.insert) {
        let incidencia = this.incidencia;
        incidencia.incidencia_has_recursos.forEach((incidencia_has_recurs) => {
          let afectat = incidencia_has_recurs.afectat;
          if (!this.afectats.includes(afectat)) this.afectats.push(afectat);
        });
      }
      return this.afectats.length;
    },
  },
};
</script>
