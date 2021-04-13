<template>
  <div>
    <h1 class="page-title">ALERTANTS</h1>

    <div class="d-flex justify-content-end mb-4">
      <button
        class="button button-icon button--pink"
        style="background-image: url('../assets/icons/add.svg')"
        id="show-btn"
        @click="nouAlertant"
      >
        AFEGEIX UN NOU ALERTANT
      </button>
    </div>

    <div v-if="loading" class="table-loading">
      <p>{{ loadingStatus }}</p>
      <div class="progress-line"></div>
    </div>

    <div v-else>
      <div class="row">
        <div class="table-header">
          <div>
            <button size="sm" @click="selectAllRows">Select all</button>
            <button size="sm" class="ml-2" @click="clearSelected">
              Clear selected
            </button>
          </div>

          <button class="button button-icon" @click="showModal('delete-modal')">
            ELIMINAR ({{ selected.length }})
          </button>
        </div>
      </div>

      <b-table
        id="alertants-table"
        :fields="fields"
        :items="alertants"
        :per-page="perPage"
        :current-page="currentPage"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        sort-icon-left
        ref="selectableTable"
        selectable
        @row-selected="onRowSelected"
        large
        hover
      >
        <template #cell(Seleccionat)="{ rowSelected }">
          <template v-if="rowSelected">
            <span aria-hidden="true">&check;</span>
            <span class="sr-only">Selected</span>
          </template>
          <template v-else>
            <span aria-hidden="true">&nbsp;</span>
            <span class="sr-only">Not selected</span>
          </template>
        </template>

        <template #cell(Editar)>
          <svg
            @click="editButtonClick()"
            xmlns="http://www.w3.org/2000/svg"
            height="24px"
            viewBox="0 0 24 24"
            width="24px"
            fill="#11AEBF"
          >
            <path d="M0 0h24v24H0V0z" fill="none" />
            <path
              d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"
            />
          </svg>
        </template>
      </b-table>

      <b-pagination
        class="mt-5"
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        aria-controls="incidencies-table"
      ></b-pagination>

    </div>
  </div>
</template>

<script>
export default {
  props: {

  },
  data() {
    return {
      sortBy: "id",
      sortDesc: false,
      perPage: 10,
      currentPage: 1,
      alertants: [],
      editClick: false,
      insert: false,
      alertant: {
        id: "",
        telefon: "",
        nom: "",
        cognoms: "",
        adreca: "",
        tipus_alertants_id: "",
        municipis_id: "",
      },
      fields: [
        "Seleccionat",
        { key: "id", label: "ID", sortable: true },
        { key: "telefon", label: "Telèfon", sortable: true },
        { key: "nom", label: "Nom", sortable: true },
        { key: "cognoms", label: "Cognoms", sortable: true },
        { key: "adreca", label: "Adreça", sortable: true },
        { key: "municipi.nom", label: "Municipi", sortable: true },
        { key: "tipus_alertant.tipus", label: "Tipus", sortable: true },
        "Editar",
      ],
      loading: true,
      loadingStatus: "Carregant les dades...",
      errors: [],
      selected: [],
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
    selectAlertants() {
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
    insertAlertant() {
      let me = this;

      axios
        .post("/alertants", me.alertant)
        .then((response) => {
          console.log(response);

          if (response.status == 201) {
            me.selectAlertants();
            me.emptyAlertant();
            me.errors = [];
            me.hideModal("alertant-modal");
          }
        })
        .catch((error) => {
          console.log(error.response);
          console.log(error.response.data.errorMessage);
        });
    },

    //   UPDATE - PUT   //
    updateAlertant() {
      let me = this;

      axios
        .put("/alertants/" + me.alertant.id, me.cicle)
        .then((response) => {
          console.log(response);
          me.selectAlertants();
          me.hideModal("delete-modal");
        })
        .catch((error) => {
          console.log(error.response);
          console.log(error.response.data.errorMessage);
        });
    },

    //   DELETE   //
    deleteAlertants() {
      let me = this;

      me.selected.forEach((alertant) => {
        axios
          .delete("/alertants/" + alertant.id)
          .then((response) => {
            console.log(response);
            me.selectAlertants();
            me.hideModal("delete-modal");
          })
          .catch((error) => {
            console.log(error.response);
            console.log(error.response.data.errorMessage);
          });
      });
    },

    //   UTILS   //
    /**
     * Funció que fa control d'errors i redirecciona a la funcio insertAlertant() o updateAlertant() en cas d'OK
     */
    checkNotNull() {
      this.errors = [];

      if (this.alertant.telefon) {
        if (this.alertant.telefon.length != 9) {
          this.checkIfExistsError("El camp telèfon ha d'incloure 9 números");
        }
      } else {
        this.checkIfExistsError("El camp telèfon és obligatori.");
      }

      if (!this.alertant.tipus_alertants_id) {
        this.checkIfExistsError("El camp tipus és obligatori.");
      }

      if (this.errors.length == 0) {
        if (this.insert) {
          this.insertAlertant();
        } else {
          this.updateAlertant();
        }
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
     * Funció per a buidar els camps del objecte alertant (associat al formulari amb v-model)
     */
    emptyAlertant() {
      this.alertant.id = "";
      this.alertant.nom = "";
      this.alertant.cognoms = "";
      this.alertant.telefon = "";
      this.alertant.adreca = "";
      this.alertant.municipis_id = "";
      this.alertant.tipus_alertants_id = "";
    },

    editButtonClick() {
      this.editClick = true;
    },

    editAlertant() {
      this.showModal("alertant-modal");
      this.clearSelected();
    },

    nouAlertant() {
      this.emptyAlertant();
      this.insert = true;
      this.showModal("alertant-modal");
    },

    /**
     * Funció que recupera l'últim alertant seleccionat
     *
     * @param {Array} oldarray Array que conté els alertants seleccionats excepte l'últim que s'acaba de seleccionar
     * @param {Array} newarray Array que conté els alertants seleccionats amb l'últim que s'acaba de seleccionar
     */
    getLastSelected(oldarray, newarray) {
      let exists = false;
      let i = 0,
        j = 0;

      while (exists && i < newarray.length) {
        while (exists && j < oldarray.length) {
          if (olditem.id == newarray[i].id) {
            exists = true;
          }
          j++;
        }

        if (!exists) {
          this.alertant = newarray[i];
        }

        i++;
      }
    },

    //   TABLE   //
    onRowSelected(items) {
      if (this.editClick) {
        if (items.length == 1) {
          this.alertant = items[0];
        } else {
          this.getLastSelected(this.selected, items);
        }

        this.editAlertant();
        this.editClick = false;
      }

      this.selected = items;
    },

    selectAllRows() {
      this.$refs.selectableTable.selectAllRows();
    },
    clearSelected() {
      this.$refs.selectableTable.clearSelected();
    },

    //   MODALS   //
    showModal(modal) {
      this.$refs[modal].show();
    },
    hideModal(modal) {
      this.$refs[modal].hide();
    },
  },
  computed: {
    rows() {
      return this.alertants.length;
    },
  },
};
</script>
