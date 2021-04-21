<template>
  <div class="recurs-item">
    <h3 class="mb-4">Recurs mòbil</h3>

    <div class="row">
      <div class="col-lg-4">
        <div class="input input--col mb-4">
          <label for="tipusrecurs">Tipus recurs Mòbil</label>
          <b-form-select
            name="tipusrecurs"
            id="tipusrecurs"
            class="select"
            value-field="id"
            text-field="tipus"
            :options="tipusrecurs"
          ></b-form-select>
        </div>
        <div class="input input--col mb-4">
          <label for="prioritat">Prioritat</label>
          <b-form-select
            name="prioritat"
            id="prioritat"
            class="select"
            value-field="id"
            text-field="tipus"
            :options="prioritat"
          ></b-form-select>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="input input--col mb-2">
          <label for="horaActi">Hora d'activació</label>
          <input
            type="text"
            name="horaActi"
            id="horaActi"
            placeholder="Introdueix l'hora d'activació..."
          />
        </div>
        <input type="checkbox" name="trasllat" id="trasllat" />
        <label for="trasllat">Trasllat Hospitalari</label>
      </div>
      <div class="col-lg-4">
        <div class="mt-5" style="text-align: center">
          <button
            class="button button-icon button--rounded button-inverted button-inverted--red"
            style="background-image: url('/cepsem/webapp/cepsem/public/assets/icons/deleteUser.svg');"
          >
            Eliminar recurs
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="input input--col mb-4">
          <label for="desti">Destí Hospitalari</label>
          <b-form-select
            name="desti"
            id="desti"
            class="select"
            value-field="id"
            text-field="tipus"
            :options="desti"
          ></b-form-select>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="input input--col mb-2">
          <label for="horatransport">Hora de Transport</label>
          <input
            type="text"
            name="horatransport"
            id="horatransport"
            placeholder="Introdueix l'hora de transport..."/>
        </div>
        <div class="input input--col mb-2">
          <label for="horatransferencia">Hora de Transferència</label>
          <input
            type="text"
            name="horatransferencia"
            id="horatransferencia"
            placeholder="Introdueix l'hora de transferencia..."
          />
        </div>
      </div>
      <div class="col-lg-4">
        <div class="input input--col mb-2">
          <label for="horahospital">Hora d'arribada a l'hospital</label>
          <input
            type="text"
            name="horahospital"
            id="horahospital"
            placeholder="Introdueix l'hora d'arribada a l'hospital..."/>
        </div>
        <div class="input input--col mb-2">
          <label for="horafinal">Hora de Finalització</label>
          <input
            type="text"
            name="horafinal"
            id="horafinal"
            placeholder="Introdueix l'hora de finalització..."
          />
        </div>
      </div>
      <div class="incidencia-form-footer">
          <button
            class="button button-icon button--pink button--rounded"
            style="
              background-image: url('/cepsem/webapp/cepsem/public/assets/icons/next.svg');
            "
          >
            Finalitzar
          </button>
        </div>
    </div>




  </div>
</template>

<script>
export default {
  data() {
    return {
      fields: ["selected", "isActive", "age", "first_name", "last_name"],
      items: [
        {
          isActive: true,
          age: 40,
          first_name: "Dickerson",
          last_name: "Macdonald",
        },
        { isActive: false, age: 21, first_name: "Larsen", last_name: "Shaw" },
        { isActive: false, age: 89, first_name: "Geneva", last_name: "Wilson" },
        { isActive: true, age: 38, first_name: "Jami", last_name: "Carney" },
      ],
      selected: [],
    };
  },
  methods: {
    onRowSelected(items) {
      this.selected = items;
    },
    selectAllRows() {
      this.$refs.selectableTable.selectAllRows();
    },
    clearSelected() {
      this.$refs.selectableTable.clearSelected();
    },
  },
};
</script>
