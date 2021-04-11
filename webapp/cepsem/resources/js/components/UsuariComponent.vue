<template>
  <div>
    <h1 class="page-title">USUARIS</h1>

    <div class="d-flex justify-content-end mb-4">
      <button
        class="button button-icon button--pink"
        style="background-image: url('../assets/icons/add.svg')"
        id="show-btn"
        @click="showModal"
      >
        AFEGEIX UN NOU USUARI
      </button>
    </div>

    <div v-if="loading" class="table-loading">
      <p>{{ loadingStatus }}</p>
      <div class="progress-line"></div>
    </div>

    <div v-else>
      <b-table
        id="usuaris-table"
        :fields="fields"
        :items="usuaris"
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
        aria-controls="usuaris-table"
      ></b-pagination>
    </div>

    <b-modal hide-footer hide-header centered size="lg" ref="alertant-modal">
      <div class="cepsem-modal alertant-modal">
        <h2 class="mb-4">USUARIS</h2>
        <form>
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="username">Usuari</label>
                  <input
                    type="text"
                    name="username"
                    id="username"
                    placeholder="Introdueix el usuari de l'usuari..."
                    v-model="usuari.username"
                    autofocus
                  />
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="contrasenya">Contrasenya</label>
                  <input
                    type="password"
                    name="contrasenya"
                    id="contrasenya"
                    v-model="usuari.contrasenya"
                    placeholder="Introdueix la contrasenya de l'usuari..."
                  />
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="email">Email</label>
                  <input
                    type="text"
                    name="email"
                    id="email"
                    v-model="usuari.email"
                    placeholder="Introdueix el email de l'usuari..."
                  />
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="nom">Nom</label>
                  <input
                    type="text"
                    name="nom"
                    id="nom"
                    v-model="usuari.nom"
                    placeholder="Introdueix el nom de l'usuari..."
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
                    v-model="usuari.cognoms"
                    placeholder="Introdueix els cognoms de l'usuari..."
                  />
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="rol">Rol</label>
                  <b-form-select
                    name="rol"
                    id="rol"
                    v-model="usuari.rols_id"
                    class="select"
                    value-field="id"
                    text-field="nom"
                    :options="rols"
                  ></b-form-select>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="input input--col mb-4">
                  <label for="recurs">Recurs</label>
                  <b-form-select
                    name="recurs"
                    id="recurs"
                    v-model="usuari.recursos_id"
                    class="select"
                    value-field="id"
                    text-field="codi"
                    :options="recursos"
                  ></b-form-select>
                </div>
              </div>
            </div>

            <div
              v-show="errors.length"
              class="input-error input-error--show"
              style="margin-bottom: 0"
            >
              <img
                src="/cepsem/webapp/cepsem/public/assets/icons/alert.svg"
                alt=""
                width="18px"
                height="18px"
                style="margin-bottom: auto"
              />
              <div style="display: flex; flex-direction: column">
                <span>Petició invàlida, corregeix els següents errors:</span>
                <ul>
                  <li v-for="(error, index) in errors" :key="index">
                    {{ error }}
                  </li>
                </ul>
              </div>
            </div>

            <div class="cepsem-modal-footer">
              <button
                class="button button-icon button--rounded button--blue"
                type="button"
                style="background-image: url('../assets/icons/check.svg')"
                @click="checkNotNull"
              >
                Afegir
              </button>
              <button
                class="button button-icon button--rounded button-inverted button-inverted--red ml-2 mt-3"
                block
                @click="hideModal"
                type="button"
              >
                Cancel·lar
              </button>
            </div>
          </div>
        </form>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: {
    recursos: {
      type: Array,
      required: false,
    },

    rols: {
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
      usuaris: [],
      usuari: {
        id: "",
        username: "",
        contrasenya: "",
        email: "",
        nom: "",
        cognoms: "",
        rols_id: "",
        recursos_id: "",
      },
      fields: [
        { key: "id", label: "ID", sortable: true },
        { key: "username", label: "Usuari", sortable: true },
        { key: "contrasenya", label: "Contrasenya", sortable: true },
        { key: "email", label: "Email", sortable: true },
        { key: "nom", label: "Nom", sortable: true },
        { key: "cognoms", label: "Cognoms", sortable: true },
        { key: "rol.nom", label: "Rol", sortable: true },
        { key: "recurs.codi", label: "Recurs", sortable: true },
      ],
      loading: true,
      loadingStatus: "Carregant les dades...",
      errors: [],
    };
  },
  created() {
    this.selectUsuaris();

  },
  mounted() {
    console.log("Usuari component mounted.");
  },
  methods: {
    //   SELECT - GET   //
    selectUsuaris() {
      let me = this;

      axios
        .get("/usuaris")
        .then((response) => {
          me.usuaris = response.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
          this.loadingStatus = error;
        });
    },

    //   INSERT - POST   //
    insertUsuari() {
      let me = this;

      axios
        .post("/usuaris", me.usuari)
        .then((response) => {
          console.log(response);

          if (response.status == 201) {
            me.selectUsuaris();
            me.emptyUsuari();
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
     * Funció que fa control d'errors i redirecciona a la funcio insertUsuari() en cas d'OK
     */
    checkNotNull() {
      this.errors = [];

      if (!this.usuari.username) {
        this.checkIfExistsError("El camp usuari és obligatori.");
      }

      if (!this.usuari.contrasenya) {
        this.checkIfExistsError("El camp contrasenya és obligatori.");
      }

      if (!this.usuari.email) {
        this.checkIfExistsError("El camp email és obligatori.");
      }

      if (!this.usuari.nom) {
        this.checkIfExistsError("El camp nom és obligatori.");
      }

      if (!this.usuari.cognoms) {
        this.checkIfExistsError("El camp cognoms és obligatori.");
      }

      if (!this.usuari.rols_id) {
        this.checkIfExistsError("El camp rol és obligatori.");
      }

      //
      if (this.errors.length == 0) {
        this.insertUsuari();
      }
    },

    /**
     * Funció que rep un missatge d'error per paràmetre, si no existeix a la llista d'errors l'afegirà
     *
     * @param {String} errorMessage
     */
    checkIfExistsError(errorMessage) {
      if (!this.errors.includes(errorMessage)) {
        this.errors.push(errorMessage);
      }
    },

    /**
     * Funció per a buidar els camps del objecte usuari (associat al formulari amb v-model)
     */
    emptyUsuari() {
        this.usuari.id = '',
        this.usuari.username = '';
        this.usuari.contrasenya = '';
        this.usuari.email = '';
        this.usuari.nom = '';
        this.usuari.cognoms = '';
        this.usuari.rols_id = '';
        this.usuari.recursos_id = '';
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
      return this.usuaris.length;
    },
  },
};
</script>
