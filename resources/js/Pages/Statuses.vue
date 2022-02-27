<template>
    <div>
        <BreezeNavLayout>
            
            <div class=" w-full px-3 py-4 ">

                <div class=" flex justify-end">
                        <button @click="openBox()" class=" bg-slate-300 rounded-md shadow-md px-3 py-2 mx-2 my-3 border-none ring-slate-400 text-gray-800 transition duration-500 hover:bg-slate-500">
                            Add New Status
                        </button>
                </div>



                 <table class="table-auto mt-10 text-center px-4 w-full">
                    <thead class=" bg-gray-700 text-gray-100 ">
                        <tr class=" justify-around ...">
                        
                        
                            <td class=""> Title </td>
                            <td class=""> Slug </td>
                            <td class=""> Edit </td>
                            <td class=""> Delete </td>

                        

                        </tr>
                    </thead>
            <tbody class=" bg-white">
                <tr v-for="status in statuses" :key="status.id" class=" border-b-2">

                  
                  
                    <td>{{status.title}}</td>
                    <td>{{status.slug}}</td>
                
                    <td> 
                        <button @click=" editData(status)" class="  text-sm text-green-500"> 
                           <font-awesome-icon icon="pen-to-square"/> 
                        </button> 
                    </td>
                    <td> 
                        <button @click="daleteData(status.id)" class="  text-sm text-red-500">
                            <font-awesome-icon icon="trash-can"/>
                         </button>
                    </td>
                </tr>
            </tbody>
        </table> 


                   

                   
            </div>

        <!----------------------------------- modal for upload data --------------------------------------->
         
                    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" v-if="isOpen">
                         <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h1 class=" font-bold text-gray-700 text-center"> Add New Status</h1>
                           <form @submit.prevent="submit()">
    
                               <input type="text" v-model="form.title" placeholder=" title" class=" w-full mx-auto my-3 rounded border-gray-500 shadow-sm hover:shadow-lg">

                               <textarea v-model="form.slug" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" placeholder="description"></textarea>
                               
                             
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                              <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-green-400 text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> Submit</button>

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
                            <h1 class=" font-bold text-gray-700 text-center"> Update Data</h1>
                           <form @submit.prevent="updateData(form)">
    
                               <input type="text" v-model="form.title" placeholder=" title" class=" w-full mx-auto my-3 rounded border-gray-500 shadow-sm hover:shadow-lg">

                               <textarea v-model="form.slug" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" placeholder="description"></textarea>
                               
                               
                          
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


export default {
    components: {
        Link,
        useForm,
        BreezeNavLayout,
      
    },

    props:{
        statuses: Array,
    } ,

    data() {
        return {
            isOpen: false,
            editMode: false,
        
          
        
            form: {
                title: '',
                slug:'',
              
            }
        }
    },

    methods: {
        openBox() {
           this.isOpen = true ;
        },

        closeBox() {
            this.isOpen = false ;
        },

        reset() {
            this.form = {
                title: null,
                slug: null,
            }
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

            this.$inertia.put(`/statuses/update/` + data.id , data);
             this.closeBoxEdit();
            this.reset();
             
        },

        submit() {
           
            this.$inertia.post('/statuses' , this.form);
            this.closeBox();
            this.reset();
        }, 

      

      

        daleteData(id) {
             if(!confirm ('Are You Sure To Delete')) return ;
                this.$inertia.delete(`/statuses/delete/${id}`);
    
        },
        
       

        
    },

    

   
}

</script>


<style>
   
</style>