<script setup>
const emit = defineEmits(['navigate']);

const menuItems = [
  { name: "Overview", icon: "🏠" },
  { name: "ManageClothes", icon: "👗" },
  { name: "Search", icon: "🔍" },
  { name: "Favorites", icon: "❤️" },
];
</script>

<template>
  <div class="w-64 bg-black text-white h-full p-4">
    <h2 class="text-xl font-bold mb-4">Wardrobe Manager</h2>
    
    <ul>
      <li
        v-for="item in menuItems"
        :key="item.name"
        @click="$emit('navigate', item.name)"
        class="p-3 hover:bg-gray-800 cursor-pointer flex items-center space-x-2 rounded-md"
      >
        <span>{{ item.icon }}</span>
        <span>{{ item.name }}</span>
      </li>
    </ul>
  </div>
</template>
