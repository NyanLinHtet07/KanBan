<script setup>
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);

</script>

<template>
 
        <div class="h-screen flex">
            <div class=" bg-slate-100 w-1/5 border-r" v-if="open">
           
                
                <h3 class=" p-2 mt-3 text-center font-bold text-gray-800"> KanBan Board </h3>

                <div class=" mt-3 px-2 mx-2 bg-white rounded">
                    <h3 class=" px-3 flex justify-start font-semibold text-lg"> {{ $page.props.auth.user.name }} </h3>
                    <small class=" px-3 text-gray-700"> {{ $page.props.auth.user.email}}</small>
                </div>

                <nav class=" mt-3">

                    <Link :href="route('dash')" class=" flex justify-between bg-gray-200 transition duration-700 hover:bg-gray-300 px-3 py-1 mx-3 my-2 rounded-md shadow-sm">
                         <span> Home </span> 
                    </Link>

                     <Link :href="route('statuses.index')" class="flex justify-between bg-gray-200 transition duration-700 hover:bg-gray-300 px-3 py-1 mx-3 my-2 rounded-md shadow-sm">
                          <span> Statuses </span>
                    </Link>

                     <Link :href="route('logout')" method="post" class="flex justify-between bg-gray-200 transition duration-700 hover:bg-gray-300 px-3 py-1 mx-3 my-2 rounded-md shadow-sm">
                        <span> LogOut </span>
                    </Link>
                </nav>
             
            </div>

            <div class=" flex-1 w-4/5 bg-white border-gray-200">
                    <div class=" ml-3 mt-3">
                        <p v-if=" !open" @click="isOpen()" class=" cursor-pointer"> <font-awesome-icon icon="bars" class=" text-lg p-2 rounded-full bg-slate-300 text-slate-500 shadow-md"/></p>
                        <p v-else @click="isClose()" class=" cursor-pointer"> <font-awesome-icon icon="bars" class=" text-lg p-2 rounded-full bg-slate-300 text-slate-500 shadow-md"/> </p>
                    </div>
                     <main>
                        <slot /> 
                    </main>
            </div>

        </div>

</template>

<script>
export default {
    data(){
        return {
            open:false,
        }
    },

    methods: {
        isOpen(){
            this.open = true;
        },

        isClose(){
            this.open = false;
        }
    },
}
</script>

<style>

</style>