<template>
    <div class="current-stats">
        <div v-for="statsDataItems in statsData" :key="statsDataItems.name" class="stats-items">
            <template v-if="showLoading">
                <div class="loader small"></div>
            </template>
            <template v-else>
                <div class="current-stats__value">
                    {{ statsDataItems.value }}
                </div>
                <div class="current-stats__name">{{ statsDataItems.name }}</div>
            </template>
        </div>
    </div>

</template>

<script>
export default {
  name: 'CurrentStats',
  props: ['statsData','showLoading']
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
.current-stats {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
}
.stats-items {
    flex: 1 1 30%;
    padding: 10px;
}
.current-stats__value {
    font-size: 1.4em;
    font-weight: bold;
}
.current-stats__name {
    font-size: 0.9em;
}
</style>
