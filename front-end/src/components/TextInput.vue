<template>
  <input
    v-bind="$attrs"
    :disabled="disabled"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    :class="[
      'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm',
      $attrs.class,
    ]"
  />
</template>

<script>
export default {
  name: "TextInput",
  props: {
    modelValue: String, // <-- for v-model
    disabled: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
