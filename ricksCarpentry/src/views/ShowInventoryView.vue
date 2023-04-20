<template>
    <div>
        <ShowInventory>
        </ShowInventory>
    </div>
  </template>
  
  <script>
  // @ is an alias to /src
  import ShowInventory from '@/components/ShowInventory.vue'
  
  export default {
    name: 'ShowInventoryView',
    components: {
    ShowInventory
}
  }
  </script>