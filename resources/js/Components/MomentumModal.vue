<script setup>
import { useModal } from "momentum-modal"

const { show, close, redirect } = useModal()

</script>

<template>
    <teleport to="body">
        <transition leave-active-class="duration-200" appear as="template" :show="show" >
            <div v-show="show" class="fixed z-10 inset-0 w-full h-full flex" scroll-region>
                <transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                    @after-leave="redirect">
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
                        <div class="absolute inset-0 bg-gray-500 opacity-75" />
                    </div>
                </transition>

                <transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div v-show="show" class="m-auto p-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all w-1/4 ">
                        <div class="w-full flex justify-end cursor-pointer text-gray-500 -mb-2" @click="close"><i class="pi pi-times"></i></div>
                        <slot v-if="show" />
                    </div>
                </transition>
            </div>
        </transition>
    </teleport>
</template>
