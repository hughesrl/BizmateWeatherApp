<template>
    <v-layout wrap class="current-temperature" fill-height>
        <template v-if="showLoading">
            <div class="loader large"></div>
        </template>
        <template v-else>
            <v-flex xs6 sm6 class="pa-1">
                <img :src="info.icon" class="current-temperature__icon" alt="">
            </v-flex>
            <v-flex xs6 sm6 class="pa-1">
                <div class="current-temperature__value">{{info.temp}}°</div>
                <div class="current-temperature__summary">{{info.desc}}</div>
            </v-flex>
        </template>
    </v-layout>

</template>

<script>
export default {
  name: 'CurrentTemp',
  props: ['info','showLoading']
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
.current-temperature {
    min-height: 200px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    // border-right: 1px solid #fff;
}

.current-temperature__icon-container {
//   flex-grow: 1.25;
  text-align: center;
}

.current-temperature__content-container {
//   flex-grow: 1;
  text-align: center;
}

.current-temperature__icon {
  width: 10.5em;
  background-color: rgba(0,0,0, 0.2);
  border-radius: 15px;
}

.current-temperature__value {
  font-size: 7.25em;
  font-weight: bold;
}

.current-temperature__summary {
  margin-top: -0.5em;
  font-size: 2em;
}
</style>
