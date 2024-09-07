<script setup>
    const model = defineModel({
        type:null,
        required:true,
    });

    const props = defineProps({
        name: {
            type: String,
            Required: true,
        },
        datas :{
            type: Object,
            required: true,
        },
    });

</script>
<template>
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ name }}</label>
        <select v-model="model" id="" class="block w-full p-2 border
             border-gray-300 rounded-md">
            <option v-for="data in datas" :key="data.id" :value="data.id">
                {{ data.name }}
            </option>
        </select>
    </div>
</template>