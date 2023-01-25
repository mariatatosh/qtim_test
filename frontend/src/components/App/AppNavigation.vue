<template>
  <v-sheet rounded="lg">
    <v-list rounded="lg">
      <router-link
          v-for="link in links"
          :key="link.path"
          :to="link.path"
          class="text-decoration-none text-black"
      >
        <v-list-item link>
          <v-list-item-title class="text-uppercase">
            {{ link.label }}
          </v-list-item-title>
        </v-list-item>
      </router-link>

      <v-divider class="my-2" />

      <router-link
          :to="{ name: 'auth.login' }"
          class="text-decoration-none text-black"
      >
        <v-list-item link color="grey-lighten-4">
          <v-list-item-title class="text-uppercase">
            Login
          </v-list-item-title>
        </v-list-item>
      </router-link>
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