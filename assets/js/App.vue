<template>
  <div id="app">
    <button @click="prevYear"><</button>
    {{ year }}
    <button @click="pickerShow">Afficher le calendrier</button>
    <button @click="save">Save</button>
    <button @click="nextYear">></button>
    <div v-if="isPickerVisible" style="position: static;top: 0;left: 0;right: 0;bottom: 0;overflow: scroll;">
      <range-picker :key="year" :year=year v-model="ranges" @cancel="pickerHide" @submit="pickerHide"/>
    </div>
  </div>
</template>

<script>

import RangePicker from './components/RangePicker'

export default {
  name: 'App',
  data () {
    return {
      isPickerVisible: false,
      ranges: [],
      year: 2018
    }
  },
  mounted () {
    this.ranges = window.rangersBD
    if (this.ranges.length == 0) {
      this.ranges = [ [ 1519945200, 1519945200 ], [ 1517180400, 1518649200 ] ]
    }
  },
  components: {
    RangePicker
  },
  methods: {
    pickerShow () {
      this.isPickerVisible = true
    },
    pickerHide () {
      this.isPickerVisible = false
    },
    prevYear () {
      this.year = this.year-1
      this.$emit('reload')
    },
    nextYear () {
      this.year = this.year+1
      this.$emit('reload')
    },
    save () {
      let r = Routing.generate('home_save', { date: this.ranges })
      location.href = r
    }
  }
}
</script>
