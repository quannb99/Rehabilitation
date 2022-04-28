<template>
  <div>
    <example-component
    :title="title"
    :content="content"
    />
  </div>
</template>

<script>
import ExampleComponent from './ExampleComponent.vue';
export default {
  components: { ExampleComponent },
  data() {
    return {
      title: "Example title",
      content: "Example content",
    };
  },

  mounted() {
    console.log("App mounted.");
  },
};
</script>

<style lang="scss" scoped></style>
