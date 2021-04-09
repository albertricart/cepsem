<template>
  <div class="header">

    <div class="header-main">
      <!-- <a href="#" class="header-logo"></a> -->
      <div href="#" class="header-logo"></div>

      <nav class="header-nav">
        <a href="/cepsem/webapp/cepsem/public/">Inici</a>
        <a href="/cepsem/webapp/cepsem/public/cecos/">CECOS</a>
        <a href="">Recursos Mòbils</a>
        <a href="">Formació</a>
      </nav>
    </div>

    <div class="header-trail">
      <div v-show="helpbox" class="header-icon header-icon--helpbox"></div>
      <div v-show="formacio" class="header-icon header-icon--formacio"></div>
      <div v-show="logged" class="header-icon header-icon--login">Hola, Albert</div>

      <!-- <a href="" class="header-formacio"></a>
      <a href="" class="header-help"></a> -->
    </div>

  </div>
</template>

<script>
export default {
  props: {
    formacio: {
      type: Boolean,
      required: true,
    },

    helpbox: {
      type: Boolean,
      required: true,
    },

    logged: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {};
  },
  created() {},
  mounted() {
    console.log("Header component mounted.");
  },
  computed: {},
};
</script>
