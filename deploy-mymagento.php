<?php
namespace Deployer;

require 'recipe/magento2.php';

// Project name
set('application', 'sample_project');

// Project repository
set('repository', 'https://github.com/shanahmed-snap/mymagento.git');
set('default_stage', 'staging');
set('static_content_locales', 'en_US');
set('static_content_jobs', '1');
set('verbose', '-vvv');
set('config_folder', 'app/etc/');



// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
// set('shared_files', [
//     'app/etc/env.php',
//     'var/.maintenance.ip',
// ]);
// set('shared_dirs', []);
// Writable dirs by web server 
// set('writable_dirs', []);
set('allow_anonymous_stats', false);
// Env Configurations
set('php', '/usr/bin/php');
// set('bin/composer', '/home/magento/domains/deployer_test/oursnapshop.com/util/composer.phar');
set('compile_UAT', 0);
set('assets_parallel_jobs',2);
set('default_timeout','1200');
set('keep_releases', 2);
set('writable_mode', 'chmod');
// Hosts

host('Staging')
->hostname('34.211.251.99')
->user('ubuntu')
->port(22)
->set('deploy_path', '/opt/magento2')
->set('branch', 'master')
->stage('staging')
->set('is_production', 0)
->roles('roles  ')
//->configFile('~/.ssh/config')
->identityFile('snap-ecommerce-dev.pem')
->addSshOption('UserKnownHostsFile', '/dev/null')
->addSshOption('StrictHostKeyChecking', 'no');
    

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:configurations',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');


desc('Copying Configurations');
task('deploy:configurations', function () {
    run("cp -r {{deploy_path}}/{{config_folder}}/env.php  {{release_path}}/app/etc");
});