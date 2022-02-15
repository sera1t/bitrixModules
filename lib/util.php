<?php

namespace Bitrix\MyOrder;
use Bitrix\Main;
class Util
{
    public static function OnSaleOrderBeforeSaved(Main\Event $event)
    {
        /** @var Order $order */
        $order = $event->getParameter("ENTITY");
        $order->setField('COMMENTS', 'New comments');
        $event->addResult(
            new Main\EventResult(
                Main\EventResult::SUCCESS, $order
            )
        );
        AddMessage2Log('Module is work','test');
    }
}
?>
