<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config
set('ssh_type', 'native');
set('ssh_multiplexing', false);
set('git_tty', false);

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts
//FaithFlow
host('production')
    ->set('hostname', '206.189.231.7')
    ->set('remote_user', 'manifest')
    ->set('deploy_path', '/var/www/faithflow.yensoftgh.com');


    task('deploy', [
        // 'deploy:unlock',
        'deploy:prepare',
        'deploy:vendors',
        'artisan:storage:link',
        'artisan:view:cache',
        'artisan:config:cache',
        'artisan:migrate',
        // 'artisan:db:seed',
        // 'npm:install',
        // 'npm:run:prod',
        'deploy:publish',
        //  'php-fpm:reload',
    ]);

// Hooks

after('deploy:failed', 'deploy:unlock');
