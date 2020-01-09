<?php

namespace Gamesmkt\Fishpond;

use Carbon\Carbon;
use Gamesmkt\Fishpond\Config;

interface BetRecordFormatInterface
{
    public function __construct(Config $config);

    public function getPlayerName($reocrd): string;

    public function getGameId($reocrd): string;

    public function getStatus($reocrd): int;

    public function getBetAmount($reocrd): string;

    public function getValidBetAmount($reocrd): string;

    public function getPayment($reocrd): ?string;

    public function getWinloss($reocrd): ?string;

    public function formatDateTime($record): ?Carbon;
}
