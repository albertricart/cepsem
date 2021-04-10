<template>
  <div>
    <h1 class="page-title">ALERTANTS</h1>

    <div class="d-flex justify-content-end mb-4">
      <b-button
        class="button button-icon button--pink"
        style="background-image: url('../assets/icons/add.svg')"
        id="show-btn"
        @click="showModal"
      >
        AFEGEIX UN NOU ALERTANT
      </b-button>
    </div>

    <div v-if="loading" class="table-loading">
      <p>{{ error }}</p>
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
      <div class="cepsem-modal alertant-modal">
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
                  <input type="text" name="telefon" id="telefon" v-model="alertant.telefon" placeholder="Introdueix el telèfon de l'alertant..."/>
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

            <div class="cepsem-modal-footer">
                <button class="button button-icon button--rounded button--blue" type="button" style="background-image: url('../assets/icons/check.svg')" @click="insertAlertant">Afegir</button>
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
      error: "Carregant les dades...",
        tipus: [
          { value: null, text: 'Please select an option' },
          { value: 'a', text: 'This is First option' },
          { value: 'b', text: 'Selected Option' },
          { value: { C: '3PO' }, text: 'This is an option with object value' },
          { value: 'd', text: 'This one is disabled', disabled: true }
        ]
    };
  },
  created() {
    let me = this;

    axios
      .get("/alertants")
      .then((response) => {
        me.alertants = response.data;
        this.loading = false;
      })
      .catch((error) => {
        console.log(error);
        this.error = error;
      });

  },
  mounted() {
    console.log("Alertant component mounted.");
  },
  methods: {
    showModal() {
      this.$refs["alertant-modal"].show();
    },
    hideModal() {
      this.$refs["alertant-modal"].hide();
    },

    insertAlertant(){
        let me = this;

        axios
        .post("/alertants", me.alertant)
        .then((response) => {
            console.log(response);
            hideModal();
        })
        .catch((error) => {
            console.log(error);
            console.log(error.status);
            console.log(error.data);
        });
    }
  },
  computed: {
    rows() {
      return this.alertants.length;
    },


  },
};
</script>
