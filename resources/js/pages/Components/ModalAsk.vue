<script setup>

const props = defineProps({
    isOpen: {
        type: Boolean,
        required: true,
    },
    closeNo: {
        type: Function,
        required: true,
    },
    closeYes: {
        type: Function,
        required: true,
    },
    message:String,
});
</script>
<template>
 <!--    <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-2 rounded-lg shadow-lg w-full max-w-4xl max-h-full overflow-y-auto">
            <h4>{{ props.message }}</h4>
            <button @click="closeNo" class="px-4 py-2 bg-red-500 text-white rounded">No</button>
            <button @click="closeYes" class="px-4 py-2 bg-green-500 text-white rounded">Si</button>              
        </div>        
    </div> -->
    <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h4 class="text-xl font-semibold text-gray-800 mb-4">{{ props.message }}</h4>
        <div class="flex justify-end space-x-4">
            <button @click="closeNo" class="px-4 py-2 bg-red-500 text-white font-medium rounded hover:bg-red-600 transition duration-200">
                No
            </button>
            <button @click="closeYes" class="px-4 py-2 bg-green-500 text-white font-medium rounded hover:bg-green-600 transition duration-200">
                Sí
            </button>
        </div>
    </div>
</div>

</template>
