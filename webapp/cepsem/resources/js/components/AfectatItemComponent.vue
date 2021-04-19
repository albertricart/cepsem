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

      <div style="text-align:end;">
          <button class="button button--blue" style="padding-top: 8px; padding-bottom: 8px;">CARREGAR DADES</button>
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
        class="button button-icon button--rounded button-inverted button-inverted--red"
        style="
          background-image: url('/cepsem/webapp/cepsem/public/assets/icons/deleteUser.svg');
        "
      >
        Eliminar afectat
      </button>
    </div>
  </div>

</template>

<script>
export default {
  props: {},
  data() {
    return {};
  },
  created() {},
  mounted() {
    console.log("Afectat component mounted.");
  },
  methods: {},
  computed: {},
};
</script>
