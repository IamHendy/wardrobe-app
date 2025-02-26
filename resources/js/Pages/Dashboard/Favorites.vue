<!-- Favorites.vue -->
<template>
  <div class="p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold">Favorites</h1>
    <p class="text-gray-700 mt-2">Your favorite clothes collection.</p>

    <div class="mt-6">
      <ul v-if="favoriteClothes.length">
        <li
          v-for="item in favoriteClothes"
          :key="item.id"
          class="p-3 bg-gray-100 rounded-lg mb-2 flex justify-between items-center"
        >
          <div class="flex items-center">
            <img
              v-if="item.imageUrl"
              :src="item.imageUrl"
              class="w-12 h-12 object-cover rounded-md mr-2"
            />
            <div>
              <span class="font-bold">{{ item.name }}</span>
              - <span class="text-gray-600">{{ item.category }}</span>
            </div>
          </div>
          <button @click="removeFavorite(item)" class="text-red-500">
            Remove ❌
          </button>
        </li>
      </ul>
      <p v-else class="text-gray-500 mt-2">No favorites yet.</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";

// Holds all clothes loaded from your API
const clothes = ref([]);

// Fetch all clothes on component mount
const fetchClothes = async () => {
  try {
    const response = await axios.get("/clothes");
    clothes.value = response.data;
  } catch (error) {
    console.error("Error fetching clothes", error);
  }
};

onMounted(fetchClothes);

// Computed property that filters out favorites based on the isFavorite flag
const favoriteClothes = computed(() => {
  return clothes.value.filter((item) => item.isFavorite);
});

// Remove a favorite by updating the isFavorite flag to false in the backend
const removeFavorite = async (item) => {
  try {
    // Create an updated item with isFavorite set to false
    const updatedItem = { ...item, isFavorite: false };
    const response = await axios.put(`/clothes/${item.id}`, updatedItem);
    // Update the local clothes array with the new item data
    clothes.value = clothes.value.map((cloth) =>
      cloth.id === item.id ? response.data : cloth
    );
  } catch (error) {
    console.error("Error updating favorite", error);
  }
};
</script>

