<!-- SearchAndSort.vue -->
<template>
    <div>
      <!-- Search and sort controls -->
      <SortingSearching @search="handleSearch" @sort="handleSort" />
      <!-- ManageClothes in search mode using passed props -->
      <ManageClothes :search-mode="true" :search-query="searchQuery" :selected-sort="selectedSort" />
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import SortingSearching from './SortingSearching.vue';
  import ManageClothes from './ManageClothes.vue';
  
  const searchQuery = ref('');
  const selectedSort = ref('name');
  
  const handleSearch = (query) => {
    searchQuery.value = query;
  };
  
  const handleSort = (sort) => {
    selectedSort.value = sort;
  };
  </script>
  