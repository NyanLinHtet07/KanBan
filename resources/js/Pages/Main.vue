<template>
    <div>
        <BreezeNavLayout>
            <div>
                <div class=" flex justify-end px-3 border-0 border-none rounded-md  mx-3 my-2">
                   
                  

                    <Link :href="route('statuses.index')" class=" mx-3 my-2 px-3 py-2 rounded-xl font-semibold text-xl text-gray-800 hover:text-green-700 border-red-100 bg-gray-100"> 
                    <font-awesome-icon icon="arrow-up" /> <span class=" text-sm text-gray-600">Statuses </span> 
                    </Link>
                
                </div> 
            </div>
            
            <div class=" w-full px-3 py-4 grid grid-cols-4 gap-3 sm:grid-cols-2 lg:grid-cols-4 justify-start">

                <div v-for=" status in datas" :key="status.id">
                    <div class=" rounded-xl shadow-lg mx-4 my-3 bg-gray-200 ">
                        <div class=" font-semibold text-lg flex justify-between">
                             <h3 class=" p-3"> {{status.title}} </h3>
                           

                           <button @click="openBox(status.id)"> <font-awesome-icon icon="plus" class="px-3 py-4"/> </button>

                        </div>
                        <div class=" flex justify-start mr-4">
                            <small class=" mx-3">{{status.start}}</small>  <small class="mx-3">{{status.end}}</small>
                        </div>

                       
                            
                              <draggable  v-model="status.datas"
                                     :group="{ name: 'people', put: true  }"
                                     item-key="id"
                                     @change="log">  

                                <div class=" px-2 py-3 rounded-md  mx-1 my-2" v-for=" data in status.datas" :key="data.name">
                                        <div class="list-group-item px-3 py-2 mx-3 my-2 rounded bg-white text-gray-900 transition duration-500 hover:bg-slate-100 hover:shadow-md ">
                                            <div class=" flex justify-between"> 
                                                <p> {{ data.title}} </p>

                                                <button @click="editData(data)" class=" text-sm text-green-500" > 
                                                    <font-awesome-icon icon="pen-to-square"/>
                                                </button>

                                               
                                            </div>

                                            <div class=" flex justify-between">
                                                 <small> {{ data.description}} </small>

                                                 <button @click="daleteData(data.id)" class=" text-sm text-red-500" > 
                                                    <font-awesome-icon icon="trash-can"/>
                                                </button>
                                            </div>
                                           
                                        </div>       
                                 </div>
                              </draggable>
                        
                    </div>
                 </div>

                   

                   
            </div>

        <!----------------------------------- modal for upload data --------------------------------------->
         
                    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" v-if="isOpen">
                         <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h1 class=" font-bold text-gray-700 text-center"> Add New Data</h1>
                           <form @submit.prevent="submit()">
    
                               <input type="text" v-model="form.title" placeholder=" title" class=" w-full mx-auto my-3 rounded border-gray-500 shadow-sm hover:shadow-lg">

                               <textarea v-model="form.description" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" placeholder="description"></textarea>
                               
                               
                          
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                            <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-green-400 text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> Submit</button>
                            
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="closeBox">Cancel</button>
                        </div>

                         </form>
                        </div>
                        </div>
                    </div>
                    </div>

            <!----------------------------------------- end -------------------------------------->


             <!----------------------------------- modal for edit data --------------------------------------->
         
                    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" v-if="editMode">
                         <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h1 class=" font-bold text-gray-700 text-center"> Add New Data</h1>
                           <form @submit.prevent="updateData(form)">
    
                               <input type="text" v-model="form.title" placeholder=" title" class=" w-full mx-auto my-3 rounded border-gray-500 shadow-sm hover:shadow-lg">

                               <textarea v-model="form.description" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" placeholder="description"></textarea>
                               
                               
                          
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                            <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-green-400 text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> Update</button>
                            
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="closeBoxEdit">Cancel</button>
                        </div>

                         </form>
                        </div>
                        </div>
                    </div>
                    </div>

            <!----------------------------------------- end -------------------------------------->

        
        </BreezeNavLayout>
    </div>
</template>

<script>

import { Link , useForm } from '@inertiajs/inertia-vue3';
import BreezeNavLayout from '@/Layouts/Navigation.vue';
import { VueDraggableNext} from 'vue-draggable-next';
//import draggable from 'vuedraggable';


export default {
    components: {
        Link,
        useForm,
        BreezeNavLayout,
        draggable : VueDraggableNext,
        //draggable,
    },

    props:{
        datas: Array,
    } ,

    data() {
        return {
            drag: false,

            isOpen: false,
            editMode: false,
        
            enable: true,
            dragging: false,
        
            form: {
                title: '',
                description:'',
                status_id: '',
            }
        }
    },

    methods: {
        openBox($id) {
           this.isOpen = true ;
           this.form.status_id = $id ;
        },

        closeBox() {
            this.isOpen = false ;
        },

        closeBoxEdit() {
            this.editMode = false;
        },

        reset() {
            this.form = {
                title: null,
                description: null,
            }
        },

        editData(data) {
             this.form = Object.assign({}, data);
            this.editMode = true ;
        },

         updateData(data) {
            data.method = 'PUT';

            this.$inertia.put(`/datas/update/` + data.id , data);
             this.closeBoxEdit();
            this.reset();
             
        },

        submit() {
            this.formdata = JSON.parse(JSON.stringify(this.form))
            this.$inertia.post('/datas' , this.formdata);
            this.closeBox();
            this.reset();
        }, 

        daleteData(id) {
             if(!confirm ('Are You Sure To Delete')) return ;
                this.$inertia.delete(`/datas/${id}`);
    
        },

        dataMoved() {
            this.$inertia.put('/datas/sync' , {columns: this.statuses});
        },
        
        log(event) {
                console.log(event)
             },

        
    },


    

   
}

</script>


<style>
  
</style>