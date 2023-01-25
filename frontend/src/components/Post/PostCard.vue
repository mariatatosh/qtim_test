<template>
  <v-card
      :height="cardHeight"
      :width="cardWidth"
      class="d-flex justify-space-between align-center"
      outlined
  >
    <div class="w-50 h-100 d-flex flex-column justify-space-between py-3">
      <v-card-title class="text-truncate">
        {{ title }}
      </v-card-title>

      <v-card-subtitle>
        <p>Автор: <strong>{{ author || 'Анонимно' }}</strong></p>
        <p>Создано: <strong>{{ createdAt }}</strong></p>
      </v-card-subtitle>

      <v-card-text></v-card-text>

      <v-card-actions>
        <router-link :to="`/posts/${slug}`" class="text-decoration-none">
          <v-btn color="primary" class="font-weight-bold" text>Read more</v-btn>
        </router-link>
      </v-card-actions>
    </div>

    <v-img
        style="margin-right: -85px;"
        :src="image || 'https://via.placeholder.com/400x300/dbd9d9/dbd9d9?text=+'"
    />
  </v-card>
</template>

<script>
export default {
  name: 'PostCard',
  props: {
    title: {
      type: String,
      required: true,
    },
    slug: {
      type: String,
      required: true,
    },
    author: {
      type: String,
      default: null,
    },
    image: {
      type: String,
      default: null,
    },
    createdAt: {
      type: String,
      required: true,
    },
    cardWidth: {
      type: String,
      default: null,
    },
    cardHeight: {
      type: String,
      default: null,
    },
  },
};
</script>