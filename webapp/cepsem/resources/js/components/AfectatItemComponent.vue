<template>
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
      <label for="adreca">Adreça</label>
      <input
        type="text"
        name="adreca"
        id="adreca"
        placeholder="Introdueix l'adreça de l'alertant..."
      />
    </div>

    <div class="input input--col mb-4">
      <label for="adreca">Adreça</label>
      <input
        type="text"
        name="adreca"
        id="adreca"
        placeholder="Introdueix l'adreça de l'alertant..."
      />
    </div>

    <div class="input input--col mb-4">
      <label for="adreca">Adreça</label>
      <input
        type="text"
        name="adreca"
        id="adreca"
        placeholder="Introdueix l'adreça de l'alertant..."
      />
    </div>

    <div class="input input--col mb-4">
      <label for="adreca">Adreça</label>
      <input
        type="text"
        name="adreca"
        id="adreca"
        placeholder="Introdueix l'adreça de l'alertant..."
      />
    </div>

    <div class="mt-5" style="text-align: center">
      <button
        class="button button-icon button--rounded button-inverted button-inverted--red removeAfectat"
      >
        Eliminar afectat
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
      editAfectat:{
          type: Object,
          required: false
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
      this.editAfectat = this.afectat;
  },
  mounted() {
    console.log("Afectat component mounted.");
  },
  methods: {},
  computed: {

  },
};
</script>
