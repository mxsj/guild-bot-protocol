<?php

namespace Botuild\GuildBotProtocol\Networking\Packets\Events;

use Botuild\GuildBotProtocol\Networking\BasePacket;
use Botuild\GuildBotProtocol\Networking\Client\ApiClient;
use Botuild\GuildBotProtocol\Networking\Packet;
use Botuild\GuildBotProtocol\Structure\Channel;
use Botuild\GuildBotProtocol\Structure\Guild;
use Botuild\GuildBotProtocol\Structure\Member;

abstract class GuildMemberEvent implements Packet
{
    Public Member $member;

    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    public static function parse(ApiClient $client, BasePacket $packet)
    {
        $target_class = get_called_class();
        return new $target_class(Member::parse($packet->payload, $client));
    }

    public function pack(): BasePacket
    {
        $target_class = get_called_class();
        if (!$target_class instanceof Packet)
            throw new \Exception('Invalid class');
        $packet = new BasePacket(0);
        $packet->payload_type = $target_class::getPacketInformation()['event_name'];
        $packet->payload = $this->member->pack();
        return $packet;
    }

}