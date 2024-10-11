<script setup>
import { ref, defineProps, watch, } from 'vue';
import {router } from '@inertiajs/vue3'; 
import CreateEmployee from './Create.vue'
import routes from '../../../router';
import Modal from '../../Components/Modal.vue';
import ModalAsk from '../../Components/ModalAsk.vue';
import UpdateEmployee from './Update.vue';

const props = defineProps({
    employees: {
        type: Object,
        required: true,
    }
});

const showFlash = ref(true);
//modal destroy
const showAlert = ref(false);
const modalAsk = ref(false);
const current_id = ref();

const openModalAlert = (id) =>{
    showAlert.value = true;
    showFlash.value = true;
    current_id.value = id;
}
const closeModalAlert = () =>{
    showAlert.value = false;
}
const closeModalAlertYes = () =>{
    modalAsk.value = true;
    showFlash.value = false;
    deleteEmployee(current_id.value, modalAsk.value );
    closeModalAlert();
}
const closeModalAlertNo = () =>{
    modalAsk.value = false;
    showFlash.value = true;
    closeModalAlert();
}

const deleteEmployee = (id, ask) => {
    if (ask == true) {
        router.delete(routes.employees.delete(id), {
            onSuccess: () => {
            },
            onError: (error) => {
                console.error(error);
            },
        });
    }
};

//modal create and edit 
const showModalCreate = ref(false);
const showModalEdit = ref(false);
const current_objet = ref();
//create
const openModalCreate = () => {
    showModalCreate.value = true;
    showFlash.value = true;
};

const closeModalCreate = () => {
    showModalCreate.value = false;
    showFlash.value = false;
};

//edit
const openModalEdit = (objet) => { 
    current_objet.value = objet;
    showModalEdit.value = true;
    showFlash.value = true;
};
const closeModalEdit = () => {
    showModalEdit.value = false;
    showFlash.value = false;
};
const closeFlashAndModal = () => {
    showModalCreate.value = false;
    showModalEdit.value = false;
    showFlash.value = true;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const dateFormatted = date.toLocaleDateString('es-AR', { year: 'numeric', month: '2-digit', day: '2-digit' });
    const timeFormatted = date.toLocaleTimeString('es-AR', { hour: '2-digit', minute: '2-digit' });

    return `${dateFormatted} ${timeFormatted}`;
}
</script>
<template>

    <Head title="Admin" />

    <p v-if="showFlash == false && $page.props.flash.greet" class="p-4 bg-green-200">{{ $page.props.flash.greet }}</p>
    <!-- Modal -->
    <div>
        <button @click="openModalCreate" class="px-4 py-2 bg-blue-500 text-white rounded">Crear empleado</button>
        <Modal :isOpen="showModalCreate" :closeModal="closeFlashAndModal">
            <CreateEmployee @actionExecuted="closeModalCreate" />
        </Modal>
    </div>
    <div v-if="current_objet">                 
            <Modal :isOpen="showModalEdit" :closeModal="closeFlashAndModal">
                <UpdateEmployee :employees="current_objet" @actionExecuted="closeModalEdit" />
            </Modal>       
    </div>
    <div>
        <ModalAsk :isOpen="showAlert" :closeNo="closeModalAlertNo" :closeYes="closeModalAlertYes" message="Esta seguro de eliminar este producto?"/>
    </div>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Empleados</h1>
        <div class="flex justify-center">
            <div class="overflow-x-auto w-full max-w-6xl">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Correo</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha Creado
                            </th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha Actualizado
                            </th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actualizar
                            </th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Eliminar
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="empolyee in employees" :key="empolyee.id">
                            <td class="px-2 py-3 text-sm text-gray-900">{{ empolyee.name }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ empolyee.email }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ formatDate(empolyee.created_at) }}</td>
                            <td class="px-2 py-3 text-sm text-gray-500">{{ formatDate(empolyee.updated_at) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <button @click="openModalEdit(empolyee)"
                                    class="bg-blue-500 text-white px-3 py-1 rounded text-xs">
                                    Editar
                                </button>
                            </td>
                          
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <button @click="openModalAlert(empolyee.id)"
                                    class="bg-red-500 text-white px-3 py-1 rounded text-xs">Eliminar</button>
                                    
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>