<?php


namespace Botuild\GuildBotProtocol\Networking\Packets;


use Botuild\GuildBotProtocol\Networking\BasePacket;
use Botuild\GuildBotProtocol\Networking\Client\ApiClient;
use Botuild\GuildBotProtocol\Networking\Packet;

class HeartbeatAcknowledgePacket implements Packet
{

    public static function getPacketInformation(): array
    {
        return [
            'opcode' => 11,
            'name' => 'Heartbeat Acknowledgement'
        ];
    }

    public static function parse(ApiClient $client, BasePacket $packet)
    {
        return new HeartbeatAcknowledgePacket();
    }

    public function pack(): BasePacket
    {
        return new BasePacket(11);
    }
}