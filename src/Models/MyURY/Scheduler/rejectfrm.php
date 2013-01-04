<?php

/**
 *
 * @todo Proper Documentation
 * @author Lloyd Wallis <lpw@ury.org.uk>
 * @version 02012013
 * @package MyURY_Scheduler
 */
$form = (new MyURYForm('sched_reject', $module, 'doReject',
                array(
                    'debug' => false,
                    'title' => 'Reject Season Application'
                )
        ))->addField(
                new MyURYFormField('season_id', MyURYFormField::TYPE_HIDDEN)
        )->addField(
                new MyURYFormField('reason', MyURYFormField::TYPE_BLOCKTEXT,
                        array(
                            'label' => 'Reason for Rejection: '
                ))
        )->addField(
        new MyURYFormField('notify_user', MyURYFormField::TYPE_CHECK,
                array(
                    'label' => 'Notify the Applicant via Email?',
                    'options' => array('checked' => true),
                    'required' => false
        ))
);