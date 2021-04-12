<template>
  <div>
    <h1 class="page-title">RECURSOS</h1>

    <div class="d-flex justify-content-end mb-4">
      <button
        class="button button-icon button--pink"
        style="background-image: url('../assets/icons/add.svg')"
        id="show-btn"
        @click="showModal"
      >
        AFEGEIX UN NOU RECURS
      </button>
    </div>

    <div v-if="loading" class="table-loading">
      <p>{{ loadingStatus }}</p>
      <div class="progress-line"></div>
    </div>

    <div v-else>
        <div class="row">
            <div>
                <input type="checkbox" id="selectAll" @click="selectAllRows">
                <label for="">Selecionar tot</label>
            </div>

            <!-- <button size="sm" @click="selectAllRows">Select all</button>
            <button size="sm" @click="clearSelected">Clear selected</button> -->
        </div>
      <b-table
        id="recursos-table"
        :fields="fields"
        :items="recursos"
        :per-page="perPage"
        :current-page="currentPage"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        ref="selectableTable"
        sort-icon-left
        selectable
        large
        hover
        @row-selected="onRowSelected"
      >
      <template #cell(selected)="{ rowSelected }">
        <template v-if="rowSelected">
          <span aria-hidden="true">&check;</span>
          <span class="sr-only">Selected</span>
        </template>
        <template v-else>
          <span aria-hidden="true">&nbsp;</span>
          <span class="sr-only">Not selected</span>
        </template>
      </template>
      </b-table>

      <b-pagination
        class="mt-5"
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        aria-controls="recursos-table"
      ></b-pagination>

    </div>

    <b-modal hide-footer hide-header centered size="md" ref="recurs-modal">
      <div class="cepsem-modal">
        <h2 class="mb-4">RECURS</h2>
        <form>
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="input input--col mb-4">
                  <label for="codi">Codi</label>
                  <input
                    type="text"
                    name="codi"
                    id="codi"
                    placeholder="Introdueix el codi..."
                    v-model="recurs.codi"
                    autofocus
                  />
                </div>
              </div>

              <div class="col-lg-12">
                <div class="input input--col mb-4">
                  <label for="rol">Tipus</label>
                  <b-form-select
                    name="tipus"
                    id="tipus"
                    v-model="recurs.tipus_recursos_id"
                    class="select"
                    value-field="id"
                    text-field="tipus"
                    :options="tipusrecursos"
                  ></b-form-select>
                </div>
              </div>

              <div class="col-lg-6" >
                <div class="input input--col mb-4">
                 <label class="col-form-check-label" for="actiu">Actiu</label>
                        <input
                        class="form-check-input"
                        type="checkbox"
                        id="actiu"
                        name="actiu"
                        v-model="recurs.actiu"
                        value="actiu">
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
          </div>
        </form>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: {
    tipusrecursos: {
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
      recursos: [],
      recurs: {
        id: "",
        codi: "",
        actiu: false,
        tipus_recursos_id: "",
      },
      fields: [
          "selected",
        { key: "id", label: "ID", sortable: true },
        { key: "codi", label: "Codi", sortable: true },
        { key: "tipus_recurs.tipus", label: "Tipus", sortable: true },
        { key: "actiu", label: "Actiu", sortable: true },
      ],
      loading: true,
      loadingStatus: "Carregant les dades...",
      errors: [],
      selected: [],
    };
  },
  created() {
    this.selectRecursos();

  },
  mounted() {
    console.log("Recurs component mounted.");
  },
  methods: {
    //   SELECT - GET   //
    selectRecursos() {
      let me = this;

      axios
        .get("/recursos")
        .then((response) => {
          me.recursos = response.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
          this.loadingStatus = error;
        });
    },

    //   INSERT - POST   //
    insertRecurs() {
      let me = this;

      axios
        .post("/recursos", me.recurs)
        .then((response) => {
          console.log(response);

          if (response.status == 201) {
            me.selectRecursos();
            me.emptyRecursosi();
            me.errors = [];
            me.hideModal();
          }
        })
        .catch((error) => {
          console.log(error.response);
          console.log(error.response.data.errorMessage);
        });
    },
    onRowSelected(items) {
        this.selected = items
      },
    selectAllRows() {
        if (document.getElementById("selectAll").checked) {
            this.$refs.selectableTable.selectAllRows()
        } else {
            this.$refs.selectableTable.clearSelected()
        }

      },
    clearSelected() {

      },

    //   UTILS   //

    /**
     * Funció que fa control d'errors i redirecciona a la funcio insertUsuari() en cas d'OK
     */
    checkNotNull() {
      this.errors = [];

      if (!this.recurs.codi) {
        this.checkIfExistsError("El camp codi és obligatori.");
      }

      if (!this.recurs.tipus_recursos_id) {
        this.checkIfExistsError("El camp tipus és obligatori.");
      }


      //
      if (this.errors.length == 0) {
        this.insertRecurs();
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
     * Funció per a buidar els camps del objecte recurs (associat al formulari amb v-model)
     */
    emptyRecurs() {
        this.recurs.id = '',
        this.recurs.codi = '';
        this.recurs.tipus_recursos_id = '';
        this.recurs.actiu = false;
    },

    //   MODALS   //
    showModal() {
      this.$refs["recurs-modal"].show();
    },
    hideModal() {
      this.$refs["recurs-modal"].hide();
    },
  },
  computed: {
    rows() {
      return this.recursos.length;
    },
  },
};
</script>
