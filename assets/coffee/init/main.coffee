module.exports = ->
  queue = $(document.body).attr('class').split ' '

  actions =
    before: require './before'
    after: require './after'
    common: require './common'
    home: require './home'
    # 'template-name': require './template-name'
    # 'page-slug': require './page-slug'

  actions.before()
  actions.common()

  for action in queue
    actions[action]?.call()

  actions.after()
