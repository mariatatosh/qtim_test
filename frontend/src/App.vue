<template>
  <v-app id="inspire">
    <app-header />

    <v-main class="bg-grey-lighten-3">
      <v-container>
        <v-row>
          <v-col cols="2">
            <app-navigation />
          </v-col>

          <v-col>
            <v-sheet min-height="85vh" rounded="lg">
              <v-container>
                <router-view />
              </v-container>
            </v-sheet>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import AppHeader from '@/components/App/AppHeader.vue';
import AppNavigation from '@/components/App/AppNavigation.vue';

export default {
  name: 'App',
  components: {
    AppNavigation,
    AppHeader
  },
};
</script>
