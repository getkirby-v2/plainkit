queue = document.body.dataset.action.split ' '

playbook =
  before: require 'init/before'
  after: require 'init/after'
  common: require 'init/common'
  default: require 'init/default'

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
