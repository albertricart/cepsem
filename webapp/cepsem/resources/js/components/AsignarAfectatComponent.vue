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
            :options="tipusrecursos"
          ></b-form-select>
        </div>
        <div class="input input--col mb-4">
          <label for="prioritat">Prioritat</label>
          <b-form-select
            name="prioritat"
            id="prioritat"
            class="select"
            :options="prioritats"
          ></b-form-select>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="input input--col mb-2">
          <label for="horaActi" >Hora d'activació</label>
          <input type="time" name="horaActi" id="horaActi" v-model="hora" />
        </div>
        <input
          type="checkbox"
          name="trasllat"
          id="trasllat"
          v-model="trasllat"
          style="margin-top:65px"
        />
        <label for="trasllat">Trasllat Hospitalari</label>
      </div>
      <div class="col-lg-4">
        <div class="mt-5" style="text-align: center">
          <button
            class="button button-icon button--rounded button-inverted button-inverted--red"
            style="
              background-image: url('/cepsem/webapp/cepsem/public/assets/icons/deleteUser.svg');
            "
          >
            Eliminar recurs
          </button>
        </div>
      </div>
    </div>
    <div class="row" v-if="trasllat">
      <div class="col-lg-4">
        <div class="input input--col mb-4">
          <label for="desti">Destí Hospitalari</label>
          <input
            type="text"
            name="desti"
            id="desti"
            placeholder="Introdueix lloc de destí..."
          />
        </div>
      </div>
      <div class="col-lg-4">
        <div class="input input--col mb-2">
          <label for="horatransport">Hora de Transport</label>
          <input
            type="time"
            name="horatransport"
            id="horatransport"
            placeholder="Introdueix l'hora de transport..."
          />
        </div>
        <div class="input input--col mb-2">
          <label for="horatransferencia">Hora de Transferència</label>
          <input
            type="time"
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
            type="time"
            name="horahospital"
            id="horahospital"
            placeholder="Introdueix l'hora d'arribada a l'hospital..."
          />
        </div>
        <div class="input input--col mb-2">
          <label for="horafinal">Hora de Finalització</label>
          <input
            type="time"
            name="horafinal"
            id="horafinal"
            placeholder="Introdueix l'hora de finalització..."
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    editrecurs: {
      type: Object,
      required: false,
    },
    tipusrecursos: {
      type: Array,
      required: false,
    },
    prioritat: {
      type: Array,
      required: false,
    },
  },
  data() {
    return {
      trasllat: false,
      prioritats: [1, 2, 3, 4, 5],
      hora: this.getTime(),
    };
  },
  created() {
    this.recurs = this.editrecurs;
  },
  mounted() {},
  methods: {
    getTime() {
        var today = new Date();

        var hour = today.getHours(),
          min = today.getMinutes();

        hour = (hour < 10 ? "0" : "") + hour;
        min = (min < 10 ? "0" : "") + min;

        var time = hour + ":" + min;

        setTimeout(this.getTime, 5000);
        this.hora = time;
    },
  },
  computed: {},
};
</script>
