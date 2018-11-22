import Range from './Range.js'

export default class Ranges {
  constructor (ranges) {
    this.ranges = ranges
  }
  contains (date) {
    for (let k in this.ranges) {
      if (this.ranges[k].contains(date)) {
        return this.ranges[k]
      }
    }
    return null
  }
  addRange (newRange) {
    let merged = this.ranges.reduce((m, r) => {
      if (newRange.contains(r)) {
        this.removeRange(r)
      } else {
        if (r.intersect(newRange)) {
          r.merge(newRange)
          return true
        }
      }
      return m
    }, false)
    if (merged === false) {
      this.ranges.push(newRange)
    }
  }
  removeRange (range) {
    this.ranges = this.ranges.filter(r => r !== range)
  }
  toTimestamps () {
    return this.ranges.map(range => {
      return [range.getStart().getTime(), range.getEnd().getTime()]
    })
  }
  static fromTimestamps (ranges) {
    return new Ranges(ranges.map(range => {
      return new Range(new Date(range[0] * 1000), new Date(range[1] * 1000))
    }))
  }
}
