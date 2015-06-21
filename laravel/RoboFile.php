<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * 	Suppression des fichiers de cache générés lors de la production de vues et la création de session
     */
    public function cacheClean(){
    	$this->taskCleanDir(['../app/storage/sessions','../app/storage/views','../app/storage/debugbar'])->run();
    }

    /**
     * 	Composer update
     */
    public function packageUpdate(){
    	$this->taskComposerUpdate()->run();
    }

    /**
     *  Git automatic push on multi repo / branch
     * @param $commit message for the commit
     * @param $branche branch name destination
     */
    public function repoPush( $commit, $branch ){

            $this->taskGitStack()
             ->stopOnFail()
             ->add('-A')
             ->commit( $commit )
             ->push('origin', $branch )
             ->checkout( 'master' )
             ->merge( $branch )
             ->push('origin','master')
             ->push('prod', 'master')
             ->push('--mirror', 'github')
             ->checkout( $branch )
             ->run();
    }

    /**
     * Tests
     */
    public function testUnit(){
        $this->taskPHPUnit()->run();
    }
}
