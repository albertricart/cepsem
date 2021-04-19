<template>
  <div>
    <h1 class="page-title">Recurs Mobil</h1>



    <div v-if="loading" class="table-loading">
      <p>{{ loadingStatus }}</p>
      <div class="progress-line"></div>
    </div>

    <div v-else>

      <b-table
        id="recursMobil-table"
        :fields="fields"
        :items="recursMobil"
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
      <template #cell(Editar)>
            <svg @click="editRecursMobil" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#11AEBF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
        </template>
      </b-table>

      <b-pagination
        class="mt-5"
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        aria-controls="recursMobil-table"
      ></b-pagination>

    </div>



    <b-modal hide-footer hide-header centered size="lg" ref="delete-modal">
      <div class="cepsem-modal">
        <div class="modal-header">
          <h2>ESBORRAR</h2>
        </div>

        <div class="modal-body">
          <p>Estàs segur que vols esborrar els següents recurs mobil?</p>
          <ul>
            <li v-for="(recursMobil, index) in selected" :key="index">
              {{ recursMobil.id + " " }}
              <span v-if="recursMobil.nom">{{ recursMobil.nom }}</span>
              <span v-if="recursMobil.cognoms">{{ recursMobil.cognoms }}</span>
            </li>
          </ul>
        </div>

        <div class="cepsem-modal-footer">
          <button
            class="button button-icon button--rounded button--blue"
            type="button"
            style="background-image: url('../assets/icons/check.svg')"
            @click="deleteRecursMobil"
          >
            Eliminar
          </button>
          <button
            class="button button-icon button--rounded button-inverted button-inverted--red ml-2 mt-3"
            block
            @click="hideModal('delete-modal')"
            type="button"
          >
            Cancel·lar
          </button>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: {
    incidencia: {
      type: Array,
      required: false,
    },

    recurs: {
      type: Array,
      required: false,
    },

    afectat: {
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
      recursosMobil: [],
      editClick: false,
      insert: false,
      recursMobil: {
        id: "",
        nom: "",
        cognoms: "",
        edat: "",
        tipusAcident: "",
        direccio: "",

      },
      fields: [
        { key: "incidencia.id", label: "ID", sortable: true },
        { key: "afectat.nom", label: "Nom", sortable: true },
        { key: "afectat.cognom", label: "Cognom", sortable: true },
        { key: "afectat.edat", label: "Edat", sortable: true },
        { key: "incidencies.tipus_incidencies_id", label: "Tipus Incidencia", sortable: true },
        { key: "incidencies.adreca", label: "Adreça", sortable: true },
      ],
      loading: true,
      loadingStatus: "Carregant les dades...",
      errors: [],
      selected: [],
    };
  },
  created() {
    this.selectRecursMobil();

  },
  mounted() {
    console.log("Recurs mobil component mounted.");
  },
  methods: {
    //   SELECT - GET   //
    selectRecursMobil() {
      let me = this;

      axios
        .get("/recursMobil")
        .then((response) => {
          me.recursosMobil = response.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
          this.loadingStatus = error;
        });
    },

    //   INSERT - POST   //
    insertRecursMobil() {
      let me = this;

      axios
        .post("/recursMobil", me.recursMobil)
        .then((response) => {
          console.log(response);

          if (response.status == 201) {
            me.selectRecursMobil();
            me.emptyRecursMobil();
            me.errors = [];
            me.hideModal("recursMobil-modal");
          }
        })
        .catch((error) => {
          console.log(error.response);
          console.log(error.response.data.errorMessage);
        });
    },
    updateRecursMobil(){
        let me = this;

      axios
        .put("/recursMobil/" + me.recursMobil.id, me.recursMobil)
        .then((response) => {
          console.log(response);

          if (response.status == 204) {
            me.selectRecursMobil();
            me.emptyRecursMobil();
            me.errors = [];
            me.hideModal("recursMobil-modal");
          }
        })
        .catch((error) => {
          console.log(error.response);
          console.log(error.response.data.errorMessage);
        });
    },
    //   DELETE   //
    deleteRecursMobil() {
      let me = this;

      me.selected.forEach((recursMobil) => {
        axios
          .delete("/recursMobil/" + recursMobil.id)
          .then((response) => {
            console.log(response);
            me.selectRecursMobil();
            me.hideModal("delete-modal");
          })
          .catch((error) => {
            console.log(error.response);
            console.log(error.response.data.errorMessage);
          });
      });
    },
    afegirRecursMobil() {
      this.insert = true;
      this.emptyRecursMobil();
      this.selectRecursMobil();
      this.showModal("recursMobil-modal");
    },
    editRecursMobil(){
        this.editClick = true;

      if (this.insert) {
        this.insert = false;
      }
    },
    onRowSelected(items) {
      if (this.editClick) {
        this.getLastSelected(this.selected, items);
        this.showModal("recursMobil-modal");
        this.editClick = false;
      }

      this.selected = items;
    },
    editButtonClick(){
        this.editClick = true;
    },
    getLastSelected(oldarray, newarray) {
      let found = false;
      let inarray = false;
      let i = 0,
        j = 0;
      //   debugger;

      while (!found && i < newarray.length) {
        j = 0;
        inarray = false;

        while (!inarray && j < oldarray.length) {
          if (oldarray[j].id == newarray[i].id) {
            inarray = true;
          }
          j++;
        }

        if (!inarray) {
          this.recursMobil = newarray[i];
          found = true;
        }

        i++;
      }
    },
    selectAllRows() {
      this.$refs.selectableTable.selectAllRows();
    },
    clearSelected() {
      this.$refs.selectableTable.clearSelected();
    },
    //   UTILS   //

    /**
     * Funció que fa control d'errors i redirecciona a la funcio insertUsuari() en cas d'OK
     */
    /* checkNotNull() {
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
        if (this.insert) {
          this.insertUsuari();
        } else {
          this.updateUsuari();
        }
      }
    }, */

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
      return this.recursMobil.length;
    },
  },
};
</script>
