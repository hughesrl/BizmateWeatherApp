<template>
    <div class="location-and-date">
        <div class="location-and-date__title">
            <LocationDropDown @changeLocation="changeLocation"></LocationDropDown>
            <div>{{ info.date }}</div>
        </div>
    </div>
</template>

<script>
import LocationDropDown from "./LocationDropDown.vue";
export default {
  name: 'LocationAndDate',
  components: {
    LocationDropDown
    // NextDays
  },
  props: ['info'],
  methods: {
    changeLocation(newLocation) {
        this.$emit('mainChangeLocation', newLocation);
    }
  }
}
</script>

<style scoped lang="scss">
.location-and-date {
  width: 100%;
}
.location-and-date__location {
  margin: 0;
  font-size: 2em;
  font-weight: 600;
}
</style>
