<?php
/**
 * Edit a Campaign.
 */
use \MyRadio\MyRadio\CoreUtils;
use \MyRadio\MyRadio\URLUtils;
use \MyRadio\ServiceAPI\MyRadio_Banner;
use \MyRadio\ServiceAPI\MyRadio_BannerCampaign;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Submitted
    $data = MyRadio_BannerCampaign::getForm()->readValues();

    if (empty($data['id'])) {
        //create new
        $campaign = MyRadio_BannerCampaign::create(
            MyRadio_Banner::getInstance($data['bannerid']),
            $data['location'],
            $data['effective_from'],
            $data['effective_to'],
            $data['timeslots']
        );
    } else {
        //submit edit
        $campaign = MyRadio_BannerCampaign::getInstance($data['id']);

        $campaign->clearTimeslots();

        foreach ($data['timeslots'] as $timeslot) {
            $campaign->addTimeslot($timeslot['day'], $timeslot['start_time'], $timeslot['end_time']);
        }

        $campaign->setEffectiveFrom($data['effective_from'])
            ->setEffectiveTo($data['effective_to'])
            ->setLocation($data['location']);
    }

    URLUtils::backWithMessage('Campaign Updated!');
} else {
    //Not Submitted

    if (isset($_REQUEST['campaignid'])) {
        //edit form

            $campaign = MyRadio_BannerCampaign::getInstance($_REQUEST['campaignid']);
        $campaign->getEditForm()
                ->render(
                    [
                    'campaignStart' => CoreUtils::happyTime($campaign->getEffectiveFrom()),
                    'bannerName' => $campaign->getBanner()->getAlt(),
                    ]
                );
    } else {
        //create form

        if (!isset($_REQUEST['bannerid'])) {
            throw new MyRadioException('You must provide a bannerid', 400);
        }

        $banner = MyRadio_Banner::getInstance($_REQUEST['bannerid']);

        MyRadio_BannerCampaign::getForm($banner->getBannerID())
            ->render(
                [
                'bannerName' => $banner->getAlt(),
                ]
            );
    }
}
