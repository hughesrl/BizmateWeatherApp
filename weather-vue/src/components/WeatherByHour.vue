<template>
    <div class="weather-by-hour">
        <div class="weather-by-hour__title">Todays weather</div>
        <div class="weather-by-hour-data">
            <div v-for="hourlyWeatherItems in hourlyWeather" :key="hourlyWeatherItems.datetime" class="weather-by-hours-items" :class="(hourlyWeatherItems.is_now) ? 'today' : ''">
                <template v-if="showLoading">
                    <div class="loader small" style="margin: auto;"></div>
                </template>
                <template v-else>
                    <div class="weather-by-hour-time">{{ moment(hourlyWeatherItems.datetime).format("ha") }}</div>
                    <div class="weather-by-hour-icon">
                        <img :src="hourlyWeatherItems.icon" class="current-weather-by-hour__icon" alt="">
                    </div>
                    <div class="weather-by-hour-temp">{{ hourlyWeatherItems.temp }}</div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
  name: 'WeatherByHour',
  props: ['hourlyWeather','showLoading'],
  data: () => ({
  }),
  methods: {
    changeLocation(newLocation) {
        this.$emit('mainChangeLocation', newLocation);
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

</style>
