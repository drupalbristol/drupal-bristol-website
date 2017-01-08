from fabric.api import task, env, run, local, lcd, cd
from fabric.contrib.files import exists
from fabric.contrib.project import rsync_project

env.use_ssh_config = True

project_root = '/var/www/drupalbristol'
drupal_root = '%s/web' % project_root

@task
def build_deploy():
  init()
  file_permissions()
  build()
  deploy()
  post_deploy()
  file_permissions()

def init():
  if not exists('%s' % project_root):
    run('sudo mkdir -p %s' % project_root)
    run('sudo mkdir -p %s/backups' % project_root)
    run('sudo mkdir -p %s/logs' % project_root)
    file_permissions()

def build():
  local('composer install --no-dev --optimize-autoloader')
  with lcd('web/themes/custom/drupalbristol'):
    local('yarn --pure-lockfile')
    local('./node_modules/.bin/bower install')
    local('./node_modules/.bin/gulp --production')

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

def post_deploy():
  with cd('%s' % drupal_root):
    run('drush -y config-import')
    run('drush -y updatedb')
    run('drush cache-rebuild')
