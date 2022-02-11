import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';
import moment from 'moment';

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
      locationDate: {},
      currentTemp: {},
      currentStats: {},
      hourlyWeather: {},
      dailyWeather: {},
      showLoading: false
  },
  getters: {
    locationDate: state => state.locationDate,
    currentTemp: state => state.currentTemp,
    currentStats: state => state.currentStats,
    hourlyWeather: state => state.hourlyWeather,
    dailyWeather: state => state.dailyWeather,
    showLoading: state => state.showLoading,
  },
  mutations: {
    locationDate: (state, locationDate) => (state.locationDate = locationDate),
    currentTemp: (state, currentTemp) => (state.currentTemp = currentTemp),
    currentStats: (state, currentStats) => (state.currentStats = currentStats),
    hourlyWeather: (state, hourlyWeather) => (state.hourlyWeather = hourlyWeather),
    dailyWeather: (state, dailyWeather) => (state.dailyWeather = dailyWeather),
    showLoading: (state, showLoading) => (state.showLoading = showLoading),
  },
  actions: {
    async getMainWeather ({ dispatch, commit }, weatherLoc) {
        commit("showLoading", true)
		axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
		await axios.get('get-weather/'+weatherLoc).then(response => {
            if(response.data.status) {
                const resData = response.data.data;

                commit('locationDate', {
                    location: resData.title,
                    lat: resData.lat,
                    lon: response.lon,
                    date: moment().format('dddd DD MMMM')
                })
                commit('currentTemp', {
                    icon: resData.icon,
                    temp: resData.temp,
                    desc: resData.temp_desc,
                })
                commit('currentStats', [
                    { name: "High", value: resData.temp_high+"°"},
                    { name: "Wind", value: resData.wind+" mph"},
                    { name: "Sunrise", value: moment(resData.sunrise).format('HH:mm')},
                    { name: "Low", value: resData.temp_low+"°"},
                    { name: "Rain", value: resData.rain.volume+"%"},
                    { name: "Sunset", value: moment(resData.sunset).format('HH:mm')}
                ])

                dispatch('getDailyWeather', {
                    lat: resData.lat,
                    lon: resData.lon,
                });

                dispatch('getHourlyWeather', {
                    lat: resData.lat,
                    lon: resData.lon,
                });
            }
            commit("showLoading", false)
		})
		.catch(err => {
			console.log(err);
			// router.push('/');
		})
	},
    async getHourlyWeather ({ dispatch, commit }, weatherLatLon) {
        const deviceDateTime = moment().format('YYYY-MM-DD HH:mm:ss');
		axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
        commit("showLoading", true)
		await axios.get('get-hourly-weather/'+deviceDateTime+"/"+weatherLatLon.lat+"/"+weatherLatLon.lon).then(response => {
            if(response.data.status) {
                const resData = response.data.data;

                commit("hourlyWeather", resData);
            }
            commit("showLoading", false)
		})
		.catch(err => {
			console.log(err);
			// router.push('/');
		})
	},
    async getDailyWeather ({ dispatch, commit }, weatherLatLon) {
        const deviceDateTime = moment().format('YYYY-MM-DD HH:mm:ss');
		axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
        commit("showLoading", true)
		await axios.get('get-days-weather/'+weatherLatLon.lat+"/"+weatherLatLon.lon).then(response => {
            if(response.data.status) {
                const resData = response.data.data;
                commit("dailyWeather", resData);
            }
		})
		.catch(err => {
			console.log(err);
			// router.push('/');
		})
	},
  },
  modules: {
  }
})
