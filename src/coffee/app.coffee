queue = document.body.className.split ' '

actions =
  before: require 'init/before'
  after: require 'init/after'
  common: require 'init/common'
  home: require 'init/home'
  # 'template-name': require './template-name'
  # 'page-slug': require './page-slug'

actions.before()
actions.common()

for action in queue
  actions[action]?.call()

actions.after()
