
<script setup>
import { defineProps, defineEmits } from 'vue';

// Define props
const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    modelValue: {
        type: [String, Number],
        default: null,
    },
    datas: {
        type: Array,
        required: true,
    },
    message: String,
});

// Define emits
const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ props.name }}</label>
        <select
            :value="props.modelValue"
            @change="$emit('update:modelValue', $event.target.value)"
            class="block w-full p-2 border border-gray-300 rounded-md"
        >
            <option v-for="data in props.datas" :key="data.id" :value="data.id">
                {{ data.name }}
            </option>
        </select>
        <p v-if="props.message" class="text-red-500 text-sm">{{ props.message }}</p>
    </div>
</template>
