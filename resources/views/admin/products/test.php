<template>

  <div>


    <draggable v-model="items" @end="onEnd">

      <div v-for="item in items" :key="item.id">

        {{ item.name }}

      </div>

    </draggable>

    <button @click="saveOrder">保存</button>

  </div>

</template>

<script>
  import draggable from 'vuedraggable';


  import axios from 'axios';

  export default {

    components: {
      draggable
    },

    data() {

      return {

        items: [

          {
            id: 1,
            name: "Item 1"
          },

          {
            id: 2,
            name: "Item 2"
          },

          {
            id: 3,
            name: "Item 3"
          },

        ],

      };

    },

    methods: {

      onEnd() {

        console.log("New order:", this.items);

      },

      async saveOrder() {

        try {

          await axios.post('/api/items/order', {
            items: this.items
          });

          alert("Order saved!");

        } catch (error) {

          console.error(error);

          alert("Failed to save order.");

        }

      },

    },

  };