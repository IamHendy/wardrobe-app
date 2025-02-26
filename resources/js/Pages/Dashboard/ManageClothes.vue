<!-- ManageClothes.vue -->
<template>
  <div class="p-6 bg-white shadow-md rounded-lg relative">
    <h1 class="text-2xl font-bold text-gray-800">Manage Clothes</h1>
    <p class="text-gray-600 mt-2">Add, edit, categorize, and manage your wardrobe items.</p>

    <!-- Toast Notification -->
    <div
      v-if="toast.show"
      :class="['fixed top-4 right-4 px-4 py-2 rounded-md shadow-md text-white', toast.color]"
      class="transition-opacity duration-300"
    >
      {{ toast.message }}
    </div>

    <!-- Add Clothes Form (only if not in search mode) -->
    <form
      v-if="!searchMode"
      @submit.prevent="editingIndex !== null ? updateCloth() : addCloth()"
      class="mt-6 bg-gray-100 p-4 rounded-lg"
      enctype="multipart/form-data"
    >
      <h2 class="text-lg font-bold text-gray-700">
        {{ editingIndex !== null ? "Edit Cloth" : "Add New Cloth" }}
      </h2>

      <div class="mt-4">
        <label class="block text-gray-600">Cloth Name:</label>
        <input
          type="text"
          v-model="currentCloth.name"
          class="w-full p-2 border rounded-md"
          required
        />
      </div>

      <div class="mt-4">
        <label class="block text-gray-600">Category:</label>
        <select
          v-model="currentCloth.category"
          class="w-full p-2 border rounded-md"
          required
        >
          <option v-for="category in categories" :key="category" :value="category">
            {{ category }}
          </option>
        </select>
      </div>

      <div class="mt-4 flex items-center">
        <input type="checkbox" v-model="currentCloth.isFavorite" class="mr-2" />
        <label class="text-gray-600">Mark as Favorite</label>
      </div>

      <div class="mt-4">
        <label class="block text-gray-600">Upload Image:</label>
        <input
          type="file"
          @change="handleImageUpload($event)"
          class="w-full p-2 border rounded-md"
          accept="image/*"
        />
        <img
          v-if="currentCloth.imageUrl"
          :src="currentCloth.imageUrl"
          class="mt-2 w-32 h-32 object-cover rounded-md"
        />
      </div>

      <button
        type="submit"
        class="mt-4 bg-gradient-to-r from-pink-500 to-black text-white px-4 py-2 rounded-lg"
      >
        {{ editingIndex !== null ? "Update Cloth" : "Add Cloth" }}
      </button>

      <button
        v-if="editingIndex !== null"
        @click="cancelEdit"
        type="button"
        class="mt-4 ml-2 bg-gray-500 text-white px-4 py-2 rounded-lg"
      >
        Cancel
      </button>
    </form>

    <!-- Clothes List -->
    <div class="mt-8">
      <h2 class="text-xl font-bold text-gray-800">Your Clothes</h2>
      <ul v-if="filteredClothes.length" class="mt-4">
        <li
          v-for="item in filteredClothes"
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
              <span v-if="item.isFavorite" class="ml-2 text-red-500">❤️</span>
            </div>
          </div>
          <!-- Only show edit/delete if not in search mode -->
          <div v-if="!searchMode">
            <button @click="editCloth(item)" class="text-blue-500 mr-2">Edit</button>
            <button @click="deleteCloth(item)" class="text-red-500">Delete</button>
          </div>
        </li>
      </ul>
      <p v-else class="text-gray-500 mt-2">No clothes added yet.</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";

// Define props for search mode functionality
const props = defineProps({
  searchMode: { type: Boolean, default: false },
  searchQuery: { type: String, default: "" },
  selectedSort: { type: String, default: "name" },
});

// Local state for managing clothes
const clothes = ref([]);
const categories = ["Tops", "Pants", "Dresses", "Shoes", "Outerwear", "Accessories"];
const currentCloth = ref({ name: "", category: "", isFavorite: false, imageUrl: null, imageFile: null });
const editingIndex = ref(null);
const toast = ref({ show: false, message: "", color: "" });

const showToast = (message, type) => {
  toast.value = {
    show: true,
    message,
    color: type === "success" ? "bg-green-500" : "bg-red-500",
  };
  setTimeout(() => {
    toast.value.show = false;
  }, 3000);
};

const fetchClothes = async () => {
  try {
    const response = await axios.get("/clothes");
    clothes.value = response.data;
  } catch (error) {
    showToast("Error fetching clothes", "error");
  }
};

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = (e) => {
    currentCloth.value.imageUrl = e.target.result;
    currentCloth.value.imageFile = file;
  };
  reader.readAsDataURL(file);
};

const addCloth = async () => {
  const formData = new FormData();
  formData.append("name", currentCloth.value.name);
  formData.append("category", currentCloth.value.category);
  formData.append("isFavorite", currentCloth.value.isFavorite ? "1" : "0");
  if (currentCloth.value.imageFile) formData.append("image", currentCloth.value.imageFile);

  try {
    const response = await axios.post("/clothes", formData);
    clothes.value.push(response.data);
    resetForm();
    showToast("Cloth added successfully!", "success");
  } catch (error) {
    showToast("Error adding cloth", "error");
  }
};

const editCloth = (item) => {
  const index = clothes.value.findIndex((cloth) => cloth.id === item.id);
  if (index !== -1) {
    editingIndex.value = index;
    currentCloth.value = { ...clothes.value[index] };
  }
};

const updateCloth = async () => {
  try {
    const response = await axios.put(`/clothes/${clothes.value[editingIndex.value].id}`, currentCloth.value);
    clothes.value[editingIndex.value] = response.data;
    cancelEdit();
    showToast("Cloth updated successfully!", "success");
  } catch (error) {
    showToast("Error updating cloth", "error");
  }
};

const deleteCloth = async (item) => {
  const index = clothes.value.findIndex((cloth) => cloth.id === item.id);
  if (index !== -1) {
    try {
      await axios.delete(`/clothes/${item.id}`);
      clothes.value.splice(index, 1);
      showToast("Cloth deleted successfully!", "success");
    } catch (error) {
      showToast("Error deleting cloth", "error");
    }
  }
};

const cancelEdit = () => {
  editingIndex.value = null;
  resetForm();
};

const resetForm = () => {
  currentCloth.value = { name: "", category: "", isFavorite: false, imageUrl: null, imageFile: null };
};

onMounted(fetchClothes);

// Compute the filtered and sorted list when in search mode
const filteredClothes = computed(() => {
  let result = clothes.value;
  if (props.searchMode && props.searchQuery) {
    result = result.filter((item) =>
      item.name.toLowerCase().includes(props.searchQuery.toLowerCase()) ||
      item.category.toLowerCase().includes(props.searchQuery.toLowerCase())
    );
  }
  if (props.searchMode && props.selectedSort) {
    if (props.selectedSort === "category") {
      result = result.slice().sort((a, b) => a.category.localeCompare(b.category));
    } else if (props.selectedSort === "name") {
      result = result.slice().sort((a, b) => a.name.localeCompare(b.name));
    }
  }
  return result;
});
</script>
