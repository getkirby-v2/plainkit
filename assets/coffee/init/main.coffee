module.exports = ->
  template = $(document.body).data('template')

  actions =
    before: require './before'
    after: require './after'
    common: require './common'
    home: require './home'

  actions.before()
  actions.common()
  actions[template]?.call()
  actions.after()
