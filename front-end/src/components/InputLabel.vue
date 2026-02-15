<template>
    <label
        :class="[
            'block font-medium text-sm text-gray-700 dark:text-gray-300',
            $attrs.class,
        ]"
        v-bind="$attrs"
    >
        {{ value || $slots.default() }}
    </label>
</template>

<script>
export default {
    name: "InputLabel",
    props: {
        value: {
            type: String,
            default: "",
        },
    },
};
</script>
