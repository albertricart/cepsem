<template>
  <a :href="'/cepsem/webapp/cepsem/public/cecos/' + page ">
    <div :class="'cepsem-card cepsem-card--' + size">{{ name }}</div>
  </a>
</template>

<script>
export default {
  props: {
    page: {
      type: String,
      required: true,
    },

    name: {
      type: String,
      required: true,
    },

    size: {
      type: String,
      required: true,
    },
  },
  data() {
    return {};
  },
  created() {},
  mounted() {
    console.log("Menu card component mounted.");
  },
  computed: {},
};
</script>
