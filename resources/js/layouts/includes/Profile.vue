<template>
    <div
  
    >
        <v-menu
          button
          offset-y
          content-class="bubble-menu"
          style="z-index:999"
        >
          <template
            v-slot:activator="{ on }"
          >
            <v-avatar
              color="white"
              v-on="on"
              size="32"
              class="clicker"
            >
             
            </v-avatar>
          </template>
           <v-list
              dense
              class="clicker"
            >
              <v-list-item
                dense
                class="text-capitalize"
              >
                edit profile
              </v-list-item>
              <v-list-item
                dense
                class="text-capitalize"
                @click="logout"
              >
                logout
              </v-list-item>
            </v-list>
        </v-menu>
    </div>
  </template>
  <script>
  import logo from '../../assets/logocard.png'
  export default {
    data(){
      return {
        logo
      }
    },
    methods:{
      logout(){
        localStorage.setItem('token', '')
        location.reload();
      }
    }
  }
  </script>
  
  