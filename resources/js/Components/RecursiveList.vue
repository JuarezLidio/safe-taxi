<script setup>
defineEmits(['upload-data'])

</script>
<template>
    <div v-for="(item, index) in items" :key="item.id">
        <div v-if="item.children">

            <div v-if="comparisionItems?.find(comparisionItems => comparisionItems.id === item.id )?.id" :style="{ marginLeft: level * 20 + 'px' }" class="flex items-center mb-4">
                <input checked
                    @change="updateModel(item.id)" type="checkbox"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-900 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checked:bg-blue-500">
                <label class="ms-2 text-sm  text-gray-900 dark:text-gray-300">{{ item[target] }}</label>
            </div>

            <div v-else-if="comparisionFlag == true"
                :style="{ marginLeft: level * 20 + 'px' }" class="flex items-center mb-4">
                <input @change="updateModel(item.id)" type="checkbox"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-900 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checked:bg-blue-500">
                <label class="ms-2 text-sm  text-gray-900 dark:text-gray-300">{{ item[target] }}</label>
            </div>

            <p v-else :style="{ marginLeft: level * 20 + 'px' }" class="font-semibold capitalize">{{ item[target] }} </p>

            <RecursiveList :items="item.children" :target="target" :level="level + 1"
                :comparisionItems="comparisionItems?.[index]?.children" :comparisionFlag="comparisionFlag"
                @upload-data="uploadData"/>
        </div>

        <div v-else>

            <div v-if="comparisionItems?.find(comparisionItems => comparisionItems.id === item.id )?.id" :style="{ marginLeft: level * 20 + 'px' }" class="flex items-center mb-4">
                <input checked @change="updateModel(item.id, this)" type="checkbox"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-900 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checked:bg-blue-500">
                <label class="ms-2 text-sm text-gray-900 dark:text-gray-300">{{ item[target] }}</label>
            </div>

            <div v-else-if="comparisionFlag == true"
                :style="{ marginLeft: level * 20 + 'px' }" class="flex items-center mb-4">
                <input @change="updateModel(item.id)" type="checkbox"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-900 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checked:bg-blue-500">
                <label class="ms-2 text-sm  text-gray-900 dark:text-gray-300">{{ item[target] }}</label>
            </div>

            <p class="capitalize" v-else :style="{ marginLeft: level * 20 + 'px', fontWeight: level === 1 ? '600' : 'normal' }">{{ item[target] }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        items: Array,
        target: String,
        level: {
            type: Number,
            default: 1,
        },
        comparisionItems: {
            Array,
            default: null,
        },
        comparisionFlag: {
            Boolean,
            default: false,
        },
    },
    methods: {
        updateModel(itemId) {
            this.$emit('upload-data', itemId, this.target);
        },
        uploadData(itemId) {
            this.$emit('upload-data', itemId, this.target);
        }
    },
};

</script>
