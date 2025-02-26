<template>
  <div class="p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800">Overview</h1>
    <p class="text-gray-600 mt-2">
      Welcome to your wardrobe dashboard! Here, you can view recent activity, quick stats, and manage your fashion items.
    </p>

    <!-- Quick Stats Section -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mt-6">
      <div class="p-4 bg-blue-100 rounded-lg">
        <h2 class="text-lg font-semibold text-blue-800">Total Clothes</h2>
        <p class="text-2xl font-bold">{{ totalClothes }}</p>
      </div>

      <div class="p-4 bg-green-100 rounded-lg">
        <h2 class="text-lg font-semibold text-green-800">Favorites</h2>
        <p class="text-2xl font-bold">{{ favoriteCount }}</p>
      </div>

      <div class="p-4 bg-purple-100 rounded-lg">
        <h2 class="text-lg font-semibold text-purple-800">Recently Added</h2>
        <p class="text-2xl font-bold">{{ recentClothes.length }}</p>
      </div>
    </div>

    <!-- Recently Added Clothes -->
    <div class="mt-8">
      <h2 class="text-xl font-bold text-gray-800">Recently Added</h2>
      <ul v-if="recentClothes.length" class="mt-4">
        <li v-for="(item, index) in recentClothes" :key="index" class="p-3 bg-gray-100 rounded-lg mb-2">
          {{ item.name }} - {{ item.category }}
        </li>
      </ul>
      <p v-else class="text-gray-500 mt-2">No recent additions.</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";

const clothes = ref([]);

// Total number of clothes
const totalClothes = computed(() => clothes.value.length);

// Count clothes marked as favorite
const favoriteCount = computed(() => clothes.value.filter(item => item.isFavorite).length);

// Recently added: assumes the array is in chronological order; takes the last three items
const recentClothes = computed(() => {
  return clothes.value.slice(-3).reverse();
});

onMounted(async () => {
  try {
    const response = await axios.get("/clothes");
    clothes.value = response.data;
  } catch (error) {
    console.error("Error fetching clothes", error);
  }
});
</script>

<style scoped>
/* Custom styling (if needed) */
</style>
