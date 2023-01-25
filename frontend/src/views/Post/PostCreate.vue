<template>
  <app-page title="Create post">
    <v-form v-model="valid" class="d-flex flex-column align-center">
      <v-col cols="6">
        <v-row>
          <v-text-field
              v-model="title"
              :rules="[v => !!v || 'Title is required',]"
              label="Title"
              variant="outlined"
              color="primary"
              required
          />
        </v-row>
      </v-col>

      <v-col cols="6">
        <v-row>
          <v-text-field
              v-model="image"
              label="Image URL"
              variant="outlined"
              color="primary"
          />
        </v-row>
      </v-col>

      <v-col cols="6" class="mb-6">
        <v-row>
          <text-editor v-model="content" />
        </v-row>
      </v-col>

      <v-col cols="6">
        <v-row>
          <v-btn
              size="large"
              width="100%"
              color="primary"
              @click="submit()"
          >
            Create
          </v-btn>
        </v-row>
      </v-col>
    </v-form>
  </app-page>
</template>

<script>
import AppPage from '@/components/App/AppPage.vue';
import TextEditor from '@/components/TextEditor.vue';

import PostApi from '@/api/User/PostApi';

const postApi = new PostApi();

export default {
  name: 'PostCreate',
  components: {
    AppPage,
    TextEditor,
  },
  data: () => ({
    valid: false,
    title: '',
    content: '',
    image: null,
  }),
  methods: {
    async submit() {
      const { title, content, image } = this;

      try {
        await postApi.create({ title, content, image });

        this.$router.push({ name: 'posts.list' });
      } catch (e) {
        //
      }
    },
  },
};
</script>