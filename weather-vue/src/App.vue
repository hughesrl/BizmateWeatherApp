<template>
  <div id="app" class="main-container">
    <LocationAndDate :info="locationDate" :showLoading="showLoading" @mainChangeLocation="mainChangeLocation"></LocationAndDate>
    <CurrentTemp :info="currentTemp" :showLoading="showLoading"></CurrentTemp>
    <CurrentStats :statsData="currentStats" :showLoading="showLoading"></CurrentStats>
    <div class="sm-divider">
        <hr />
    </div>

    <WeatherByHour :hourlyWeather="hourlyWeather" :showLoading="showLoading"></WeatherByHour>
    <div class="sm-divider">
        <hr />
    </div>
    <NextDays :dailyWeather="dailyWeather" :showLoading="showLoading"></NextDays>
  </div>
</template>

<script>
import LocationAndDate from './components/LocationAndDate.vue'
import CurrentTemp from './components/CurrentTemp.vue'
import CurrentStats from './components/CurrentStats.vue'
import WeatherByHour from './components/WeatherByHour.vue'
import NextDays from './components/NextDays.vue'

import { mapGetters, mapActions } from "vuex";

export default {
  name: 'App',
  components: {
    LocationAndDate,
    CurrentTemp,
    CurrentStats,
    WeatherByHour,
    NextDays
  },
  mounted() {
    this.getMainWeather('tokyo,jp');
  },
  computed: {
    ...mapGetters([
        "locationDate",
        "currentTemp",
        "currentStats",
        "hourlyWeather",
        "dailyWeather",
        "showLoading",
    ])
  },
  methods: {
    ...mapActions([
        "getMainWeather",
    ]),
    mainChangeLocation(newLocation) {

        this.getMainWeather(newLocation.value);

        // this.getHourlyWeather({
        //     lat: newLocation.lat,
        //     lon: newLocation.lon,
        // })
    }
  }
}
</script>

<style lang="scss">
    @import "@/styles/app.scss";
</style>

<style lang="scss">
// #app {
//   font-family: Avenir, Helvetica, Arial, sans-serif;
//   -webkit-font-smoothing: antialiased;
//   -moz-osx-font-smoothing: grayscale;
//   text-align: center;
//   color: #2c3e50;
//   margin-top: 60px;
// }
</style>
