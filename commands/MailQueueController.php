<?php

/**
 * Mail Command Controller
 * 
 * @author Rochdi B. <rochdi80tn@gmail.com>
 */

namespace nterms\mailqueue;

use yii\console\Controller;

/**
 * This command processes the mail queue
 *
 * @author Rochdi B. <rochdi80tn@gmail.com>
 * @since 0.0.6
 */
class MailQueueController extends Controller
{
    /**
     * This command processes the mail queue     
     */
    public function actionIndex()
    {
        \Yii::$app->mailqueue->process();
    }
}
