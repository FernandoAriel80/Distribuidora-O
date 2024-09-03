<script setup>
    const model = defineModel({
        type:null,
        required:true,
    });

    defineProps({
        name:{
            type: String,
            required:true,
        },
        type:{
            type:String,
            default: "text",
        },
        message: String,
    });
</script>

<template>
    <div class="mb-6">
        <label class="block text-sm font-medium leading-6 text-slate-900">{{ name }}</label>
        <input :type=" type" v-model="model" :class=" {' !ring-red-500': message}" 
        class="block w-full rounded-md border-0 p-2 text-slate-900 shadow-sm ring-1 ring-inset
         ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500
          sm:text-sm bg-white mb-4"/>
        <small class="error" v-if="message">{{ message }}</small>
    </div>
</template>
