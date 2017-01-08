from fabric.api import task, env, run
from fabric.contrib.files import exists
from fabric.contrib.project import rsync_project

env.use_ssh_config = True

project_root = '/var/www/drupalbristol'
drupal_root = '%s/web' % project_root

@task
def build_deploy():
  init()
  # build()
  deploy()
  file_permissions()

def init():
  if not exists('%s' % project_root):
    run('sudo mkdir -p %s' % project_root)
    run('sudo mkdir -p %s/backups' % project_root)
    run('sudo mkdir -p %s/logs' % project_root)
    file_permissions()

def deploy():
  rsync_project(
    remote_dir='%s/' % project_root,
    local_dir='./',
    default_opts='-vzcrSLh',
    exclude=('.git', '/backups', '/logs', '/private', '/tmp', '/web/**/local.*.php', '/web/sites/*/files', 'node_modules'),
    delete=True
  )

  run('echo %s > %s/version' % (env.build_number, project_root))

  if not exists('%s/sites/default/local.settings.php' % drupal_root):
    run('cp %s/sites/example.settings.local.php %s/sites/default/local.settings.php' % (drupal_root, drupal_root))

def file_permissions():
  run('sudo chown -R %s:%s %s' % (env.user, env.group, project_root))
