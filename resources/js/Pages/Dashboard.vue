<!-- Dashboard.vue -->
<template>
  <div v-if="$page.props.flash.message">
    <p class="p-4 bg-green-100 text-sm">{{ $page.props.flash.message }}</p>
  </div>
  
  <h1 class="title">Welcome back {{ $page.props.auth.user.name }}</h1>
  
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <Sidebar @navigate="activeComponent = $event" />
    <!-- Main Content -->
    <div class="flex-1 p-6">
      <component :is="components[activeComponent]" />
    </div>
  </div>
</template>

<script setup>
import Sidebar from './Components/Sidebar.vue';
import { ref } from 'vue';
import Overview from './Dashboard/Overview.vue';
import ManageClothes from './Dashboard/ManageClothes.vue';
import SearchAndSort from './Dashboard/SearchAndSort.vue';
import Favorites from './Dashboard/Favorites.vue';
import SettingsProfile from './Dashboard/SettingProfile.vue';

// Manage active component
const activeComponent = ref('Overview');

// Map components dynamically; note that the "Search" key now maps to SearchAndSort.vue
const components = {
  Overview,
  ManageClothes,
  Search: SearchAndSort,
  Favorites,
  SettingsProfile,
};
</script>
