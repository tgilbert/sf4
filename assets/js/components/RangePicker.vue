<template lang="html">
  <div class="">
    <div class="rangepicker">
        <div class="rangerpicker_month" v-for="month in months" :key="month.index">
            <div class="rangepicker_monthtitle">
                {{ month.getName() }}
            </div>
            <div class="rangepicker_days">
                <div>Lun</div>
                <div>Mar</div>
                <div>Mer</div>
                <div>Jeu</div>
                <div>Ven</div>
                <div>Sam</div>
                <div>Dim</div>
            </div>
            <div class="rangepicker_numbers">
                <div class="rangerpicker_day"
                     @mousedown="startDrag(day)"
                     @mouseover="overDay(day)"
                     @mouseup="endDrag()"
                     @dblclick="deleteZone(day)"
                     v-for="day in month.getDays()" :key="day.index"
                     :class="classForDay(day, month, newRange)">
                  {{ day.getDate() }}
                </div>
            </div>
        </div>
    </div>
    <div class="rangepicker_actions">
      <button class="rangepicker_cancel" @click="cancel">Annuler</button>
      <button class="rangepicker_submit" @click="submit">Enregistrer</button>
    </div>
  </div>
</template>

<script>
import Month from './Month.js'
import Ranges from './Ranges.js'
import Range from './Range.js'

export default {
  data () {
    return {
      months: [],
      ranges: [],
      newRange: null,
      cursor: 1,
      startDate: null
    }
  },
  mounted () {
    this.ranges = Ranges.fromTimestamps(this.value)
    this.months = Month.createMonthsForYear(this.year)
  },
  props: {
    year: Number,
    value: Array
  },
  methods: {
    classForDay (day, month, newRange) {
      let classes = []
      let range = this.ranges.contains(day)
      if (range !== null) {
        classes.push('rangepicker_range')
        if (range.isStart(day)) {
          classes.push('rangepicker_range-start')
        }
        if (range.isEnd(day)) {
          classes.push('rangepicker_range-end')
        }
      }
      if (newRange !== null) {
        if (newRange.contains(day)) {
          classes = ['rangepicker_newrange']
          if (newRange.isStart(day)) {
            classes.push('rangepicker_range-start')
          }
          if (newRange.isEnd(day)) {
            classes.push('rangepicker_range-end')
          }
        }
      }
      if (!month.contains(day)) {
        classes.push('rangepicker_out')
      }
      return classes
    },
    startDrag (day) {
      let range = this.ranges.contains(day)
      if (range) {
        if (range.isStart(day)) {
          this.newRange = range
          this.ranges.removeRange(range)
          this.startDate = range.getEnd()
          this.cursor = 0
        } else if (range.isEnd(day)) {
          this.newRange = range
          this.ranges.removeRange(range)
          this.startDate = range.getStart()
          this.cursor = 1
        }
      } else {
        this.startDate = day
        this.newRange = new Range(day, day)
      }
    },
    overDay (day) {
      if (this.newRange !== null) {
        try {
          if (this.cursor === 1) {
            this.newRange.setEnd(day)
          } else {
            this.newRange.setStart(day)
          }
        } catch (e) {
          this.cursor = Math.abs(this.cursor - 1)
          this.newRange = new Range(this.startDate, this.startDate)
          this.overDay(day)
        }
      }
    },
    endDrag () {
      this.ranges.addRange(this.newRange)
      this.newRange = null
    },
    deleteZone (day) {
      let range = this.ranges.contains(day)
      if (range) {
        this.ranges.removeRange(range)
      }
    },
    cancel () {
      this.$emit('cancel')
    },
    submit () {
      this.$emit('input', this.ranges.toTimestamps())
      this.$emit('submit')
    }
  }
}
</script>
