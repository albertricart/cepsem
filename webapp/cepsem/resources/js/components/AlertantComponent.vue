<template>
  <div>
    <h1 class="page-title">ALERTANTS</h1>

    <div class="d-flex justify-content-end mb-4">
      <button
        class="button button-icon button--pink"
        style="background-image: url('../assets/icons/add.svg')"
        id="show-btn"
        @click="showModal"
      >
        AFEGEIX UN NOU ALERTANT
      </button>
    </div>

    <div v-if="loading" class="table-loading">
      <p>{{ loadingStatus }}</p>
      <div class="progress-line"></div>
    </div>

    <div v-else>
      <b-table
        id="alertants-table"
        :fields="fields"
        :items="alertants"
        :per-page="perPage"
        :current-page="currentPage"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        sort-icon-left
        large
        hover
      ></b-table>

      <b-pagination
        class="mt-5"
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        aria-controls="alertants-table"
      ></b-pagination>
    </div>

    <b-modal hide-footer hide-header centered size="lg" ref="alertant-modal">
      <div class="cepsem-modal">
        <h2 class="mb-4">ALERTANT</h2>
        <form>
          <div class="container">
            <div class="row">

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="nom">Nom</label>
                  <input type="text" name="nom" id="nom" placeholder="Introdueix el nom de l'alertant..." v-model="alertant.nom" autofocus/>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="cognoms">Cognoms</label>
                  <input type="text" name="cognoms" id="cognoms" v-model="alertant.cognoms" placeholder="Introdueix els cognoms de l'usuari..."/>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="telefon">Telèfon</label>
                  <input type="number" min="600000000" max="999999999" name="telefon" id="telefon" v-model="alertant.telefon" placeholder="Introdueix el telèfon de l'alertant..."/>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="adreca">Adreça</label>
                  <input type="text" name="adreca" id="adreca" v-model="alertant.adreca" placeholder="Introdueix l'adreça de l'alertant..."/>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="tipus">Tipus</label>
                  <b-form-select name="tipus" id="tipus" v-model="alertant.tipus_alertants_id" class="select" value-field="id" text-field="tipus" :options="tipusalertants"></b-form-select>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="provincia">Provincia</label>
                  <b-form-select name="provincia" id="provincia" class="select" value-field="id" text-field="nom" :options="tipusalertants"></b-form-select>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="comarca">Comarca</label>
                  <b-form-select name="comarca" id="comarca" class="select" value-field="id" text-field="nom" :options="tipusalertants"></b-form-select>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="municipi">Municipi</label>
                  <b-form-select name="municipi" id="municipi" v-model="alertant.municipis_id" class="select" value-field="id" text-field="nom" :options="municipis"></b-form-select>
                </div>
              </div>

            </div>

            <div v-show="errors.length" class="input-error input-error--show" style="margin-bottom: 0;">
                <img src="/cepsem/webapp/cepsem/public/assets/icons/alert.svg" alt="" width="18px" height="18px" style="margin-bottom: auto">
                <div style="display: flex; flex-direction:column;">
                    <span>Petició invàlida, corregeix els següents errors:</span>
                <ul>
                    <li v-for="(error, index) in errors" :key="index">{{error}}</li>
                </ul>
                </div>
            </div>

            <div class="cepsem-modal-footer">
                <button class="button button-icon button--rounded button--blue" type="button" style="background-image: url('../assets/icons/check.svg')" @click="checkNotNull">Afegir</button>
                <button class="button button-icon button--rounded button-inverted button-inverted--red ml-2 mt-3" block @click="hideModal" type="button">Cancel·lar</button>
            </div>
          </div>
        </form>


      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
    props:{
        tipusalertants:{
            type: Array,
            required: false,
        },

        municipis:{
            type: Array,
            required: false,
        },

    },
  data() {
    return {
      sortBy: "id",
      sortDesc: false,
      perPage: 10,
      currentPage: 1,
      alertants: [],
      alertant: {
          id: '',
          telefon: '',
          nom: '',
          cognoms: '',
          adreca: '',
          tipus_alertants_id: '',
          municipis_id:'',
      },
      fields: [
        { key: "id", label: "ID", sortable: true },
        { key: "telefon", label: "Telèfon", sortable: true },
        { key: "nom", label: "Nom", sortable: true },
        { key: "cognoms", label: "Cognoms", sortable: true },
        { key: "adreca", label: "Adreça", sortable: true },
        { key: "municipi.nom", label: "Municipi", sortable: true },
        { key: "tipus_alertant.tipus", label: "Tipus", sortable: true },
      ],
      loading: true,
      loadingStatus: "Carregant les dades...",
      errors: [],
    };
  },
  created() {
      this.selectAlertants();
  },
  mounted() {
    console.log("Alertant component mounted.");
  },
  methods: {

    //   SELECT - GET   //
    selectAlertants(){
        let me = this;

        axios
        .get("/alertants")
        .then((response) => {
            me.alertants = response.data;
            this.loading = false;
        })
        .catch((error) => {
            console.log(error);
            this.loadingStatus = error;
        });
    },

    //   INSERT - POST   //
    insertAlertant(){
        let me = this;

        axios
        .post("/alertants", me.alertant)
        .then((response) => {
            console.log(response);

            if(response.status == 201){
                me.selectAlertants();
                me.emptyAlertant();
                me.errors = [];
                me.hideModal();
            }

        })
        .catch((error) => {
            console.log(error.response);
            console.log(error.response.data.errorMessage);
        });
    },


    //   UTILS   //

    /**
     * Funció que fa control d'errors i redirecciona a la funcio insertAlertant() en cas d'OK
     */
    checkNotNull(){
        this.errors = [];

        if(this.alertant.telefon){
            if(this.alertant.telefon.length != 9){
                this.checkIfExistsError("El camp telèfon ha d'incloure 9 números");
            }
        }else{
            this.checkIfExistsError("El camp telèfon és obligatori.");
        }

        if(!this.alertant.tipus_alertants_id){
                this.checkIfExistsError("El camp tipus és obligatori.");
        }

        //
        if(this.errors.length == 0){
            this.insertAlertant();
        }
    },


    /**
     * Funció que rep un missatge d'error per paràmetre, si no existeix a la llista d'errors l'afegirà
     *
     * @param {String} errorMessage
     */
    checkIfExistsError(errorMessage){
        if(!this.errors.includes(errorMessage)){
            this.errors.push(errorMessage);
        }
    },

    /**
     * Funció per a buidar els camps del objecte alertant (associat al formulari amb v-model)
     */
    emptyAlertant(){
        this.alertant.id = '',
        this.alertant.nom = '';
        this.alertant.cognoms = '';
        this.alertant.telefon = '';
        this.alertant.adreca = '';
        this.alertant.municipis_id = '';
        this.alertant.tipus_alertants_id = '';
    },


    //   MODALS   //
    showModal() {
      this.$refs["alertant-modal"].show();
    },
    hideModal() {
      this.$refs["alertant-modal"].hide();
    },

  },
  computed: {
    rows() {
      return this.alertants.length;
    },
  },
};
</script>
