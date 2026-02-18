<template>
  <input
    type="file"
    :disabled="disabled"
    accept="image/*"
    @change="$emit('update:modelValue', $event.target.files[0])"
    :class="[
      'text-sm text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-white dark:bg-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500',
      $attrs.class,
    ]"
  />
</template>

<script>
export default {
  name: "ImageInput",
  props: {
    modelValue: File,
    disabled: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
