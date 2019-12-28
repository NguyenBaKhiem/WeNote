<template>
  <div class="" id="menu">
    <div class="content">
      <h1>Notifications</h1>
    </div>
  </div>
</template>
<script>
  import { mapState } from 'vuex';

  import Const from 'common/Const';
  
  export default {
    data() {
      return {
        isAuthenticated: window.isAuthenticated,
      }
    },
    computed: {
      ...mapState(['user', 'usersOnline']),
    },
    methods: {

    }
  }
</script>