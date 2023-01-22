<template>
  <v-sheet rounded="lg">
    <v-list rounded="lg">
      <v-list-item
          v-for="link in links"
          :key="link.path"
          link
      >
        <v-list-item-title class="text-uppercase">
          <router-link :to="link.path" class="text-decoration-none text-black">{{ link.label }}</router-link>
        </v-list-item-title>
      </v-list-item>

      <v-divider class="my-2" />

      <v-list-item
          link
          color="grey-lighten-4"
      >
        <v-list-item-title>
          LOGOUT
        </v-list-item-title>
      </v-list-item>
    </v-list>
  </v-sheet>
</template>

<script>
export default {
  name: 'AppNavigation',
  data: () => ({
    links: [
      {
        label: 'Posts',
        path: '/posts',
      },
      {
        label: 'Create post',
        path: '/posts/create',
      },
    ],
  }),
};
</script>