<template>
  <app-page title="Create Account">
    <v-form v-model="valid" class="d-flex flex-column align-center">
      <v-col cols="4">
        <v-row>
          <v-text-field
              v-model="email"
              :rules="[
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid',
              ]"
              label="E-mail"
              variant="outlined"
              color="primary"
              required
          />
        </v-row>
      </v-col>

      <v-col cols="4">
        <v-row>
          <v-text-field
              v-model="password"
              :rules="[v => !!v || 'Password is required']"
              type="password"
              label="Password"
              variant="outlined"
              color="primary"
              required
          />
        </v-row>
      </v-col>

      <v-col cols="4">
        <v-row>
          <v-text-field
              v-model="repeatPassword"
              :rules="[v => v === password || 'Passwords don\'t match']"
              type="password"
              label="Repeat password"
              variant="outlined"
              color="primary"
              required
          />
        </v-row>
      </v-col>

      <v-col cols="4">
        <v-row>
          <v-btn
              size="large"
              width="100%"
              color="primary"
              @click="submit()"
          >
            Register
          </v-btn>
        </v-row>
      </v-col>

      <v-col cols="4" class="mt-3">
        <v-row justify="center">
          <p class="">Already have an account? &nbsp;</p>
          <router-link to="/auth/login" class="font-weight-bold">Log in</router-link>
        </v-row>
      </v-col>
    </v-form>
  </app-page>
</template>

<script>
import AppPage from '@/components/App/AppPage.vue';

import AuthApi from '@/api/AuthApi';

const authApi = new AuthApi();

export default {
  name: 'Register',
  components: {
    AppPage,
  },
  data: () => ({
    valid: false,
    email: '',
    password: '',
    repeatPassword: '',
  }),
  methods: {
    async submit() {
      if (this.password !== this.repeatPassword) {
        return;
      }

      try {
        await authApi.register(this.email, this.password);
        await this.$router.push({name: 'auth.login'});
      } catch (e) {
        //
      }
    },
  },
}
</script>