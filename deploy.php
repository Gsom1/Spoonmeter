<?php

namespace Deployer;


require 'recipe/symfony.php';

// Project name
set('application', 'SpoonMeter');

// Project repository
set('repository', 'https://github.com/Gsom1/Spoonmeter');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);

set('default_stage', 'hoster_test');
// Hosts
host('ssh-108036.srv.hoster.ru')
    ->stage('hoster_test')
    ->user('srv108036')
    ->set('deploy_path', '/storage/home/srv108036/srv108036.hoster-test.ru');
//Sp00nMeter

    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');

