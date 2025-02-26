 <!-- SortingSearching.vue -->
 <template>
  <div class="p-4">
    <h2 class="text-xl font-bold">Search & Sort Clothes</h2>
    
    <input
      v-model="searchQuery"
      @input="filterClothes"
      type="text"
      placeholder="Search clothes..."
      class="border p-2 w-full rounded-md mb-2"
    />
    
    <select v-model="selectedSort" @change="sortClothes" class="border p-2 rounded-md">
      <option value="name">Sort by Name</option>
      <option value="category">Sort by Category</option>
    </select>
  </div>
</template>

<script setup>
import { ref, defineEmits } from "vue";

const searchQuery = ref("");
const selectedSort = ref("name");
const emit = defineEmits(["search", "sort"]);

const filterClothes = () => {
  emit("search", searchQuery.value);
};

const sortClothes = () => {
  emit("sort", selectedSort.value);
};
</script>
