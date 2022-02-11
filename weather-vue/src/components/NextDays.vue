<template>
    <div class="next-5-days">
        <div class="next-5-days__title">Next 7 days</div>
        <div class="table" id="results">
            <template v-if="showLoading">
                <div class="loader large" style="margin: auto;"></div>
            </template>
            <template v-else>
                <div class='table_row' v-for="dailyWeatherItems in dailyWeather" :key="dailyWeatherItems.date">
                    <div class='table_small'>
                        <div class='table_cell'>
                            <div>{{dailyWeatherItems.day}}</div>
                            <div>{{dailyWeatherItems.date}}</div>
                        </div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>
                            <img :src="dailyWeatherItems.icon" class="next-5-days__icon" alt="">
                        </div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>
                            <div class="table_cell_value">{{dailyWeatherItems.low}}</div>
                            <div class="table_cell_name">Low</div>
                        </div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>
                            <div class="table_cell_value">{{dailyWeatherItems.high}}</div>
                            <div class="table_cell_name">High</div>
                        </div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>
                            <div class="table_cell_value">{{dailyWeatherItems.wind}}</div>
                            <div class="table_cell_name">Wind</div>
                        </div>
                    </div>
                    <div class='table_small'>
                        <div class='table_cell'>
                            <div class="table_cell_value">{{dailyWeatherItems.rain}}</div>
                            <div class="table_cell_name">Rain</div>
                        </div>
                    </div>
                </div>
            </template>


        </div>
    </div>
</template>

<script>
export default {
  name: 'NextDays',
  props: ['dailyWeather','showLoading'],
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
.next-5-days__title {
    margin: 0;
    font-size: 2em;
    font-weight: 600;
}
  .table {

    width: 100%;
    border-collapse: separate;
    font-family: 'Roboto', sans-serif;
    font-weight: 400;


  }

  .table_row {
    text-align: center;
    display: flex;
    background-color: rgba(0, 0, 0, 0.2);
    color: #e5e5e5;
    flex-direction: row;
    align-items: center;
    width: 100%;
    height: 5em;
    margin-bottom: 5px;
  }

  .table_small {
    width: 100%;
    color: #e5e5e5;
  }

    .table_row .next-5-days__icon {
        width: 90px;
    }

  @media screen and (max-width: 650px) {

    .table {
      text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow-x: auto;
    }
    .table_row {
      background: none;
      padding: 20px 2px;
        background-color: rgba(0,0,0, 0.2);
        border-radius: 15px;
        margin: 5px;
        min-height: 217px;
    }
    .table_row:nth-child(2n+3) {
      background: none;
      padding: 20px 2px;
        background-color: rgba(0,0,0, 0.2);
        border-radius: 15px;
        margin: 5px;
        min-height: 217px;
    }
    .table_row > .table_small > .next-5-days__icon {
        width: 60px;
    }
    .table_row > .table_small > .table_cell:nth-child(odd) {
      display: table-cell;
      width: 100%;
    }

    .table_row > .table_small:nth-child(4) ~ .table_small {
        display: none;
    }

    .table_row > .table_small:nth-child(3) {
        float:left;
        width: 50%;
        clear: none;

    }
    .table_row > .table_small:nth-child(3) .table_cell {
        float:left;
        text-align: right;
    }

    .table_row > .table_small:nth-child(3) .table_cell_value:after {
        content: " - ";
    }

    .table_row > .table_small:nth-child(3) .table_cell_name {
        display: none
    }
    // .table_row > .table_small:nth-child(4) .table_cell_value {
    //     width: 50%;
    // }
    .table_row > .table_small:nth-child(4) .table_cell_name {
        display: none
    }
    .table_row > .table_small:nth-child(4) {
        padding-left:5px;
        float: right;
        width: 50%;
        clear: none;
    }
    .table_cell {
      display: table-cell;
      width: 50%;
    }
    .table_row {
      display: table;
      width: 20%;
      text-align: center;
      float: left;
    }
    .table_small {
      display: table-row;
    }
    .table_row > .table_small:first-child > .table_cell:last-child {
        border: none;
    }
    .table_row > .table_small > .table_cell:first-child {
        border: none;
    }
    .table_row > .table_small:first-child > .table_cell:first-child {
        border: none;
    }
    .table_row > .table_small:first-child > .table_cell:last-child {
        border: none;
    }
    .table_row > .table_small:last-child > .table_cell:first-child {
        border: none;
    }
    .table_row > .table_small > .table_cell:last-child {
        border: none;
    }
    .table_row > .table_small:last-child > .table_cell:first-child {
        border: none;
    }
    .table_row > .table_small:last-child > .table_cell:last-child {
        border: none;
    }
  }
</style>
