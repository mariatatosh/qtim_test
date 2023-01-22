<template>
  <app-page title="Login">
    <v-form v-model="valid" class="d-flex flex-column align-center">
      <v-col cols="4">
        <v-row>
          <v-text-field
              v-model="email"
              :rules="emailRules"
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
              label="Password"
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
            Login
          </v-btn>
        </v-row>
      </v-col>

      <v-col cols="4" class="mt-3">
        <v-row justify="center">
          <p>New user? &nbsp;</p>
          <router-link to="/auth/register" class="font-weight-bold">Create account</router-link>
        </v-row>
      </v-col>
    </v-form>
  </app-page>
</template>

<script>
import AppPage from '@/components/App/AppPage.vue';

export default {
  name: 'Login',
  components: {
    AppPage,
  },
  data: () => ({
    valid: false,
    email: '',
    password: '',
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+/.test(v) || 'E-mail must be valid',
    ],
  }),
  methods: {
    submit() {

    },
  },
}
</script>