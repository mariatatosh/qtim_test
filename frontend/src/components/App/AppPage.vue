<template>
  <div>
    <h5 class="text-h5 text-uppercase text-center">{{ title }}</h5>

    <v-divider class="mt-6 mb-5" />

    <slot />
  </div>
</template>

<script>
export default {
  name: 'AppPage',
  props: {
    title: {
      type: String,
      required: true,
    },
  },
};
</script>