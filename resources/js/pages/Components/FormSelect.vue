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
        message: String,
    });

</script>
<template>
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ name }}</label>
        <select v-model="model" id="" class="block w-full p-2 border
             border-gray-300 rounded-md"  >
            <option v-for="data in datas" :key="data.id" :value="data.id">
                {{ data.name }}
            </option>
        </select>
        <!-- <small class="text-red-500 text-sm" v-if="props.message">{{ props.message }}</small> -->
        <p v-if="props.message" class="text-red-500 text-sm">{{ props.message }}</p>
    </div>
</template>