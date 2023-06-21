<template>
    <div>
        <BreezeNavLayout>
            <div>
                <div class="flex justify-end px-3 mx-3 my-2 border-0 border-none rounded-md ">
                   
                  

                    <Link :href="route('statuses.index')" class="px-3 py-2 mx-3 my-2 text-xl font-semibold text-gray-800 bg-gray-100 border-red-100 rounded-xl hover:text-green-700"> 
                    <font-awesome-icon icon="arrow-up" /> <span class="text-sm text-gray-600 ">Statuses </span> 
                    </Link>
                
                </div> 
            </div>
            
            <div class="grid justify-start w-full grid-cols-4 gap-3 px-3 py-4 sm:grid-cols-2 lg:grid-cols-4">

                <div v-for=" status in datas" :key="status.id">
                    <div class="mx-4 my-3 bg-gray-200 shadow-lg rounded-xl">
                        <div class="flex justify-between text-lg font-semibold ">
                             <h3 class="p-3 "> {{status.title}} </h3>
                           

                           <button @click="openBox(status.id)"> <font-awesome-icon icon="plus" class="px-3 py-4"/> </button>

                        </div>
                        <div class="flex justify-start mr-4 ">
                            <small class="mx-3 ">{{status.start}}</small>  <small class="mx-3">{{status.end}}</small>
                        </div>

                       
                            
                              <draggable  v-model="status.datas"
                                     :group="{ name: 'people', put: true  }"
                                     item-key="id"
                                     @change="log">  

                                <div class="px-2 py-3 mx-1 my-2 rounded-md " v-for=" data in status.datas" :key="data.name">
                                        <div class="px-3 py-2 mx-3 my-2 text-gray-900 transition duration-500 bg-white rounded list-group-item hover:bg-slate-100 hover:shadow-md ">
                                            <div class="flex justify-between "> 
                                                <p> {{ data.title}} </p>

                                                <button @click="editData(data)" class="text-sm text-green-500 " > 
                                                    <font-awesome-icon icon="pen-to-square"/>
                                                </button>

                                               
                                            </div>

                                            <div class="flex justify-between ">
                                                 <small> {{ data.description}} </small>

                                                 <button @click="daleteData(data.id)" class="text-sm text-red-500 " > 
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
         
                    <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" v-if="isOpen">
                         <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        
                        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                            <h1 class="font-bold text-center text-gray-700 "> Add New Data</h1>
                           <form>
    
                               <input type="text" v-model="form.title" placeholder=" title" class="w-full mx-auto my-3 border-gray-500 rounded shadow-sm hover:shadow-lg">

                               <textarea v-model="form.description" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" placeholder="description"></textarea>
                               
                               
                          
                        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">

                            <button @click="submit()" v-if="isEdit === false" type="submit" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-green-400 border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> Submit</button>
                            <button @click="updateData(form)" v-else type="submit" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-green-400 border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> Update</button>

                            <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="closeBox">Cancel</button>
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
            isEdit: false,
        
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


        reset() {
            this.form = {
                title: null,
                description: null,
            }
        },

        editData(data) {
             this.form = Object.assign({}, data);
             this.isOpen = true ;
            this.isEdit = true;
        },

         updateData(data) {
            data.method = 'PUT';

            this.$inertia.put(`/datas/update/` + data.id , data);
             this.closeBox();
            this.reset();
            this.isEdit = false
             
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