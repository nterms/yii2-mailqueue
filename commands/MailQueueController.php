<?php

/**
 * Mail Command Controller
 * 
 * @author Rochdi B. <rochdi80tn@gmail.com>
 */

namespace nterms\mailqueue\commands;

use yii\console\Controller;

/**
 * This command processes the mail queue
 *
 * @author Rochdi B. <rochdi80tn@gmail.com>
 * @since 0.0.6
 */
class MailQueueController extends Controller
{
    
    public $defaultAction = 'process';
      
    /**
     * This command processes the mail queue     
     */
    public function actionProcess()
    {
        \Yii::$app->mailqueue->process();
    }
}
