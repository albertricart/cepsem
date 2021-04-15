<template>
  <div class="incidencia-form mx-5 my-5">
    <h1 class="page-title">NOVA INCIDÈNCIA</h1>

    <nav class="incidencia-form-nav table-header mt-5">
      <span class="active">ALERTANT</span>
      <span>LOCALITZACIÓ</span>
      <span>AFECTATS</span>
      <span>RECURSOS MÒBILS</span>
    </nav>

    <div class="incidencia-form-body">
      <section id="alertant">
        <div class="row">
          <div class="col-lg-6">
            <div class="col-lg-12">
              <div class="input input--col mb-4">
                <label for="nom">Telèfon</label>
                <div class="input-button">
                  <input
                    type="text"
                    name="telefon"
                    id="telefon"
                    placeholder="Introdueix el telèfon de l'alertant..."
                    autofocus
                  />
                  <button class="button button--blue" style="width: 100%">
                    CARREGAR DADES
                  </button>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="input input--col mb-4">
                <label for="tipusaccident">Tipus Accident</label>
                <b-form-select
                  name="tipusaccident"
                  id="tipusaccident"
                  class="select"
                ></b-form-select>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="input input--col mb-4">
                <label for="tipusalertant">Tipus Alertant</label>
                <b-form-select
                  name="tipusalertant"
                  id="tipusalertant"
                  class="select"
                ></b-form-select>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="input input--col mb-4">
                <label for="nom">Alertant</label>
                <input
                  type="text"
                  name="nom"
                  id="nom"
                  placeholder="Introdueix el nom de l'alertant..."
                />
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="incidencia-hora">
              <div class="input input--row mb-4">
                <label for="nom">Data</label>
                <input
                  type="text"
                  name="nom"
                  id="nom"
                  placeholder="Introdueix el nom de l'alertant..."
                />
              </div>

              <div class="input input--row mb-4">
                <label for="nom">Hora</label>
                <input
                  type="text"
                  name="nom"
                  id="nom"
                  placeholder="Introdueix el nom de l'alertant..."
                />
              </div>

              <div>
                <button class="button button--blue">EDITAR</button>
                <button class="button button--pink ml-2">ACTUALITZAR</button>
              </div>
            </div>
          </div>
        </div>

        <div class="incidencia-form-footer">
          <button
            class="button button-icon button--pink button--rounded"
            style="background-image: url('../assets/icons/next.svg')"
          >
            Següent
          </button>
        </div>
      </section>

      <section id="localitzacio"></section>
      <section id="afectats"></section>
      <section id="recursos"></section>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    incidencia: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  created() {},
  mounted() {
    console.log("Incidència component mounted.");
  },
  computed: {},
};
</script>
