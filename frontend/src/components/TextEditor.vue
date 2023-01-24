<template>
  <ckeditor v-model="input" :editor="editor" />
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
  name: 'TextEditor',
  props: {
    modelValue: {
      type: String,
      required: true,
    },
  },
  data: () => ({
    editor: ClassicEditor,
    data: '',
    input: '',
  }),
  watch: {
    input(newVal) {
      this.$emit('update:modelValue', newVal);
    },
  },
};
</script>

<style>
.ck-editor {
  width: 100% !important;
}

.ck-editor__editable {
  min-height: 300px;
}
</style>