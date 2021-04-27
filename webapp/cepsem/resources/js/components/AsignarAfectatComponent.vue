<template>

  <div class="recurs-item mb-4">
    <h3 class="mb-4">RECURS MÒBIL</h3>


    <div class="row">
        <div class="col-lg-12 mb-3">
            <h3 class="section-title">
                <img
                src="/cepsem/webapp/cepsem/public/assets/icons/person.svg"
                alt=""
                class="mr-3"
                />
                <span v-if="afectat.nom">{{ afectat.nom + " -"}}&nbsp;</span>
                <span v-if="afectat.sexes_id == 1">Home,&nbsp;</span>
                <span v-else>Dona, </span>
                <span v-if="afectat.edat">{{" " + afectat.edat + " anys"}}</span>
            </h3>
        </div>
      <div class="col-lg-6">
        <div class="input input--col mb-4">
          <label for="tipusrecurs">Tipus recurs Mòbil</label>
          <b-form-select
            name="tipusrecurs"
            id="tipusrecurs"
            v-model="recurs.recursos_id"
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
            v-model="recurs.prioritat"
            :options="prioritats"
          ></b-form-select>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="input input--col mb-2">
          <label for="horaActi" >Hora d'activació</label>
          <input type="time" name="horaActi" id="horaActi" v-model="recurs.hora_activacio" />
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
            v-model="recurs.desti"
          />
        </div>
      </div>
      <div class="col-lg-8" v-if="usuarilogin.rols_id == 3">
          <div class="row">
              <div class="col-lg-6" >
        <div class="input input--col mb-2">
          <label for="horatransport">Hora de Transport</label>
          <input
            type="time"
            name="horatransport"
            id="horatransport"
            placeholder="Introdueix l'hora de transport..."
            v-model="recurs.hora_transport"
          />
        </div>
        <div class="input input--col mb-2">
          <label for="horatransferencia">Hora de Transferència</label>
          <input
            type="time"
            name="horatransferencia"
            id="horatransferencia"
            placeholder="Introdueix l'hora de transferencia..."
            v-model="recurs.hora_transferencia"
          />
        </div>
      </div>
      <div class="col-lg-6">
        <div class="input input--col mb-2">
          <label for="horahospital">Hora d'arribada a l'hospital</label>
          <input
            type="time"
            name="horahospital"
            id="horahospital"
            placeholder="Introdueix l'hora d'arribada a l'hospital..."
            v-model="recurs.hora_arribada_hospital"
          />
        </div>
        <div class="input input--col mb-2">
          <label for="horafinal">Hora de Finalització</label>
          <input
            type="time"
            name="horafinal"
            id="horafinal"
            placeholder="Introdueix l'hora de finalització..."
            v-model="recurs.hora_finalitzacio"
          />
        </div>
      </div>
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
    editafectat: {
      type: Object,
      required: false,
    },
    sexes: {
      type: Array,
      required: false,
    },
    usuarilogin: {
      type: Object,
      required: false,
    },
    usuarirecurs: {
      type: Object,
      required: false,
    },
    insert: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      trasllat: false,
      prioritats: [1, 2, 3, 4, 5],
      hora: this.checkUpdate(),
      afectat: {},

    };
  },
  created() {
    this.recurs = this.editrecurs;
    if (this.editafectat === undefined) {
      this.afectat = this.emptyAfectat();
    } else {
      this.afectat = this.editafectat;
    }


  },
  mounted() {},
  methods: {
      checkUpdate(){
          if (this.insert) {
              this.getTime();
          }
      },
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
    emptyAfectat() {
      return {
        id: 0,
        telefon: "",
        cip: "",
        nom: "",
        cognoms: "",
        edat: 0,
        te_cip: false,
        sexes_id: 0,
        sexe: {
          id: 0,
          sexe: "",
        },
        saveAfectat: false,
      };
    },
  },
  computed: {},
};
</script>
