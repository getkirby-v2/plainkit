queue = document.body.className.split ' '

playbook =
  before: require 'init/before'
  after: require 'init/after'
  common: require 'init/common'
  home: require 'init/home'
  # 'template-name': require './template-name'
  # 'page-slug': require './page-slug'

playbook.before()
playbook.common()

for hook in queue
  if hook in Object.keys playbook
    action = playbook[hook]

    if Array.isArray action
      action[task].call() for task of action
    else
      action.call()

playbook.after()
