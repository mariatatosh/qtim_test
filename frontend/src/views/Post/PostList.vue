<template>
  <app-page title="Posts">
    <div class="grid">
      <post-card
        v-for="post in items"
        :key="post.slug"
        :title="post.title"
        :slug="post.slug"
        :author="post.author"
        :image="post.image"
        :created-at="post.createdAt"
        card-width="100%"
        card-height="200"
      />
    </div>
  </app-page>
</template>

<script>
import AppPage from '@/components/App/AppPage.vue';
import PostCard from '@/components/Post/PostCard.vue';

import PostApi from '@/api/User/PostApi';

const postApi = new PostApi();

export default {
  name: 'PostList',
  components: {
    AppPage,
    PostCard,
  },
  data: () => ({
    items: [],
  }),
  async mounted() {
    await this.init();
  },
  methods: {
    async init() {
      try {
        this.items = await postApi.list();
      } catch (e) {
        //
      }
    },
  },
};
</script>

<style scoped>
.grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 40px;
}
</style>