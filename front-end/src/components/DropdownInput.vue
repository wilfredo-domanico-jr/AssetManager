<template>
  <select
    v-bind="$attrs"
    :disabled="disabled"
    :value="modelValue"
    @change="$emit('update:modelValue', $event.target.value)"
    :class="[
      'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm',
      $attrs.class,
    ]"
  >
    <option v-for="option in options" :key="option.value" :value="option.value">
      {{ option.label }}
    </option>
  </select>
</template>

<script>
export default {
  name: "DropdownInput",
  props: {
    modelValue: {
      type: [String, Number],
      default: "",
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    options: {
      type: Array,
      default: () => [],
    },
  },
};
</script>
