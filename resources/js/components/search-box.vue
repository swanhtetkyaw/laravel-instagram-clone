<template>
  <div class="ml-5" style="z-index: 100">
    <div class="input-group d-flex" style="width: 200px">
      <input
        type="text"
        class="form-control"
        @input="searchUser"
        v-model="name"
        placeholder="name.."
      />
      <div id="input-btn" class="input-group-prepend">
        <span class="input-group-text">{{box}}</span>
      </div>
    </div>
    <div style="position: absolute" v-if="matches.length > 0">
      <div
        id="user-box"
        style="width: 200px; display:flex; border: 1px solid aquamarine; align-items: center;"
        @click="redirectProfile(match.id)"
        v-for="match in matches"
        :key="match.length"
      >
        <img :src="'/storage/'+ match.image" class="rounded-circle" width="35px" />
        <p style="padding-top: 10px; flex:1; margin-left: 10px">{{match.username}}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      box: "search",
      name: "",
      status: "",
      matches: []
    };
  },
  methods: {
    searchUser() {
      axios
        .get("/api/users")
        .then(response => {
          let states = response.data.data;
          // console.log(states.data);
          this.matches = states.filter(state => {
            // console.log(state);
            const regx = new RegExp(`^${this.name}`, "gi");
            return state.username.match(regx);
          });
          if (this.name.length == 0) {
            this.matches = [];
          }
          console.log(this.matches[0].username);
        })
        .catch(e => {
          console.log(e);
        });
    },
    redirectProfile(id) {
      // console.log(id);
      window.location = "/profile/" + id;
    }
  }
};
</script>

<style scoped>
#input-btn {
  cursor: pointer;
}
#user-box:hover {
  background-color: aquamarine;
  cursor: pointer;
}
</style>