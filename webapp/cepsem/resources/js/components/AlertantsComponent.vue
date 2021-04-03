<template>
  <div class="container-fluid my-5">
    <h1 class="page-title">Alertants</h1>

    <div class="d-flex justify-content-end">
      <a
        href=""
        class="button button-icon button--pink"

      >
        AFEGEIX UN NOU ALERTANT</a
      >
    </div>

    <div class="table-responsive py-4">
      <table class="table table-hover">
        <thead>
          <tr class="table-danger">
            <th scope="col">id (proves)</th>
            <th scope="col">Telèfon</th>
            <th scope="col">Nom</th>
            <th scope="col">Cognom</th>
            <th scope="col">Adreça</th>
            <th scope="col">Municipi</th>
            <th scope="col">Tipus</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="table-info py-5"
            v-for="alertant in alertants"
            :key="alertant.id"
          >
            <th scope="row">{{ alertant.id }}</th>
            <td>{{ alertant.telefon }}</td>
            <td>{{ alertant.nom }}</td>
            <td>{{ alertant.cognoms }}</td>
            <td>{{ alertant.adreca }}</td>
            <td>{{ alertant.municipi }}</td>
            <td>{{ alertant.tipus }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
      return {
          alertants: []
      }
  },
  created(){
      let me = this;

      axios
      .get('/alertants')
      .then(response => {
          me.alertants = response.data;
      })
      .catch(error => {
          console.log(error);
      })
      .finally(() => this.loading = false)

  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
