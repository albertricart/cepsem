<template>
  <div class="container">
    <h1 class="page-title">ALERTANTS</h1>

    <div class="d-flex justify-content-end">
      <button
        v-show="afegir"
        class="button button-icon button--pink"
        style="background-image: url('../assets/icons/add.svg')"
      >
        AFEGEIX UN NOU ALERTANT
      </button>
    </div>

    <div class="table-responsive py-4">
      <table class="table table-hover">
        <thead>
          <tr class="table-danger">
            <th scope="col" v-for="(camp, index) in camps" :key="index">
              {{ camp }}
            </th>
          </tr>
        </thead>

        <div v-show="loading" class="table-loading">
          <p>{{ error }}</p>
          <div class="progress-line"></div>
        </div>

        <tbody>
          <tr class="table-info py-5" v-for="(alertant, index) in alertants" :key="index">
            <td>{{ alertant.id }}</td>
            <td>{{ alertant.telefon }}</td>
            <td>{{ alertant.nom }}</td>
            <td>{{ alertant.cognoms }}</td>
            <td>{{ alertant.adreca }}</td>
            <td>{{ alertant.municipi.nom }}</td>
            <td>{{ alertant.tipus_alertant.tipus }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    camps: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      alertants: [],
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
  computed: {},
};
</script>
