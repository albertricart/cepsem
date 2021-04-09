<template>
  <div>
    <h1 class="page-title">ALERTANTS</h1>

    <div class="d-flex justify-content-end mb-4">
      <button
        class="button button-icon button--pink"
        style="background-image: url('../assets/icons/add.svg')">
        AFEGEIX UN NOU ALERTANT
      </button>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      sortBy: "id",
      sortDesc: false,
      perPage: 10,
      currentPage: 1,
      alertants: [],
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
  computed: {
    rows() {
      return this.alertants.length;
    },
  },
};
</script>
