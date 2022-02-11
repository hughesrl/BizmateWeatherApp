<template>
<div class="location-dropdown">
    <h1 class="selected location-and-date__location" @click="toggle">{{ selected }}</h1>
    <div class="options" v-show="isOpen">
        <div class="option" v-for="dropdownLocationItems in dropdownLocation" :key="dropdownLocationItems.name" @click="set(dropdownLocationItems)">
            <h1 class="location-and-date__location">{{ dropdownLocationItems.name }}</h1>
        </div>
    </div>
</div>
</template>

<script>
export default {
  name: 'LocationDropDown',
  props: {
    msg: String
  },
  data: () => ({
      dropdownLocation: [
          { name: "Tokyo, JP", value: "tokyo,jp"},
          { name: "Yokohama, JP", value: "yokohama,jp"},
          { name: "Kyoto, JP", value: "kyoto,jp"},
          { name: "Osaka, JP", value: "osaka,jp"},
          { name: "Sapporo, JP", value: "sapporo,jp"},
          { name: "Nagoya, JP", value: "nagoya,jp"}
      ],
      isOpen: false,
      selected: "Tokyo, JP",
  }),
  methods: {
    toggle: function() {
      this.isOpen = !this.isOpen;
    },
    show: function() {
      this.isOpen = true;
    },
    hide: function() {
      this.isOpen = false;
    },
    set: function(option) {
      this.selected = option.name;

      this.$emit('changeLocation', option);
      this.hide();
    }
  }
}
</script>

<style scoped lang="scss">
.location-dropdown {
    cursor: pointer;
    position: relative;
    padding: 10px 0px;
    width: auto;
}
.location-and-date .options {
    position: absolute;
    background-color: #1488cc;
    border-radius: 15px;
    // padding: 10px;
    font-size: 15px;
}
.selected:after {
  opacity: 0.5;
  display: inline-block;
  margin-left: 10px;
  content: '▼';
}

/* Hover state */
.selected:hover:after {
  opacity: 1;
}

.option {
  padding: 5px 20px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.25);
  font-size: 0.8rem;
}

/* Hover state */
.option:hover {
  background-color: rgba(0, 0, 0, 0.05);
}

/* Reset last child for a nice layout */
.option:last-child {
  border-bottom: none;
}

/* Transition */
.fade-enter-active, .fade-leave-active {
  transition: all .25s ease-out;
}

.fade-enter, .fade-leave-active {
  opacity: 0;
  transform: translateY(-30px);
}

</style>
