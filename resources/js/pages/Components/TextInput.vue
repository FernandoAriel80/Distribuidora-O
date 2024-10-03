
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
         default: '',
     },
     type: {
         type: String,
         default: 'text',
     },
     message: String,
 });
 
 const emit = defineEmits(['update:modelValue']);
 </script>
 
 <template>
     <div class="m-1">
         <label class="block text-sm font-medium leading-6 text-slate-900">{{ props.name }}</label>
         <input
             :type="props.type"
             :value="props.modelValue"
             @input="$emit('update:modelValue', $event.target.value)"
             :class="{'!ring-red-500': props.message}"
             class="block w-full min-w-[150px] rounded-md border-0 p-2
              text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300
               placeholder:text-slate-500 focus:ring-2 focus:ring-inset
                focus:ring-blue-500 sm:text-sm bg-white mb-2"
         />
         <small class="error" v-if="props.message">{{ props.message }}</small>
     </div>
 </template>
 