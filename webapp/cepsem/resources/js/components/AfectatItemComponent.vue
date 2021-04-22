<template>
  <div class="col-lg-6 col-xl-4 mb-5">
    <div class="afectat-item">
      <h3 class="mb-4">Afectat</h3>

      <input type="checkbox" name="notecip" id="notecip" />
      <label for="notecip">No té CIP*</label>

      <div class="mb-4">
        <div class="input input--col mb-2">
          <label for="cip">CIP</label>
          <input
            type="text"
            name="cip"
            id="cip"
            placeholder="Introdueix el CIP de l'afectat..."
            v-model="afectat.cip"
          />
        </div>

        <div style="text-align: end">
          <button
            class="button button--blue"
            style="padding-top: 8px; padding-bottom: 8px"
          >
            CARREGAR DADES
          </button>
        </div>
      </div>

      <div class="input input--col mb-4">
        <label for="telefon">Telèfon*</label>
        <input
          type="text"
          name="telefon"
          id="telefon"
          placeholder="Introdueix el telefon de l'afectat..."
          v-model="afectat.telefon"
        />
      </div>

      <div class="input input--col mb-4">
        <label for="nom">Nom</label>
        <input
          type="text"
          name="nom"
          id="nom"
          placeholder="Introdueix el nom de l'afectat..."
          v-model="afectat.nom"
        />
      </div>

      <div class="input input--col mb-4">
        <label for="cognoms">Cognoms</label>
        <input
          type="text"
          name="cognoms"
          id="cognoms"
          placeholder="Introdueix els cognoms de l'afectat..."
          v-model="afectat.cognoms"
        />
      </div>

      <div class="input input--col mb-4">
        <label for="edat">Edat</label>
        <input
          type="number"
          name="edat"
          id="edat"
          placeholder="Introdueix l'edat de l'afectat..."
          v-model="afectat.edat"
        />
      </div>
<!--
      <div class="input input--col mb-4">
        <label for="sexe">Sexe</label>
        <b-form-select
          name="sexe"
          id="sexe"
          v-model="alertant.sexes_id"
          class="select"
          value-field="id"
          text-field="sexe"
          :options="sexes"
        ></b-form-select>
      </div> -->

      <!-- <div class="input input--col mb-4">
        <label for="adreca">Sexe</label>
        <input
          type="text"
          name="telefon"
          id="telefon"
          placeholder="Introdueix el telefon de l'afectat..."
        />
      </div> -->

      <div class="mt-5" style="text-align: center">
        <button
          class="button button-icon button--rounded button-inverted button-inverted--red removeAfectat"
        >
          Eliminar afectat
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    editafectat: {
      type: Object,
      required: false,
    },

    sexes:{
        type: Array,
        required: false,
    }
  },
  data() {
    return {
      afectat: {
        id: 0,
        telefon: "",
        cip: "",
        nom: "",
        cognoms: "",
        edat: 0,
        te_cip: 0,
        sexes_id: 0,
        saveAfectat: false,
      },
    };
  },
  created() {
    this.afectat = this.editafectat;
  },
  mounted() {
    console.log("Afectat " + this.afectat.cip + " component mounted.");
  },
  methods: {},
  computed: {},
};
</script>
